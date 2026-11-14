<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSettingController extends Controller
{
    /**
     * Show the front page settings form.
     */
    public function index(): View
    {
        $settings = [
            'hero_title_1' => SiteSetting::get('hero_title_1', 'Discover Bali.'),
            'hero_title_2' => SiteSetting::get('hero_title_2', 'Respect Its Culture.'),
            'hero_subtitle' => SiteSetting::get('hero_subtitle', 'Pemandu AI Budaya & Etika Bali berbasis rujukan resmi Surat Edaran Gubernur Bali No. 4/2023 dan Awig-Awig Desa Adat.'),
            'announcement_banner' => SiteSetting::get('announcement_banner', ''),
            'about_heading' => SiteSetting::get('about_heading', 'Menjaga Kesucian & Harmoni Jagat Bali'),
            'about_p1' => SiteSetting::get('about_p1', 'Bali bukan sekadar destinasi liburan tropis dunia; Pulau Dewata adalah ruang hidup spiritual yang sakral dengan tatanan nilai kearifan lokal Tri Hita Karana yang diwariskan turun-temurun.'),
            'about_p2' => SiteSetting::get('about_p2', 'Santi hadir sebagai asisten digital kebudayaan pertama di Bali yang menjembatani wisatawan dengan adat istiadat setempat melalui konsultasi interaktif berbasis kecerdasan buatan terverifikasi.'),
            'about_highlight' => SiteSetting::get('about_highlight', 'Pedoman berlandaskan regulasi resmi pemerintah & Awig-Awig desa adat yang terverifikasi.'),
            'emergency_phone_112' => SiteSetting::get('emergency_phone_112', '112'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the front page settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_title_1' => ['required', 'string', 'max:255'],
            'hero_title_2' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string'],
            'announcement_banner' => ['nullable', 'string', 'max:500'],
            'about_heading' => ['required', 'string', 'max:255'],
            'about_p1' => ['required', 'string'],
            'about_p2' => ['required', 'string'],
            'about_highlight' => ['nullable', 'string', 'max:255'],
            'emergency_phone_112' => ['required', 'string', 'max:50'],
        ], [
            'hero_title_1.required' => 'Judul Hero baris 1 wajib diisi.',
            'hero_title_2.required' => 'Judul Hero baris 2 wajib diisi.',
            'hero_subtitle.required' => 'Subjudul Hero wajib diisi.',
            'about_heading.required' => 'Judul Tentang Kami wajib diisi.',
            'about_p1.required' => 'Paragraf 1 Tentang Kami wajib diisi.',
            'about_p2.required' => 'Paragraf 2 Tentang Kami wajib diisi.',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Konten Halaman Depan berhasil diperbarui dan langsung tampil di website publik!');
    }
}

