# Website Toko Online Alat Kesehatan

Website ini merupakan website toko online yang menjual alat kesehatan. Website ini dibuat menggunakan framework Laravel.

## Fitur user
- Menampilkan produk-produk yang dijual
- Menampilkan detail produk
- Menambahkan produk ke keranjang
- Melakukan checkout
- Melihat riwayat pembelian

## Fitur admin
- Menambahkan produk
- Mengedit produk
- Menghapus produk
- Menambahkan kategori
- Mengedit kategori
- Menghapus kategori
- Melihat riwayat pembelian
- Melihat detail pembelian
- Melihat user yang terdaftar

## Cara instalasi
1. Ekstrak file ke dalam folder htdocs
2. Buka terminal
3. Masuk ke dalam folder htdocs
4. Ketikkan perintah `composer install`
5. Buat file `.env` dengan menyalin isi dari file `.env.example`
6. Buat database baru
7. Import file `medshop.sql` ke dalam database yang baru dibuat
8. Buka file `.env` dan ubah konfigurasi database sesuai dengan database yang baru dibuat
9. Ketikkan perintah
    ```
    php artisan key:generate
    php artisan serve
    ```
10. Buka terminal baru
11. Ketikkan perintah
    ```
    npm install && npm run dev
    ```
12. Buka browser dan ketikkan `localhost:8000`