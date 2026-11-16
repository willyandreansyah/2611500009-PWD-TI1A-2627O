<?php
session_start();

include("fungsi.php");

// echo "<h1>hai disana</h1>";
// echo "<script>
// 	alert('hai');
// 	</script>";

// echo bersihkan("<p>hai disana</p>");
// echo bersihkan("<script>
// 	alert('hai');
// 	</script>");

// Mengambil nilai teks dari $_POST (selalu string dan sudah di-trim).
function ambilTeks(string $kunci): string
{
	$nilai = $_POST[$kunci] ?? "";
	return is_scalar($nilai) ? trim((string) $nilai) : "";
}

// Memeriksa tanggal berformat Y-m-d yang benar-benar valid.
function tanggalValid(string $tanggal): bool
{
	$d = DateTime::createFromFormat("Y-m-d", $tanggal);
	return $d !== false && $d->format("Y-m-d") === $tanggal;
}

// ---------------------------------------------------------------
// P7/P8/P9: Memproses data formulir dan menyimpannya ke dalam session.
//   $_SESSION["kegiatan"]         = data Rencana Kegiatan yang valid (array)
//   $_SESSION["kontak"]           = data Kontak yang valid (array)
//   $_SESSION["galat"]["kegiatan"] / ["kontak"] = pesan kesalahan (sekali tampil)
// ---------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// Menentukan formulir mana yang dikirim melalui input tersembunyi "form_type".
	$formType = ambilTeks("form_type");
	$anchor = "home";

	if ($formType === "rencanakegiatan") {
		// Formulir Rencana Kegiatan: hanya memproses data kegiatan.
		$data = [
			"namakegiatan"       => ambilTeks("namakegiatan"),
			"kategorikegiatan"   => ambilTeks("kategorikegiatan"),
			"tanggalpelaksanaan" => ambilTeks("tanggalpelaksanaan"),
			"lokasikegiatan"     => ambilTeks("lokasikegiatan"),
			"deskripsikegiatan"  => ambilTeks("deskripsikegiatan"),
		];

		$galat = validasiRencanaKegiatan($data);

		if ($galat === "") {
			$_SESSION["kegiatan"] = $data;
			unset($_SESSION["galat"]["kegiatan"]);
		} else {
			$_SESSION["galat"]["kegiatan"] = $galat;
		}

		$anchor = "rencanakegiatan";
	} elseif ($formType === "contact") {
		// Formulir Kontak: hanya memproses data kontak.
		$minat = $_POST["minat"] ?? [];

		// Checkbox dapat mengirimkan lebih dari satu nilai.
		if (!is_array($minat)) {
			$minat = [];
		}
		$minat = array_values(array_filter(array_map(
			static fn($m) => is_scalar($m) ? trim((string) $m) : "",
			$minat
		), static fn($m) => $m !== ""));

		$data = [
			"nama"        => ambilTeks("nama"),
			"email"       => ambilTeks("email"),
			"semester"    => ambilTeks("semester"),
			"tanggal"     => ambilTeks("tanggal"),
			"jenis_pesan" => ambilTeks("jenis_pesan"),
			"minat"       => $minat,
			"prodi"       => ambilTeks("prodi"),
			"pesan"       => ambilTeks("pesan"),
		];

		$galat = validasiKontak($data);

		if ($galat === "") {
			$_SESSION["kontak"] = $data;
			unset($_SESSION["galat"]["kontak"]);
		} else {
			$_SESSION["galat"]["kontak"] = $galat;
		}

		$anchor = "contact";
	}

	// PRG: mencegah pengiriman POST berulang ketika halaman dimuat ulang.
	header("Location: index.php#" . $anchor);
	exit;
}

// Validasi sisi peladen PHP
function validasiRencanaKegiatan(array $data): string
{
	$panjangNama = mb_strlen($data["namakegiatan"], "UTF-8");
	if ($panjangNama < 3 || $panjangNama > 50) {
		return "Nama kegiatan harus diisi 3 sampai 50 karakter.";
	}

	if (!in_array($data["kategorikegiatan"], ["Wajib", "Tidak Wajib"], true)) {
		return "Pilih kategori kegiatan (Wajib atau Tidak Wajib).";
	}

	if ($data["tanggalpelaksanaan"] === "") {
		return "Tanggal pelaksanaan harus diisi.";
	}
	if (!tanggalValid($data["tanggalpelaksanaan"])) {
		return "Format tanggal pelaksanaan tidak valid.";
	}

	if (!in_array($data["lokasikegiatan"], ["Di Luar Kampus", "Di Dalam Kampus"], true)) {
		return "Pilih lokasi kegiatan.";
	}

	$panjangDeskripsi = mb_strlen($data["deskripsikegiatan"], "UTF-8");
	if ($panjangDeskripsi === 0 || $panjangDeskripsi > 300) {
		return "Deskripsi kegiatan harus diisi dan maksimal 300 karakter.";
	}

	return "";
}

