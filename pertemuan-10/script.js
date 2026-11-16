// Navigasi responsif.
const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    const isOpen = navMenu.classList.toggle("nav-open");
    navToggle.setAttribute("aria-expanded", String(isOpen));
    navToggle.setAttribute(
      "aria-label",
      isOpen ? "Tutup navigasi" : "Buka navigasi",
    );
  });
}

// Validasi formulir Kontak.
// Selector menggunakan atribut/class, bukan ID formulir tertentu,
// sehingga formulir lain dapat ditambahkan dengan ID yang berbeda.
const contactForms = document.querySelectorAll(
  'form[data-validation="contact"]',
);

contactForms.forEach((contactForm) => {
  const formFeedback = contactForm.querySelector("[data-form-feedback]");

  const ambilInput = (nama) => contactForm.elements.namedItem(nama);

  contactForm.addEventListener("submit", (event) => {
    // Mencegah pengiriman otomatis sebelum seluruh validasi selesai.
    event.preventDefault();

    const namaInput = ambilInput("nama");
    const emailInput = ambilInput("email");
    const semesterInput = ambilInput("semester");
    const tanggalInput = ambilInput("tanggal");
    const prodiInput = ambilInput("prodi");
    const pesanInput = ambilInput("pesan");
    const jenisPesan = contactForm.querySelector(
      'input[name="jenis_pesan"]:checked',
    );
    const topikDipilih = contactForm.querySelectorAll(
      'input[name="minat[]"]:checked',
    );

    const nama = namaInput.value.trim();
    const email = emailInput.value.trim();
    const semester = Number(semesterInput.value);
    const tanggal = tanggalInput.value;
    const prodi = prodiInput.value;
    const pesan = pesanInput.value.trim();

    const tampilkanKesalahan = (pesanKesalahan) => {
      if (formFeedback) {
        formFeedback.textContent = pesanKesalahan;
        formFeedback.className = "form-feedback-error";
      }
    };

    if (formFeedback) {
      formFeedback.textContent = "";
      formFeedback.className = "form-feedback";
    }

    if (nama.length < 3 || nama.length > 50) {
      tampilkanKesalahan("Nama lengkap harus diisi 3 sampai 50 karakter.");
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      tampilkanKesalahan("Masukkan alamat email yang valid.");
      return;
    }

    if (
      semesterInput.value.trim() === "" ||
      !Number.isInteger(semester) ||
      semester < 1 ||
      semester > 14
    ) {
      tampilkanKesalahan("Semester harus diisi dengan angka 1 sampai 14.");
      return;
    }

    if (tanggal === "") {
      tampilkanKesalahan("Tanggal kunjungan harus diisi.");
      return;
    }

    if (!jenisPesan) {
      tampilkanKesalahan("Pilih jenis pesan.");
      return;
    }

    if (topikDipilih.length === 0) {
      tampilkanKesalahan("Pilih minimal satu topik yang diminati.");
      return;
    }

    if (prodi === "") {
      tampilkanKesalahan("Pilih program studi.");
      return;
    }

    if (pesan.length === 0 || pesan.length > 300) {
      tampilkanKesalahan("Pesan harus diisi dan maksimal 300 karakter.");
      return;
    }

    // Mengirim formulir setelah seluruh validasi JavaScript berhasil.
    // HTMLFormElement.submit() tidak memicu event submit kembali.
    contactForm.submit();
  });

  contactForm.addEventListener("reset", () => {
    if (formFeedback) {
      formFeedback.textContent = "";
      formFeedback.className = "form-feedback";
    }
  });

  contactForm.addEventListener("input", () => {
    if (formFeedback) {
      formFeedback.textContent = "";
      formFeedback.className = "form-feedback";
    }
  });
});

// Validasi formulir Rencana Kegiatan.
const rencanaForms = document.querySelectorAll(
  'form[data-validation="rencanakegiatan"]',
);
 
rencanaForms.forEach((rencanaForm) => {
  const formFeedback = rencanaForm.querySelector("[data-form-feedback]");
 
  const ambilInput = (nama) => rencanaForm.elements.namedItem(nama);
 
  const bersihkanPesan = () => {
    if (formFeedback) {
      formFeedback.textContent = "";
      formFeedback.className = "form-feedback";
    }
  };
 
  rencanaForm.addEventListener("submit", (event) => {
    // Mencegah pengiriman otomatis sebelum seluruh validasi selesai.
    event.preventDefault();
 
    const namaKegiatanInput = ambilInput("namakegiatan");
    const tanggalInput = ambilInput("tanggalpelaksanaan");
    const lokasiInput = ambilInput("lokasikegiatan");
    const deskripsiInput = ambilInput("deskripsikegiatan");
    const kategoriDipilih = rencanaForm.querySelector(
      'input[name="kategorikegiatan"]:checked',
    );
 
    const namaKegiatan = namaKegiatanInput.value.trim();
    const tanggal = tanggalInput.value;
    const lokasi = lokasiInput.value;
    const deskripsi = deskripsiInput.value.trim();
 
    const tampilkanKesalahan = (pesanKesalahan) => {
      if (formFeedback) {
        formFeedback.textContent = pesanKesalahan;
        formFeedback.className = "form-feedback-error";
      }
    };
 
    bersihkanPesan();
 
    if (namaKegiatan.length < 3 || namaKegiatan.length > 50) {
      tampilkanKesalahan("Nama kegiatan harus diisi 3 sampai 50 karakter.");
      return;
    }
 
    if (!kategoriDipilih) {
      tampilkanKesalahan("Pilih kategori kegiatan (Wajib atau Tidak Wajib).");
      return;
    }
 
    if (tanggal === "") {
      tampilkanKesalahan("Tanggal pelaksanaan harus diisi.");
      return;
    }
 
    if (lokasi === "") {
      tampilkanKesalahan("Pilih lokasi kegiatan.");
      return;
    }
 
    if (deskripsi.length === 0 || deskripsi.length > 300) {
      tampilkanKesalahan(
        "Deskripsi kegiatan harus diisi dan maksimal 300 karakter.",
      );
      return;
    }
 
    // Mengirim formulir setelah seluruh validasi JavaScript berhasil.
    rencanaForm.submit();
  });
 
  rencanaForm.addEventListener("reset", bersihkanPesan);
  rencanaForm.addEventListener("input", bersihkanPesan);
});