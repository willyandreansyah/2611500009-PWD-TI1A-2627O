<?php
session_start();

function bersihkan($teks)
{
	return htmlspecialchars($teks ?? "", ENT_QUOTES, "UTF-8");
}

echo "<h1>hai disana</h1>";
echo "<script>
	alert('hai');
	</script>";

echo bersihkan("<p>hai disana</p>");
echo bersihkan("<script>
	alert('hai');
	</script>");

// P7/P8: Memproses data formulir dan menyimpannya ke dalam session.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// Menentukan formulir mana yang dikirim melalui input tersembunyi "form_type".
	$formType = trim((string) ($_POST["form_type"] ?? ""));

	if ($formType === "rencanakegiatan") {
		// Formulir Rencana Kegiatan: hanya menyimpan data kegiatan.
		$_SESSION["namakegiatan"] = trim((string) ($_POST["namakegiatan"] ?? ""));
		$_SESSION["kategorikegiatan"] = trim((string) ($_POST["kategorikegiatan"] ?? ""));
		$_SESSION["tanggalpelaksanaan"] = trim((string) ($_POST["tanggalpelaksanaan"] ?? ""));
		$_SESSION["lokasikegiatan"] = trim((string) ($_POST["lokasikegiatan"] ?? ""));
		$_SESSION["deskripsikegiatan"] = trim((string) ($_POST["deskripsikegiatan"] ?? ""));

		$anchor = "rencanakegiatan";
	} else {
		// Formulir Kontak: hanya menyimpan data kontak.
		$minat = $_POST["minat"] ?? [];

		// Checkbox dapat mengirimkan lebih dari satu nilai.
		if (!is_array($minat)) {
			$minat = [];
		}

		$_SESSION["nama"] = trim((string) ($_POST["nama"] ?? ""));
		$_SESSION["email"] = trim((string) ($_POST["email"] ?? ""));
		$_SESSION["semester"] = trim((string) ($_POST["semester"] ?? ""));
		$_SESSION["tanggal"] = trim((string) ($_POST["tanggal"] ?? ""));
		$_SESSION["jenis_pesan"] = trim((string) ($_POST["jenis_pesan"] ?? ""));
		$_SESSION["minat"] = $minat;
		$_SESSION["prodi"] = trim((string) ($_POST["prodi"] ?? ""));
		$_SESSION["pesan"] = trim((string) ($_POST["pesan"] ?? ""));

		$anchor = "contact";
	}

	// PRG: mencegah pengiriman POST berulang ketika halaman dimuat ulang.
	header("Location: index.php#" . $anchor);
	exit;
}

// Mengamankan data sebelum ditampilkan kembali ke halaman HTML.
// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
$nim = "2611500009";
$namaMahasiswa = "Willy Andreansyah";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 1;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "willyandreansyah";

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 4: Percabangan switch-case-default
switch ($programStudi) {
	case "SI":
		$fokusProgramStudi = "Sistem informasi dan proses bisnis";
		break;
	case "TI":
		$fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
		break;
	default:
		$fokusProgramStudi = "Belum ditentukan";
}
?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profil Mahasiswa</title>
	<link rel="stylesheet" href="style.css?v=2" />
</head>

