# pertemuan-10

Pada P10, yang saya lakukan adalah:

1. Menyalin artefak bahan pertemuan 09, sebagai baseline pertemuan 10, dan menguji tampilan `http://localhost/PWD/2627o/ti1a/2611500009-PWD-TI1A-2627O/pertemuan-10/` dimana hasilnya masih sama dengan artefak bahan pertemuan 09
2. Menyiapkan direktori dan lingkungan pengembangan pertemuan 10, pengujian: Menjalankan laragon dan memastikan layanan Apache dan MySQL berjalan lancar
3. Memeriksa kesiapan phpMyAdmin dan repositori pertemuan 10, pengujian: Memastikan phpMyAdmin dapat dibuka dan menampilkan antarmuka pengelolaan basis data MySQL
4. Mengidentifikasi kebutuhan data formulir kontak P10, pengujian: Memeriksa kembali bagian formulir pada  `pertemuan-10\index.php`, dan memastikan kedelapan data tersebut sesuai dengan atribut name dan jenis input yang tersedia pada kode
5. Menentukan data formulir yang akan disimpan ke basis data, pengujian: Mencocokkan delapan data yang akan disimpan dengan elemen formulir pada `pertemuan-10\index.php`, dan memastikan tidak ada informasi profil yang dimasukkan sebagai bagian dari data formulir kontak
6. Menentukan representasi data pilihan minat, pengujian: Memeriksa kembali kode formulir pada `pertemuan-10\index.php`, dan memastikan kedua checkbox menggunakan atribut `name="minat[]"` dan memiliki nilai HTML serta CSS
7. Menentukan nama basis data dan tabel P10, pengujian: Memeriksa penulisan nama basis data dan tabel berdasarkan NIM masing-masing `(NIM saya sendiri: 2611500009)`, dan memastikan kedua nama mengikuti pola yang telah ditentukan `(nama basis data: db_pwd_2611500009 dan nama tabel: tbl_kontak_2611500009)`
8. Merancang atribut dan tipe data tabel kontak, pengujian: Memeriksa kembali delapan atribut dan tipe data yang telah ditentukan, dan memastikan nama atribut sesuai dengan data formulir P9 dan ukuran tipe data sesuai dengan batasan input yang digunakan
9. Menentukan primary key dan auto increment tabel kontak, pengujian: Memastikan atribut id telah ditambahkan pada rancangan tabel dengan tipe data INT, ditetapkan sebagai PRIMARY KEY dan menggunakan AUTO_INCREMENT
10. Memeriksa rancangan akhir struktur tabel kontak, pengujian: Memeriksa kembali rancangan sembilan atribut yang telah dibuat, dan memastikan seluruh data formulir P9 telah terwakili, tipe data sesuai dengan karakteristik masing-masing atribut, dan hanya atribut id yang ditetapkan sebagai PRIMARY KEY dengan AUTO_INCREMENT
11. Memasukkan data awal ke tabel kontak, pengujian: Memastikan data berhasil dimasukkan tanpa pesan kesalahan, dan memeriksa kembali nilai yang diisikan pada setiap atribut dan pastikan id terbentuk secara otomatis
12. Mempelajari perintah SQL insert, pengujian: Memperhatikan hubungan antara perintah INSERT dan atribut tabel yang telah dibuat pada SQL Insert, dan memastikan data berhasil ditambahkan
13. Memeriksa data awal pada tabel kontak, pengujian: Memastikan data yang ditampilkan pada tab Browse sesuai dengan data yang dimasukkan sebelumnnya (ada dua data yang dimasukkan pertama menggunakan `Insert` kedua menggunakan `SQL Insert`), dan memeriksa setiap atribut dan memastikan tidak terdapat data yang hilang atau berubah secara tidak disengaja
14. Memeriksa dan memperbaiki data awal tabel kontak, pengujian: Memastikan seluruh data pada tabel sesuai dengan ketentuan atribut dan nilai yang digunakan pada formulir P9
15. Menentukan pengaturan ekspor basis data, pengujian: Memastikan basis data `db_pwd_2611500009` telah dipilih dan pengaturan ekspor menggunakan metode Quick serta format SQL
16. Mengekspor basis data ke berkas SQL, pengujian: Memastikan berkas `db_pwd_2611500009.sql` berhasil diunduh dan telah ditempatkan pada direktori `pertemuan-10`
17. Memeriksa kelengkapan berkas ekspor SQL, pengujian: Memastikan berkas SQL memuat struktur tabel `db_pwd_2611500009` dan data awal yang telah dimasukkan, dan memeriksa kesesuaian nama tabel, sembilan atribut, serta nilai data yang diekspor