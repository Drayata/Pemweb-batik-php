# Product Requirements Document (PRD)

**Project Name:** Pekalongan Batik Catalog & Product Management System ("Pesona Batik Pekalongan")  
**Tech Stack:** HTML5, Native CSS3, Vanilla JavaScript, Native PHP (Procedural), MySQL/MariaDB  
**Environment:** XAMPP on Linux Fedora (`/opt/lampp/htdocs/batik_pekalongan`)  
**Code Standard Reference:** University Web Programming Lab Modules (Module 5 Basic PHP, Module 6 PHP CRUD `mysqli`, Module 7 PHP Session & Authentication)

---

## 1. Feasibility Analysis & Project Constraints

This document is strictly tailored to match the student's university lab modules (Modules 5, 6, and 7). **CRITICAL INSTRUCTION FOR AI AGENT / DEVELOPER:** Do not use advanced techniques, frameworks, or abstractions outside the boundaries listed below. The codebase must remain 100% aligned with introductory procedural PHP lab standards so the student can easily explain every line of code during grading.

### A. MANDATORY Coding Standards (Per Lab Modules):
1. **PHP Programming Paradigm:** Strictly procedural PHP. **DO NOT** use Object-Oriented Programming (`class`, `new`), PDO, prepared statements, or modern MVC/Routing patterns.
2. **Database Connection & Queries:** Must use procedural `mysqli` functions exactly as taught in Module 6:
   * `mysqli_connect("localhost", "root", "", "db_batik")`
   * `mysqli_query($koneksi, "...")`
   * `mysqli_fetch_array($result)` inside a `while` loop
3. **Page Modularity:** Use `include('filename.php');` or `include("filename.php");` (Per Module 5 Experiment 3).
4. **Authentication & State Management:** Use `session_start()`, `$_SESSION['username']`, `session_unset()`, and `session_destroy()` (Per Module 7). Passwords are stored and verified as plain strings in SQL queries to match Module 6 & 7 lab examples.
5. **Data Passing Between Pages:** Use `$_POST` for form submissions and `$_GET['id']` in URL query parameters for Edit, Delete, and Product Detail actions (Per Module 6).
6. **Page Redirection:** Use `header("Location: filename.php");` (Per Modules 6 & 7).

### B. Out-of-Scope / Simplified Features:
1. **No Shopping Cart or Payment Gateway:** Because multi-table transaction state and external APIs (cURL) are not covered in the modules, purchasing will use **Direct Checkout via WhatsApp** per product.
2. **No CSS/JS Frameworks:** **DO NOT** use Bootstrap, Tailwind, or jQuery. All styling must use pure Native CSS3 (`style.css`) with basic Flexbox/Grid, and client-side interactivity must use Vanilla JavaScript (`script.js`).
3. **Simple Image Upload:** Handle product images using basic `$_FILES` and `move_uploaded_file()`, with a fallback to `default.jpg` if no file is uploaded.

---

## 2. Project Directory Structure

The project resides in `/opt/lampp/htdocs/batik_pekalongan/` with a flat, beginner-friendly directory structure:

```text
/opt/lampp/htdocs/batik_pekalongan/
│
├── database.sql          # SQL script to be imported into phpMyAdmin
├── koneksi.php           # Database connection script using mysqli_connect
├── menu.php              # Navigation/Header component (included in public pages)
├── footer.php            # Footer component (included across pages)
│
├── index.php             # Main Public Page (Landing Page + Batik Catalog)
├── detail.php            # Product Detail Page + Direct Buy via WhatsApp form
│
├── login.php             # Admin Login Page (Module 7)
├── register.php          # Admin Registration Page (Module 7)
├── logout.php            # Session destruction / Logout script (Module 7)
│
├── admin_index.php       # Admin Dashboard: READ table of batik products (Module 6)
├── create.php            # CREATE form & processing script for new batik products (Module 6)
├── update.php            # UPDATE form & processing script to edit batik products (Module 6)
├── delete.php            # DELETE script to remove batik products (Module 6)
│
└── assets/
    ├── css/
    │   └── style.css     # Native CSS3 stylesheet (Modern/Elegant Batik theme)
    ├── js/
    │   └── script.js     # Vanilla JS (Search filter, delete confirmation, WhatsApp link generator)
    └── img/              # Product images folder (Requires chmod 777 on Linux Fedora)
        ├── default.jpg
        └── ...
```

---

## 3. Database Schema (`database.sql`)

The database uses XAMPP's bundled MySQL/MariaDB named `db_batik`. Variable and column names are kept in Indonesian to match the lab module conventions (`pengguna`, `produk`):

