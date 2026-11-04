<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Pura Ulun Danu Beratan Bedugul',
                'slug' => 'pura-ulun-danu-beratan',
                'description' => 'Pura air ikonik di tepi Danau Beratan Bedugul dengan menara meru 11 tingkat yang tampak mengapung di atas danau berkabut, didedikasikan untuk memuja Dewi Danu.',
                'address' => 'Danau Beratan, Candikuning, Kec. Baturiti, Kabupaten Tabanan, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pura Agung Besakih',
                'slug' => 'pura-besakih',
                'description' => 'Pura terbesar dan tersuci di Pulau Bali (Mother Temple) yang terletak di lereng Gunung Agung. Memiliki kompleks bertingkat yang sakral bagi umat Hindu Dharma.',
                'address' => 'Jl. Gunung Agung, Desa Besakih, Kec. Rendang, Kabupaten Karangasem, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pura Luhur Uluwatu',
                'slug' => 'pura-uluwatu',
                'description' => 'Pura Sad Kahyangan Jagat yang berdiri kokoh di atas tebing karang terjal setinggi 97 meter menjorok ke Samudra Hindia, terkenal dengan tarian Kecak dan panorama matahari terbenam.',
                'address' => 'Desa Pecatu, Kec. Kuta Selatan, Kabupaten Badung, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pura Tirta Empul Tampaksiring',
                'slug' => 'pura-tirta-empul',
                'description' => 'Pura petirtaan suci peninggalan Dinasti Warmadewa (abad ke-10) dengan kolam mata air alami suci yang digunakan untuk ritual penyucian diri (Melukat).',
                'address' => 'Jl. Tirta, Manukaya, Kec. Tampaksiring, Kabupaten Gianyar, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pura Tanah Lot',
                'slug' => 'pura-tanah-lot',
                'description' => 'Pura laut legendaris di atas bongkahan batu karang besar di lepas pantai, dibangun oleh Dang Hyang Nirartha pada abad ke-16 untuk memuja dewa laut Baruna.',
                'address' => 'Desa Beraban, Kec. Kediri, Kabupaten Tabanan, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pura Desa Simulasi (Uji Coba Sistem)',
                'slug' => 'pura-desa-simulasi',
                'description' => 'Lokasi simulasi uji coba untuk mendemonstrasikan penanganan lokasi yang belum memiliki aturan adat resmi terverifikasi.',
                'address' => 'Kawasan Laboratorium Simulasi Budaya Bali',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $loc) {
            Location::updateOrCreate(
                ['slug' => $loc['slug']],
                $loc
            );
        }
    }
}
