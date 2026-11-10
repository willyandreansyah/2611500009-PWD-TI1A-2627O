# pertemuan-09

Pada P9, yang saya lakukan adalah:

1. Menyalin artefak bahan pertemuan 08, sebagai baseline pertemuan 09, dan menguji tampilan `http://localhost/PWD/2627o/ti1a/2611500009-PWD-TI1A-2627O/pertemuan-09/` dimana hasilnya masih sama dengan artefak bahan pertemuan 08
2. Membuat fungsi `bersihkan($teks)` untuk membatalkan eksekusi skrip html atau javascript sebelum output dihasilkan, tanpa fungsi `bersihkan()` output akan dieksekusi contohnya: `<h1>teks</h1>` membuat teks menjadi heading, dengan fungsi `bersihkan()` outputnya menjadi `<h1>teks</h1>` tanpa membuat teks menjadi heading
3. Membuat file dengan nama `fungsi.php` berisi fungsi `bersihkan()` yang dipindahkan dari `index.php`, pada `index.php` baris fungsi diganti dengan `include("fungsi.php")`, setelah pengujian: hasilnya tetap sama antara penulisan fungsi `bersihkan()`langsung di `index.php` maupun setelah fungsi `bersihkan()` dipindahkan ke `fungsi.php`
4. Mengubah kumpulan `SESSION POST` menggunakan array supaya lebih rapi dan ringkas, setelah diuji hasilnya sama saja seperti sebelum menggunakan array karena emang array berfungsi untuk membuat kode coding menjadi ringkas saja