<body>
	<header>
		<div class="header-top">
			<h1>Profil Mahasiswa</h1>

			<button
				class="nav-toggle"
				id="navToggle"
				type="button"
				aria-label="Buka navigasi"
				aria-controls="navMenu"
				aria-expanded="false">
				&#9776;
			</button>
		</div>

		<nav>
			<ul id="navMenu">
				<li><a href="#home">Beranda</a></li>
				<li><a href="#about">Tentang</a></li>
				<li><a href="#contact">Kontak</a></li>
				<li><a href="#rencanakegiatan">Rencana Kegiatan</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>

			<img src="img/foto-profil.jpg?v=2" alt="Foto profil Nama Mahasiswa" />
		</section>

		<section id="about">
			<h2>Tentang Saya</h2>

			<article>
				<h3>Profil Singkat</h3>
				<p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
				<p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
				<p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
				<p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
				<p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
				<p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
				<p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
				<p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>

				<h3>Target Belajar (Perulangan for)</h3>
				<ol>
					<?php
					// Perulangan for tanpa array; materi larik dibahas pada P9.
					for ($i = 1; $i <= 5; $i++) {
						echo "<li>Target belajar ke-" . $i . ": ";
						switch ($i) {
							case 1:
								echo "Memahami sintaks dasar PHP.";
								break;
							case 2:
								echo "Menggunakan variabel dan konstanta.";
								break;
							case 3:
								echo "Menerapkan operator dan percabangan.";
								break;
							case 4:
								echo "Menggunakan perulangan for dan while.";
								break;
							default:
								echo "Belum dipetakan";
								break;
						}
						echo "</li>";
					}
					?>
				</ol>

				<h3>Semester (Perulangan while):</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3) {
						echo "<li>Semester " . $nomorSemester . "</li>";
						$nomorSemester++; // operator penugasan
					}
					?>
				</ol>
			</article>
		</section>

		<section id="rencanakegiatan">
			<h2>Rencana Kegiatan Mahasiswa</h2>

			<form id="rencanakegiatanForm" class="js-rencanakegiatan-form" data-validation="rencanakegiatan" action="index.php" method="post" novalidate>
				<input type="hidden" name="form_type" value="rencanakegiatan" />

				<div class="form-group">
					<label for="namakegiatan">Nama Kegiatan</label><br />

					<input class="input-form" type="text" id="namakegiatan" name="namakegiatan" placeholder="Nama Kegiatan" minlength="3" maxlength="50" required />
				</div>

				<div class="form-group">
					<p>Kategori Kegiatan</p>

					<input type="radio" id="wajib" name="kategorikegiatan" value="Wajib" required />
					<label for="wajib">Wajib</label>

					<input type="radio" id="tidakwajib" name="kategorikegiatan" value="Tidak Wajib" />
					<label for="tidakwajib">Tidak Wajib</label>
				</div>

				<div class="form-group">
					<label for="tanggalpelaksanaan">Tanggal Pelaksanaan</label><br />

					<input class="input-form" type="date" id="tanggalpelaksanaan" name="tanggalpelaksanaan" required />
				</div>

				<div class="form-group">
					<label for="lokasikegiatan">Lokasi Kegiatan</label><br />

					<select class="input-form" id="lokasikegiatan" name="lokasikegiatan" required>
						<option value="">-- Pilih Lokasi Kegiatan --</option>
						<option value="Di Luar Kampus">Di Luar Kampus</option>
						<option value="Di Dalam Kampus">Di Dalam Kampus</option>
					</select>
				</div>

				<div class="form-group">
					<label for="deskripsikegiatan">Deskripsi Kegiatan</label><br />

					<textarea class="input-form" id="deskripsikegiatan" name="deskripsikegiatan" maxlength="300" placeholder="Tulis pesan Anda" required></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if (isset($_SESSION["namakegiatan"])): ?>
				<article id="hasilRencanakegiatan" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<p><strong>Nama Kegiatan:</strong> <?= htmlspecialchars($_SESSION["namakegiatan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Kategori Kegiatan:</strong> <?= htmlspecialchars($_SESSION["kategorikegiatan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Tanggal Pelaksanaan:</strong> <?= htmlspecialchars($_SESSION["tanggalpelaksanaan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Lokasi Kegiatan:</strong> <?= htmlspecialchars($_SESSION["lokasikegiatan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Deskripsi Kegiatan:</strong> <?= htmlspecialchars($_SESSION["deskripsikegiatan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
				</article>
			<?php endif; ?>
		</section>

		<section id="contact">
			<h2>Kontak</h2>

			<p>
				Kunjungi
				<a target="_blank" href="https://github.com/<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>

			<form id="contactForm" class="js-contact-form" data-validation="contact" action="index.php" method="post" novalidate>
				<input type="hidden" name="form_type" value="contact" />

				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br />

					<input
						class="input-form"
						type="text"
						id="nama"
						name="nama"
						placeholder="Masukkan nama lengkap"
						minlength="3"
						maxlength="50"
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />

					<input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />

					<input class="input-form" type="number" id="semester" name="semester" min="1" max="14" required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />

					<input class="input-form" type="date" id="tanggal" name="tanggal" required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>

					<input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" required />
					<label for="pertanyaan">Pertanyaan</label>

					<input type="radio" id="saran" name="jenis_pesan" value="saran" />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>

					<input type="checkbox" id="minat-html" name="minat[]" value="HTML" />
					<label for="minat-html">HTML</label>

					<input type="checkbox" id="minat-css" name="minat[]" value="CSS" />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />

					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI">Sistem Informasi</option>
						<option value="TI">Teknik Informatika</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pesan">Pesan</label><br />

					<textarea
						class="input-form"
						id="pesan"
						name="pesan"
						maxlength="300"
						placeholder="Tulis pesan Anda"
						required></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if (isset($_SESSION["nama"])): ?>
				<article id="hasilKontak" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($_SESSION["nama"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["email"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Semester:</strong> <?= htmlspecialchars($_SESSION["semester"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($_SESSION["tanggal"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Jenis Pesan:</strong> <?= htmlspecialchars($_SESSION["jenis_pesan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Topik yang Diminati:</strong>
						<?= htmlspecialchars(implode(", ", $_SESSION["minat"] ?? []), ENT_QUOTES, "UTF-8") ?>
					</p>
					<p><strong>Program Studi:</strong> <?= htmlspecialchars($_SESSION["prodi"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Pesan:</strong> <?= nl2br(htmlspecialchars($_SESSION["pesan"] ?? "", ENT_QUOTES, "UTF-8")) ?></p>
				</article>
			<?php endif; ?>
		</section>
	</main>

	<footer>
		<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
	</footer>
	<script src="script.js?v=2"></script>
</body>

</html>