<?php
include("koneksi.php");

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
$data = mysqli_fetch_array($result);

if (!$data) {
    header("Location: index.php");
    exit;
}

$gambar_produk = !empty($data['gambar']) ? $data['gambar'] : 'default.jpg';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $data['nama_batik']; ?> &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div style="margin-bottom: 1.5rem;">
      <a href="index.php#katalog" class="action-link">&larr; Kembali ke Katalog Batik</a>
    </div>

    <div class="detail-grid">
      <div class="detail-image-box">
        <img
          src="assets/img/<?php echo $gambar_produk; ?>"
          alt="<?php echo $data['nama_batik']; ?>"
          onerror="this.src='assets/img/default.jpg'"
        >
      </div>

      <div>
        <span class="eyebrow-gold"><?php echo $data['kategori']; ?> &bull; Motif <?php echo $data['jenis_motif']; ?></span>
        <h1 class="section-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">
          <?php echo $data['nama_batik']; ?>
        </h1>
        <p class="product-price" style="font-size: 1.65rem; margin-bottom: 1rem;">
          Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>
        </p>

        <p style="font-size: 0.95rem; color: rgba(38, 33, 29, 0.85);">
          <?php echo $data['deskripsi']; ?>
        </p>

        <div class="spec-list">
          <div class="spec-item">
            <strong>Jenis Motif</strong>
            <span><?php echo $data['jenis_motif']; ?></span>
          </div>
          <div class="spec-item">
            <strong>Bahan Kain</strong>
            <span><?php echo $data['bahan']; ?></span>
          </div>
          <div class="spec-item">
            <strong>Ukuran Tersedia</strong>
            <span><?php echo $data['ukuran']; ?></span>
          </div>
          <div class="spec-item">
            <strong>Ketersediaan Stok</strong>
            <span><?php echo $data['stok']; ?> pcs</span>
          </div>
        </div>

        <!-- Direct WhatsApp Checkout Form (PRD.md Section 4.2) -->
        <div class="checkout-card">
          <span class="eyebrow-gold">Pemesanan Langsung (Direct Checkout)</span>
          <h2 class="section-title" style="font-size: 1.65rem; margin-bottom: 1rem;">Form Pemesanan via WhatsApp</h2>

          <form onsubmit="return checkoutWhatsApp(event)">
            <input type="hidden" id="namaBatik" value="<?php echo htmlspecialchars($data['nama_batik']); ?>">
            <input type="hidden" id="hargaSatuan" value="<?php echo $data['harga']; ?>">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <div class="form-group">
                <label for="ukuran">Pilih Ukuran</label>
                <input
                  type="text"
                  id="ukuran"
                  name="ukuran"
                  class="form-control"
                  value="<?php echo htmlspecialchars($data['ukuran']); ?>"
                  required
                >
              </div>

              <div class="form-group">
                <label for="jumlah">Jumlah (pcs)</label>
                <input
                  type="number"
                  id="jumlah"
                  name="jumlah"
                  class="form-control"
                  value="1"
                  min="1"
                  max="<?php echo $data['stok']; ?>"
                  oninput="updateTotalHarga()"
                  required
                >
              </div>
            </div>

            <div class="form-group">
              <label for="nama_pembeli">Nama Pembeli</label>
              <input
                type="text"
                id="nama_pembeli"
                name="nama_pembeli"
                class="form-control"
                placeholder="Masukkan nama lengkap Anda"
                required
              >
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Pengiriman Lengkap</label>
              <textarea
                id="alamat"
                name="alamat"
                class="form-control"
                rows="2"
                placeholder="Jl. Nusantara No. 10, Kecamatan, Kota, Kode Pos"
                required
              ></textarea>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.9rem 1rem; background: var(--sandstone-card); margin-bottom: 1rem;">
              <span style="font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.12em;">Estimasi Total Harga:</span>
              <strong id="totalHargaDisplay" style="font-size: 1.25rem; color: var(--sogan-brown);">
                Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>
              </strong>
            </div>

            <button type="submit" class="btn-primary-sogan" style="width: 100%; padding: 1rem;">
              Pesan Sekarang via WhatsApp &rarr;
            </button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
