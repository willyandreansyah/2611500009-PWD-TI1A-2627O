# Pertemuan 5 - JavaScript Dasar, DOM, Event, dan Validasi Sisi Klien
## Deskripsi
Dokumentasi pengembangan halaman web pada P5, meliputi JavaScript, DOM, event listener, interaksi
navigasi, dan validasi formulir sisi klien.
## Fitur dan Pengembangan
`getElementById()`:
- Fungsinya untuk mencari dan mengambil (memilih) satu elemen HTML berdasarkan atribut id, contohnya: `const navToggle = document.getElementById("navToggle");`.
`querySelector()`:
- Metode `querySelector()` digunakan untuk memilih satu elemen HTML berdasarkan selector CSS yang
diberikan, contohnya:
- `const jenisPesan = document.querySelector('input[name="jenis_pesan"]:checked');`.
`querySelectorAll()`:
- Metode querySelectorAll() digunakan untuk memilih beberapa elemen HTML yang sesuai dengan selector
CSS yang diberikan, contohnya: `const topikDipilih = document.querySelectorAll('input[name="minat"]:checked');`.
`addEventListener()`:
- Metode addEventListener() digunakan untuk mendaftarkan event listener pada suatu elemen HTML, sintaks dasar: `elemen.addEventListener("nama-event", fungsi);`
## Pengujian
`getElementById()`:
- Langkah: Buka `index.html` di browser pada lebar layar kecil (< 768px), lalu klik tombol ☰ (`navToggle`). Klik sekali lagi untuk menutup.
- Hasil aktual: Elemen `navToggle` dan `navMenu` berhasil diambil lewat Id. Menu navigasi tampil saat tombol diklik, dan tersembunyi saat diklik lagi. Atribut `aria-expanded` dan `aria-label` ikut berubah ("Buka navigasi" dan "Tutup navigasi").
`querySelector()`:
- Langkah: Isi seluruh form kecuali "Jenis Pesan", lalu klik Kirim. Kemudian pilih salah satu radio button dan klik Kirim lagi.
- Hasil aktual: Tanpa pilihan, muncul pesan merah "Pilih jenis pesan." karena `querySelector('input[name="jenis_pesan"]:checked')` mengembalikan `null`. Setelah salah satu radio dipilih, elemen terpilih ditemukan dan validasi lanjut ke tahap berikutnya.
`querySelectorAll()`:
- Langkah: Isi form lainnya tanpa mencentang topik minat, lalu klik Kirim. Setelah itu centang HTML atau CSS dan klik Kirim lagi.
- Hasil aktual: Tanpa centang, `querySelectorAll('input[name="minat"]:checked')` menghasilkan daftar kosong (`length === 0`) sehingga muncul pesan "Pilih minimal satu topik yang diminati." Dengan minimal satu centang, validasi lolos.
`addEventListener()`:
- Langkah: Klik Kirim dengan data tidak valid, lalu dengan data valid, kemudian ketik di salah satu input dan klik Batal.
- Hasil aktual: Event `submit` mencegah reload dan menampilkan pesan error merah atau pesan sukses hijau "Form berhasil divalidasi." Event `input` dan `reset` menghapus pesan feedback.
## Riwayat Pengembangan
Catat perkembangan melalui commit Git yang bermakna.
`membuat file javascript eksternal dan menghubungkannya ke HTML`:
- Membuat `script.js` dan menghubungkannya ke `index.html` dengan `<script src="script.js"></script>`.
`menambahkan menu button baru di HTML dengan class nav-toogle untuk membuat hamburger menu`:
- Menambahkan `<button class="nav-toggle" id="navToggle">` di `header` dan `id="navMenu"` pada daftar navigasi.
`menambahkan css untuk hamburger menu dan yang lainnya`:
- Menambahkan gaya untuk hamburger menu (`.nav-toggle`, `#navMenu`, `.nav-open`), media query untuk layar ≥ 768px, serta gaya form dan pesan feedback.
``