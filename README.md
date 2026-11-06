# SANTI — AI Cultural Guardian Bali
> **"Discover Bali. Respect Its Culture."**  
> *Sistem Pemandu dan Penjaga Budaya Bali Virtual Berbasis Artificial Intelligence untuk Wisatawan Domestik dan Mancanegara di Kawasan Suci & Cagar Budaya Bali.*

[![Bali DigiFest 2026](https://img.shields.io/badge/Bali%20DigiFest-2026%20AI%20Web%20Innovation%20Challenge-174D3B?style=for-the-badge)](https://balidigifest.baliprov.go.id)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Google Gemini](https://img.shields.io/badge/Google%20Gemini-3.5%20Flash-4285F4?style=for-the-badge&logo=google&logoColor=white)](https://ai.google.dev)
[![Tests](https://img.shields.io/badge/Tests-20%20Passed%20(93%20Assertions)-21845B?style=for-the-badge)](tests/Feature/SantiCulturalGuardianTest.php)

---

## 1. Description

**SANTI (Sistem Asisten & Navigasi Tradisi Interaktif)** adalah platform web inovasi pariwisata berbasis Generative AI yang dirancang sebagai penjaga budaya (*Cultural Guardian*) digital di Pulau Dewata. SANTI menjembatani kesenjangan pemahaman antara wisatawan (domestik maupun internasional) dengan nilai-nilai kesucian adat Bali (*Dresta Bali*).

SANTI memberikan panduan etika wisata interaktif, kontekstual, dan ramah budaya secara *real-time* sebelum dan saat wisatawan berada di pura agung, desa adat, pantai, kawasan subak, hingga gunung sakral di Bali. Platform ini dilengkapi sistem *Anti-Hallucination Grounding* berbasis basis data aturan adat terverifikasi resmi (mengacu pada Surat Edaran Gubernur Bali No. 4/2023 dan pedoman Parisada Hindu Dharma Indonesia / PHDI).

---

## 2. Problem & Target User

### Problem Statement
1. **Tingginya Insiden Pelanggaran Norma Budaya**: Maraknya insiden wisatawan berpakaian tidak pantas di pura, menaiki tempat suci (*pelinggih*), menerbangkan drone di upacara sakral, atau masuk ke area suci dalam keadaan berkabung/menstruasi (*cuntaka*).
2. **Keterbatasan Informasi Kontekstual di Lokasi**: Papan informasi konvensional seringkali pasif, hanya berupa teks statis satu arah, dan tidak mampu menjawab pertanyaan dinamis wisatawan dalam berbagai bahasa.
3. **Risiko Halusinasi AI Generik**: Aplikasi AI generik tanpa sistem *grounding* kerap mengarang informasi adat (*cultural hallucination*), menciptakan kesalahpahaman fatwa adat yang fatal.

### Target User
- **Wisatawan Domestik (Nusantara)**: Membutuhkan panduan praktis busana sopan adat, makna canang sari, dan tata karma berfoto di pura.
- **Wisatawan Mancanegara (Mancanegara)**: Wisatawan dari Australia, Asia, Eropa, dan Amerika yang membutuhkan asistensi dalam bahasa ibu mereka (Inggris, Mandarin, Jepang, Rusia, Prancis, Jerman).
- **Pengelola Cagar Budaya & Desa Adat**: Prajuru adat dan pemandu lokal yang membutuhkan platform edukasi mandiri bagi turis di gerbang masuk via QR Code.

---

## 3. Key Features

1. **AI Cultural Guardian Chatbot (Multi-Turn Conversational AI)**:
   - Asisten virtual dengan persona ramah tamah Bali ("Om Swastiastu"), berbasis model **Google Gemini 3.5 Flash**.
   - Manajemen konteks percakapan dinamis (mendukung dialog bertahap hingga 20 interaksi dengan mekanisme peringkasan otomatis tanpa memotong tampilan pengguna).
2. **Anti-Hallucination Grounded Database**:
   - Jawaban AI wajib berlandaskan data aturan adat resmi (`cultural_rules`) berstatus `is_verified = true`.
   - Transparansi rujukan aturan resmi lengkap dengan nama sumber (SE Gubernur Bali, Awig-Awig Desa Adat, SK Pengelola Pura).
3. **Multi-Destination Coverage (13 Destinasi Budaya Utama)**:
   - Mencakup Pura Agung Besakih, Pura Luhur Uluwatu, Pura Tirta Empul, Pura Ulun Danu Beratan, Pura Tanah Lot, Desa Adat Penglipuran, Subak Jatiluwih, Pantai Kuta, GWK, Ubud Monkey Forest, Gunung Batur Kintamani, hingga panduan umum *Seluruh Bali*.
4. **Dukungan 7 Bahasa Internasional**:
   - Bahasa Indonesia (ID), English (EN), 中文 (ZH), 日本語 (JA), Русский (RU), Français (FR), Deutsch (DE).
5. **Katalog Panduan Adat 2x2 Responsive Grid**:
   - Halaman panduan adat terstruktur per kategori: Busana Adat (*Dress Code*), Kawasan Sakral (*Sacred Area*), Tata Krama (*Behavior*), Fotografi (*Photography*), dan Aturan Umum.
6. **QR Code Ready Access**:
   - URL berbasis slug ramah pindai (`/panduan/pura-besakih`, `/santi/desa-penglipuran`) untuk diintegrasikan pada standee fisik di gerbang pura.
7. **Premium Modern Minimalist Footer & Modal Kebijakan**:
   - Strip filosofi **Tri Hita Karana** (Parahyangan, Pawongan, Palemahan), kontak darurat wisatawan (Bali 112 & Polisi Pariwisata), dan modal popup Pedoman Resmi SE Gubernur Bali No. 4/2023.

---

## 4. Tech Stack

| Layer | Teknologi | Keterangan |
|---|---|---|
| **Backend Framework** | Laravel 13.x (PHP 8.4+) | Robust MVC architecture, Eloquent ORM, Rate Limiting, Strict Validation |
| **Frontend UI** | Laravel Blade + Tailwind CSS v4 | Clean semantic HTML, fluid typography, dark/light theme support |
| **Build Tool** | Vite 8.x | High-speed asset pipeline with font optimization |
| **AI Engine** | Google Gemini API (`gemini-3.5-flash`) | Context grounding, latency optimization (< 4s), zero-thinking budget |
| **Database** | MySQL 8.0+ / SQLite 3 | Relational schema with migrations, factories, and deterministic seeders |
| **Testing** | PHPUnit 12.x | 20 Automated Feature & Unit Tests with `Http::fake()` |
| **Security** | Laravel Middleware | CSRF Protection, Encrypted Session Cookies, Rate Limiting (`throttle:25,1`) |

---

## 5. AI Implementation

Integrasi AI diimplementasikan secara tersentralisasi pada kelas [`app/Services/GeminiService.php`](app/Services/GeminiService.php) dengan spesifikasi teknis berikut:

- **Model AI**: `gemini-3.5-flash` melalui endpoint Google AI Studio API (`v1beta`).
- **Optimization Latency**: Dikonfigurasi dengan `thinkingBudget: 0` dan timeout 35 detik, menghasilkan waktu respons rata-rata **~3.2 – 3.8 detik** tanpa penurunan kualitas jawaban.
- **Grounding Protocol (Anti-Hallucination)**:
  - Sebelum *prompt* dikirim ke Gemini, backend melakukan injeksi aturan adat terverifikasi dari tabel `cultural_rules` ke dalam `systemInstruction`.
  - Jika suatu lokasi belum memiliki aturan adat resmi yang terverifikasi, AI diinstruksikan menolak menjawab secara spekulatif dan menyarankan konfirmasi ke prajuru adat setempat (`insufficient_verified_information`).
- **Conversational Memory & Turn Alternation**:
  - Mendukung riwayat percakapan bertahap (*multi-turn conversation*).
  - Backend membatasi payload riwayat terbaru (maksimal 6 pesan terakhir), meringkas pesan lawas ke dalam ringkasan konteks, dan memangkas pesan model berlebih demi efisiensi token tanpa memotong teks di UI.
  - Memastikan alternasi *role* yang valid (`user` &rarr; `model` &rarr; `user`) sesuai spesifikasi Gemini API.
- **Fallback Handlers**:
  - Proteksi otomatis terhadap kendala jaringan atau batas kuota (*rate limiting* / 429) dengan pesan alternatif terjemahan lokal yang informatif.

---

## 6. Architecture / Data Flow

```mermaid
flowchart TD
    subgraph Client ["Frontend (Wisatawan)"]
        UI["Antarmuka Web SANTI\n(Blade + Tailwind CSS v4)"]
        QR["Scan QR Code Papan Informasi Pura"]
    end

    subgraph Server ["Laravel Backend Engine"]
        Router["Route Dispatcher & Middleware\n(CSRF, SetLocale, Rate Limiter: 25/min)"]
        Controller["SantiChatController"]
        DB[(Database MySQL / SQLite\nLocations & CulturalRules)]
        Service["GeminiService\n(Prompt Grounding & History Manager)"]
    end

    subgraph External ["External AI Services"]
        GeminiAPI["Google Gemini 3.5 Flash API\n(v1beta generateContent)"]
    end

    QR -->|Akses URL /panduan/{slug}| UI
    UI -->|Kirim Pesan & Riwayat| Router
    Router --> Controller
    Controller -->|Query Aturan Terverifikasi is_verified=true| DB
    DB -->|Konteks Aturan Resmi| Controller
    Controller -->|Kompilasi Konteks & Sanitasi History| Service
    Service -->|Payload JSON dengan System Instruction| GeminiAPI
    GeminiAPI -->|Respons Jawaban Budaya| Service
    Service --> Controller
    Controller -->|JSON Response: Jawaban + Rujukan Resmi| UI
```

---

## 7. Installation / Run Instructions

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan pengembang lokal (*Local Environment*):

### Prasyarat Sistem
- PHP >= 8.3 (dengan ekstensi `pdo_mysql`, `curl`, `mbstring`, `openssl`, `intl`)
- Composer >= 2.5
- Node.js >= 20.x & npm >= 10.x
- MySQL 8.0+ atau MariaDB 10.4+

### Langkah 1: Clone Repositori
```bash
git clone https://github.com/justsanzz07/lomba-bali-.git
cd lomba-bali-
```

### Langkah 2: Instal Dependensi PHP & Node.js
```bash
composer install
npm install
```

### Langkah 3: Konfigurasi File Environment
```bash
cp .env.example .env
php artisan key:generate
```

### Langkah 4: Konfigurasi Database & API Key di `.env`
Buka file `.env` dan sesuaikan parameter berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=santi_bali
DB_USERNAME=root
DB_PASSWORD=

# Dapatkan API Key gratis di https://aistudio.google.com
GEMINI_API_KEY=your_gemini_api_key_here
GEMINI_MODEL=gemini-3.5-flash
```

### Langkah 5: Migrasi & Isi Database (Seed Data)
```bash
php artisan migrate:fresh --seed
```

### Langkah 6: Kompilasi Aset Frontend
```bash
npm run build
```

### Langkah 7: Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi kini aktif dan dapat diakses di: **`http://127.0.0.1:8000`**

---

## 8. Deployment URL

- **Repositori Resmi GitHub**: [https://github.com/justsanzz07/lomba-bali-](https://github.com/justsanzz07/lomba-bali-)
- **Live Production URL**: [https://santi-ai-topaz.vercel.app](https://santi-ai-topaz.vercel.app)  
  *(Cermin Serverless Vercel / Railway Ready)*

---

## 9. Demo Account

Aplikasi dirancang sebagai **Public Citizen & Tourist Service Platform** tanpa registrasi akun yang memberatkan pengguna (*Guest-Accessible by Design*). Wisatawan dapat langsung mengakses seluruh fitur panduan, katalog pura, serta asisten AI tanpa login, dengan proteksi *Rate Limiting* berbasis IP untuk mencegah *abuse*.

---

## 10. Known Limitations

1. **Ketergantungan Kuota Gemini API**: Penggunaan API Key tier gratis (*Google AI Studio Free Tier*) memiliki batas kuota permintaan per menit (RPM). Jika batas terlampaui, sistem secara otomatis menampilkan pesan *fallback* informasi terverifikasi database.
2. **Konektivitas Internet di Kawasan Pegunungan**: Respon AI membutuhkan koneksi internet aktif. Di masa depan, panduan aturan teks dasar dirancang dapat di-cache secara offline (*PWA Service Worker*).
3. **Cakupan Database Awig-Awig**: Saat ini basis data terverifikasi mencakup 13 destinasi prioritas di Bali; penambahan aturan desa adat lainnya memerlukan kurasi berkelanjutan dari bendesa adat setempat.

---

## 11. Third-party Resources / Credits

- **Regulasi & Pedoman Resmi**:
  - *Surat Edaran Gubernur Bali No. 4 Tahun 2023* tentang Tatanan Baru bagi Wisatawan Mancanegara selama Berada di Bali.
  - *Pedoman Kesucian Pura* — Parisada Hindu Dharma Indonesia (PHDI) Bali.
  - *Awig-Awig & Peraturan Pengelola Kawasan Suci Pura Agung Besakih*.
- **Asset Visual & Tipografi**:
  - Plus Jakarta Sans Font (Google Fonts / Tokotype).
  - Unsplash Photography (Kredit kepada fotografer dokumentasi budaya Bali).
  - Heroicons (Icons Library by Tailwind Labs).
- **Infrastruktur & Framework**:
  - Laravel Framework (Taylor Otwell & Komunitas Open-Source Laravel).
  - Google Gemini AI (Google DeepMind).

---

## 12. Team Members

**Tim Pengembang SANTI (Bali DigiFest 2026 AI Web Innovation Challenge)**:

| No | Nama Lengkap | Peran / Tanggung Jawab | Institusi / Afiliasi |
|:---:|---|---|---|
| **1** | **Nur Hasan** | Full-Stack Developer & Prompt Engineer | Universitas / Tim Inovator Bali |
| **2** | **Tim SANTI Cultural Tech** | UX Researcher & Balinese Cultural Curator | Tim Inovator Bali |

---
*Matur Suksma. Rahayu Sareng Sami.* 🙏🌺
