<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'hero_title_1',
                'value' => 'Discover Bali.',
                'description' => 'Judul baris pertama di Hero Banner',
            ],
            [
                'key' => 'hero_title_2',
                'value' => 'Respect Its Culture.',
                'description' => 'Judul baris kedua di Hero Banner',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Asisten virtual kebudayaan cerdas berbasis AI yang memandu wisatawan nusantara dan mancanegara memahami tata krama adat, kesucian pura, etika berbusana, dan regulasi resmi SE Gubernur Bali No. 4/2023.',
                'description' => 'Deskripsi pendukung di Hero Banner',
            ],
            [
                'key' => 'announcement_banner',
                'value' => 'Tatanan Baru Wisatawan Bali: Patuhi Surat Edaran Gubernur Bali No. 4 Tahun 2023 demi menjaga kesucian alam, pura, dan budaya Bali.',
                'description' => 'Pita Pengumuman Khusus di atas halaman depan (kosongkan jika tidak aktif)',
            ],
            [
                'key' => 'about_heading',
                'value' => 'Menjaga Kesucian & Harmoni Jagat Bali',
                'description' => 'Judul utama di bagian Tentang Kami',
            ],
            [
                'key' => 'about_p1',
                'value' => 'Bali bukan sekadar destinasi liburan tropis dunia; Pulau Dewata adalah ruang hidup spiritual yang sakral dengan tatanan nilai kearifan lokal Tri Hita Karana yang diwariskan turun-temurun.',
                'description' => 'Paragraf pertama bagian Tentang Kami',
            ],
            [
                'key' => 'about_p2',
                'value' => 'Santi hadir sebagai asisten digital kebudayaan pertama di Bali yang menjembatani wisatawan dengan adat istiadat setempat melalui konsultasi interaktif berbasis kecerdasan buatan terverifikasi.',
                'description' => 'Paragraf kedua bagian Tentang Kami',
            ],
            [
                'key' => 'about_highlight',
                'value' => 'Pedoman berlandaskan regulasi resmi pemerintah & Awig-Awig desa adat yang terverifikasi.',
                'description' => 'Teks sorotan di bawah Tentang Kami',
            ],
            [
                'key' => 'emergency_phone_112',
                'value' => '112',
                'description' => 'Nomor Kontak Darurat Wisatawan',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
