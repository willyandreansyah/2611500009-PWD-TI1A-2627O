# Pertemuan 6 - PHP Dasar dan Pemrograman Sisi Peladen
## Deskripsi
Dokumentasi pengembangan halaman web pada P6, yaitu perubahan `index.html` menjadi `index.php`, penggunaan sintaks dasar PHP (variabel, konstanta, operator, percabangan, dan perulangan), serta cara menjalankannya lewat server lokal.
## Fitur dan Pengembangan
- Perubahan `index.html` ke `index.php`: File diganti ekstensinya menjadi `.php`, lalu ditambah blok `<?php ... ?>` di bagian atas untuk menyimpan data dan logika. Teks yang tadinya ditulis langsung di HTML sekarang diambil dari variabel PHP. Atribut form juga diubah menjadi `action="index.php"`. CSS dan JavaScript tidak berubah.
- Variabel dan konstanta: Variabel diawali `$` untuk data yang bisa berubah, sedangkan konstanta memakai `const` untuk data tetap, contohnya yaitu `$namaMahasiswa = "Willy Andreansyah";` dan `const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";`.
- Operator: Dipakai untuk menghitung dan membandingkan nilai, contohnya yaitu `$sisaSemester = $batasSemester - $semester;` dan `$semesterValid = $semester >= 1 && $semester <= $batasSemester;`.
- `if-elseif-else`: Memilih keterangan berdasarkan kondisi, contohnya yaitu `if ($semester < 3) { ... } elseif ($semester <= 6) { ... } else { ... }` untuk menentukan keterangan semester.
- `switch-case-default`: Memilih satu hasil dari beberapa pilihan nilai, contohnya yaitu `switch ($programStudi) { case "SI": ... case "TI": ... default: ... }` untuk menentukan fokus program studi.
- Perulangan `for` dan `while`: `for ($i = 1; $i <= 5; $i++)` dipakai untuk membuat daftar target belajar, dan `while ($nomorSemester <= 3)` dipakai untuk membuat daftar semester.
- Menampilkan data: `echo` dan `print` untuk mencetak nilai, serta `<?= ... ?>` sebagai singkatan `echo`, contohnya yaitu `<?= date("Y") ?>` untuk tahun di footer.
## Cara Menjalankan
PHP tidak bisa dibuka langsung dengan klik dua kali, jadi perlu dijalankan lewat server lokal (Laragon).
1. Buka laragon dan klik Start All
2. Buka browser dan ketik `http://localhost/PWD/2627o/ti1a/2611500009-PWD-TI1A-2627O/pertemuan-06/`
## Pengujian
- Variabel dan konstanta: Langkahnya yaitu buka `index.php` lewat server lokal dan lihat bagian Beranda. Hasil aktualnya yaitu nama, mata kuliah, dan tahun akademik tampil sesuai nilai variabel dan konstanta ("Willy Andreansyah", "Pemrograman Web Dasar", "2026/2027").
- Operator: Langkahnya yaitu lihat bagian Tentang Saya. Hasil aktualnya yaitu sisa semester tampil `7` dan pemeriksaan rentang semester tampil "Sesuai rentang".
- `if-elseif-else`: Langkahnya yaitu lihat baris Semester. Hasil aktualnya yaitu tampil "1 (Semester awal)" karena `$semester` bernilai 1. Jika nilainya diubah menjadi 4 atau 7, keterangannya berubah menjadi "Semester menengah" dan "Semester akhir".
- `switch-case-default`: Langkahnya yaitu lihat baris Program Studi dan Fokus program studi. Hasil aktualnya yaitu tampil "Teknik Informatika (TI)" dan "Komputasi dan pengembangan perangkat lunak". Jika `$programStudi` diisi nilai lain, fokusnya menjadi "Belum ditentukan".
- Perulangan `for`: Langkahnya yaitu lihat daftar Target Belajar. Hasil aktualnya yaitu muncul 5 target, dan target ke-5 bertuliskan "Belum dipetakan" karena masuk ke `default`.
- Perulangan `while`: Langkahnya yaitu lihat daftar Semester. Hasil aktualnya yaitu muncul Semester 1, 2, dan 3.
- Format nilai dan `null`: Langkahnya yaitu lihat baris IPK dan Catatan tambahan. Hasil aktualnya yaitu IPK tampil `3,75` dan catatan tampil "Belum ada" karena nilainya `null`.
- Fitur lama (navigasi dan form): Langkahnya yaitu klik tombol ☰ dan kirim form dengan data kosong maupun valid. Hasil aktualnya yaitu menu dan validasi tetap berfungsi seperti pada `index.html`.
## Riwayat Pengembangan
Catat perkembangan melalui commit Git yang bermakna.
- `menyalin file p5 ke p6`: Menyalin artefak P5 ke P6 sebagai baseline.
- `mengubah index.html menjadi index.php`: Mengganti ekstensi file.
- `pengujian komentar, echo, tag dasar PHP`: Menguji tag `<?php ?>`, komentar, dan `echo` untuk memastikan PHP diproses oleh peladen.
- `mempelajari komentar dan keluaran dengan echo dan print di PHP`: Membandingkan `echo` dan `print`, serta memastikan isi komentar tidak tampil di halaman.
- `membandingkan keluaran tag HTML dan tag HTML di dalam tag PHP`: Membandingkan HTML statis dengan HTML yang dihasilkan PHP, lalu memeriksanya lewat View Page Source.
- `menambahkan deklarasi variabel PHP`: Menambahkan variabel data diri (`$nim`, `$namaMahasiswa`, `$semester`, `$ipk`, dan lainnya) di bagian atas `index.php`.
- `menambahkan konstanta PHP`: Menambahkan konstanta `NAMA_MATA_KULIAH` dan `PROFIL_GITHUB` menggunakan `const`.
- `menampilkan data mahasiswa dengan variabel dan konstanta`: Menampilkan nama, mata kuliah, dan tahun akademik di bagian Beranda, serta memakai konstanta untuk tautan GitHub.
- `menambahkan operator aritmetika PHP`: Menghitung sisa semester (`$batasSemester - $semester`) dan menampilkannya di Profil Singkat.
- `menerapkan pemeriksaan rentang semester`: Memakai operator perbandingan, logika, dan ternary untuk menampilkan status "Sesuai rentang" atau "Perlu diperiksa".
- `menerapkan percabangan if elseif else`: Menentukan keterangan semester awal, menengah, atau akhir berdasarkan nilai `$semester`.
- `menerapkan operator ternary pada profil mahasiswa`: Menentukan nama program studi dan status mahasiswa (Aktif/Tidak aktif) dengan operator `? :`.
- `menerapkan percabangan switch case`: Menentukan fokus program studi berdasarkan kode program studi.
- `menerapkan perulangan for untuk target belajar`: Membuat daftar lima target belajar dengan `for`, dipadukan dengan `switch`.
- `menerapkan perulangan while untuk nomor semester`: Membuat daftar Semester 1 sampai 3 dengan `while`.
- `memformat tampilan IPK dengan number_format`: Menampilkan IPK dengan dua angka desimal dan koma sebagai pemisah.
- `menampilkan catatan tambahan berdasarkan nilai null`: Menampilkan "Belum ada" jika `$catatanTambahan` bernilai `null`.
- `menampilkan tahun dinamis pada footer`: Mengganti tahun statis di footer dengan `date("Y")`.
- `menerapkan sintaks keluaran singkat PHP`: Memastikan tautan GitHub dan footer memakai sintaks singkat `<?= ... ?>`.
- `menyesuaikan action formulir ke index.php`: Mengubah atribut `action` form dari `index.html` menjadi `index.php`.
- `mengisi readme untuk dokumentasi`: Menulis dokumentasi fitur dan pengembangan, cara menjalanlan, pengujian, riwayat pengembangan.