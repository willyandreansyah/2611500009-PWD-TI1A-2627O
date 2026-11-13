# pertemuan-09

Pada P9, yang saya lakukan adalah:

1. Menyalin artefak bahan pertemuan 08, sebagai baseline pertemuan 09, dan menguji tampilan `http://localhost/PWD/2627o/ti1a/2611500009-PWD-TI1A-2627O/pertemuan-09/` dimana hasilnya masih sama dengan artefak bahan pertemuan 08
2. Membuat fungsi `bersihkan($teks)` untuk membatalkan eksekusi skrip html atau javascript sebelum output dihasilkan, tanpa fungsi `bersihkan()` output akan dieksekusi contohnya: `<h1>teks</h1>` membuat teks menjadi heading, dengan fungsi `bersihkan()` outputnya menjadi `<h1>teks</h1>` tanpa membuat teks menjadi heading
3. Membuat file dengan nama `fungsi.php` berisi fungsi `bersihkan()` yang dipindahkan dari `index.php`, pada `index.php` baris fungsi diganti dengan `include("fungsi.php")`, setelah pengujian: hasilnya tetap sama antara penulisan fungsi `bersihkan()`langsung di `index.php` maupun setelah fungsi `bersihkan()` dipindahkan ke `fungsi.php`
4. Membuat session array assosiatif untuk menampung data form -> `$data` yang dimasukkan ke `$_SESSION["kegiatan"]` dan `$_SESSION["kontak"]`, dan outputnya dengan for each. Menggunakan array label untuk menampilkan hasil formulir dengan for each -> `$labelKegiatan` dan `$labelKontak`.