```sql
CREATE DATABASE IF NOT EXISTS db_batik;
USE db_batik;

-- 1. Admin / Users Table (Based on Module 7 Exercise Page 8)
CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Default admin accounts for initial login
INSERT INTO `pengguna` (`username`, `password`) VALUES
('admin', 'admin123'),
('owner', 'pekalongan123');

-- 2. Batik Products Table (Adaptation of Module 6 Exercises)
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_batik` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,      -- e.g., Kemeja Pria, Blouse Wanita, Kain Batik, Sarimbit
  `jenis_motif` varchar(100) NOT NULL,  -- e.g., Jlamprang, Tujuh Rupa, Mega Mendung, Buketan
  `bahan` varchar(100) NOT NULL,        -- e.g., Katun Prima, Katun Primisima, Sutra
  `ukuran` varchar(50) NOT NULL,        -- e.g., M, L, XL, All Size
  `harga` int(11) NOT NULL,             -- e.g., 150000
  `stok` int(11) NOT NULL,              -- e.g., 15
  `gambar` varchar(255) NOT NULL,       -- Stores image filename, e.g., batik1.jpg
  `deskripsi` varchar(1000) NOT NULL,   -- Full product description
  PRIMARY KEY (`id`)
);

-- Initial dummy data (Minimum 3 products)
INSERT INTO `produk` (`nama_batik`, `kategori`, `jenis_motif`, `bahan`, `ukuran`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
('Kemeja Batik Tulis Jlamprang Eksklusif', 'Kemeja Pria', 'Jlamprang', 'Katun Primisima', 'L, XL', 275000, 10, 'batik_jlamprang.jpg', 'Kemeja batik pria lengan panjang dengan motif khas Jlamprang Pekalongan. Dibuat menggunakan bahan katun primisima yang adem, halus, dan nyaman dipakai untuk acara formal maupun kerja.'),
('Blouse Batik Cap Tujuh Rupa Modern', 'Blouse Wanita', 'Tujuh Rupa', 'Katun Prima', 'M, L', 185000, 15, 'batik_tujuhrupa.jpg', 'Blouse wanita elegan dengan perpaduan warna cerah khas pesisir Pekalongan. Motif Tujuh Rupa melambangkan kekayaan alam dan akulturasi budaya yang anggun.'),
('Kain Batik Pesisir Buketan Halus', 'Kain Batik', 'Buketan', 'Mori Sutra', '200x115 cm', 320000, 5, 'batik_buketan.jpg', 'Kain lembaran batik tulis kombinasi cap dengan motif bunga Buketan klasik. Cocok dijadikan bawahan kebaya atau dijahit menjadi busana pesta.');
```

---

## 4. Functional Requirements per File

### 4.1. Shared Components
* **`koneksi.php`**
  * Contains the database connection script following Module 6 Experiment 2:
    ```php
    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "db_batik") or die("Gagal koneksi");
    ?>
    ```
* **`menu.php` & `footer.php`**
  * Included via `<?php include 'menu.php'; ?>` and `<?php include 'footer.php'; ?>`.
  * `menu.php` displays the brand title **"Pesona Batik Pekalongan"**, navigation links to Catalog (`index.php`), About Us (`#tentang`), and an Admin Login link (`login.php` or a link back to `admin_index.php` if an admin session is active).

### 4.2. Public Storefront Pages
* **`index.php` (Main Catalog)**
  * Includes `koneksi.php` and executes `SELECT * FROM produk ORDER BY id DESC`.
  * Displays a cultural Hero Banner highlighting Pekalongan Batik.
  * Includes a client-side search bar and category filter powered by Vanilla JS (`script.js`).
  * Renders a responsive Product Grid using `while($data = mysqli_fetch_array($read))` displaying: Product Image, Batik Name, Category badge, Motif, Price (formatted in IDR), and a **"Lihat Detail & Beli"** button linking to `detail.php?id=$data[id]`.
* **`detail.php` (Product Details & Direct WhatsApp Checkout)**
  * Retrieves `$_GET['id']` and queries `SELECT * FROM produk WHERE id=$id`.
  * Displays large product image, batik name, price, stock availability, material, motif, available sizes, and full description.
  * **Direct WhatsApp Checkout Form (No Database Transaction Required):**
    * Inputs: Selected Size (`ukuran`), Quantity (`jumlah`), Buyer Name (`nama_pembeli`), and Shipping Address (`alamat`).
    * Clicking **"Pesan Sekarang via WhatsApp"** triggers a JavaScript function in `script.js` that calculates the total price (`harga * jumlah`) and opens `https://wa.me/6281234567890?text=...` in a new tab with a pre-filled message:
      > *"Halo Admin Pesona Batik Pekalongan, saya ingin memesan:*  
      > *- Produk: [Nama Batik]*  
      > *- Ukuran: [Ukuran]*  
      > *- Jumlah: [Jumlah] pcs*  
      > *- Total Harga: Rp [Harga x Jumlah]*  
      > *Atas nama: [Nama Pembeli] ([Alamat]). Apakah stok masih tersedia?"*

### 4.3. Admin Authentication (Per Module 7)
* **`login.php`**
  * Calls `session_start()`. If `isset($_SESSION['username'])` is true, redirects to `admin_index.php`.
  * Contains a POST form with `username` and `password`.
  * On submit, queries the `pengguna` table:
    `SELECT * FROM pengguna WHERE username='$username' AND password='$password'`
  * If a matching row is found, sets `$_SESSION['username'] = $username;` and redirects via `header("Location: admin_index.php");`. Otherwise, displays an error message.
