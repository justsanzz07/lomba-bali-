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
        $seluruhBali = Location::where('slug', 'seluruh-bali')->first();
        if ($seluruhBali) {
            $seluruhBaliRules = [
                [
                    'category' => 'dress_code',
                    'title' => 'Etika Berbusana di Pantai vs Ruang Publik (SE Gubernur No. 4/2023)',
                    'content' => 'Pakaian renang (bikini, baju renang, atau bertelanjang dada) hanya pantas dikenakan di area pasir pantai atau kolam renang. Saat melangkah keluar pantai menuju jalan raya umum, pertokoan, restoran, atau permukiman, wisatawan wajib mengenakan pakaian penutup yang sopan. Saat memasuki pura atau tempat suci, wajib mengenakan kamen menutup hingga bawah lutut dan selendang senteng.',
                    'source_name' => 'Surat Edaran Gubernur Bali No. 4 Tahun 2023 & Awig-Awig Adat',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Menghormati Kesucian Pura, Puncak Gunung, dan Pohon Sakral',
                    'content' => 'Dilarang memasuki pelataran Utama Mandala (Jeroan) tempat suci/pura bagi wisatawan yang tidak bersembahyang atau yang sedang dalam masa cuntaka (menstruasi/masa berkabung). Gunung dan pohon-pohon besar di Bali disucikan sebagai stana dewa; dilarang keras berfoto tanpa busana (telanjang), memanjat pohon sakral, atau merusak ornamen suci.',
                    'source_name' => 'Pedoman PHDI Bali & SE Gubernur Bali No. 4/2023',
                    'source_url' => 'https://phdi.or.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Kesantunan Sosial, Upacara Adat, dan Canang Sari',
                    'content' => 'Wisatawan wajib berperilaku santun, bertutur kata sopan, dan menghormati prosesi upacara keagamaan di jalan (tidak memotong barisan iring-iringan upacara atau berdiri lebih tinggi dari pemangku/pendeta). Jangan pernah menginjak atau melangkahi canang sari yang diletakkan di trotoar atau jalan.',
                    'source_name' => 'Tata Krama Adat Krama Bali & SE Gubernur No. 4/2023',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Dokumentasi Foto, Video, dan Pengoperasian Drone',
                    'content' => 'Dilarang berpose tidak senonoh atau provokatif di seluruh ruang publik dan kawasan sakral. Dilarang menggunakan lampu kilat (flash) ke arah mata penari/pemangku dalam ritual sakral. Pengoperasian drone di atas pura suci dan prosesi keagamaan dilarang keras tanpa izin resmi tertulis.',
                    'source_name' => 'Regulasi Dokumentasi Budaya Bali & SE No. 4/2023',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'general',
                    'title' => 'Tata Tertib Resmi Wisatawan Mancanegara & Domestik di Bali',
                    'content' => 'Wisatawan wajib bertransaksi menggunakan mata uang Rupiah dan kode QRIS resmi Indonesia. Saat menyewa kendaraan bermotor, wajib memiliki SIM internasional/nasional yang sah, mengenakan helm berstandar SNI, dan tertib berlalu lintas. Dilarang keras melakukan aktivitas komersial/bekerja ilegal tanpa visa kerja resmi.',
                    'source_name' => 'Surat Edaran Gubernur Bali No. 4 Tahun 2023 & Regulasi Imigrasi',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($seluruhBaliRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $seluruhBali->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $ulunDanu = Location::where('slug', 'pura-ulun-danu-beratan')->first();
        if ($ulunDanu) {
            $ulunDanuRules = [
                [
                    'category' => 'dress_code',
                    'title' => 'Ketentuan Busana Kamen dan Selendang',
                    'content' => 'Pengunjung wajib mengenakan kain penutup (kamen/sarung) dan selendang pengikat pinggang saat melangkah memasuki pelataran batas suci pura. Pakaian atas wajib sopan dan menutup bahu.',
                    'source_name' => 'Simulasi SOP Pengelola DTW Ulun Danu Beratan',
                    'source_url' => 'https://ulundanuberatan.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Zona Suci Meru Terapung di Danau',
                    'content' => 'Pelinggih Meru 11 tingkat di atas danau merupakan linggih pemujaan Sang Hyang Danu. Wisatawan dilarang mendekati dengan wahana air melampaui tali pelampung batas suci atau memanjat struktur candi.',
                    'source_name' => 'Simulasi Awig-Awig Adat Desa Candikuning',
                    'source_url' => 'https://tabanankab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Foto dan Larangan Drone Tanpa Izin',
                    'content' => 'Pengambilan foto dari daratan taman diperbolehkan. Dilarang menerbangkan drone di atas area pelinggih suci tanpa izin resmi dari kantor pengelola objek wisata.',
                    'source_name' => 'Simulasi Panduan Etika Kunjungan Kawasan Danau Beratan',
                    'source_url' => 'https://ulundanuberatan.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($ulunDanuRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $ulunDanu->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

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

        $penglipuran = Location::where('slug', 'desa-penglipuran')->first();
        if ($penglipuran) {
            $penglipuranRules = [
                [
                    'category' => 'behavior',
                    'title' => 'Zona Bebas Kendaraan Bermotor & Larangan Merokok',
                    'content' => 'Kawasan utama desa adat Penglipuran merupakan zona steril kendaraan bermotor demi menjaga kualitas udara dan ketenangan lingkungan. Dilarang merokok di sepanjang jalur pemukiman utama; merokok hanya diperbolehkan di area khusus yang telah disediakan pengelola desa.',
                    'source_name' => 'Awig-Awig Desa Adat Penglipuran & Pengelola Desa Wisata',
                    'source_url' => 'https://penglipuran.net',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'dress_code',
                    'title' => 'Etika Busana Sopan & Memasuki Pekarangan Rumah Warga',
                    'content' => 'Wisatawan wajib mengenakan pakaian yang sopan (menutup pundak dan paha). Saat berkunjung atau memotret ke dalam pekarangan rumah tradisional warga melalui gerbang angkul-angkul, pengunjung wajib mengucapkan salam "Om Swastiastu" dengan ramah dan tidak memasuki area pribadi sanggah (pelinggih keluarga) tanpa seizin tuan rumah.',
                    'source_name' => 'Pedoman Kunjungan Desa Wisata Penglipuran & SE Gubernur Bali No. 4/2023',
                    'source_url' => 'https://penglipuran.net',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Kelestarian Hutan Bambu Suci & Larangan Mengambil Flora',
                    'content' => 'Hutan bambu seluas 45 hektar di utara desa adalah hutan lindung resapan air dan kawasan sakral desa adat. Wisatawan dilarang mematahkan bambu, mencoret-coret batang bambu, merusak vegetasi, atau membuang sampah dalam bentuk apa pun di jalur hutan.',
                    'source_name' => 'Awig-Awig Perlindungan Hutan Adat Penglipuran',
                    'source_url' => 'https://penglipuran.net',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Fotografi Warga & Kegiatan Keseharian',
                    'content' => 'Pengambilan foto lanskap tata ruang desa diperkenankan. Namun untuk memotret aktivitas warga lokal atau tetua adat yang sedang beraktivitas secara dekat, mohon meminta izin secara santun terlebih dahulu guna menghormati privasi warga.',
                    'source_name' => 'Panduan Etika Wisatawan Desa Adat Penglipuran',
                    'source_url' => 'https://penglipuran.net',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($penglipuranRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $penglipuran->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $jatiluwih = Location::where('slug', 'jatiluwih-rice-terraces')->first();
        if ($jatiluwih) {
            $jatiluwihRules = [
                [
                    'category' => 'sacred_area',
                    'title' => 'Penghormatan Sistem Subak & Pelinggih Pura Bedugul',
                    'content' => 'Sistem irigasi Subak Jatiluwih adalah warisan budaya dunia UNESCO yang sarat nilai spiritual Tri Hita Karana. Wisatawan dilarang memanjat atau menginjak pelinggih Pura Bedugul (kuil pemujaan Dewi Sri di petak sawah) serta dilarang memanipulasi saluran air irigasi yang mengalir.',
                    'source_name' => 'SOP Pengelola Daya Tarik Wisata Jatiluwih & Badan Pengelola UNESCO',
                    'source_url' => 'https://jatiluwih.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Etika Melintasi Pematang Sawah & Larangan Sampah Plastik',
                    'content' => 'Pengunjung diwajibkan berjalan di jalur setapak resmi (trekking route). Dilarang menginjak atau merusak tanaman padi yang sedang tumbuh. Kawasan ini menerapkan kebijakan bebas sampah plastik; pengunjung wajib membawa kembali sampah anorganik masing-masing.',
                    'source_name' => 'Peraturan Desa Adat Jatiluwih & Awig-Awig Subak',
                    'source_url' => 'https://jatiluwih.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Drone & Dokumentasi Aktivitas Petani',
                    'content' => 'Penggunaan drone untuk tujuan komersial atau sinematik wajib mendaftar ke pos pengelola resmi guna mencegah gangguan terhadap satwa burung sawah dan ketenteraman petani yang sedang membajak atau menanam.',
                    'source_name' => 'Regulasi Dokumentasi Kawasan Ekowisata Jatiluwih',
                    'source_url' => 'https://jatiluwih.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'dress_code',
                    'title' => 'Pakaian Nyaman Ekowisata yang Tetap Sopan',
                    'content' => 'Disarankan mengenakan alas kaki anti-selip untuk jalur tanah sawah. Meskipun berada di area alam terbuka, pakaian tetap harus sopan (tidak hanya mengenakan pakaian renang/bikini di jalur desa dan sawah umum).',
                    'source_name' => 'SE Gubernur Bali No. 4/2023 tentang Tata Krama Wisatawan',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($jatiluwihRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $jatiluwih->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $pantaiKuta = Location::where('slug', 'pantai-kuta')->first();
        if ($pantaiKuta) {
            $kutaRules = [
                [
                    'category' => 'dress_code',
                    'title' => 'Etika Busana Renang & Larangan Bertelanjang Dada di Jalan Raya',
                    'content' => 'Pakaian renang (bikini, baju renang, celana pendek pantai) hanya pantas dikenakan di area pasir pantai. Wisatawan dilarang keras berjalan keluar kawasan pantai ke jalan raya, toko, restoran umum, atau area pemukiman desa hanya mengenakan pakaian renang atau bertelanjang dada.',
                    'source_name' => 'Surat Edaran Gubernur Bali No. 4/2023 & Peraturan Desa Adat Kuta',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Penghormatan Sesajen Canang Sari di Pasir Pantai',
                    'content' => 'Masyarakat dan nelayan lokal kerap meletakkan sesajen canang sari dan dupa di tepi pantai sebagai wujud syukur kepada Batara Baruna (dewa penguasa laut). Wisatawan dilarang melangkahi, menendang, atau menduduki sesajen tersebut.',
                    'source_name' => 'Awig-Awig Tradisi Pesisir Desa Adat Kuta',
                    'source_url' => 'https://badungkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Keselamatan Laut Balawista & Larangan Membuang Sampah Plastik',
                    'content' => 'Patuhi rambu bendera keselamatan dari tim penyelamat pantai (Balawista). Dilarang keras berenang di zona bendera merah. Kawasan pantai menerapkan bebas sampah plastik; dilarang meninggalkan botol plastik, puntung rokok, atau sampah kemasan di pasir.',
                    'source_name' => 'SOP Balawista Badung & Perda Pengurangan Sampah Plastik Bali No. 97/2018',
                    'source_url' => 'https://badungkab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($kutaRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $pantaiKuta->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $gwk = Location::where('slug', 'gwk-cultural-park')->first();
        if ($gwk) {
            $gwkRules = [
                [
                    'category' => 'behavior',
                    'title' => 'Penghormatan Ikon Kebudayaan Dewa Wisnu & Garuda',
                    'content' => 'Patung Garuda Wisnu Kencana merupakan mahakarya seni yang merepresentasikan nilai luhur pemeliharaan alam semesta dalam filsafat Hindu Bali. Pengunjung diimbau bersikap santun, menjaga kebersihan, dan tidak memanjat struktur relief patung.',
                    'source_name' => 'Tata Tertib Kawasan Taman Budaya GWK',
                    'source_url' => 'https://gwkbali.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'photography',
                    'title' => 'Etika Menyaksikan Pementasan Tari Tradisional & Fotografi',
                    'content' => 'Saat menyaksikan pementasan Tari Kecak, Barong, atau Legong di amfiteater, dilarang menyalakan lampu kilat (flash) kamera langsung ke arah mata penari. Pengoperasian drone wajib memiliki izin tertulis dari manajemen GWK.',
                    'source_name' => 'Pedoman Penonton Pementasan Seni Budaya GWK',
                    'source_url' => 'https://gwkbali.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($gwkRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $gwk->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $monkeyForest = Location::where('slug', 'ubud-monkey-forest')->first();
        if ($monkeyForest) {
            $mfRules = [
                [
                    'category' => 'behavior',
                    'title' => 'Etika Berinteraksi dengan Kera Sakral & Larangan Makanan Luar',
                    'content' => 'Kera ekor panjang di Wenara Wana disucikan oleh masyarakat adat Padangtegal. Dilarang menyentuh kera, dilarang menatap mata kera secara agresif, dan dilarang memberi makanan ringan dari luar (snack, permen, roti). Amankan kacamata, anting, dan tas.',
                    'source_name' => 'SOP Pengelola Mandala Suci Wenara Wana Ubud',
                    'source_url' => 'https://monkeyforestubud.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'sacred_area',
                    'title' => 'Kawasan Suci Pura Dalem Agung Padangtegal di Dalam Hutan',
                    'content' => 'Di dalam kawasan hutan terdapat Pura Dalem Agung Padangtegal yang sakral. Wisatawan hanya diperbolehkan melihat dari pelataran luar; dilarang melangkah ke area persembahyangan suci kecuali mengenakan pakaian adat lengkap dan didampingi prajuru.',
                    'source_name' => 'Awig-Awig Desa Adat Padangtegal Ubud',
                    'source_url' => 'https://monkeyforestubud.com',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($mfRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $monkeyForest->id, 'title' => $rule['title']],
                    $rule
                );
            }
        }

        $batur = Location::where('slug', 'gunung-batur-kintamani')->first();
        if ($batur) {
            $baturRules = [
                [
                    'category' => 'sacred_area',
                    'title' => 'Kesucian Puncak Gunung Sakral & Larangan Perbuatan Asusila',
                    'content' => 'Gunung-gunung di Bali disucikan sebagai stana dewa dan hulu spiritual pulau. Berdasarkan SE Gubernur Bali No. 4/2023, wisatawan dilarang keras berfoto tanpa busana/tidak senonoh, memanjat pohon keramat, atau melakukan tindakan amoral di kawasan puncak dan kaldera.',
                    'source_name' => 'Surat Edaran Gubernur Bali No. 4/2023 & Awig-Awig Desa Adat Batur',
                    'source_url' => 'https://baliprov.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
                [
                    'category' => 'behavior',
                    'title' => 'Kewajiban Pemandu Lokal Resmi & Bebas Sampah Gunung',
                    'content' => 'Wisatawan yang mendaki matahari terbit diwajibkan menggunakan jasa pemandu lokal resmi (HPPGB Kintamani) demi keselamatan di jalur bebatuan vulkanik. Wajib membawa kembali seluruh sampah kemasan/plastik turun ke pos bawah.',
                    'source_name' => 'SOP Asosiasi Pemandu Gunung Batur & Dinas Pariwisata Bangli',
                    'source_url' => 'https://banglikab.go.id',
                    'is_verified' => true,
                    'is_active' => true,
                ],
            ];

            foreach ($baturRules as $rule) {
                CulturalRule::updateOrCreate(
                    ['location_id' => $batur->id, 'title' => $rule['title']],
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
