# SANTI — AI Cultural Guardian Bali
> **"Discover Bali. Respect Its Culture."**
> Asisten Pemandu Budaya Virtual Berbasis AI untuk Wisatawan Domestik dan Mancanegara di Kawasan Suci Bali.

---

## 1. Tentang Proyek

**Santi** adalah platform web AI Cultural Guardian yang dirancang untuk menjawab tantangan tata krama dan etika kunjungan wisatawan di pura dan situs suci Bali. Santi menjembatani pemahaman wisatawan mengenai:
- Aturan busana adat (kewajiban kain kamen & senteng/selendang).
- Batas-batas kesucian mandala pura (Utama Mandala/Jeroan vs Jaba Tengah).
- Larangan adat (pantangan cuntaka/menstruasi, masa berkabung/sebel).
- Etika fotografi, penggunaan drone, dan interaksi dengan satwa suci.

### Keunggulan Arsitektur Anti-Halusinasi
Santi tidak mengarang peraturan adat pura. Jawaban AI diground dengan **Database-Backed Context Retrieval** dari tabel `cultural_rules` yang berstatus `is_verified = true`. Jika suatu pura belum memiliki aturan resmi yang terverifikasi, Santi secara transparan mengembalikan status `insufficient_verified_information` dan menganjurkan wisatawan untuk bertanya langsung kepada prajuru adat setempat.

---

## 2. Technology Stack

- **Backend Framework**: Laravel 12 (PHP 8.4)
- **Frontend & Styling**: Laravel Blade, Tailwind CSS v4, JavaScript (ES6+ Fetch API)
- **Database**: MySQL 8.0 (Eloquent ORM, Migrations, Seeders, Factories)
- **Generative AI Engine**: Google Gemini API (`gemini-2.5-flash` / configurable via environment)
- **Architecture**: Laravel Frontend &rarr; Laravel Backend &rarr; MySQL Context &rarr; Gemini API &rarr; Verified AI Guidance
- **Testing**: PHPUnit / Laravel Test Suite (dengan `Http::fake()` untuk simulasi AI)

---

## 3. Persyaratan Sistem (Prerequisites)

Pastikan lingkungan server atau komputer pengembang telah memiliki:
1. **PHP**: Versi >= 8.2 (Direkomendasikan PHP 8.4 dengan ekstensi `pdo_mysql`, `curl`, `mbstring`, `openssl`, `intl`)
2. **Composer**: Versi >= 2.5
3. **Node.js & npm**: Node.js >= 18 dan npm >= 9
4. **MySQL Server**: Versi 8.0 atau MariaDB 10.4+

---

## 4. Panduan Instalasi Langkah-demi-Langkah

### Langkah 1: Clone Repositori dan Masuk ke Direktori
```bash
cd d:/lomba_bali
```

### Langkah 2: Instal Dependensi PHP
```bash
composer install
```

### Langkah 3: Konfigurasi File Environment (`.env`)
Salin file konfigurasi contoh:
```bash
cp .env.example .env
```
Buat application key:
```bash
php artisan key:generate
```