function validasiKontak(array $data): string
{
	$panjangNama = mb_strlen($data["nama"], "UTF-8");
	if ($panjangNama < 3 || $panjangNama > 50) {
		return "Nama lengkap harus diisi 3 sampai 50 karakter.";
	}

	if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
		return "Masukkan alamat email yang valid.";
	}

	$semester = filter_var($data["semester"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 14]]);
	if ($data["semester"] === "" || $semester === false) {
		return "Semester harus diisi dengan angka 1 sampai 14.";
	}

	if ($data["tanggal"] === "") {
		return "Tanggal kunjungan harus diisi.";
	}
	if (!tanggalValid($data["tanggal"])) {
		return "Format tanggal kunjungan tidak valid.";
	}

	if (!in_array($data["jenis_pesan"], ["pertanyaan", "saran"], true)) {
		return "Pilih jenis pesan.";
	}

	if (count($data["minat"]) === 0) {
		return "Pilih minimal satu topik yang diminati.";
	}
	foreach ($data["minat"] as $m) {
		if (!in_array($m, ["HTML", "CSS"], true)) {
			return "Topik yang diminati tidak valid.";
		}
	}

	if (!in_array($data["prodi"], ["SI", "TI"], true)) {
		return "Pilih program studi.";
	}

	$panjangPesan = mb_strlen($data["pesan"], "UTF-8");
	if ($panjangPesan === 0 || $panjangPesan > 300) {
		return "Pesan harus diisi dan maksimal 300 karakter.";
	}

	return "";
}

// Mengambil pesan kesalahan dari session, lalu menghapusnya agar hanya tampil sekali.
$galatKegiatan = $_SESSION["galat"]["kegiatan"] ?? "";
$galatKontak = $_SESSION["galat"]["kontak"] ?? "";
unset($_SESSION["galat"]);

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

// Bagian 5: Array label untuk menampilkan hasil formulir dengan foreach
$labelKegiatan = [
	"namakegiatan"       => "Nama Kegiatan",
	"kategorikegiatan"   => "Kategori Kegiatan",
	"tanggalpelaksanaan" => "Tanggal Pelaksanaan",
	"lokasikegiatan"     => "Lokasi Kegiatan",
	"deskripsikegiatan"  => "Deskripsi Kegiatan",
];
 
$labelKontak = [
	"nama"        => "Nama Lengkap",
	"email"       => "Email",
	"semester"    => "Semester",
	"tanggal"     => "Tanggal Kunjungan",
	"jenis_pesan" => "Jenis Pesan",
	"minat"       => "Topik yang Diminati",
	"prodi"       => "Program Studi",
	"pesan"       => "Pesan",
];
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

				<p class="<?= $galatKegiatan !== "" ? "form-feedback-error" : "form-feedback" ?>" data-form-feedback aria-live="polite"><?= bersihkan($galatKegiatan) ?></p>
				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
			</form>

			<?php if (isset($_SESSION["kegiatan"])): ?>
				<article id="hasilRencanakegiatan" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<?php foreach ($labelKegiatan as $kunci => $label): ?>
						<?php $nilai = $_SESSION["kegiatan"][$kunci] ?? ""; ?>
						<p>
							<strong><?= $label ?>:</strong>
							<?= $kunci === "deskripsikegiatan" ? nl2br(bersihkan($nilai)) : bersihkan($nilai) ?>
						</p>
					<?php endforeach; ?>
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

				<p class="<?= $galatKontak !== "" ? "form-feedback-error" : "form-feedback" ?>" data-form-feedback aria-live="polite"><?= bersihkan($galatKontak) ?></p>
				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
			</form>

			<?php if (isset($_SESSION["kontak"])): ?>
				<article id="hasilKontak" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<?php foreach ($labelKontak as $kunci => $label): ?>
						<?php
						$nilai = $_SESSION["kontak"][$kunci] ?? "";
						if (is_array($nilai)) {
							$nilai = implode(", ", $nilai); // untuk "minat" (checkbox)
						}
						?>
						<p>
							<strong><?= $label ?>:</strong>
							<?= $kunci === "pesan" ? nl2br(bersihkan($nilai)) : bersihkan($nilai) ?>
						</p>
					<?php endforeach; ?>
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