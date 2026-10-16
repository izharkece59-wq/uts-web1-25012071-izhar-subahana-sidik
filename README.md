# Dokumentasi Pengujian Website Menu Makanan

## 1. Identitas Mahasiswa

- **Nama:** Izhar Subahana Sidik
- **NIM:** 25012071
- **Mata Kuliah:** Pemrograman Web 1

## 2. Deskripsi Proyek

Proyek ini merupakan website menu makanan berbasis PHP yang dibuat untuk mempelajari dan melakukan pengujian fungsi pada aplikasi web.

Website menyediakan fitur daftar menu makanan, pencarian menu, keranjang pesanan, dan perhitungan diskon.

## 3. Teknologi yang Digunakan

- PHP
- HTML
- CSS
- Web browser
- PHP Development Server atau XAMPP

## 4. Fitur Website

1. Menampilkan daftar menu makanan.
2. Mencari menu berdasarkan nama.
3. Menambahkan pesanan ke keranjang.
4. Mengosongkan keranjang.
5. Menghitung subtotal, diskon, dan total pembayaran.

## 5. Cara Menjalankan Website

### Menggunakan CMD

1. Pastikan PHP sudah terpasang melalui XAMPP.
2. Buka Command Prompt (CMD).
3. Masuk ke direktori proyek dengan perintah:

   `cd C:\xampp\htdocs\pengujian-menu`

4. Jalankan server PHP:

   `php -S localhost:3000`

5. Buka browser dan kunjungi:

   `http://localhost:3000`

Catatan: CMD harus tetap terbuka selama server digunakan. Jika muncul pesan bahwa perintah `php` tidak dikenali, konfigurasi lokasi PHP perlu diperiksa.

## 6. Skenario Pengujian

| ID | Fitur yang Diuji | Hasil yang Diharapkan | Status |
|---|---|---|---|
| U01 | Daftar menu | Lima menu ditampilkan | Berhasil diamati |
| U02a | Pencarian menu tersedia | Menu yang dicari ditampilkan | Berhasil diamati |
| U02b | Pencarian menu tidak tersedia | Pesan menu tidak ditemukan ditampilkan | Perlu dicatat sesuai hasil aktual |
| U03a | Validasi jumlah pesanan | Jumlah yang tidak valid ditolak | Perlu verifikasi |
| U08a | Diskon pada subtotal Rp49.000 | Diskon Rp0, total Rp49.000 | Perlu verifikasi |
| U08b | Diskon pada subtotal Rp50.000 | Diskon Rp5.000, total Rp45.000 | Perlu verifikasi |

## 7. Dokumentasi Pengujian

Screenshot hasil pengujian disimpan di folder `dokumentasi/pengujian`, jika folder tersebut tersedia dalam proyek.

Nama file screenshot dapat menggunakan format berikut:

- `U01-daftar-menu.png`
- `U02a-pencarian-berhasil.png`
- `U02b-pencarian-tidak-ditemukan.png`
- `U03a-validasi-jumlah.png`
- `U08a-diskon-tidak-berlaku.png`
- `U08b-diskon-berlaku.png`

## 8. Kesimpulan

Pengujian dilakukan untuk memeriksa fungsi utama website menu makanan, mulai dari menampilkan daftar menu, pencarian, pengelolaan keranjang, hingga perhitungan diskon.

Kesimpulan akhir dibuat setelah seluruh skenario pengujian dijalankan, hasil aktual dicatat, dan bukti pengujian disimpan.