<?php
include("koneksi.php");
$read = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
$hero_ver = file_exists("assets/img/hero.jpg") ? filemtime("assets/img/hero.jpg") : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesona Batik Pekalongan &mdash; Atelier Pekalongan</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">
</head>
<body>

  <!-- FULL-BLEED 100VH IMAGE-ORIENTED HERO VIEWPORT -->
  <section class="hero-studio">
    <!-- Full-Bleed Hero Image Layer -->
    <div class="hero-bg-media">
      <img
        src="assets/img/hero.jpg?v=<?php echo $hero_ver; ?>"
        alt="Koleksi Utama Pesona Batik Pekalongan"
        class="hero-bg-image"
        onerror="this.src='assets/img/default.jpg'"
      >
    </div>

    <!-- Cinematic Chiaroscuro Vignette Layer -->
    <div class="studio-backdrop"></div>

    <!-- Dappled Studio Window & Foliage Lighting Shadow -->
    <svg class="shadow-dappled" viewBox="0 0 1440 900" preserveAspectRatio="none" aria-hidden="true">
      <defs>
        <filter id="dappled-blur" x="-20%" y="-20%" width="140%" height="140%">
          <feGaussianBlur stdDeviation="38" />
        </filter>
      </defs>
      <g filter="url(#dappled-blur)" fill="#191512" fill-opacity="0.09">
        <polygon points="0,0 520,0 180,900 0,900" />
        <ellipse cx="1180" cy="180" rx="260" ry="120" transform="rotate(-18 1180 180)" />
        <ellipse cx="1260" cy="340" rx="220" ry="95" transform="rotate(-24 1260 340)" />
        <ellipse cx="1090" cy="490" rx="190" ry="80" transform="rotate(-15 1090 490)" />
      </g>
    </svg>

    <div class="studio-floor"></div>

    <!-- Top Navigation Component (menu.php) -->
    <?php include("menu.php"); ?>

    <!-- Main Content Perimeter Canvas -->
    <div class="hero-perimeter">
      <!-- Top-Left Quadrant -->
      <div class="hero-top-left">
        <span class="hero-eyebrow">PESONA BATIK PEKALONGAN &bull; EST. PEKALONGAN</span>
        <h1 class="hero-headline">
          <span>Batik Autentik</span>
          <span>Pekalongan</span>
        </h1>

        <div class="dual-cta-group">
          <a href="#katalog" class="btn-outline-hero">JELAJAHI KOLEKSI</a>
          <a href="#katalog" class="btn-circle-hero" aria-label="Jelajahi Koleksi">
            <span class="arrow-shift">&darr;</span>
          </a>
        </div>
      </div>

      <!-- Bottom Perimeter Row: Editorial Description & Floating Craft Card -->
      <div class="hero-bottom-row">
        <p class="hero-editorial-copy">
          Batik tulis Pekalongan dirancang untuk Anda yang menghargai ketelitian tangan pengrajin dan keindahan motif pesisir dalam setiap momen istimewa.
        </p>

        <button type="button" class="craft-media-card" onclick="toggleModal('craft-modal', true)">
          <div class="craft-thumb">
            <svg viewBox="0 0 64 48" xmlns="http://www.w3.org/2000/svg">
              <rect width="64" height="48" fill="#382518" />
              <circle cx="32" cy="24" r="16" stroke="#D9A86C" stroke-width="1.2" fill="none" />
              <circle cx="32" cy="24" r="8" stroke="#F6F2EC" stroke-width="1" fill="none" />
              <circle cx="32" cy="24" r="2.5" fill="#D9A86C" />
            </svg>
          </div>
          <div class="craft-meta">
            <span class="craft-title">TAHAPAN MEMBATIK</span>
            <span class="craft-sub">Canting &amp; Pewarna Alam</span>
          </div>
        </button>
      </div>
    </div>

    <!-- Bottom Hairline Footer Bar inside Hero -->
    <div class="hero-hairline-footer">
      <div class="hero-footer-inner">
        <a href="#katalog">Explore  ↓</a>
        <div class="status-signature">
          <span class="status-dot"></span>
          <span>ATELIER PEKALONGAN</span>
        </div>
      </div>
    </div>
  </section>

  <!-- CURATED COLLECTION CATALOG SECTION -->
  <section id="katalog" class="catalog-section">
    <div class="section-header">
      <div>
        <span class="eyebrow-gold">Katalog Resmi Pesona Batik Pekalongan</span>
        <h2 class="section-title">Koleksi Warisan Pesisir</h2>
      </div>

      <!-- Client-Side Search & Category Filter  -->
      <div class="catalog-controls">
        <input
          type="text"
          id="searchInput"
          class="input-search"
          placeholder="Cari nama batik atau motif..."
          oninput="filterCatalog()"
          aria-label="Cari nama batik atau motif"
        >
        <select id="categoryFilter" class="select-filter" onchange="filterCatalog()" aria-label="Filter Kategori Batik">
          <option value="">Semua Kategori</option>
          <option value="Kemeja Pria">Kemeja Pria</option>
          <option value="Blouse Wanita">Blouse Wanita</option>
          <option value="Kain Batik">Kain Batik</option>
          <option value="Sarimbit">Sarimbit</option>
        </select>
      </div>
    </div>

    <div class="product-grid" id="productGrid">
      <?php
      while ($data = mysqli_fetch_array($read)) {
          $gambar_produk = !empty($data['gambar']) ? $data['gambar'] : 'default.jpg';
      ?>
      <article
        class="product-card"
        data-nama="<?php echo htmlspecialchars($data['nama_batik']); ?>"
        data-motif="<?php echo htmlspecialchars($data['jenis_motif']); ?>"
        data-kategori="<?php echo htmlspecialchars($data['kategori']); ?>"
      >
        <div class="product-img-wrap">
          <span class="badge-kategori"><?php echo $data['kategori']; ?></span>
          <img
            src="assets/img/<?php echo $gambar_produk; ?>"
            alt="<?php echo $data['nama_batik']; ?>"
            onerror="this.src='assets/img/default.jpg'"
          >
        </div>

        <div class="product-body">
          <span class="product-motif">Motif <?php echo $data['jenis_motif']; ?></span>
          <h3 class="product-title"><?php echo $data['nama_batik']; ?></h3>
          <p class="product-meta">
            Bahan: <strong><?php echo $data['bahan']; ?></strong> &bull; Ukuran: <strong><?php echo $data['ukuran']; ?></strong> &bull; Stok: <strong><?php echo $data['stok']; ?> pcs</strong>
          </p>

          <div class="product-footer">
            <span class="product-price">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></span>
            <a href="detail.php?id=<?php echo $data['id']; ?>" class="btn-primary-sogan">
              Lihat Detail &amp; Beli &rarr;
            </a>
          </div>
        </div>
      </article>
      <?php } ?>
    </div>

    <div id="catalogEmptyNotice" class="alert-box" style="display: none; margin-top: 2rem;">
      Tidak ditemukan koleksi batik yang sesuai dengan pencarian Anda.
    </div>
  </section>

  <!-- CULTURAL HERITAGE / ABOUT US SECTION (#tentang) -->
  <section id="tentang" class="about-section">
    <div class="about-inner">
      <div class="section-header">
        <div>
          <span class="eyebrow-gold">Tentang Kami &bull; Warisan Budaya UNESCO</span>
          <h2 class="section-title">Tentang Pesona Batik Pekalongan</h2>
        </div>
        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
          <button type="button" class="btn-primary-sogan" onclick="toggleModal('craft-modal', true)">
            Lihat Tahapan Membatik
          </button>
          <button type="button" class="action-link" style="padding: 0.7rem 1.2rem;" onclick="openConsultWithMotif('Buketan')">
            Konsultasi Pesanan &rarr;
          </button>
        </div>
      </div>

      <div class="about-grid">
        <div class="about-story">
          <h3 class="about-subtitle">Menjaga Ketekunan Tangan Pembatik Pesisir Kampung Kauman</h3>
          <p>
            <strong>Pesona Batik Pekalongan (Atelier Pekalongan)</strong> hadir sebagai ruang kurasi batik tulis dan cap asli dari jantung Kota Pekalongan, Jawa Tengah. Kami bekerja langsung bersama pengrajin lokal untuk merawat tradisi canting tembaga dan pencelupan warna soga alam yang diwariskan lintas generasi.
          </p>
          <p>
            Berbeda dari batik pedalaman yang cenderung monokromatis, batik pesisir Pekalongan merayakan akulturasi budaya melalui perpaduan warna yang hidup, detail <em>isen-isen cecek</em> (titik malam) yang rapat, serta penggunaan kain Katun Primisima dan Mori Sutra pilihan.
          </p>

          <div class="about-stats">
            <div class="stat-item">
              <span class="stat-num">100%</span>
              <span class="stat-label">Karya Pengrajin Lokal</span>
            </div>
            <div class="stat-item">
              <span class="stat-num">3 Tahap</span>
              <span class="stat-label">Nyoret, Medel, Nglorod</span>
            </div>
            <div class="stat-item">
              <span class="stat-num">Asli</span>
              <span class="stat-label">Katun Primisima &amp; Sutra</span>
            </div>
          </div>

          <div class="about-workshop-box">
            <strong>Galeri &amp; Rumah Produksi</strong>
            <span>Kampung Batik Kauman, Jl. Hayam Wuruk No. 48, Kota Pekalongan, Jawa Tengah 51127 &bull; Buka Setiap Hari (08.00 &ndash; 20.00 WIB)</span>
          </div>
        </div>

        <div class="about-pillars">
          <div class="pillar-card">
            <h4 class="pillar-title">Motif Jlamprang &mdash; Filosofi Geometris</h4>
            <p class="pillar-desc">Terinspirasi dari tenun patola dan kosmologi bintang teratai, melambangkan keharmonisan hubungan manusia dengan alam semesta.</p>
          </div>
          <div class="pillar-card">
            <h4 class="pillar-title">Motif Tujuh Rupa &mdash; Kekayaan Hayati</h4>
            <p class="pillar-desc">Memadukan ragam flora dan fauna pesisir dalam sapuan warna cerah sebagai simbol keterbukaan budaya masyarakat pelabuhan Pekalongan.</p>
          </div>
          <div class="pillar-card">
            <h4 class="pillar-title">Motif Buketan Pesisir &mdash; Keanggunan Klasik</h4>
            <p class="pillar-desc">Rangkaian bunga mekar dengan detail burung hong dan kupu-kupu yang melambangkan kebahagiaan, kemakmuran, serta keanggunan abadi.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("footer.php"); ?>
</body>
</html>
