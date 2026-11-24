# Sistem Informasi Perpustakaan Digital Kampus

Aplikasi manajemen perpustakaan berbasis web dan REST API yang dibangun menggunakan Laravel 12.

## Fitur Utama
- **Autentikasi & Otorisasi:** Login dan logout berbasis session dengan pembagian hak akses (`admin` dan `petugas`) menggunakan custom middleware `CheckAdminRole`.
- **Manajemen Data Master & Transaksi:** CRUD Buku, Kategori (khusus Admin), Anggota, serta transaksi Peminjaman & Pengembalian multi-buku.
- **REST API:** Endpoint JSON terstandar menggunakan Laravel API Resource untuk `books`, `members`, `loans`, dan `stats`.
- **Dashboard & Laporan (API Consumer):** Halaman Dashboard dan Laporan Peminjaman yang mengonsumsi endpoint API internal menggunakan Laravel HTTP Client (`Http::get()`).

---

## Panduan Instalasi & Menjalankan Project

1. **Clone Repository**
   ```bash
   git clone <url-repository-github-anda>
   cd app-perpustakaan