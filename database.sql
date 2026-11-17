CREATE DATABASE IF NOT EXISTS db_batik;
USE db_batik;

-- 1. Admin / Users Table (Based on Module 7 Exercise Page 8)
CREATE TABLE IF NOT EXISTS `pengguna` (
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
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_batik` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_motif` varchar(100) NOT NULL,
  `bahan` varchar(100) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Initial dummy data (Minimum 3 products)
INSERT INTO `produk` (`nama_batik`, `kategori`, `jenis_motif`, `bahan`, `ukuran`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
('Kemeja Batik Tulis Jlamprang Eksklusif', 'Kemeja Pria', 'Jlamprang', 'Katun Primisima', 'L, XL', 275000, 10, 'batik_jlamprang.jpg', 'Kemeja batik pria lengan panjang dengan motif khas Jlamprang Pekalongan. Dibuat menggunakan bahan katun primisima yang adem, halus, dan nyaman dipakai untuk acara formal maupun kerja.'),
('Blouse Batik Cap Tujuh Rupa Modern', 'Blouse Wanita', 'Tujuh Rupa', 'Katun Prima', 'M, L', 185000, 15, 'batik_tujuhrupa.jpg', 'Blouse wanita elegan dengan perpaduan warna cerah khas pesisir Pekalongan. Motif Tujuh Rupa melambangkan kekayaan alam dan akulturasi budaya yang anggun.'),
('Kain Batik Pesisir Buketan Halus', 'Kain Batik', 'Buketan', 'Mori Sutra', '200x115 cm', 320000, 5, 'batik_buketan.jpg', 'Kain lembaran batik tulis kombinasi cap dengan motif bunga Buketan klasik. Cocok dijadikan bawahan kebaya atau dijahit menjadi busana pesta.');
