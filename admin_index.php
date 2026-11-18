<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include("koneksi.php");

// ponytail: direct file overwrite to assets/img/hero.jpg avoids extra DB table; move to settings table if multiple hero slides are needed.
if (isset($_POST['update_hero'])) {
    if (isset($_FILES['hero_gambar']) && $_FILES['hero_gambar']['name'] != "") {
        move_uploaded_file($_FILES['hero_gambar']['tmp_name'], "assets/img/hero.jpg");
    }
    header("Location: admin_index.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
$hero_ver = file_exists("assets/img/hero.jpg") ? filemtime("assets/img/hero.jpg") : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div class="admin-toolbar">
      <div>
        <span class="eyebrow-gold">Manajemen Katalog Produk</span>
        <h1 class="section-title" style="font-size: 2.2rem;">
          <?php echo "Halo, " . $_SESSION['username']; ?>
        </h1>
      </div>
      <div class="admin-actions">
        <a href="create.php" class="btn-primary-sogan">+ Tambah Baju Batik</a>
        <a href="index.php" class="action-link" style="padding: 0.7rem 1.1rem;">Lihat Katalog Publik</a>
        <a href="logout.php" class="action-link delete" style="padding: 0.7rem 1.1rem;">Logout</a>
      </div>
    </div>

    <!-- Pengaturan Gambar Hero Section -->
    <div class="admin-toolbar" style="margin-bottom: 1.75rem;">
      <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;">
        <img
          src="assets/img/hero.jpg?v=<?php echo $hero_ver; ?>"
          width="120"
          height="72"
          alt="Preview Hero"
          style="object-fit: cover; border: 1px solid rgba(74, 44, 17, 0.25);"
          onerror="this.src='assets/img/default.jpg'"
        >
        <div>
          <span class="eyebrow-gold">Tampilan Utama (Hero Banner)</span>
          <strong style="display: block; font-family: var(--font-serif); font-size: 1.4rem;">Gambar Background Hero Section</strong>
          <span style="font-size: 0.8rem; color: rgba(38, 33, 29, 0.72);">Unggah foto baru untuk mengganti background utama halaman depan (`assets/img/hero.jpg`).</span>
        </div>
      </div>

      <form action="admin_index.php" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
        <input type="file" name="hero_gambar" class="form-control" accept="image/*" style="width: auto; max-width: 260px;" required>
        <button type="submit" name="update_hero" class="btn-primary-sogan">Ganti Gambar Hero</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Batik</th>
            <th>Kategori</th>
            <th>Motif</th>
            <th>Bahan</th>
            <th>Ukuran</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Operasi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($data = mysqli_fetch_array($result)) {
              $img_file = !empty($data['gambar']) ? $data['gambar'] : 'default.jpg';
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td>
              <img src="assets/img/<?php echo $img_file; ?>" width="60" alt="<?php echo $data['nama_batik']; ?>" onerror="this.src='assets/img/default.jpg'">
            </td>
            <td><strong><?php echo $data['nama_batik']; ?></strong></td>
            <td><?php echo $data['kategori']; ?></td>
            <td><?php echo $data['jenis_motif']; ?></td>
            <td><?php echo $data['bahan']; ?></td>
            <td><?php echo $data['ukuran']; ?></td>
            <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $data['stok']; ?> pcs</td>
            <td style="max-width: 240px;"><?php echo $data['deskripsi']; ?></td>
            <td style="white-space: nowrap;">
              <a href="update.php?id=<?php echo $data['id']; ?>" class="action-link">Edit</a>
              <a href="delete.php?id=<?php echo $data['id']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus data batik ini?');">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
