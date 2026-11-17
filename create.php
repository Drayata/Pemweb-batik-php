<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include("koneksi.php");

if (isset($_POST['Submit'])) {
    $nama_batik = $_POST['nama_batik'];
    $kategori = $_POST['kategori'];
    $jenis_motif = $_POST['jenis_motif'];
    $bahan = $_POST['bahan'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    if ($gambar != "") {
        move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/img/" . $gambar);
    } else {
        $gambar = "default.jpg";
    }

    $result = mysqli_query($koneksi, "INSERT INTO produk(nama_batik, kategori, jenis_motif, bahan, ukuran, harga, stok, gambar, deskripsi) VALUES('$nama_batik', '$kategori', '$jenis_motif', '$bahan', '$ukuran', '$harga', '$stok', '$gambar', '$deskripsi')");

    header("Location: admin_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk Batik &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div class="crud-card">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
          <span class="eyebrow-gold">Formulir Tambah Data</span>
          <h1 class="section-title" style="font-size: 2.2rem;">Tambah Koleksi Batik</h1>
        </div>
        <a href="admin_index.php" class="action-link">&larr; Kembali ke Dashboard</a>
      </div>

      <form action="create.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nama_batik">Nama Batik</label>
          <input type="text" id="nama_batik" name="nama_batik" class="form-control" placeholder="Contoh: Kemeja Batik Tulis Jlamprang Eksklusif" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-control" required>
              <option value="Kemeja Pria">Kemeja Pria</option>
              <option value="Blouse Wanita">Blouse Wanita</option>
              <option value="Kain Batik">Kain Batik</option>
              <option value="Sarimbit">Sarimbit</option>
            </select>
          </div>

          <div class="form-group">
            <label for="jenis_motif">Jenis Motif</label>
            <input type="text" id="jenis_motif" name="jenis_motif" class="form-control" placeholder="Contoh: Jlamprang / Tujuh Rupa / Buketan" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="bahan">Bahan Kain</label>
            <input type="text" id="bahan" name="bahan" class="form-control" placeholder="Contoh: Katun Primisima / Mori Sutra" required>
          </div>

          <div class="form-group">
            <label for="ukuran">Ukuran Tersedia</label>
            <input type="text" id="ukuran" name="ukuran" class="form-control" placeholder="Contoh: M, L, XL atau 200x115 cm" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" class="form-control" placeholder="Contoh: 275000" required>
          </div>

          <div class="form-group">
            <label for="stok">Stok (pcs)</label>
            <input type="number" id="stok" name="stok" class="form-control" placeholder="Contoh: 10" required>
          </div>
        </div>

        <div class="form-group">
          <label for="gambar">Foto Produk Batik (Kosongkan untuk default.jpg)</label>
          <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi Lengkap</label>
          <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan filosofi motif, karakteristik bahan, dan petunjuk perawatan..." required></textarea>
        </div>

        <button type="submit" name="Submit" class="btn-primary-sogan" style="width: 100%; padding: 0.95rem;">
          Simpan Produk Batik
        </button>
      </form>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
