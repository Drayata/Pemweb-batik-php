// ==========================================================================
// ATELIER PEKALONGAN / PESONA BATIK PEKALONGAN — Vanilla JS (PRD.md & DESIGN.md)
// ==========================================================================

// 1. Slide-Out Navigation Drawer & Modals (DESIGN.md Section 5.6)
function toggleDrawer(open) {
  var drawer = document.getElementById("menu-drawer");
  if (!drawer) return;
  if (open) {
    drawer.classList.add("open");
  } else {
    drawer.classList.remove("open");
  }
}

function toggleModal(modalId, open) {
  var modal = document.getElementById(modalId);
  if (!modal) return;
  if (open) {
    modal.classList.add("open");
  } else {
    modal.classList.remove("open");
  }
}

function openConsultWithMotif(motifName) {
  var motifSelect = document.getElementById("consult-motif");
  if (motifSelect && motifName) {
    motifSelect.value = motifName;
  }
  var successBox = document.getElementById("consult-success");
  if (successBox) {
    successBox.style.display = "none";
  }
  toggleModal("consult-modal", true);
}

function submitConsultation(event) {
  if (event) event.preventDefault();
  var nama = document.getElementById("consult-nama")
    ? document.getElementById("consult-nama").value.trim()
    : "";
  var motif = document.getElementById("consult-motif")
    ? document.getElementById("consult-motif").value
    : "Jlamprang";
  var catatan = document.getElementById("consult-catatan")
    ? document.getElementById("consult-catatan").value.trim()
    : "";
  var successBox = document.getElementById("consult-success");
  if (successBox) {
    successBox.style.display = "block";
    successBox.textContent =
      "Terima kasih " +
      (nama || "Pelanggan") +
      ". Permintaan konsultasi motif " +
      motif +
      " telah disiapkan.";
  }
  var pesan =
    "Halo Atelier Pesona Batik Pekalongan, saya " +
    (nama || "Pelanggan") +
    " ingin konsultasi pesanan khusus Motif " +
    motif +
    ". Catatan: " +
    (catatan || "-");
  var waUrl = "https://wa.me/6281234567890?text=" + encodeURIComponent(pesan);
  window.open(waUrl, "_blank");
  return false;
}

// 4. Live Catalog Search & Category Filter (PRD.md Section 5.B.1)
function filterCatalog() {
  var searchInput = document.getElementById("searchInput");
  var categoryFilter = document.getElementById("categoryFilter");
  var keyword = searchInput ? searchInput.value.toLowerCase().trim() : "";
  var category = categoryFilter
    ? categoryFilter.value.toLowerCase().trim()
    : "";

  var cards = document.querySelectorAll(".product-card");
  var visibleCount = 0;

  for (var i = 0; i < cards.length; i++) {
    var card = cards[i];
    var title = (card.getAttribute("data-nama") || "").toLowerCase();
    var motif = (card.getAttribute("data-motif") || "").toLowerCase();
    var kat = (card.getAttribute("data-kategori") || "").toLowerCase();

    var matchKeyword =
      !keyword ||
      title.indexOf(keyword) !== -1 ||
      motif.indexOf(keyword) !== -1;
    var matchCat = !category || kat === category;

    if (matchKeyword && matchCat) {
      card.style.display = "flex";
      visibleCount++;
    } else {
      card.style.display = "none";
    }
  }

  var emptyNotice = document.getElementById("catalogEmptyNotice");
  if (emptyNotice) {
    emptyNotice.style.display = visibleCount === 0 ? "block" : "none";
  }
}

// 5. Live Price Calculator & Direct WhatsApp Checkout (PRD.md Section 4.2 & 5.B.2)
function formatRupiah(angka) {
  var num = parseInt(angka, 10) || 0;
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateTotalHarga() {
  var hargaEl = document.getElementById("hargaSatuan");
  var jumlahEl = document.getElementById("jumlah");
  var totalDisplay = document.getElementById("totalHargaDisplay");
  if (!hargaEl || !jumlahEl || !totalDisplay) return;

  var harga = parseInt(hargaEl.value, 10) || 0;
  var jumlah = parseInt(jumlahEl.value, 10) || 1;
  if (jumlah < 1) {
    jumlah = 1;
    jumlahEl.value = 1;
  }
  var total = harga * jumlah;
  totalDisplay.textContent = "Rp " + formatRupiah(total);
}

function checkoutWhatsApp(event) {
  if (event) event.preventDefault();

  var namaBatik = document.getElementById("namaBatik").value;
  var harga = parseInt(document.getElementById("hargaSatuan").value, 10) || 0;
  var ukuran = document.getElementById("ukuran").value.trim();
  var jumlah = parseInt(document.getElementById("jumlah").value, 10) || 1;
  var namaPembeli = document.getElementById("nama_pembeli").value.trim();
  var alamat = document.getElementById("alamat").value.trim();

  if (!namaPembeli || !alamat) {
    alert("Mohon lengkapi Nama Pembeli dan Alamat Pengiriman.");
    return false;
  }

  var totalHarga = harga * jumlah;
  var pesan =
    "Halo Admin Pesona Batik Pekalongan, saya ingin memesan:\n" +
    "- Produk: " +
    namaBatik +
    "\n" +
    "- Ukuran: " +
    ukuran +
    "\n" +
    "- Jumlah: " +
    jumlah +
    " pcs\n" +
    "- Total Harga: Rp " +
    formatRupiah(totalHarga) +
    "\n" +
    "Atas nama: " +
    namaPembeli +
    " (" +
    alamat +
    "). Apakah stok masih tersedia?";

  var waUrl = "https://wa.me/6281234567890?text=" + encodeURIComponent(pesan);
  window.open(waUrl, "_blank");
  return false;
}
