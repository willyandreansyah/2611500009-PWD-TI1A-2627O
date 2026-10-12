const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");
const contactForm = document.getElementById("contactForm");

const jenisPesan = document.querySelector('input[name="jenis_pesan"]:checked');
if (!jenisPesan) {
    // Proses validasi ketika jenis pesan belum dipilih.
}

const topikDipilih = document.querySelectorAll('input[name="minat"]:checked');
if (topikDipilih.length === 0) {
    // Proses validasi ketika belum ada topik yang dipilih.
}