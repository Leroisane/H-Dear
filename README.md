# H-Dear – Aplikasi Generator Undangan & Surat Resmi Otomatis

H-Dear adalah aplikasi berbasis web yang dirancang untuk mempermudah panitia acara (Event Organizer/BEM/Hima) dalam membuat surat permohonan dan undangan resmi secara otomatis. Aplikasi ini menyediakan berbagai template standar (seperti MC, Pemateri, Juri, VIP) dengan formulir input dinamis dan menghasilkan output langsung berupa file PDF siap cetak.

Project ini dibangun menggunakan arsitektur MVC dan menerapkan database relasional.

## ✨ Daftar Fitur
Berikut adalah implementasi fitur:
- Authentication System: Login & Register untuk pengguna.
- Role-Based Access Control (RBAC): Pemisahan akses antara User (Pembuat Surat) dan Admin (Pengelola Template).
- CRUD Template (Admin): Admin dapat Membuat, Membaca, Mengedit, dan Menghapus template surat beserta thumbnail-nya.
- Smart Form Logic: Formulir input bersifat dinamis; kolom input akan berubah menyesuaikan jenis template yang dipilih (misal: kolom "Topik Materi" hanya muncul untuk template Pemateri).
- PDF Generator: Generate surat otomatis menjadi file `.pdf` menggunakan library DomPDF.
- Session & Middleware: Proteksi route admin dan user menggunakan middleware `auth` dan pengecekan role `is_admin`.

## 🔧 Arsitektur / Tech Stack
Teknologi yang digunakan dalam pengembangan project:

- Backend: PHP / Laravel 10 (MVC Architecture)
- Database: MySQL (Relational Database)
- Frontend: Blade Templates, Tailwind CSS (CDN)
- PDF Engine: barryvdh/laravel-dompdf
- Version Control: Git & GitHub

## 🗂 Skema Database
Aplikasi ini menggunakan minimal 3 tabel yang saling berelasi.

### Tabel `users`
Menyimpan data pengguna dan status role (admin/user).
- `id` (Primary Key)
- `name`
- `email`
- `password`
- `is_admin` (Boolean: 1=Admin, 0=User)
- `timestamps`

### Tabel `templates`
Menyimpan desain master surat HTML dan konfigurasi tampilan.
- `id` (Primary Key)
- `nama_template` (String)
- `deskripsi` (Text)
- `html_content` (LongText - kode HTML surat)
- `thumbnail` (String - path gambar)
- `is_active` (Boolean)
- `timestamps`

### Tabel `undangans`
Menyimpan data surat yang telah dibuat oleh user.
- `id` (Primary Key)
- `user_id` (Foreign Key -> users.id)
- `template_id` (Foreign Key -> templates.id)
- `nama_pengirim`
- `nama_acara`
- `tanggal_acara`
- `tempat_acara`
- `tujuan_undangan` (Nama Penerima)
- `nomor_surat` (Nullable)
- `jabatan_penerima` (Nullable - e.g., MC, Juri)
- `topik_acara` (Nullable - Khusus Pemateri/Juri)
- `link_dokumen` (Nullable - Khusus TOR/Rundown)
- `pesan_tambahan`
- `timestamps`

**Relasi:**
- User *has many* Undangans.
- Template *has many* Undangans.

## 🚀 Cara Menjalankan (Installation)

Ikuti langkah berikut untuk menjalankan project:

**a. Clone repository**
```bash
git clone https://github.com/Leroisane/H-Dear
````

**b. Masuk Folder Project**

```bash
cd h-dear
```

**c. Install Dependencies**

```bash
composer install
npm install
```

**d. Setup Environment**

  - Copy file `.env.example` menjadi `.env`.
  - Atur konfigurasi database di file `.env`:

<!-- end list -->

```env
DB_CONNECTION=mysql
DB_HOST=ballast.proxy.rlwy.net
DB_PORT=32780
DB_DATABASE=h_dear
DB_USERNAME=root
DB_PASSWORD=rjjwJInhqKnqNavRBHaQCUwJFEQCqOqb
```

**e. Generate App Key**

```bash
php artisan key:generate
```

**f. Setup Storage Link**
Wajib dilakukan agar thumbnail template muncul.

```bash
php artisan storage:link
```

**g. Migrasi & Seeding Data (PENTING)**
Perintah ini akan membuat tabel dan mengisi data Admin default serta 6 Template bawaan.

```bash
php artisan migrate:fresh --seed
```

**h. Jalankan Server**

```bash
php artisan serve
```

Akses web di: `http://127.0.0.1:8000`

## 📌 List Endpoint / Route

Daftar path utama yang tersedia dalam project:

### Authentication

  - `GET  /login` : Halaman Login
  - `POST /login` : Proses Login
  - `GET  /register` : Halaman Daftar
  - `POST /register` : Proses Daftar
  - `POST /logout` : Logout User

### User (Pembuat Surat)

  - `GET  /dashboard` : Redirect ke halaman utama user
  - `GET  /undangan` : Halaman pilih template (Read)
  - `GET  /undangan/{id}/create` : Form pembuatan surat (Create)
  - `POST /undangan` : Simpan data surat (Store)
  - `GET  /undangan/{id}/preview` : Halaman preview surat sebelum download
  - `GET  /undangan/{id}/download` : Download PDF surat

### Admin (Pengelola)

Dilindungi middleware `is_admin`.

  - `GET  /admin/templates` : Dashboard daftar template (Read)
  - `GET  /admin/templates/create` : Form tambah template (Create)
  - `POST /admin/templates` : Simpan template baru
  - `GET  /admin/templates/{id}/edit` : Form edit template (Update)
  - `PUT  /admin/templates/{id}` : Update data template
  - `DELETE /admin/templates/{id}` : Hapus template (Delete)

## 🖼 Screenshots UI

**1. Halaman Pilihan Template (User)**

**2. Smart Form Input**

**3. Preview & Download PDF**

## 👥 Anggota Kelompok

Project ini dikerjakan oleh:

- Muhammad Ihsan Fadillah (245150700111023): User Interface & PDF Generator
- Mohammad Rozan Hanan (245150700111042): Backend & Authentication Specialist
- Audrey Khansa Larasati (245150701111031): Admin Panel & Template Management

## 📄 Akun Default

Gunakan akun ini untuk pengujian:

  - **Admin**: `admin@admin.com` / password: `password`
  - **User**: Silakan register akun baru.
