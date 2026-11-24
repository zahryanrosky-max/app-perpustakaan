# Skenario Demo Aplikasi - Perpustakaan Digital Kampus

## Persiapan Sebelum Demo
1. Pastikan dua instance server berjalan bersamaan pada dua terminal berbeda:
   - **Terminal 1 (Server Web Utama):** `php artisan serve --port=8000`
   - **Terminal 2 (Server Internal API):** `php artisan serve --port=8011`
2. Buka browser ke `http://127.0.0.1:8000` dan siapkan Postman.

---

## Urutan Langkah Demo

1. **Login Aplikasi**
   - Akses `http://127.0.0.1:8000`, tunjukkan bahwa sistem otomatis mengarahkan pengguna yang belum login ke halaman `/login`.
   - Login sebagai Admin menggunakan email `admin@pens.ac.id` dan password `password`.

2. **Tampilkan Dashboard**
   - Setelah login berhasil, tunjukkan halaman Dashboard yang menampilkan kartu statistik (Total Buku, Total Anggota, Peminjaman Aktif) yang dikonsumsi langsung dari endpoint `GET /api/stats`.

3. **Tambah Kategori (Hak Akses Admin)**
   - Buka menu **Kategori** (yang hanya muncul untuk role Admin berkat middleware `CheckAdminRole`).
   - Tambahkan 1 kategori baru (misalnya: *Ensiklopedia*).

4. **Tambah Buku**
   - Buka menu **Buku**, tunjukkan daftar buku hasil seeding beserta pagination yang berfungsi.
   - Klik **Tambah Buku**, masukkan data buku baru dengan kategori yang baru dibuat.

5. **Tambah Anggota**
   - Buka menu **Anggota**, klik **Tambah Anggota**, dan daftarkan 1 anggota mahasiswa baru.

6. **Buat Transaksi Peminjaman**
   - Buka menu **Peminjaman** -> **Tambah Peminjaman**.
   - Tunjukkan bahwa nama petugas pencatat otomatis terisi dari akun yang sedang login.
   - Pilih anggota baru, pilih 1 atau lebih buku, tentukan tanggal pinjam & kembali, lalu simpan.

7. **Lihat Daftar Peminjaman Aktif**
   - Pada halaman **Peminjaman**, tunjukkan transaksi yang baru dibuat muncul dengan status `Dipinjam`.

8. **Proses Pengembalian Buku**
   - Klik tombol **Kembalikan** pada transaksi peminjaman tersebut.
   - Tunjukkan status transaksi berubah menjadi `Dikembalikan` dan tanggal pengembalian otomatis tercatat.

9. **Tampilkan Laporan Peminjaman**
   - Buka menu **Laporan**, tunjukkan tabel riwayat seluruh peminjaman yang datanya diambil melalui `GET /api/loans` beserta navigasi halamannya.

10. **Demo REST API di Postman**
    - Buka Postman dan uji endpoint API secara langsung (`GET /api/books`, `POST /api/loans`, `GET /api/stats`) dengan header `Accept: application/json`, tunjukkan status code (`200 OK`, `201 Created`) dan format response JSON.