### Langkah 4: Buat Database MySQL
Masuk ke MySQL client dan buat database bernama `santi_bali`:
```sql
CREATE DATABASE santi_bali CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Pastikan konfigurasi koneksi pada file `.env` sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=santi_bali
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 5: Konfigurasi Kunci Google Gemini API
Dapatkan API Key gratis melalui [Google AI Studio](https://aistudio.google.com/app/apikey).
Tambahkan API Key dan nama model pada `.env`:
```env
GEMINI_API_KEY=your_actual_gemini_api_key_here
GEMINI_MODEL=gemini-2.5-flash
```

> **Catatan Pengujian Offline**: Jika API Key belum diisi, sistem tetap berfungsi dan menampilkan rujukan data aturan adat terverifikasi dari database dengan pesan notifikasi yang aman.

### Langkah 6: Jalankan Migrasi dan Database Seeder
Jalankan migrasi tabel `locations` dan `cultural_rules` beserta data simulasi demonstrasi:
```bash
php artisan migrate:fresh --seed
```

### Langkah 7: Kompilasi Aset Frontend (Tailwind CSS)
```bash
npm install
npm run build
```

---

## 5. Menjalankan Aplikasi

Jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Aplikasi web kini dapat diakses melalui peramban di:
👉 **http://localhost:8000**

---

## 6. Struktur Halaman & Fitur Aplikasi

| URL Halaman | Fungsi & Fitur Utama |
|---|---|
| `/` | **Landing Page**: Branding Santi, filosofi dresta Bali, hero headline, cara kerja, manfaat budaya, dan kartu pura unggulan. |
| `/locations` | **Katalog Lokasi Pura**: Pencarian real-time, filter pura, informasi jumlah aturan adat terverifikasi, dan akses URL QR Code. |
| `/santi/{slug}` | **AI Cultural Assistant**: Chatbot responsif, identitas lokasi aktif, ucapan "Om Swastiastu", toggle bahasa (ID/EN), pertanyaan cepat, indikator verifikasi, dan panel rujukan sumber resmi. |
| `POST /chat` | **API Endpoint**: Menerima pertanyaan wisatawan, validasi input, mengambil konteks database terverifikasi, mengirim ke Gemini API, dan mengembalikan respons terstruktur. |

### Fitur QR Code Ready
Setiap pura memiliki URL berbasis slug permanen yang ramah untuk dicetak pada papan informasi akrilik atau standee QR Code di gerbang masuk pura:
- Pura Agung Besakih: `/santi/pura-besakih`
- Pura Luhur Uluwatu: `/santi/pura-uluwatu`
- Pura Tirta Empul: `/santi/pura-tirta-empul`
- Pura Tanah Lot: `/santi/pura-tanah-lot`
- Pura Desa Simulasi (Uji Coba Unverified): `/santi/pura-desa-simulasi`

---

## 7. Panduan Menambahkan Aturan Adat Terverifikasi

Pengelola objek wisata atau kurator budaya dapat menambahkan atau memperbarui aturan resmi melalui database atau seeder:

```php
use App\Models\Location;
use App\Models\CulturalRule;

$location = Location::where('slug', 'pura-besakih')->first();

CulturalRule::create([
    'location_id' => $location->id,
    'category'    => 'dress_code', // dress_code, sacred_area, photography, behavior, general
    'title'       => 'Kewajiban Penggunaan Selendang Kuning',
    'content'     => 'Pengunjung wajib mengikatkan selendang di pinggang sebagai lambang pengendalian diri.',
    'source_name' => 'Peraturan Desa Adat Besakih No. 02/2024',
    'source_url'  => 'https://besakih.id',
    'is_verified' => true,
    'is_active'   => true,
]);
```

> **Prinsip Keamanan Integritas**: Hanya data dengan `is_verified = true` dan `is_active = true` yang akan disuntikkan ke dalam sistem instruksi Gemini AI sebagai sumber rujukan utama.

---

## 8. Menjalankan Pengujian Otomatis (Automated Tests)

Pengujian mencakup 11 skenario kritis (responsivitas halaman, pencarian lokasi, aktivasi chat, komunikasi Gemini API via `Http::fake()`, perlindungan data unverified, bahasa ganda ID/EN, validasi input, dan penanganan kegagalan API):

```bash
php artisan test
```

Hasil uji:
```text
Pass: 11 tests passed, 39 assertions.
Duration: < 1.0s
```

Format kode (Pint):
```bash
vendor/bin/pint
```

---

## 9. Penyiapan Deployment Produksi

Saat meluncurkan ke server produksi (VPS / Ubuntu / Nginx / Laravel Cloud):
1. Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`.
2. Optimalkan caching konfigurasi, rute, dan tampilan:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. Kompilasi aset Vite untuk produksi:
   ```bash
   npm run build
   ```
4. Pastikan symlink storage terhubung jika mengunggah media:
   ```bash
   php artisan storage:link
   ```

---

## 10. Nilai Kebudayaan & Etika (Tri Hita Karana)

Santi dibangun dengan menghargai konsep **Desa, Kala, Patra** (tempat, waktu, dan keadaan). Santi bukan pengganti Pemangku atau Prajuru Adat, melainkan pemandu awal berbasis teknologi yang menumbuhkan rasa hormat (respect) dan kesadaran spiritual bagi setiap wisatawan yang menginjakkan kaki di Pulau Dewata.
