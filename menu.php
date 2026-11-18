<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Analog Film Grain Overlay -->
<svg class="grain-overlay" aria-hidden="true">
  <filter id="atelier-grain">
    <feTurbulence type="fractalNoise" baseFrequency="0.85" numOctaves="3" stitchTiles="stitch" />
  </filter>
  <rect width="100%" height="100%" filter="url(#atelier-grain)" />
</svg>

<!-- Top Perimeter Navigation Header  -->
<header class="perimeter-header">
  <div class="nav-container">
    <div class="nav-left">
      <button type="button" class="btn-glass" onclick="toggleDrawer(true)" aria-label="Buka Menu">
        <span class="hamburger-lines">
          <span></span>
          <span></span>
        </span>
        <span>MENU</span>
      </button>
      <a href="index.php#katalog" class="btn-glass hide-mobile">Katalog</a>
      <a href="index.php#tentang" class="btn-glass hide-mobile">Tentang</a>
    </div>

    <div class="nav-center">
      <a href="index.php" class="brand-wordmark">
        ATELIER PEKALONGAN
        <span class="brand-sub">Pesona Batik Pekalongan</span>
      </a>
    </div>

    <div class="nav-right">
      <button type="button" class="btn-glass" onclick="openConsultWithMotif('Jlamprang')">
        <span class="hide-mobile">KONSULTASI PESANAN</span>
        <span class="arrow-shift">&rarr;</span>
      </button>
    </div>
  </div>
</header>

<!-- Slide-Out Navigation Drawer  -->
<div id="menu-drawer" class="drawer-overlay" aria-hidden="true">
  <div id="menu-backdrop" class="drawer-backdrop" onclick="toggleDrawer(false)"></div>
  <aside id="menu-panel" class="drawer-panel">
    <div class="drawer-header">
      <div>
        <span class="brand-wordmark" style="font-size: 1.25rem;">ATELIER PEKALONGAN</span>
        <span class="brand-sub">Pesona Batik Pekalongan</span>
      </div>
      <button type="button" class="btn-glass" onclick="toggleDrawer(false)">TUTUP &times;</button>
    </div>

    <ul class="drawer-nav">
      <li>
        <a href="index.php#katalog" onclick="toggleDrawer(false)">
          <span>Katalog Koleksi Batik</span>
        </a>
      </li>
      <li>
        <a href="index.php#tentang" onclick="toggleDrawer(false)">
          <span>Tentang &amp; Warisan Pesisir</span>
        </a>
      </li>
      <li>
        <a href="#proses" onclick="toggleDrawer(false); toggleModal('craft-modal', true); return false;">
          <span>Proses Canting &amp; Warna Alam</span>
        </a>
      </li>
      <li>
        <a href="#konsultasi" onclick="toggleDrawer(false); openConsultWithMotif('Jlamprang'); return false;">
          <span>Konsultasi Pesanan</span>
        </a>
      </li>
    </ul>

    <div class="drawer-footer">
      <strong style="color: #FFFFFF; letter-spacing: 0.14em; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Galeri Pesona Batik Pekalongan</strong>
      Kampung Batik Kauman, Jl. Hayam Wuruk No. 48, Kota Pekalongan, Jawa Tengah 51127<br>
      WhatsApp Konsultasi: +62 812-3456-7890
    </div>
  </aside>
</div>

<!-- Bespoke Consultation Modal -->
<div id="consult-modal" class="modal-overlay" aria-hidden="true">
  <div class="modal-backdrop" onclick="toggleModal('consult-modal', false)"></div>
  <div class="modal-box">
    <div class="modal-header">
      <div>
        <span class="eyebrow-gold">Layanan Eksklusif Atelier</span>
        <h3 class="modal-title">Konsultasi Pesanan Batik</h3>
      </div>
      <button type="button" class="btn-glass" onclick="toggleModal('consult-modal', false)">&times;</button>
    </div>

    <div id="consult-success" class="alert-box alert-success" style="display: none;"></div>

    <form onsubmit="return submitConsultation(event)">
      <div class="form-group">
        <label for="consult-nama">Nama Lengkap</label>
        <input type="text" id="consult-nama" class="form-control" placeholder="Contoh: R.A. Kartini" required>
      </div>
      <div class="form-group">
        <label for="consult-motif">Pilihan Motif Pesisir</label>
        <select id="consult-motif" class="form-control">
          <option value="Jlamprang">Motif Jlamprang Eksklusif</option>
          <option value="Tujuh Rupa">Motif Tujuh Rupa Pesisir</option>
          <option value="Buketan">Motif Buketan Klasik</option>
          <option value="Mega Mendung">Motif Mega Mendung Pesisir</option>
        </select>
      </div>
      <div class="form-group">
        <label for="consult-catatan">Kebutuhan Ukuran / Kain</label>
        <textarea id="consult-catatan" class="form-control" rows="3" placeholder="Kemeja Tulis Sutra ukuran L / Sarimbit Keluarga..."></textarea>
      </div>
      <button type="submit" class="btn-glass" style="width: 100%; padding: 0.9rem;">
        <span>KIRIM KONSULTASI VIA WHATSAPP</span>
        <span class="arrow-shift">&rarr;</span>
      </button>
    </form>
  </div>
</div>

<!-- Craft Process Showcase Modal -->
<div id="craft-modal" class="modal-overlay" aria-hidden="true">
  <div class="modal-backdrop" onclick="toggleModal('craft-modal', false)"></div>
  <div class="modal-box modal-wide">
    <div class="modal-header">
      <div>
        <span class="eyebrow-gold">Mahakarya Tangan Pengrajin Pekalongan</span>
        <h3 class="modal-title">Tiga Tahap Tradisi Batik Tulis</h3>
      </div>
      <button type="button" class="btn-glass" onclick="toggleModal('craft-modal', false)">&times;</button>
    </div>

    <div class="craft-steps-grid">
      <div class="craft-step-card">
        <h4 class="craft-step-title">Nyoret &amp; Canting</h4>
        <p class="craft-step-desc">Tahap awal melukis pola di atas kain mori primisima atau sutra menggunakan malam (lilin) panas dan canting tembaga berukir halus untuk membentuk detail isen-isen cecek.</p>
      </div>
      <div class="craft-step-card">
        <h4 class="craft-step-title">Medel &amp; Nyoga</h4>
        <p class="craft-step-desc">Tahap pewarnaan berlapis menggunakan pewarna alam soga kayu tingi, jambal, tegeran, serta fermentasi daun tarum (indigo) khas pesisir Pekalongan.</p>
      </div>
      <div class="craft-step-card">
        <h4 class="craft-step-title">Nglorod</h4>
        <p class="craft-step-desc">Tahap penyelesaian berupa peluruhan lilin malam dalam air mendidih hingga menampakkan kontras garis motif yang tajam, dilanjutkan penjemuran teduh alami.</p>
      </div>
    </div>
  </div>
</div>
