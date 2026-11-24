# Dokumentasi REST API - App Perpustakaan

Base URL: `http://127.0.0.1:8000/api`
Header wajib: `Accept: application/json` (dan `Content-Type: application/json` untuk request ber-body).
Catatan: seluruh endpoint sengaja bersifat publik (tanpa autentikasi) pada pertemuan ini.

## Ringkasan Endpoint

| No | Method | URL | Body (jika ada) | Status Sukses | Status Gagal |
|---|---|---|---|---|---|
| 1 | GET | `/api/books` | - (query opsional: `judul`, `category_id`, `page`) | 200 | - |
| 2 | GET | `/api/books/{id}` | - | 200 | 404 |
| 3 | POST | `/api/books` | `judul, penulis, penerbit, tahun_terbit, isbn, stok, category_id` | 201 | 422 |
| 4 | PUT | `/api/books/{id}` | `judul, penulis, penerbit, tahun_terbit, isbn, stok, category_id` | 200 | 404, 422 |
| 5 | DELETE | `/api/books/{id}` | - | 200 | 404 |
| 6 | GET | `/api/members` | - | 200 | - |
| 7 | GET | `/api/members/{id}` | - | 200 | 404 |
| 8 | GET | `/api/loans` | - | 200 | - |
| 9 | POST | `/api/loans` | `member_id, user_id, tanggal_pinjam, tanggal_kembali, book_ids[]` | 201 | 422 |
| 10 | PUT | `/api/loans/{id}/kembalikan` | - | 200 | 404 |
| 11 | GET | `/api/stats` | - | 200 | - |

> 

---

## 1. GET `/api/books`

Daftar buku dengan pagination (10 per halaman). Filter opsional: `?judul=lord`, `?category_id=2`.

**200 OK**
```json
{
  "data": [
    {
      "id": 3,
      "judul": "lord of the ring",
      "penulis": "ryan",
      "penerbit": "gusman",
      "tahun_terbit": 2000,
      "isbn": null,
      "stok": 1,
      "sampul": null,
      "category": { "id": 1, "nama_kategori": "fantasy" },
      "created_at": "2026-11-21T01:40:00.000000Z",
      "updated_at": "2026-11-21T01:40:00.000000Z"
    }
  ],
  "links": { "first": "http://127.0.0.1:8000/api/books?page=1", "last": "http://127.0.0.1:8000/api/books?page=1", "prev": null, "next": null },
  "meta": { "current_page": 1, "per_page": 10, "total": 1 }
}
```

## 2. GET `/api/books/{id}`

**200 OK** - satu objek buku dalam `data` (struktur field sama seperti di atas).

**404 Not Found** (contoh `GET /api/books/999`)
```json
{ "message": "No query results for model [App\\Models\\Book] 999" }
```

## 3. POST `/api/books`

**Body**
```json
{
  "judul": "Bumi",
  "penulis": "Tere Liye",
  "penerbit": "Gramedia",
  "tahun_terbit": 2014,
  "isbn": "9786020322155",
  "stok": 3,
  "category_id": 2
}
```

**201 Created** - objek buku baru dalam `data`, lengkap dengan `category`.

**422 Unprocessable Entity** (body kosong)
```json
{
  "message": "The judul field is required. (and 5 more errors)",
  "errors": {
    "judul": ["The judul field is required."],
    "penulis": ["The penulis field is required."]
  }
}
```

## 4. PUT `/api/books/{id}`

Body sama seperti `POST /api/books` (semua field wajib kecuali `isbn`).

**200 OK** - objek buku setelah diperbarui dalam `data`.
**404** - id tidak ditemukan. **422** - validasi gagal (format sama seperti di atas).

## 5. DELETE `/api/books/{id}`

**200 OK**
```json
{ "message": "Buku berhasil dihapus." }
```
**404** - id tidak ditemukan.

## 6. GET `/api/members`

Daftar anggota dengan pagination (10 per halaman).

**200 OK**
```json
{
  "data": [
    {
      "id": 1,
      "nama": "ryan",
      "nim": "3112343",
      "email": "ZZzabdhu@gmail.com",
      "nomor_telepon": "0008123",
      "alamat": null,
      "status": "aktif",
      "created_at": "2026-11-21T01:45:00.000000Z",
      "updated_at": "2026-11-21T01:45:00.000000Z"
    }
  ],
  "links": { "...": "..." },
  "meta": { "current_page": 1, "per_page": 10, "total": 1 }
}
```

## 7. GET `/api/members/{id}`

**200 OK** - satu objek anggota dalam `data`.
**404** - id tidak ditemukan.

## 8. GET `/api/loans`

Daftar peminjaman dengan pagination (10 per halaman).

**200 OK** (saat belum ada data peminjaman)
```json
{
  "data": [],
  "links": { "first": "http://127.0.0.1:8000/api/loans?page=1", "last": "http://127.0.0.1:8000/api/loans?page=1", "prev": null, "next": null },
  "meta": { "current_page": 1, "per_page": 10, "total": 0 }
}
```

## 9. POST `/api/loans`

**Body**
```json
{
  "member_id": 1,
  "user_id": 1,
  "tanggal_pinjam": "2026-11-21",
  "tanggal_kembali": "2026-11-28",
  "book_ids": [3]
}
```

**201 Created**
```json
{
  "data": {
    "id": 1,
    "member": { "id": 1, "nama": "ryan" },
    "petugas": { "id": 1, "name": "Admin Perpustakaan" },
    "tanggal_pinjam": "2026-11-21",
    "tanggal_kembali": "2026-11-28",
    "tanggal_dikembalikan": null,
    "status": "dipinjam",
    "books": [ { "id": 3, "judul": "lord of the ring" } ]
  }
}
```

**422 Unprocessable Entity** (contoh `book_ids` kosong)
```json
{
  "message": "Pilih minimal satu buku.",
  "errors": { "book_ids": ["Pilih minimal satu buku."] }
}
```

## 10. PUT `/api/loans/{id}/kembalikan`

**200 OK** - objek peminjaman dengan `status: "dikembalikan"` dan `tanggal_dikembalikan` terisi tanggal hari ini.
**404** - id tidak ditemukan.

## 11. GET `/api/stats`

**200 OK**
```json
{
  "total_buku": 1,
  "total_anggota": 1,
  "peminjaman_aktif": 0
}
```
