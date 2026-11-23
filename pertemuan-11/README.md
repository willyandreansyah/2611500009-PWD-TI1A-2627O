# pertemuan-11

Pada P11, yang saya lakukan adalah:

1. Menyalin artefak bahan pertemuan 10, sebagai baseline pertemuan 11, dan menguji tampilan `http://localhost/PWD/2627o/ti1a/2611500009-PWD-TI1A-2627O/pertemuan-11/` dimana hasilnya masih sama dengan artefak bahan pertemuan 10
2. Menyiapkan direktori dan lingkungan pengembangan pertemuan 11, pengujian: Memastikan layanan Apache dan MySQL berjalan
3. Memeriksa kesiapan basis data dan tabel kontak P11, pengujian: Memastikan basis data `db_pwd_2611500009` dan tabel `tbl_kontak_2611500009` tersedia, dan memeriksa sembilan atribut tabel yaitu: id, nama, email, semester, tanggal, jenis_pesan, minat, prodi, dan pesan, dan memeriksa data kontak dapat ditampilkan melalui tab Browse.
4. Membuat berkas `koneksi.php` - MySQL P11, pengujian: Memastikan berkas `koneksi.php` telah tersedia di dalam direktori pertemuan-11 dan berada sejajar dengan `index.php`
5. Menentukan parameter koneksi basis data P11, pengujian: Memeriksa keempat parameter pada berkas `koneksi.php` dan memastikan nama basis data sesuai dengan yang telah dibuat pada P10 dan tidak terdapat kesalahan penulisan
6. Mengatur pelaporan kesalahan MySQLi P11, pengujian: Memastikan pemanggilan `mysqli_report(MYSQLI_REPORT_OFF);` telah ditulis setelah deklarasi parameter koneksi, dan memeriksa kembali nama fungsi dan konstanta yang digunakan
7. Mengimplementasikan koneksi PHP - MySQL menggunakan MySQLi, pengujian: Memeriksa kembali isi berkas `koneksi.php` dan memastikan parameter koneksi, pemanggilan `mysqli_report()`, fungsi `mysqli_connect()`, dan memeriksa kegagalan koneksi telah ditulis sesuai urutan.
8. Menguji koneksi dari PHP ke MySQL dengan file sementara bernama `uji_koneksi.php`, pengujian: Memastikan halaman menampilkan pesan `Koneksi ke basis data berhasil` dan setelah pengujian selesai hapus berkas sementara `uji_koneksi.php` agar tidak menjadi bagian dari artefak akhir P11
9. Menguji penanganan kegagalan koneksi PHP - MySQL, pengujian: Memastikan kondisi kegagalan koneksi dapat diamati dan pesan yang ditampilkan sesuai dengan kode. Setelah itu, kembalikan parameter `$database` ke nama basis data yang benar. Mengakses kembali `koneksi.php` untuk memeriksa bahwa pesan kegagalan tidak lagi muncul
10. Menyiapkan pemuatan berkas koneksi pada P11, pengujian: Memeriksa kembali nama berkas dan penulisan perintah `require_once("koneksi.php");` dan memastikan `koneksi.php` telah tersedia pada direktori yang sama dengan `index.php`
11. Mengintegrasikan berkas koneksi pada index P11, pengujian: Memeriksa bagian awal `index.php` dan memastikan kedua berkas dimuat menggunakan `require_once()` dan tidak terdapat kesalahan penulisan nama berkas
12. 