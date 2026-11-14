<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminLocationController extends Controller
{
    /**
     * Display a listing of destinations.
     */
    public function index(Request $request): View
    {
        $query = Location::withCount('culturalRules');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('is_active', $request->boolean('status'));
        }

        $locations = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create(): View
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:locations,slug'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama destinasi wajib diisi.',
            'description.required' => 'Deskripsi destinasi wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan oleh destinasi lain.',
        ]);

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        // Ensure unique slug if auto-generated duplicate
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Location::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $location = Location::create($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', "Destinasi '{$location->name}' berhasil ditambahkan!");
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit(Location $location): View
    {
        $location->loadCount('culturalRules');
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('locations', 'slug')->ignore($location->id)],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama destinasi wajib diisi.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan oleh destinasi lain.',
            'description.required' => 'Deskripsi destinasi wajib diisi.',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);
        $validated['is_active'] = $request->boolean('is_active');

        $location->update($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', "Destinasi '{$location->name}' berhasil diperbarui!");
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggle(Location $location): RedirectResponse
    {
        $location->update(['is_active' => ! $location->is_active]);
        $status = $location->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Status destinasi '{$location->name}' berhasil {$status}.");
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        $name = $location->name;
        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('success', "Destinasi '{$name}' dan seluruh aturan adatnya berhasil dihapus.");
    }
}

