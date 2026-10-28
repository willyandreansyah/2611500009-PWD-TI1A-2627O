# Pertemuan 7 - Pemrosesan Formulir dengan PHP, Validasi Sisi Peladen, dan PRG
## Deskripsi
Dokumentasi pengembangan halaman web pada P7, meliputi pengiriman data formulir dengan GET dan POST, validasi sisi peladen, pengamanan keluaran HTML, penggunaan session, dan pola Post-Redirect-Get (PRG). Pengembangan dilanjutkan dari artefak P6.
## Fitur dan Pengembangan
- Baseline dari P6: Seluruh berkas P6 (`index.php`, `style.css`, `script.js`, dan folder `img`) disalin ke folder `pertemuan-07` sebagai titik awal, lalu dikembangkan tanpa mengubah artefak P6.
- Metode GET (`$_GET`): Data dikirim lewat parameter URL dan dibaca dengan `$_GET`, contohnya yaitu `if (isset($_GET['nama'])) { $nama = $_GET['nama']; }`. Demonstrasi ini disimpan di `indexGet.php` sebagai pembanding.
- Metode POST (`$_POST`): Formulir utama diubah menjadi `method="post"` agar data dikirim lewat request body dan tidak muncul di URL, contohnya yaitu `$nama = trim((string) ($_POST['nama'] ?? ''));`.
- Input checkbox `minat[]`: Nama checkbox diubah menjadi `minat[]` agar PHP menerima beberapa pilihan sebagai larik. Selector JavaScript juga disesuaikan menjadi `'input[name="minat"]:checked, input[name="minat[]"]:checked'` supaya validasi berjalan di kedua formulir.
- Validasi sisi peladen: PHP memeriksa ulang data karena validasi JavaScript bisa dilewati. Pemeriksaannya mencakup kelengkapan (`trim()`), format email (`filter_var($email, FILTER_VALIDATE_EMAIL)`), semester 1 sampai 14 (`FILTER_VALIDATE_INT`), dan nilai pilihan yang diizinkan (`in_array(..., true)`).
- Normalisasi data: Setiap masukan dibersihkan spasinya dengan `trim((string) ...)` sebelum divalidasi.
- Pengamanan keluaran: Semua data yang ditampilkan kembali memakai `htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8')` agar tidak ditafsirkan sebagai HTML.
- Session dan PRG: Hasil pemrosesan disimpan ke `$_SESSION`, lalu peladen mengalihkan dengan `header('Location: index.php'); exit;`. Pesan kesalahan dihapus dengan `unset()` setelah ditampilkan, sedangkan data formulir tetap tersimpan di session.
## Pengujian
- Parameter GET: Langkahnya yaitu buka `indexGet.php?nama=Willy`, ganti dengan `?nama=Willy%20Andreansyah`, lalu buka tanpa parameter. Hasil aktualnya yaitu tampil "Nama yang diterima: Willy", lalu "Willy Andreansyah" mengikuti parameter terbaru, dan tanpa parameter tidak ada teks maupun peringatan.
- Pengiriman formulir GET: Langkahnya yaitu isi semua kolom dengan data valid di `indexGet.php` lalu klik Kirim. Hasil aktualnya yaitu halaman dimuat ulang, URL memuat parameter setelah tanda `?` yang dipisah `&`, dan nama tampil di halaman.
- Formulir POST: Langkahnya yaitu isi formulir di `index.php` lalu klik Kirim. Hasil aktualnya yaitu data tampil di halaman dan nilai input tidak muncul di URL.
- Checkbox `minat[]`: Langkahnya yaitu kirim formulir dengan dua topik, satu topik, lalu tanpa topik, juga di `indexGet.php`. Hasil aktualnya yaitu validasi mengenali pilihan di kedua formulir, dan pesan "Pilih minimal satu topik yang diminati." muncul jika tidak ada yang dicentang.
- Validasi sisi peladen: Langkahnya yaitu nonaktifkan sementara `script.js`, kirim formulir kosong, lalu isi email dengan `bukan-email`. Hasil aktualnya yaitu pesan kesalahan PHP berwarna merah muncul ("Nama lengkap wajib diisi", "Email wajib diisi", dan seterusnya), dan "Format email tidak valid." muncul untuk email salah. `script.js` sudah diaktifkan kembali setelah pengujian.
- Pengamanan keluaran: Langkahnya yaitu isi kolom pesan dengan `<b>Mahasiswa</b>` lalu kirim. Hasil aktualnya yaitu teks tampil apa adanya, tidak menjadi huruf tebal.
- Session dan PRG: Langkahnya yaitu kirim formulir valid, lalu muat ulang halaman dengan CTRL+SHIFT+R. Hasil aktualnya yaitu setelah dikirim halaman dialihkan ke `index.php`, bagian "Data yang Diterima Peladen" tetap tampil, dan browser tidak meminta kirim ulang formulir.
## Riwayat Pengembangan
Catat perkembangan melalui commit Git yang bermakna.
- `menyalin artefak pertemuan-06 untuk digunakan sebagai baseline pertemuan-07`: Menyalin berkas P6 ke folder `pertemuan-07` sebagai titik awal.
- `mempelajari penggunaan parameter GET`: Membaca parameter URL dengan `$_GET` dan menampilkannya dengan `htmlspecialchars()`.
- `mempraktikkan pengiriman formulir GET`: Menambahkan `contactForm.submit();` di `script.js` agar form terkirim setelah lolos validasi.
- `menyimpan demonstrasi formulir GET`: Menyalin `index.php` menjadi `indexGet.php` sebagai pembanding.
- `mengubah formulir utama menjadi POST`: Mengubah `method` form menjadi `post`.
- `menerima data formulir menggunakan POST`: Mengganti `$_GET` menjadi `$_POST` untuk membaca data formulir.
- `menyesuaikan pembacaan input dan validasi formulir`: Membaca semua input, mengubah checkbox menjadi `minat[]`, dan menyesuaikan selector JavaScript.
- `menampilkan pesan kesalahan validasi PHP`: Menambahkan validasi sisi peladen dan menampilkan pesan kesalahannya.
- `mengamankan keluaran data formulir`: Menampilkan data formulir dengan `htmlspecialchars()`.
- `menerapkan session dan pola PRG`: Menyimpan hasil ke session dan mengalihkan dengan `header('Location: ...')`.
- `mengisi readme untuk dokumentasi`: Menulis dokumentasi fitur dan pengembangan, pengujian, dan riwayat pengembangan.