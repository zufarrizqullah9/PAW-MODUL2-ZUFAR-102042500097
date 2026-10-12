PAW MODUL 2 - LATIHAN CRUD SHOWROOM

Aplikasi ini mengelola data mobil di sebuah showroom. Tampilan, form, dan validasinya
sudah jadi. Yang belum ada adalah query ke database, dan itu tugas kalian.

PERSIAPAN
1. Pakai PHP 8.1 ke atas dan MySQL/MariaDB (XAMPP, Laragon, atau MAMP).
2. Taruh folder ini di htdocs (atau www kalau pakai Laragon).
3. Import db_modul2.sql lewat phpMyAdmin.
4. Buka connect.php, sesuaikan port, user, dan password dengan MySQL di laptop kalian.
5. Buka http://localhost/modul-paw-2-latihan/ di browser.
   Kalau tidak pakai Apache, jalankan "php -S 127.0.0.1:8080" dari dalam folder ini
   lalu buka http://127.0.0.1:8080.

Kalau halaman daftar mobil terbuka tapi isinya kosong, itu normal. Datanya baru muncul
setelah TODO 1 selesai.

YANG DIKERJAKAN
Cari tulisan TODO di file berikut:

TODO 1 (READ)    index.php    menampilkan daftar mobil, termasuk pencarian dan filter tipe
TODO 2 (CREATE)  create.php   menyimpan mobil baru
TODO 3 (UPDATE)  update.php   menyimpan perubahan data mobil
TODO 4 (DELETE)  delete.php   menghapus mobil

Disarankan mengerjakan berurutan dari TODO 1, karena hasil TODO lain paling gampang
dicek lewat halaman daftar.

Contoh query yang sudah jadi ada di functions.php, yaitu fungsi cari_mobil().
Pola prepare lalu execute di situ bisa ditiru untuk TODO yang lain.

CARA CEK HASIL
- Daftar mobil menampilkan 3 data contoh, yang terbaru di atas.
- Cari "honda" hanya memunculkan Honda City. Filter tipe "MPV" hanya memunculkan Avanza Veloz.
- Tambah mobil baru, lalu pastikan muncul di daftar.
- Edit mobil tadi, lalu pastikan datanya berubah dan mobil lain tidak ikut berubah.
- Hapus mobil tadi, lalu pastikan hilang dari daftar dan mobil lain masih ada.
- Coba isi kolom pencarian dengan tanda petik satu ('). Halaman tidak boleh error.

CATATAN
- Semua query wajib memakai prepared statement.
- connect.php, functions.php, header.php, footer.php, form_mobil.php, dan styles.css
  tidak perlu diubah (kecuali isi koneksi di connect.php).
- Semua data contoh fiktif.
- Tenggat dan cara pengumpulan mengikuti arahan asisten.
