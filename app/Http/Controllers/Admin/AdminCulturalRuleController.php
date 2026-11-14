<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CulturalRule;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCulturalRuleController extends Controller
{
    /**
     * Display a listing of cultural rules.
     */
    public function index(Request $request): View
    {
        $locations = Location::orderBy('name')->get();
        $query = CulturalRule::with('location');

        if ($locationId = $request->input('location_id')) {
            $query->where('location_id', $locationId);
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('source_name', 'like', "%{$search}%");
            });
        }

        $rules = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.rules.index', compact('rules', 'locations'));
    }

    /**
     * Show the form for creating a new cultural rule.
     */
    public function create(Request $request): View
    {
        $locations = Location::orderBy('name')->get();
        $selectedLocationId = $request->input('location_id');

        return view('admin.rules.create', compact('locations', 'selectedLocationId'));
    }

    /**
     * Store a newly created cultural rule in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
            'category' => ['required', 'string', 'in:dress_code,sacred_area,behavior,photography,general'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'source_name' => ['nullable', 'string', 'max:255'],
            'source_url' => ['nullable', 'string', 'max:255'],
            'is_verified' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'location_id.required' => 'Pilih destinasi budaya untuk aturan ini.',
            'category.required' => 'Kategori aturan wajib dipilih.',
            'title.required' => 'Judul aturan wajib diisi.',
            'content.required' => 'Penjelasan isi aturan wajib diisi.',
        ]);

        $validated['is_verified'] = $request->boolean('is_verified', true);
        $validated['is_active'] = $request->boolean('is_active', true);

        $rule = CulturalRule::create($validated);

        return redirect()->route('admin.cultural-rules.index', ['location_id' => $rule->location_id])
            ->with('success', "Aturan budaya '{$rule->title}' berhasil ditambahkan!");
    }

    /**
     * Show the form for editing the specified cultural rule.
     */
    public function edit(CulturalRule $culturalRule): View
    {
        $locations = Location::orderBy('name')->get();
        return view('admin.rules.edit', compact('culturalRule', 'locations'));
    }

    /**
     * Update the specified cultural rule in storage.
     */
    public function update(Request $request, CulturalRule $culturalRule): RedirectResponse
    {
        $validated = $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
            'category' => ['required', 'string', 'in:dress_code,sacred_area,behavior,photography,general'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'source_name' => ['nullable', 'string', 'max:255'],
            'source_url' => ['nullable', 'string', 'max:255'],
            'is_verified' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'location_id.required' => 'Pilih destinasi budaya untuk aturan ini.',
            'category.required' => 'Kategori aturan wajib dipilih.',
            'title.required' => 'Judul aturan wajib diisi.',
            'content.required' => 'Penjelasan isi aturan wajib diisi.',
        ]);

        $validated['is_verified'] = $request->boolean('is_verified');
        $validated['is_active'] = $request->boolean('is_active');

        $culturalRule->update($validated);

        return redirect()->route('admin.cultural-rules.index', ['location_id' => $culturalRule->location_id])
            ->with('success', "Aturan budaya '{$culturalRule->title}' berhasil diperbarui!");
    }

    /**
     * Toggle verification status.
     */
    public function toggleVerify(CulturalRule $culturalRule): RedirectResponse
    {
        $culturalRule->update(['is_verified' => ! $culturalRule->is_verified]);
        $status = $culturalRule->is_verified ? 'terverifikasi' : 'belum terverifikasi';

        return back()->with('success', "Status aturan '{$culturalRule->title}' diubah menjadi {$status}.");
    }

    /**
     * Remove the specified cultural rule from storage.
     */
    public function destroy(CulturalRule $culturalRule): RedirectResponse
    {
        $title = $culturalRule->title;
        $locationId = $culturalRule->location_id;
        $culturalRule->delete();

        return redirect()->route('admin.cultural-rules.index', ['location_id' => $locationId])
            ->with('success', "Aturan budaya '{$title}' berhasil dihapus.");
    }
}

