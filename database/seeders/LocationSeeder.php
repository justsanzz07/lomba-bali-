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
                'name' => 'Seluruh Wisata & Budaya Bali',
                'slug' => 'seluruh-bali',
                'description' => 'Panduan komprehensif etika adat, tata krama budaya, dan regulasi resmi SE Gubernur Bali No. 4/2023 untuk seluruh destinasi pariwisata di Bali (pantai, pura, desa adat, gunung, geopark, dan seni budaya).',
                'address' => 'Provinsi Bali (9 Kabupaten & Kota)',
                'is_active' => true,
            ],
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
                'name' => 'Desa Wisata Adat Penglipuran',
                'slug' => 'desa-penglipuran',
                'description' => 'Desa adat Bali kuno yang dinobatkan sebagai salah satu desa terbersih di dunia, terkenal dengan tata ruang Tri Mandala, arsitektur angkul-angkul bambu seragam, dan hutan bambu lindung.',
                'address' => 'Jl. Penglipuran, Kelurahan Kubu, Kabupaten Bangli, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Lanskap Budaya Subak Jatiluwih (UNESCO)',
                'slug' => 'jatiluwih-rice-terraces',
                'description' => 'Kawasan ekowisata dan warisan budaya dunia UNESCO seluas 600 hektar terasering sawah hijau berundak, mempertahankan filosofi Tri Hita Karana melalui sistem irigasi Subak tradisional sejak abad ke-9.',
                'address' => 'Jl. Jatiluwih, Kec. Penebel, Kabupaten Tabanan, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Pantai Kuta & Pesisir Bali Selatan',
                'slug' => 'pantai-kuta',
                'description' => 'Kawasan wisata pantai pasir putih legendaris dengan panorama matahari terbenam spektakuler, tempat selancar dunia, dan ruang publik pesisir yang terikat tata kelola Desa Adat Kuta.',
                'address' => 'Jl. Pantai Kuta, Kec. Kuta, Kabupaten Badung, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Garuda Wisnu Kencana (GWK) Cultural Park',
                'slug' => 'gwk-cultural-park',
                'description' => 'Taman budaya ikonik seluas 60 hektar dengan mahakarya patung tembaga Dewa Wisnu menunggangi Garuda setinggi 121 meter, amfiteater pementasan tari tradisional, dan pusat seni Bali.',
                'address' => 'Jl. Raya Uluwatu, Ungasan, Kec. Kuta Selatan, Kabupaten Badung, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Mandala Suci Wenara Wana (Ubud Monkey Forest)',
                'slug' => 'ubud-monkey-forest',
                'description' => 'Cagar alam dan kompleks suci hutan lindung seluas 12,5 hektar yang dihuni ratusan kera ekor panjang sakral dan tiga pura suci kuno yang dikelola oleh Desa Adat Padangtegal Ubud.',
                'address' => 'Jl. Monkey Forest, Ubud, Kec. Ubud, Kabupaten Gianyar, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Kawasan Geopark Gunung & Danau Batur Kintamani',
                'slug' => 'gunung-batur-kintamani',
                'description' => 'Kawasan kaldera gunung berapi sakral berstatus UNESCO Global Geopark dengan panorama danau bulan sabit, jalur pendakian matahari terbit sakral, dan kearifan masyarakat Bali Aga.',
                'address' => 'Kecamatan Kintamani, Kabupaten Bangli, Bali',
                'is_active' => true,
            ],
            [
                'name' => 'Kawasan Simulasi Pariwisata (Uji Coba Sistem)',
                'slug' => 'pura-desa-simulasi',
                'description' => 'Destinasi simulasi uji coba untuk mendemonstrasikan penanganan lokasi pariwisata yang belum memiliki aturan adat resmi terverifikasi.',
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
