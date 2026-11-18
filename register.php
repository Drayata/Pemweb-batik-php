<?php
session_start();
include("koneksi.php");

$pesan_error = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    $cek_user = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username='$username'");

    if (mysqli_num_rows($cek_user) > 0) {
        $pesan_error = "Username sudah terdaftar! Gunakan username lain.";
    } elseif ($password != $konfirmasi_password) {
        $pesan_error = "Konfirmasi password tidak sesuai!";
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO pengguna (username, password) VALUES ('$username', '$password')");
        if ($insert) {
            header("Location: login.php");
            exit;
        } else {
            $pesan_error = "Gagal mendaftarkan akun baru.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Admin &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div class="auth-card">
      <span class="eyebrow-gold">Registrasi Pengelola</span>
      <h1 class="section-title" style="font-size: 2.25rem; margin-bottom: 0.5rem;">Daftar Akun Admin</h1>
      <p style="font-size: 0.85rem; color: rgba(38, 33, 29, 0.72); margin-bottom: 1.5rem;">
        Buat akun pengelola baru untuk sistem Pesona Batik Pekalongan.
      </p>

      <?php if ($pesan_error != "") { ?>
        <div class="alert-box"><?php echo $pesan_error; ?></div>
      <?php } ?>

      <form action="register.php" method="POST">
        <div class="form-group">
          <label for="username">Username Baru</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <div class="form-group">
          <label for="konfirmasi_password">Konfirmasi Password</label>
          <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" placeholder="Ulangi password" required>
        </div>

        <button type="submit" name="register" class="btn-primary-sogan" style="width: 100%; padding: 0.9rem; margin-top: 0.5rem;">
          Daftar Sekarang
        </button>
      </form>

      <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(74, 44, 17, 0.14); font-size: 0.82rem; display: flex; justify-content: space-between;">
        <span>Sudah punya akun? <a href="login.php" style="color: var(--sogan-brown); font-weight: 600;">Login di sini</a></span>
        <a href="index.php" style="color: var(--sogan-gold); font-weight: 600;">&larr; Katalog Publik</a>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
