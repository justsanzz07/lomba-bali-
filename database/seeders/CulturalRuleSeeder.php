<?php

namespace Database\Seeders;

use App\Models\CulturalRule;
use App\Models\Location;
use Illuminate\Database\Seeder;

class CulturalRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $besakih = Location::where('slug', 'pura-besakih')->first();
        if ($besakih) {
            $besakihRules = [
                [
                    'category' => 'dress_code',
                    'title' => 'Kewajiban Busana Sopan Adat (Kamen & Senteng)',
                    'content' => 'Setiap pengunjung wajib mengenakan busana sopan adat Bali: kain sarung (kamen) yang menutup tubuh hingga bawah lutut dan selendang (senteng/selendang kuning) yang diikat rapi di pinggang. Bahu dan dada harus tertutup; dilarang memakai tank top, crop top, celana pendek, atau pakaian transparan.',
                    'source_name' => 'Simulasi SE Gubernur Bali No. 4/2023 & Pedoman PHDI Bali',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Zona Sakral Utama Mandala (Jeroan)',
                    'content' => 'Area pelataran suci terdalam (Utama Mandala/Jeroan) khusus diperuntukkan bagi umat Hindu yang melaksanakan ritual persembahyangan suci. Wisatawan diwajibkan berada di area Jaba Tengah atau batas yang dipandu oleh pemandu lokal berlisensi.',
                    'source_name' => 'Simulasi Tata Tertib Pengelola Kawasan Suci Pura Agung Besakih',
                    'source_url' => 'https://besakih.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Mengambil Foto dan Larangan Drone',
                    'content' => 'Dilarang memotret langsung tepat di hadapan Pemangku / Pedanda yang sedang memimpin persembahyangan. Dilarang berdiri lebih tinggi dari pendeta yang sedang memimpin ritual suci atau menginjak sesajen (canang sari). Pengoperasian drone dilarang tanpa izin resmi tertulis pengelola.',
                    'source_name' => 'Simulasi Regulasi Tata Kelola Dokumentasi Desa Adat Besakih',
                    'source_url' => 'https://besakih.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Larangan Masuk Saat Periode Cuntaka / Berhalangan',
                    'content' => 'Pengunjung wanita yang sedang datang bulan (menstruasi) serta individu yang sedang dalam masa berkabung/sebel (kematian keluarga dekat) diimbau dan dilarang adat memasuki mandala pura suci guna menjaga kesucian spiritual kawasan.',
                    'source_name' => 'Simulasi Awig-Awig Adat Perlindungan Kesucian Pura',
                    'source_url' => 'https://phdi.or.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($besakihRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $besakih->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $uluwatu = Location::where('slug', 'pura-uluwatu')->first();
        if ($uluwatu) {
            $uluwatuRules = [
                [
                    'category' => 'dress_code',
                    'title' => 'Pemakaian Kamen dan Selendang Pengikat',
                    'content' => 'Wisatawan wajib mengenakan kain penutup (sarung) dan selendang kuning yang disediakan pengelola sebelum memasuki gerbang luar candi. Pakaian atas wajib menutup bagian bahu.',
                    'source_name' => 'Simulasi Standar Operasional Wisata Budaya Pura Uluwatu',
                    'source_url' => 'https://badungkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Interaksi Beradab dengan Kera Tebing',
                    'content' => 'Kawasan dihuni kelompok kera ekor panjang yang disucikan. Wisatawan dilarang memukul, melempar batu, atau menggoda satwa. Disarankan melepas atau mengamankan perhiasan berkilau, kacamata hitam, ponsel, topi, dan anting.',
                    'source_name' => 'Simulasi Panduan Keamanan Pengelola Obyek Wisata Uluwatu',
                    'source_url' => 'https://badungkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Batas Jalur Tebing dan Pura Dalam',
                    'content' => 'Pengunjung umum hanya diperkenankan menyusuri jalan setapak tebing pemandangan dan panggung pertunjukan Tari Kecak. Pintu gerbang suci paduraksa ke dalam pura hanya dibuka untuk persembahyangan umat.',
                    'source_name' => 'Simulasi Tata Kelola Kawasan Suci Desa Adat Pecatu',
                    'source_url' => 'https://badungkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($uluwatuRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $uluwatu->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $tirtaEmpul = Location::where('slug', 'pura-tirta-empul')->first();
        if ($tirtaEmpul) {
            $tirtaRules = [
                [
                    'category' => 'behavior',
                    'title' => 'Tata Tertib Ritual Penyucian Melukat',
                    'content' => 'Bagi wisatawan yang mengikuti ritual melukat, wajib menggunakan kain basahan khusus melukat bermotif hijau dan selendang yang telah disediakan. Dilarang menggunakan bikini, pakaian renang, pakaian dalam terbuka, atau baju basah santai biasa.',
                    'source_name' => 'Simulasi Pedoman Pengelola Petirtaan Suci Desa Adat Manukaya Let',
                    'source_url' => 'https://gianyarkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Larangan Pemakaian Pancuran Khusus Upacara Pitra Yadnya',
                    'content' => 'Terdapat 2 pancuran air di sisi timur kolam yang disucikan khusus untuk ritual kematian / pembersihan jenazah (Pitra Yadnya) dan upacara kremasi. Wisatawan dilarang keras membasuh diri di pancuran khusus ini.',
                    'source_name' => 'Simulasi Awig-Awig Adat Tirta Empul',
                    'source_url' => 'https://gianyarkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($tirtaRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $tirtaEmpul->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $tanahLot = Location::where('slug', 'pura-tanah-lot')->first();
        if ($tanahLot) {
            $tanahLotRules = [
                [
                    'category' => 'sacred_area',
                    'title' => 'Akses Batu Karang Menyesuaikan Pasang Surut Air Laut',
                    'content' => 'Jalur jalan kaki menuju kaki batu karang pura hanya dapat diakses saat air laut surut. Petugas keamanan (Balawista) akan menutup akses ketika ombak tinggi atau air laut mulai pasang naik.',
                    'source_name' => 'Simulasi SOP Manajemen Operasional Daya Tarik Wisata Tanah Lot',
                    'source_url' => 'https://tanahlot.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Penghormatan Gua Ular Penjaga Pura',
                    'content' => 'Terdapat gua suci tempat ular laut suci yang dipercaya sebagai penjaga pura. Pengunjung dilarang bertindak gaduh, mengganggu habitat, atau mencoba mengangkat ular suci tanpa pendampingan pemangku adat.',
                    'source_name' => 'Simulasi Panduan Etika Desa Adat Beraban',
                    'source_url' => 'https://tanahlot.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($tanahLotRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $tanahLot->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $simulasi = Location::where('slug', 'pura-desa-simulasi')->first();
        if ($simulasi) {
            // Note: This rule is explicitly UNVERIFIED to test system handling for unverified data!
            CulturalRule::updateOrCreate(
                [
                    'location_id' => $simulasi->id,
                    'title' => 'Catatan Unverified Komunitas Wisatawan (Draft Uji Coba)',
                ],
                [
                    'category' => 'general',
                    'title' => 'Catatan Unverified Komunitas Wisatawan (Draft Uji Coba)',
                    'content' => 'Catatan kiriman wisatawan anonim yang belum melalui verifikasi pengelola adat dan belum disahkan oleh otoritas kebudayaan setempat.',
                    'source_name' => null,
                    'source_url' => null,
                    'is_verified' => false,
                    'is_active' => true,
                ]
            );
        }
    }
}
