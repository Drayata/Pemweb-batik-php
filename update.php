<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include("koneksi.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_batik = $_POST['nama_batik'];
    $kategori = $_POST['kategori'];
    $jenis_motif = $_POST['jenis_motif'];
    $bahan = $_POST['bahan'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_lama = $_POST['gambar_lama'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/img/" . $gambar);
    } else {
        $gambar = $gambar_lama;
    }

    $result = mysqli_query($koneksi, "UPDATE produk SET nama_batik='$nama_batik', kategori='$kategori', jenis_motif='$jenis_motif', bahan='$bahan', ukuran='$ukuran', harga='$harga', stok='$stok', gambar='$gambar', deskripsi='$deskripsi' WHERE id=$id");

    header("Location: admin_index.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");

while ($user_data = mysqli_fetch_array($result)) {
    $nama_batik = $user_data['nama_batik'];
    $kategori = $user_data['kategori'];
    $jenis_motif = $user_data['jenis_motif'];
    $bahan = $user_data['bahan'];
    $ukuran = $user_data['ukuran'];
    $harga = $user_data['harga'];
    $stok = $user_data['stok'];
    $gambar = $user_data['gambar'];
    $deskripsi = $user_data['deskripsi'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk Batik &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div class="crud-card">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
          <span class="eyebrow-gold">Perbarui Data Produk</span>
          <h1 class="section-title" style="font-size: 2.2rem;">Edit Koleksi Batik</h1>
        </div>
        <a href="admin_index.php" class="action-link">&larr; Kembali ke Dashboard</a>
      </div>

      <form name="update_user" method="POST" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $gambar; ?>">

        <div class="form-group">
          <label for="nama_batik">Nama Batik</label>
          <input type="text" id="nama_batik" name="nama_batik" class="form-control" value="<?php echo $nama_batik; ?>" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-control" required>
              <option value="Kemeja Pria" <?php if ($kategori == "Kemeja Pria") echo "selected"; ?>>Kemeja Pria</option>
              <option value="Blouse Wanita" <?php if ($kategori == "Blouse Wanita") echo "selected"; ?>>Blouse Wanita</option>
              <option value="Kain Batik" <?php if ($kategori == "Kain Batik") echo "selected"; ?>>Kain Batik</option>
              <option value="Sarimbit" <?php if ($kategori == "Sarimbit") echo "selected"; ?>>Sarimbit</option>
            </select>
          </div>

          <div class="form-group">
            <label for="jenis_motif">Jenis Motif</label>
            <input type="text" id="jenis_motif" name="jenis_motif" class="form-control" value="<?php echo $jenis_motif; ?>" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="bahan">Bahan Kain</label>
            <input type="text" id="bahan" name="bahan" class="form-control" value="<?php echo $bahan; ?>" required>
          </div>

          <div class="form-group">
            <label for="ukuran">Ukuran Tersedia</label>
            <input type="text" id="ukuran" name="ukuran" class="form-control" value="<?php echo $ukuran; ?>" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" class="form-control" value="<?php echo $harga; ?>" required>
          </div>

          <div class="form-group">
            <label for="stok">Stok (pcs)</label>
            <input type="number" id="stok" name="stok" class="form-control" value="<?php echo $stok; ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="gambar">Ganti Foto Produk ( Saat ini: <?php echo $gambar; ?> )</label>
          <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi Lengkap</label>
          <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required><?php echo $deskripsi; ?></textarea>
        </div>

        <button type="submit" name="update" class="btn-primary-sogan" style="width: 100%; padding: 0.95rem;">
          Update Data Batik
        </button>
      </form>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