* **`register.php`**
  * Contains a POST form with `username`, `password`, and `konfirmasi_password` (Per Module 7 Exercise Page 8).
  * Checks if `username` already exists. If not, and if `password == konfirmasi_password`, runs `INSERT INTO pengguna (username, password) VALUES ('$username', '$password')` and redirects to `login.php`.
* **`logout.php`**
  * Calls `session_start()`, `session_unset()`, `session_destroy()`, and redirects to `login.php` (Per Module 7 Experiment 2).

### 4.4. Backend CRUD Dashboard (Per Module 6)
* **Session Protection:**
  * The very top of `admin_index.php`, `create.php`, `update.php`, and `delete.php` must verify the session:
    ```php
    <?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    ?>
    ```
* **`admin_index.php` (READ Products)**
  * Displays greeting: `"Halo, " . $_SESSION['username']` (Per Module 7).
  * Provides action buttons: **"+ Tambah Baju Batik"** (`create.php`), **"Lihat Katalog Publik"** (`index.php`), and **"Logout"** (`logout.php`).
  * Renders an HTML table displaying all product columns, a thumbnail image (`<img src="assets/img/..." width="60">`), and an Operations column:
    `Edit (update.php?id=...)` | `Delete (delete.php?id=...)`.
* **`create.php` (CREATE Product)**
  * Form uses `method="POST"` and `enctype="multipart/form-data"`.
  * When `isset($_POST['Submit'])` is triggered:
    * Captures all `$_POST` fields.
    * Handles image upload via `$_FILES['gambar']['name']` and `move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/img/" . $gambar)`. Defaults to `'default.jpg'` if empty.
    * Executes `INSERT INTO produk (...) VALUES (...)`.
    * Redirects via `header("Location: admin_index.php");`.
* **`update.php` (UPDATE Product)**
  * Fetches existing record by `$_GET['id']` using `while($user_data = mysqli_fetch_array($result))` to populate input `value` attributes (Per Module 6 Experiment 5).
  * Includes `<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">`.
  * When `isset($_POST['update'])` is triggered:
    * If a new image is uploaded, moves the new file and updates the `gambar` column; otherwise keeps the old image filename.
    * Executes `UPDATE produk SET ... WHERE id=$id`.
    * Redirects via `header("Location: admin_index.php");`.
* **`delete.php` (DELETE Product)**
  * Retrieves `$id = $_GET['id'];`.
  * Executes `DELETE FROM produk WHERE id=$id` (Per Module 6 Experiment 6).
  * Redirects via `header("Location: admin_index.php");`.

---

## 5. UI/UX Design & Native JavaScript Specifications

### A. Visual Theme (`assets/css/style.css`)
* **Primary Color:** Sogan Batik Brown (`#4A2C11` / `#5C3A21`)
* **Accent Color:** Golden Turmeric (`#D4AF37` / `#C59B27`)
* **Background Color:** Warm Cream / Ivory (`#FDFBF7`)
* **Layout:** Pure CSS Flexbox (`display: flex; flex-wrap: wrap;`) and CSS Grid for responsive product cards and clean admin tables without external libraries.

### B. Client-Side Interactivity (`assets/js/script.js`)
1. **Live Catalog Search & Category Filter (`index.php`):** Filters product cards in real-time by matching product title/motif text and category selection.
2. **Live Price Calculator & WhatsApp URL Builder (`detail.php`):** Updates total price dynamically when quantity changes and constructs the encoded `https://wa.me/` URL upon form submission.
3. **Delete Confirmation (`admin_index.php`):** Uses `onclick="return confirm('Yakin ingin menghapus data batik ini?');"` on delete links.

---

## 6. Special Environment Guide: XAMPP on Linux Fedora

Because this project runs on **Linux Fedora** inside `/opt/lampp/htdocs/batik_pekalongan`, file permissions must be configured properly:

1. **Start XAMPP Services on Fedora:**
   ```bash
   sudo /opt/lampp/lampp start
   ```
2. **Image Upload Directory Permissions (CRITICAL):**
   XAMPP's Apache server runs under the `daemon` or `nobody` user. To prevent `move_uploaded_file()` from failing with `Permission denied`, run:
   ```bash
   sudo chmod -R 755 /opt/lampp/htdocs/batik_pekalongan
   sudo chmod -R 777 /opt/lampp/htdocs/batik_pekalongan/assets/img
   ```
3. **PHP Error Reporting (For Debugging):**
   If a blank page occurs due to permissions or syntax errors on Fedora, add these lines at the top of the PHP script during development:
   ```php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   ```

---

## 7. Execution Sequence Checklist for AI Agent

Follow this exact order when generating the project files:
1. Generate `database.sql` and `koneksi.php`.
2. Generate `assets/css/style.css` and `assets/js/script.js` (plus placeholder image handling).
3. Generate layout components `menu.php` and `footer.php`.
4. Generate authentication files: `login.php`, `register.php`, and `logout.php`.
5. Generate Admin CRUD files: `admin_index.php`, `create.php`, `update.php`, and `delete.php`.
6. Generate Public Storefront files: `index.php` and `detail.php`.