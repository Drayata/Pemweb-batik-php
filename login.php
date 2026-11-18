<?php
session_start();
include("koneksi.php");

if (isset($_SESSION['username'])) {
    header("Location: admin_index.php");
    exit;
}

$pesan_error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['username'] = $username;
        header("Location: admin_index.php");
        exit;
    } else {
        $pesan_error = "Username atau Password salah! Silakan coba kembali.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin &mdash; Pesona Batik Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body class="subpage-body">
  <?php include("menu.php"); ?>

  <main class="page-container">
    <div class="auth-card">
      <span class="eyebrow-gold">Portal Pengelola</span>
      <h1 class="section-title" style="font-size: 2.25rem; margin-bottom: 0.5rem;">Login Admin</h1>
      <p style="font-size: 0.85rem; color: rgba(38, 33, 29, 0.72); margin-bottom: 1.5rem;">
        Masuk untuk mengelola katalog produk Pesona Batik Pekalongan.
      </p>

      <?php if ($pesan_error != "") { ?>
        <div class="alert-box"><?php echo $pesan_error; ?></div>
      <?php } ?>

      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login" class="btn-primary-sogan" style="width: 100%; padding: 0.9rem; margin-top: 0.5rem;">
          Masuk ke Dashboard Admin
        </button>
      </form>

      <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(74, 44, 17, 0.14); font-size: 0.82rem; display: flex; justify-content: space-between;">
        <span>Belum punya akun admin? <a href="register.php" style="color: var(--sogan-brown); font-weight: 600;">Daftar di sini</a></span>
        <a href="index.php" style="color: var(--sogan-gold); font-weight: 600;">&larr; Katalog Publik</a>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
