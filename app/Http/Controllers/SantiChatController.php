<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SantiChatController extends Controller
{
    public function __construct(
        protected GeminiService $geminiService
    ) {}

    /**
     * Display the Santi Landing Page with Bali cultural identity.
     */
    public function index(): View
    {
        $locations = Location::active()
            ->withCount(['culturalRules as verified_rules_count' => function ($query) {
                $query->where('is_verified', true)->where('is_active', true);
            }])
            ->get();

        return view('landing', compact('locations'));
    }

    /**
     * Display dedicated location selection page (for direct QR scan and discovery).
     */
    public function locations(): View
    {
        $locations = Location::active()
            ->with(['verifiedCulturalRules'])
            ->get();

        return view('locations', compact('locations'));
    }

    /**
     * Display the AI Cultural Assistant for a specific location.
     */
    public function show(Location $location): View
    {
        if (! $location->is_active) {
            abort(404, 'Lokasi budaya ini sedang tidak aktif.');
        }

        $location->load('verifiedCulturalRules');
        $allLocations = Location::active()->where('id', '!=', $location->id)->get();

        $suggestedQuestions = [
            'id' => [
                'Apakah saya boleh mengenakan celana pendek saat berkunjung ke sini?',
                'Apa saja ketentuan busana yang wajib dipatuhi di pura ini?',
                'Bolehkah saya mengambil foto atau video saat upacara berlangsung?',
                'Aktivitas apa saja yang dilarang keras di kawasan suci ini?',
                'Hal apa yang wajib saya ketahui sebelum melangkah ke area utama pura?',
            ],
            'en' => [
                'Can I wear shorts when visiting this temple?',
                'What are the clothing and dress code requirements?',
                'Can I take photographs or videos inside the temple?',
                'What activities are strictly prohibited in this sacred area?',
                'What should I know before entering this sacred sanctuary?',
            ],
        ];

        return view('chat', compact('location', 'allLocations', 'suggestedQuestions'));
    }

    /**
     * Handle incoming chat requests to Santi AI.
     */
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'location_slug' => ['required', 'string', 'exists:locations,slug'],
            'language' => ['nullable', 'in:id,en'],
            'history' => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['required_with:history', 'in:user,assistant,model'],
            'history.*.content' => ['required_with:history', 'string', 'max:1500'],
        ], [
            'message.required' => 'Pertanyaan tidak boleh kosong.',
            'message.max' => 'Pertanyaan maksimal 1000 karakter.',
            'location_slug.exists' => 'Lokasi yang dipilih tidak ditemukan.',
        ]);

        $location = Location::where('slug', $validated['location_slug'])
            ->where('is_active', true)
            ->first();

        if (! $location) {
            return response()->json([
                'status' => 'error',
                'answer' => 'Lokasi yang dipilih sedang tidak aktif atau tidak ditemukan.',
                'location' => null,
                'sources' => [],
            ], 404);
        }

        $verifiedRules = $location->verifiedCulturalRules()->get();
        $language = $validated['language'] ?? 'id';
        $history = $validated['history'] ?? [];

        $response = $this->geminiService->generateCulturalGuidance(
            $location,
            $verifiedRules,
            $validated['message'],
            $history,
            $language
        );

        return response()->json($response);
    }
}
