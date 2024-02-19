-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table inventory.detail_order
CREATE TABLE IF NOT EXISTS `detail_order` (
  `id_order` varchar(15) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(12) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(11) DEFAULT NULL,
  `apprSH` varchar(50) DEFAULT NULL,
  `wbs` varchar(100) DEFAULT NULL,
  `id_supplier` varchar(5) DEFAULT NULL,
  `apprWAHO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.detail_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `detail_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_order` ENABLE KEYS */;

-- Dumping structure for table inventory.list_order
CREATE TABLE IF NOT EXISTS `list_order` (
  `id_order` varchar(15) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `creaby` varchar(5) DEFAULT NULL,
  `tgl_modi` date DEFAULT NULL,
  `modiby` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.list_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `list_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `list_order` ENABLE KEYS */;

-- Dumping structure for table inventory.lokasi
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id_lokasi` varchar(12) NOT NULL,
  `nm_lokasi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.lokasi: ~4 rows (approximately)
/*!40000 ALTER TABLE `lokasi` DISABLE KEYS */;
INSERT INTO `lokasi` (`id_lokasi`, `nm_lokasi`, `keterangan`) VALUES
	('W10', 'Lemari 10', 'Ruang Office Bawah'),
	('W11', 'Lemari 11', 'Rak Bawah'),
	('W3', 'Lemari 3', 'Ruang Office'),
	('W9', 'Lemari 9', 'Ruang Atas');
/*!40000 ALTER TABLE `lokasi` ENABLE KEYS */;

-- Dumping structure for table inventory.mesin
CREATE TABLE IF NOT EXISTS `mesin` (
  `id_mesin` varchar(12) NOT NULL,
  `nm_mesin` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mesin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.mesin: ~4 rows (approximately)
/*!40000 ALTER TABLE `mesin` DISABLE KEYS */;
INSERT INTO `mesin` (`id_mesin`, `nm_mesin`, `keterangan`) VALUES
	('Mesin001', 'Jig', 'Line 5'),
	('Mesin002', 'Robot Welding', 'Baru'),
	('Mesin003', 'Mig Welding', 'Lama'),
	('Mesin004', 'Robot Slave', 'Pengelasan');
/*!40000 ALTER TABLE `mesin` ENABLE KEYS */;

-- Dumping structure for table inventory.sparepart
CREATE TABLE IF NOT EXISTS `sparepart` (
  `part_number` varchar(12) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  `harga_satuan` decimal(10,0) DEFAULT NULL,
  `id_mesin` varchar(12) NOT NULL,
  `id_lokasi` varchar(12) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `std_level_stok` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`part_number`),
  KEY `id_mesin` (`id_mesin`),
  KEY `id_lokasi` (`id_lokasi`),
  CONSTRAINT `sparepart_ibfk_1` FOREIGN KEY (`id_mesin`) REFERENCES `mesin` (`id_mesin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sparepart_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.sparepart: ~2 rows (approximately)
/*!40000 ALTER TABLE `sparepart` DISABLE KEYS */;
INSERT INTO `sparepart` (`part_number`, `deskripsi`, `satuan`, `harga_satuan`, `id_mesin`, `id_lokasi`, `stok_akhir`, `std_level_stok`, `gambar`) VALUES
	('EL-CTT-00889', 'RELAY MY4N 24 VDC+SOCKET OMRON', 'PC', 116000, 'Mesin003', 'W3', 40, 1, NULL),
	('EL-SEN-00735', 'PRESSURE SENSOR 537026 SDE1-D6-G2-W18-L-', 'PC', 2350000, 'Mesin001', 'W3', 4, 1, NULL);
/*!40000 ALTER TABLE `sparepart` ENABLE KEYS */;

-- Dumping structure for table inventory.sparepart_in
CREATE TABLE IF NOT EXISTS `sparepart_in` (
  `id_transaksi` varchar(15) NOT NULL,
  `tgl_in` date NOT NULL,
  `triger_ordering` varchar(20) NOT NULL,
  `id_pengambilan_brg` varchar(50) NOT NULL,
  `part_number` varchar(12) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tgl_plan_pasang` date DEFAULT NULL,
  `nrp` varchar(5) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `part_number` (`part_number`),
  KEY `nrp` (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.sparepart_in: ~2 rows (approximately)
/*!40000 ALTER TABLE `sparepart_in` DISABLE KEYS */;
INSERT INTO `sparepart_in` (`id_transaksi`, `tgl_in`, `triger_ordering`, `id_pengambilan_brg`, `part_number`, `jumlah`, `keterangan`, `tgl_plan_pasang`, `nrp`) VALUES
	('T-IN-2310060003', '2023-10-05', 'Project', 'GR', 'EL-CTT-00889', 50, '', '0000-00-00', '12345'),
	('T-IN-2310060004', '2023-10-01', 'Maintenance', 'GR', 'EL-SEN-00735', 4, '', '0000-00-00', '12345');
/*!40000 ALTER TABLE `sparepart_in` ENABLE KEYS */;

-- Dumping structure for table inventory.sparepart_out
CREATE TABLE IF NOT EXISTS `sparepart_out` (
  `id_transaksi` varchar(15) NOT NULL,
  `tgl_out` date NOT NULL,
  `part_number` varchar(12) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tujuan_penggunaan` varchar(50) NOT NULL,
  `nrp` varchar(5) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `part_number` (`part_number`),
  KEY `nrp` (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.sparepart_out: ~1 rows (approximately)
/*!40000 ALTER TABLE `sparepart_out` DISABLE KEYS */;
INSERT INTO `sparepart_out` (`id_transaksi`, `tgl_out`, `part_number`, `jumlah`, `keterangan`, `tujuan_penggunaan`, `nrp`) VALUES
	('T-OU-2310060002', '2023-10-03', 'EL-CTT-00889', 10, '', 'Robot', '11111');
/*!40000 ALTER TABLE `sparepart_out` ENABLE KEYS */;

-- Dumping structure for table inventory.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(5) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.supplier: ~1 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telepon`, `alamat`) VALUES
	('S0001', 'PT. Laskar Otomasi ', '0816216', 'Jl. Cikarang Raya No.31');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for table inventory.user
CREATE TABLE IF NOT EXISTS `user` (
  `nrp` varchar(5) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventory.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`nrp`, `nama_karyawan`, `email`, `telepon`, `alamat`, `username`, `password`, `role_id`, `foto`) VALUES
	('11111', 'Hinata', 'hinata@gmail.com', '1322132', 'Jl Sunter Raya No.6', 'hinata', '202cb962ac59075b964b07152d234b70', 2, 'inventory1.png'),
	('12345', 'Aris', 'pramono@xyz.com', '088877', 'Jl. Harapan Baru No. 12', 'aris', '202cb962ac59075b964b07152d234b70', 1, 'contoh1.png'),
	('18713', 'Dias', 'dias@xyz.com', '088888', 'Jl. Raya Bekasi No.31', 'dias', '202cb962ac59075b964b07152d234b70', 3, 'avatar1.png'),
	('58236', 'Abna Lubna', 'abnaL@xyz.com', '08888123', 'Jl Sunter Raya No.6', 'abna', '202cb962ac59075b964b07152d234b70', 4, 'avatar2.jpg'),
	('77777', 'Eko', 'eko@xyz.com', '08881234', 'Jl. Agus Salim No.9', 'eko', '202cb962ac59075b964b07152d234b70', 5, 'avatar31.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
