# Pertemuan 3 - Formulir HTML dan CSS Dasar
## Baseline
- Menggunakan hasil P2 sebagai dasar pengembangan P3.
- Menyalin `index.html` dan `img/foto-profil.jpg` ke `pertemuan-03/`.
## Implementasi Formulir
- Elemen form yang digunakan: [`<form>`, `<label>`, `<input>`, `<textarea>`, `<select>`, `<option>`, `<button>`]
- Tipe input yang digunakan: [1. text, 2. email, 3. number, 4. date, 5. radio, 6. checkbox, 7. submit, 8. reset]
- Atribut validasi yang digunakan: [for, id, name, action, method, placeholder, minlength, maxlength, required, min, max]
## Pengujian GET dan POST
- Hasil pengujian GET: [https://willyandreansyah.github.io/2611500009-PWD-TI1A-2627O/pertemuan-03/index.html?nama=Willy+Andreansyah&email=2611500009%40mahasiswa.atmaluhur.ac.id&semester=1&tanggal=2026-09-28&jenis_pesan=saran&minat=HTML&minat=CSS&prodi=TI&pesan=Terima+Kasih+Pak]
- Contoh URL encoding yang ditemukan: [?nama=Willy+Andreansyah, &email=2611500009%40mahasiswa.atmaluhur.ac.id, &semester=1, &tanggal=2026-09-28, &jenis_pesan=saran, &minat=HTML&minat=CSS, &prodi=TI, &pesan=Terima+Kasih+Pak]
- Hasil pengujian POST: [GitHub Pages menolak permintaan POST atau menampilkan respons galat karena tidak tersedia
pemrosesan sisi peladen yaitu berisi 405 Not Allowed]
## CSS Dasar
- Selector elemen: [Pada pertemuan P3 ini tidak ada yang langsung memakai Selector Elemen pada css]
- Selector class: [.form-group, .input-form]
- Selector ID: [#about, #about h2, #about h3, #about p, #about ol, #contact, #contact h2, #contact label, #contact button]
- Properti CSS dasar yang digunakan: [color, background-color, border, padding, margin, font-family, border-bottom, padding-bottom, margin-bottom, font-weight, font-size]
## Pengujian dan Perbaikan
- Galat yang ditemukan: [tidak ada kecuali pembelajaran pada modul untuk mencoba method="post"]
- Penyebab galat: [tidak ada kecuali pembelajaran pada modul untuk mencoba method="post", kenapa method="post" tidak muncul pada URL, karena GitHub Pages adalah hosting statis, sehingga data formulir tidak diproses oleh server]
- Perbaikan yang dilakukan: [kembalikan method="post" menjadi method="get" seperti yang diajarkan di modul p3]
- Hasil pengujian ulang: [setelah di kembalikan menjadi method="get" dan mencoba mengisi kembali form di web, setelah submit, amati query string dan perubahan pada URL]
## GitHub Pages
URL: [https://willyandreansyah.github.io/2611500009-PWD-TI1A-2627O/pertemuan-03/]