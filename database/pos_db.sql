-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2013 at 11:11 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_CauHinh`
--

CREATE TABLE IF NOT EXISTS `tbl_CauHinh` (
  `so_san_pham_tren_trang` tinyint(4) DEFAULT NULL,
  `so_phan_trang` tinyint(4) DEFAULT NULL,
  `bat_buoc_thong_tin_khach_hang` tinyint(4) DEFAULT NULL,
  `so_luong_ton_canh_bao` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiNhanh` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_chi_nhanh` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_chi_nhanh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `trang_thai` tinyint(4) NOT NULL,
  `truc_thuoc_id` int(10) DEFAULT NULL,
  `khu_vuc_id` int(10) NOT NULL,
  `loai_chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chi_nhanh` (`ma_chi_nhanh`),
  KEY `FKtbl_ChiNha197094` (`truc_thuoc_id`),
  KEY `FKtbl_ChiNha320112` (`khu_vuc_id`),
  KEY `FKtbl_ChiNha643812` (`loai_chi_nhanh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tbl_ChiNhanh`
--

INSERT INTO `tbl_ChiNhanh` (`id`, `ma_chi_nhanh`, `ten_chi_nhanh`, `dia_chi`, `dien_thoai`, `fax`, `mo_ta`, `trang_thai`, `truc_thuoc_id`, `khu_vuc_id`, `loai_chi_nhanh_id`) VALUES
(1, 'OUTSYS', 'Các nguồn bên ngoài hệ thống ', NULL, NULL, NULL, 'Các công ty, tổ chức bên ngoài hệ thống ', 1, NULL, 1, 1),
(10, 'adsad', 'yyyyy', NULL, NULL, NULL, NULL, 1, NULL, 1, 2),
(25, 'dasdsa', 'adsad', 'sadsadsa', NULL, NULL, NULL, 1, 10, 4, 2),
(26, 'adsassdsa', 'adsaasdsa ', 'dxsa', NULL, NULL, NULL, 1, 10, 1, 1),
(27, 'adsadsa', 'adsad', NULL, NULL, NULL, NULL, 0, NULL, 1, 1),
(28, 'BABA', 'adsa', NULL, NULL, NULL, NULL, 1, NULL, 1, 1),
(29, 'sa', 'sa', NULL, NULL, NULL, NULL, 0, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietHoaDonBan`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietHoaDonBan` (
  `san_pham_id` int(10) NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`hoa_don_ban_id`),
  KEY `FKtbl_ChiTie898627` (`san_pham_id`),
  KEY `FKtbl_ChiTie469808` (`hoa_don_ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietHoaDonTang`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietHoaDonTang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`hoa_don_ban_id`),
  KEY `FKtbl_ChiTie898645` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie468546` (`hoa_don_ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietHoaDonTra`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietHoaDonTra` (
  `san_pham_id` int(10) NOT NULL,
  `hoa_don_tra_id` int(10) NOT NULL,
  `so_luong` int(10) DEFAULT NULL,
  `don_gia` double DEFAULT NULL,
  PRIMARY KEY (`san_pham_id`,`hoa_don_tra_id`),
  KEY `FKtbl_ChiTie11581` (`hoa_don_tra_id`),
  KEY `FKtbl_ChiTie916439` (`san_pham_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietPhieuNhap`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietPhieuNhap` (
  `san_pham_id` int(10) NOT NULL,
  `phieu_nhap_id` int(10) NOT NULL,
  `so_luong` int(10) DEFAULT NULL,
  `gia_nhap` double DEFAULT NULL,
  PRIMARY KEY (`san_pham_id`,`phieu_nhap_id`),
  KEY `FKtbl_ChiTie125902` (`san_pham_id`),
  KEY `FKtbl_ChiTie280924` (`phieu_nhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_ChiTietPhieuNhap`
--

INSERT INTO `tbl_ChiTietPhieuNhap` (`san_pham_id`, `phieu_nhap_id`, `so_luong`, `gia_nhap`) VALUES
(2, 56657, 131, 3123),
(2, 56658, 1312312, 321321),
(2, 56662, 20, 3123),
(2, 56664, 213, 2131),
(2, 56665, 3213, 21321),
(2, 56686, 3210, -80000),
(2, 56687, 2312, -80000),
(2, 56688, 3213, 80000),
(2, 56689, 3213, -80000),
(2, 56690, 1321, -80000),
(2, 56691, 31321, -80000),
(3, 56662, 33, 3123),
(4, 56646, 110, 123),
(4, 56648, 432, 3123),
(4, 56649, 321, 432),
(4, 56653, 5555, 423),
(4, 56655, 9088, 3123),
(4, 56658, 3213, 4324),
(4, 56661, 321, 13),
(4, 56662, 123, 323),
(4, 56663, 3123, 3213),
(4, 56664, 3210, 2131),
(4, 56673, 12321, 213),
(4, 56674, -321, 3123),
(4, 56675, -320, 213),
(4, 56676, -320, 3213),
(4, 56677, -3213, 2321),
(4, 56678, -321, 321),
(4, 56679, -3213, 321321),
(4, 56680, -32321, 313),
(4, 56681, -321, 3132),
(4, 56682, -311, 3123),
(4, 56683, -13, 323),
(4, 56684, -312, 32),
(4, 56685, 1230, 2131),
(4, 56686, 213, 31321),
(4, 56687, 321, 3213),
(4, 56688, 3123, -31123),
(4, 56689, 3213, 2131),
(4, 56690, 1312, 3123),
(4, 56691, 312, 3123),
(4, 56692, 3213, -13123),
(4, 56693, 32213, 321321),
(5, 56660, 123, 43234),
(5, 56666, 9999, 99999);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietPhieuNhapSanPhamTang`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietPhieuNhapSanPhamTang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `phieu_nhap_id` int(10) NOT NULL,
  `so_luong` int(10) DEFAULT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`phieu_nhap_id`),
  KEY `FKtbl_ChiTie125142` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie280143` (`phieu_nhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietPhieuXuat`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietPhieuXuat` (
  `san_pham_id` int(10) NOT NULL,
  `phieu_xuat_id` int(10) NOT NULL,
  `so_luong` int(10) DEFAULT NULL,
  `gia_xuat` double DEFAULT NULL,
  PRIMARY KEY (`san_pham_id`,`phieu_xuat_id`),
  KEY `FKtbl_ChiTie815494` (`san_pham_id`),
  KEY `FKtbl_ChiTie259107` (`phieu_xuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_ChiTietPhieuXuat`
--

INSERT INTO `tbl_ChiTietPhieuXuat` (`san_pham_id`, `phieu_xuat_id`, `so_luong`, `gia_xuat`) VALUES
(2, 56659, 323, 9000),
(2, 56667, 323, NULL),
(2, 56669, 321, NULL),
(2, 56670, 32, NULL),
(2, 56671, 13123, NULL),
(2, 56695, 132, NULL),
(4, 56647, 50, NULL),
(4, 56651, 2, NULL),
(4, 56652, 2, NULL),
(4, 56656, 550, NULL),
(4, 56668, 312, NULL),
(4, 56672, 321, NULL),
(4, 56694, 321, NULL),
(4, 56696, 121, NULL),
(4, 56697, 311, NULL),
(4, 56698, 2147483647, NULL),
(4, 56699, 32, NULL),
(4, 56700, 221, 3231);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietPhieuXuatSanPhamTang`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietPhieuXuatSanPhamTang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `phieu_xuat_id` int(10) NOT NULL,
  `so_luong` int(10) DEFAULT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`phieu_xuat_id`),
  KEY `FKtbl_ChiTie125144` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie280145` (`phieu_xuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChungTu`
--

CREATE TABLE IF NOT EXISTS `tbl_ChungTu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_chung_tu` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_lap` date NOT NULL,
  `tri_gia` double NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `nhan_vien_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chung_tu` (`ma_chung_tu`),
  KEY `FKtbl_ChungT392230` (`nhan_vien_id`),
  KEY `FKtbl_ChungT837946` (`chi_nhanh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56701 ;

--
-- Dumping data for table `tbl_ChungTu`
--

INSERT INTO `tbl_ChungTu` (`id`, `ma_chung_tu`, `ngay_lap`, `tri_gia`, `ghi_chu`, `nhan_vien_id`, `chi_nhanh_id`) VALUES
(56646, 'BHUY', '2013-05-04', 13530, NULL, 2, 28),
(56647, 'XUATAA', '2013-05-04', 15600, NULL, 2, 28),
(56648, 'HDNDAH', '2013-05-05', 1349136, NULL, 2, 29),
(56649, 'DA', '2013-05-05', 138672, NULL, 2, 10),
(56650, 'JJSASS', '2013-05-05', 0, NULL, 2, 29),
(56651, 'HDKDA', '2013-05-05', 426, NULL, 2, 28),
(56652, 'NDKKD', '2013-05-05', 624, NULL, 2, 28),
(56653, 'adadNHAP ', '2013-05-05', 2349765, NULL, 2, 28),
(56654, 'SSASAS', '2013-05-05', 0, NULL, 2, 10),
(56655, 'BHGS', '2013-05-05', 28381824, NULL, 2, 28),
(56656, 'DDADAS', '2013-05-05', 1767150, NULL, 2, 28),
(56657, 'HDJA', '2013-05-06', 409113, NULL, 2, 10),
(56658, 'NHAP1', '2013-05-06', 421687297164, 'nhap hang moi ', 2, 26),
(56659, 'XUAT2233', '2013-05-06', 1008729, NULL, 2, 26),
(56660, 'NHAP2', '2013-05-06', 5317782, NULL, 2, 10),
(56661, 'JSSF', '2013-05-10', 4173, NULL, 2, 10),
(56662, 'FDSDSD', '2013-05-10', 205248, NULL, 2, 10),
(56663, 'GFDJD', '2013-05-10', 10034199, NULL, 2, 10),
(56664, 'GDJDJ', '2013-05-10', 7294413, NULL, 2, 10),
(56665, 'XXX333', '2013-05-10', 68504373, NULL, 2, 10),
(56666, 'CHINHANH25', '2013-05-10', 999890001, NULL, 2, 25),
(56667, 'GHD', '2013-05-10', 25840000, NULL, 2, 10),
(56668, 'DDSD', '2013-05-10', 1002456, NULL, 2, 10),
(56669, 'GDJDA', '2013-05-10', 25680000, NULL, 2, 10),
(56670, 'dasddegds', '2013-05-10', 2560000, NULL, 2, 10),
(56671, 'LKJDDKJ', '2013-05-10', 1049840000, NULL, 2, 10),
(56672, 'NFNFFDS', '2013-05-10', 1031373, NULL, 2, 10),
(56673, 'DAS', '2013-05-10', 2624373, NULL, 2, 10),
(56674, 'DADADdsd', '2013-05-11', -1002483, NULL, 2, 10),
(56675, 'HGG', '2013-05-11', -68160, NULL, 2, 10),
(56676, 'DSASA', '2013-05-11', -1028160, NULL, 2, 10),
(56677, 'HFDKD', '2013-05-11', -7457373, NULL, 2, 10),
(56678, 'DDADDAD', '2013-05-11', -103041, NULL, 2, 10),
(56679, 'XSA', '2013-05-11', -1032404373, NULL, 2, 10),
(56680, 'DADAAD', '2013-05-11', -10116473, NULL, 2, 10),
(56681, 'NMJJ', '2013-05-11', -1005372, NULL, 2, 10),
(56682, 'JJDA', '2013-05-11', -971253, NULL, 2, 10),
(56683, 'HFDDNA', '2013-05-11', -4199, NULL, 2, 10),
(56684, 'ID', '2013-05-11', -9984, NULL, 2, 10),
(56685, 'dsadsa', '2013-05-11', 2621130, NULL, 2, 10),
(56686, 'DADADDAD', '2013-05-11', -250128627, NULL, 2, 10),
(56687, 'BDND', '2013-05-11', -183928627, NULL, 2, 10),
(56688, 'VCNDA', '2013-05-11', 159842871, NULL, 2, 10),
(56689, 'HDA', '2013-05-11', -250193097, NULL, 2, 10),
(56690, 'OPOPSA', '2013-05-11', -101582624, NULL, 2, 10),
(56691, 'ODA', '2013-05-11', -2504705624, NULL, 2, 10),
(56692, 'NNDA', '2013-05-11', -42164199, NULL, 2, 10),
(56693, 'ODAD', '2013-05-11', 10350713373, NULL, 2, 26),
(56694, 'adsafff', '2013-05-11', 1031373, NULL, 2, 26),
(56695, 'sAFC', '2013-05-11', 10560000, NULL, 2, 26),
(56696, 'adasdsaf', '2013-05-11', 37873, NULL, 2, 26),
(56697, 'JDJSASSA', '2013-05-11', 6630831, NULL, 2, 26),
(56698, 'adsad', '2013-05-11', 31229826114483, NULL, 2, 26),
(56699, 'BNAA', '2013-05-11', 10272, NULL, 2, 26),
(56700, 'HDJDJAD', '2013-05-11', 714051, NULL, 2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_GanQuyen`
--

CREATE TABLE IF NOT EXISTS `tbl_GanQuyen` (
  `nhan_vien_id` int(10) NOT NULL,
  `quyen_id` int(10) NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `tham_so` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`nhan_vien_id`,`quyen_id`),
  KEY `FKtbl_GanQuy912194` (`nhan_vien_id`),
  KEY `FKtbl_GanQuy13476` (`quyen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_HoaDonBanHang`
--

CREATE TABLE IF NOT EXISTS `tbl_HoaDonBanHang` (
  `id` int(10) NOT NULL,
  `chiet_khau` int(10) DEFAULT NULL,
  `khach_hang_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `khach_hang_id` (`khach_hang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_HoaDonTraHang`
--

CREATE TABLE IF NOT EXISTS `tbl_HoaDonTraHang` (
  `id` int(10) NOT NULL,
  `ly_do_tra_hang` text COLLATE utf8_unicode_ci,
  `hoa_don_ban_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_HoaDon976146` (`hoa_don_ban_id`),
  KEY `FKtbl_HoaDon696201` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_KhachHang`
--

CREATE TABLE IF NOT EXISTS `tbl_KhachHang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_khach_hang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `dia_chi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thanh_pho` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `diem_tich_luy` int(10) DEFAULT NULL,
  `loai_khach_hang_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_khach_hang` (`ma_khach_hang`),
  KEY `FKtbl_KhachH518685` (`loai_khach_hang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_KhachHang`
--

INSERT INTO `tbl_KhachHang` (`id`, `ma_khach_hang`, `ho_ten`, `ngay_sinh`, `dia_chi`, `thanh_pho`, `dien_thoai`, `email`, `mo_ta`, `diem_tich_luy`, `loai_khach_hang_id`) VALUES
(1, 'saadad', 'daad', '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_KhuVuc`
--

CREATE TABLE IF NOT EXISTS `tbl_KhuVuc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_khu_vuc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_khu_vuc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_khu_vuc` (`ma_khu_vuc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Dumping data for table `tbl_KhuVuc`
--

INSERT INTO `tbl_KhuVuc` (`id`, `ma_khu_vuc`, `ten_khu_vuc`, `mo_ta`) VALUES
(1, 'MTR', 'Khu vực miền Trung', 'adsadsa '),
(3, 'HNO', 'Khu vực Hà Nội ', 'dssadsad'),
(4, 'HCM', 'Khu vực TP.Hồ Chí Minh', NULL),
(6, 'DNB ', 'Đông Nam Bộ ', NULL),
(10, 'bbb', 'dsa', 'adssa'),
(11, 'fsdfds', 'khu vuc xxx', 'dsa'),
(12, 'ggggsfdsfds', 'fdafd', 'fdsf'),
(13, 'BATDA', 'fsdfdsf', 'sdfdsf'),
(15, 'dsada', 'asdsa', NULL),
(16, 'dsadsa', 'dsadsad', 'adsads'),
(17, 'dsadad', 'asdsa', NULL),
(18, 'sfdds', 'sdfdsfd', NULL),
(19, 'sdfsdfdsfds', 'sdfdsfs', NULL),
(20, 'fdfs', 'sfdsf', NULL),
(21, 'sdsad', 'adsa', NULL),
(22, 'dsa', 'asdsa', NULL),
(23, 'sdfd', 'sdfdsf', NULL),
(24, 'dsss', 'sds', NULL),
(25, 'asdsa', 'adsad', NULL),
(26, 'vvv', 'wdadsa', NULL),
(27, 'sfds', 'sdfsd', NULL),
(28, 'sfdsf', 'sfdds', NULL),
(29, 'hgfhfh', 'sfdds', NULL),
(30, 'cc', 'adsa', NULL),
(31, 'sfsdf', 'sfds', NULL),
(32, 'fdsf', 'sfdd', NULL),
(33, 'sd', 'ds', NULL),
(34, 'f', 'sd', NULL),
(35, 'sf', 'sdf', NULL),
(36, 'dfdfddsa', 'sdf', NULL),
(37, 'sfs', 'SAFA', 'sdd'),
(39, 'sfd', 'sf', NULL),
(40, 's', 'dd', NULL),
(41, 'ssdd', 'ss', NULL),
(42, 'hhhd', 'ssd', NULL),
(43, 'hfhfhfhfh', 'sfdsfsdfdsfdsf', NULL),
(44, 'jjjhkhk', 'sdsad', NULL),
(46, 'fdadsad', 'adsadsa', NULL),
(48, 'bbbaa', 'dad', NULL),
(49, 'xxddw', 'sf', NULL),
(50, 'dsdma a', 'dsd', NULL),
(51, 'gdjdjdkd', 'sfda', NULL),
(52, 'bababamama', 'dss', NULL),
(53, 'fhfhf', 'asd', NULL),
(54, 'bvncm', 'asdsa', NULL),
(55, 'bvsssss', 'sasd', NULL),
(56, 'bvasddp90', 's', NULL),
(59, 'dwedde', 'd3ed', '3e43e34e3'),
(60, 'gfdg', 'dasd', 'asd'),
(61, 'gfdgfd', 'dsad', 'adsa'),
(62, 'adsa', 'ad', 'asd'),
(63, 'adsavvf', 'asd', 'das'),
(64, 'bcnh', 'sds', 'dsa'),
(65, 'hgfhf', 'adsa', NULL),
(66, 'as', 'adsa', 'adsa'),
(67, 'sdflpoo', 'sdsa', NULL),
(68, 'adsavvfdf', 'dsa', NULL),
(69, 'jgj', 'as', NULL),
(70, 'bcnd', 'sdsa', NULL),
(71, 'dsad', 'sadsa', NULL),
(72, 'das', 'adsa', NULL),
(73, 'bgtdid', 'adsa', NULL),
(74, 'fds', 'sfds', NULL),
(75, 'bfgjp', 'ad', NULL),
(76, 'nn', 'ad', NULL),
(77, 'efrw', 'efrew', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_KhuyenMai`
--

CREATE TABLE IF NOT EXISTS `tbl_KhuyenMai` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_chuong_trinh` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_chuong_trinh` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `gia_giam` int(10) DEFAULT NULL,
  `thoi_gian_bat_dau` date DEFAULT NULL,
  `thoi_gian_ket_thuc` date DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chuong_trinh` (`ma_chuong_trinh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_KhuyenMai`
--

INSERT INTO `tbl_KhuyenMai` (`id`, `ma_chuong_trinh`, `ten_chuong_trinh`, `mo_ta`, `gia_giam`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `trang_thai`) VALUES
(4, 'KM033', 'Khuyen mai tang 33%', NULL, 33, '2013-05-10', '2013-06-30', 1),
(5, 'KM044', 'khuyen mai tang 44%', NULL, 44, '2013-05-15', '2013-05-30', 0),
(6, 'KM50', 'Khuyen mai tang 50%', NULL, 50, '2013-05-30', '2013-08-30', 1),
(7, 'KM90', 'Khuyen mai tang 90%', NULL, 90, '2013-07-18', '2013-09-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_KhuyenMaiChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_KhuyenMaiChiNhanh` (
  `khuyen_mai_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`khuyen_mai_id`,`chi_nhanh_id`),
  KEY `FKtbl_Khuyen611439` (`chi_nhanh_id`),
  KEY `FKtbl_Khuyen292321` (`khuyen_mai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_KhuyenMaiChiNhanh`
--

INSERT INTO `tbl_KhuyenMaiChiNhanh` (`khuyen_mai_id`, `chi_nhanh_id`) VALUES
(5, 26),
(4, 27),
(7, 27),
(4, 28),
(5, 28),
(7, 28),
(4, 29),
(7, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_LoaiChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_LoaiChiNhanh` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_chi_nhanh` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai_chi_nhanh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_chi_nhanh` (`ma_loai_chi_nhanh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_LoaiChiNhanh`
--

INSERT INTO `tbl_LoaiChiNhanh` (`id`, `ma_loai_chi_nhanh`, `ten_loai_chi_nhanh`) VALUES
(1, 'L001', 'Chi nhánh loại 1'),
(2, 'L003', 'Chi nhánh loại 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_LoaiKhachHang`
--

CREATE TABLE IF NOT EXISTS `tbl_LoaiKhachHang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_khach_hang` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doanh_so` int(10) DEFAULT NULL,
  `giam_gia` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_khach_hang` (`ma_loai_khach_hang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_LoaiKhachHang`
--

INSERT INTO `tbl_LoaiKhachHang` (`id`, `ma_loai_khach_hang`, `ten_loai`, `doanh_so`, `giam_gia`) VALUES
(1, 'das', 'sa', NULL, NULL),
(2, 'LKH001', 'Khach loai 1', 1000000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_LoaiNhanVien`
--

CREATE TABLE IF NOT EXISTS `tbl_LoaiNhanVien` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_nhan_vien` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_nhan_vien` (`ma_loai_nhan_vien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_LoaiNhanVien`
--

INSERT INTO `tbl_LoaiNhanVien` (`id`, `ma_loai_nhan_vien`, `ten_loai`) VALUES
(1, 'TK1', 'Thu Kho 1'),
(3, 'DH1', 'Điều hành 1'),
(4, 'BH', 'Bán hàng ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_LoaiSanPham`
--

CREATE TABLE IF NOT EXISTS `tbl_LoaiSanPham` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai` (`ma_loai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_LoaiSanPham`
--

INSERT INTO `tbl_LoaiSanPham` (`id`, `ma_loai`, `ten_loai`) VALUES
(1, 'dsa', 'VVVVVV'),
(2, 'gfdgsadsad', 'dadssa'),
(3, 'ada ', 'adfsf'),
(5, 'adasd', 'dadsa'),
(6, 'wfdsa', 'sfd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_MocGia`
--

CREATE TABLE IF NOT EXISTS `tbl_MocGia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thoi_gian_bat_dau` date NOT NULL,
  `gia_ban` double NOT NULL,
  `san_pham_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `san_pham_id` (`san_pham_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Dumping data for table `tbl_MocGia`
--

INSERT INTO `tbl_MocGia` (`id`, `thoi_gian_bat_dau`, `gia_ban`, `san_pham_id`) VALUES
(32, '2013-04-17', 50009, 2),
(33, '2013-04-24', 63000, 2),
(34, '2013-04-29', 800000, 2),
(40, '2013-04-28', 80000, 2),
(42, '2013-04-12', 38000, 2),
(43, '2013-04-19', 5000, 3),
(44, '2013-04-17', 4000, 3),
(48, '2013-04-17', 8888, 4),
(49, '2013-04-24', 7000, 4),
(50, '2013-05-09', 5345, 2),
(53, '2013-08-16', 233, 2),
(54, '2013-06-13', 33, 2),
(55, '2013-04-21', 6000, 5),
(56, '2013-04-30', 80000, 5),
(57, '2013-05-29', 53543, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_NhaCungCap`
--

CREATE TABLE IF NOT EXISTS `tbl_NhaCungCap` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_nha_cung_cap` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_nha_cung_cap` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_nha_cung_cap` (`ma_nha_cung_cap`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_NhaCungCap`
--

INSERT INTO `tbl_NhaCungCap` (`id`, `ma_nha_cung_cap`, `ten_nha_cung_cap`, `mo_ta`, `dien_thoai`, `email`, `fax`, `trang_thai`) VALUES
(3, 'dsads', 'Cong Ty TNHH Coca VietNam', 'dasdsa', NULL, NULL, NULL, 1),
(4, 'ffffdsad', 'adsad', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_NhanVien`
--

CREATE TABLE IF NOT EXISTS `tbl_NhanVien` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_nhan_vien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioi_tinh` tinyint(4) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `trinh_do` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `luong_co_ban` double DEFAULT NULL,
  `chuyen_mon` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  `mat_khau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_vao_lam` date DEFAULT NULL,
  `lan_dang_nhap_cuoi` date DEFAULT NULL,
  `loai_nhan_vien_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_nhan_vien` (`ma_nhan_vien`),
  KEY `ngay_vao_lam` (`ngay_vao_lam`),
  KEY `FKtbl_NhanVi521022` (`loai_nhan_vien_id`),
  KEY `FKtbl_NhanVi835155` (`chi_nhanh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_NhanVien`
--

INSERT INTO `tbl_NhanVien` (`id`, `ma_nhan_vien`, `ho_ten`, `email`, `dien_thoai`, `dia_chi`, `gioi_tinh`, `ngay_sinh`, `trinh_do`, `luong_co_ban`, `chuyen_mon`, `trang_thai`, `mat_khau`, `ngay_vao_lam`, `lan_dang_nhap_cuoi`, `loai_nhan_vien_id`, `chi_nhanh_id`) VALUES
(2, 'adsa', 'adsa', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 'adsa', NULL, NULL, 1, 26),
(5, 'dsad', 'dsad', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 'dsadsa', NULL, NULL, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_PhanQuyen`
--

CREATE TABLE IF NOT EXISTS `tbl_PhanQuyen` (
  `vai_tro_id` int(10) NOT NULL,
  `quyen_id` int(10) NOT NULL,
  PRIMARY KEY (`vai_tro_id`,`quyen_id`),
  KEY `FKtbl_PhanQu387683` (`vai_tro_id`),
  KEY `FKtbl_PhanQu271131` (`quyen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_PhieuNhap`
--

CREATE TABLE IF NOT EXISTS `tbl_PhieuNhap` (
  `id` int(10) NOT NULL,
  `loai_nhap_vao` tinyint(4) NOT NULL,
  `chi_nhanh_xuat_id` int(10) NOT NULL,
  `nha_cung_cap_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_PhieuN364331` (`chi_nhanh_xuat_id`),
  KEY `FKtbl_PhieuN233283` (`id`),
  KEY `FKtbl_PhieuN233299` (`nha_cung_cap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_PhieuNhap`
--

INSERT INTO `tbl_PhieuNhap` (`id`, `loai_nhap_vao`, `chi_nhanh_xuat_id`, `nha_cung_cap_id`) VALUES
(56646, 0, 10, NULL),
(56648, 0, 10, NULL),
(56649, 0, 10, NULL),
(56653, 0, 10, NULL),
(56654, 0, 10, NULL),
(56655, 0, 10, NULL),
(56657, 0, 10, NULL),
(56658, 0, 28, NULL),
(56660, 0, 10, NULL),
(56661, 0, 10, NULL),
(56662, 0, 26, NULL),
(56663, 0, 1, 3),
(56664, 0, 10, NULL),
(56665, 0, 1, 3),
(56666, 0, 1, 3),
(56673, 0, 1, 4),
(56674, 0, 28, NULL),
(56675, 0, 28, NULL),
(56676, 0, 28, NULL),
(56677, 0, 28, NULL),
(56678, 0, 28, NULL),
(56679, 0, 28, NULL),
(56680, 0, 28, NULL),
(56681, 0, 28, NULL),
(56682, 0, 28, NULL),
(56683, 0, 28, NULL),
(56684, 0, 28, NULL),
(56685, 0, 28, NULL),
(56686, 0, 28, NULL),
(56687, 0, 28, NULL),
(56688, 0, 28, NULL),
(56689, 0, 28, NULL),
(56690, 0, 28, NULL),
(56691, 0, 28, NULL),
(56692, 0, 28, NULL),
(56693, 0, 28, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_PhieuXuat`
--

CREATE TABLE IF NOT EXISTS `tbl_PhieuXuat` (
  `id` int(10) NOT NULL,
  `ly_do_xuat` text COLLATE utf8_unicode_ci NOT NULL,
  `loai_xuat_ra` int(10) NOT NULL,
  `chi_nhanh_nhap_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_PhieuX543690` (`id`),
  KEY `FKtbl_PhieuX273736` (`chi_nhanh_nhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_PhieuXuat`
--

INSERT INTO `tbl_PhieuXuat` (`id`, `ly_do_xuat`, `loai_xuat_ra`, `chi_nhanh_nhap_id`) VALUES
(56647, 'adsa', 0, 10),
(56650, 'dadsa', 1, 10),
(56651, 'adas', 2, 10),
(56652, '231', 2, 10),
(56656, '2132', 2, 10),
(56659, 'xuat ban di', 0, 10),
(56667, 'adsad', 0, 25),
(56668, 'dsadsa', 0, 10),
(56669, 'adsa', 0, 10),
(56670, 'adads', 0, 10),
(56671, 'ADSSAD', 0, 10),
(56672, 'ada', 0, 26),
(56694, 'adsa', 0, 10),
(56695, 'ASDSA', 0, 10),
(56696, 'adsa', 0, 10),
(56697, 'adsad', 0, 10),
(56698, 'adsa', 0, 10),
(56699, 'adsa', 0, 10),
(56700, 'dfsad', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Quyen`
--

CREATE TABLE IF NOT EXISTS `tbl_Quyen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ten_quyen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` tinyint(4) DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `tham_so` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_quyen` (`ten_quyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPham`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPham` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_vach` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_san_pham` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_tieng_viet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `han_dung` tinyint(4) DEFAULT NULL,
  `don_vi_tinh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ton_toi_thieu` tinyint(4) DEFAULT NULL,
  `huong_dan_su_dung` text COLLATE utf8_unicode_ci,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `gia_goc` double NOT NULL,
  `trang_thai` tinyint(4) DEFAULT NULL,
  `nha_cung_cap_id` int(10) NOT NULL,
  `loai_san_pham_id` int(10) NOT NULL,
  `khuyen_mai_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_vach` (`ma_vach`),
  KEY `FKtbl_SanPha178229` (`nha_cung_cap_id`),
  KEY `FKtbl_SanPha797499` (`loai_san_pham_id`),
  KEY `FKtbl_SanPha69518` (`khuyen_mai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_SanPham`
--

INSERT INTO `tbl_SanPham` (`id`, `ma_vach`, `ten_san_pham`, `ten_tieng_viet`, `han_dung`, `don_vi_tinh`, `ton_toi_thieu`, `huong_dan_su_dung`, `mo_ta`, `gia_goc`, `trang_thai`, `nha_cung_cap_id`, `loai_san_pham_id`, `khuyen_mai_id`) VALUES
(2, 'BKBH003', 'Banh keo bien Hoa ', 'sadsa', 56, NULL, 6, 'ddddddddddddddddddddd', NULL, 80000, 1, 3, 2, 6),
(3, '543534534', 'Bàn ủi điện ', NULL, 24, NULL, 10, NULL, NULL, 0, 0, 4, 2, 4),
(4, 'b', 'dasd', NULL, 1, NULL, 50, NULL, NULL, 0, 0, 3, 3, 4),
(5, 'gfdgfd', 'sfds', 'sfdsf', 12, NULL, 50, NULL, NULL, 0, 0, 3, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamChiNhanh` (
  `chi_nhanh_id` int(10) NOT NULL DEFAULT '0',
  `san_pham_id` int(10) NOT NULL DEFAULT '0',
  `so_ton` int(10) DEFAULT NULL,
  `trang_thai` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`chi_nhanh_id`,`san_pham_id`),
  KEY `FKtbl_SanPha834242` (`chi_nhanh_id`),
  KEY `FKtbl_SanPha228435` (`san_pham_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_SanPhamChiNhanh`
--

INSERT INTO `tbl_SanPhamChiNhanh` (`chi_nhanh_id`, `san_pham_id`, `so_ton`, `trang_thai`) VALUES
(10, 2, 54568, NULL),
(10, 3, 33, NULL),
(10, 4, 9263, NULL),
(10, 5, 123, NULL),
(25, 5, 9999, NULL),
(26, 2, 1311857, NULL),
(26, 4, 1409974803, NULL),
(28, 4, 14149, NULL),
(29, 4, 432, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamTang`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamTang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_vach` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_san_pham` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gia_tang` double NOT NULL,
  `thoi_gian_bat_dau` date NOT NULL,
  `thoi_gian_ket_thuc` date NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_vach` (`ma_vach`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_SanPhamTang`
--

INSERT INTO `tbl_SanPhamTang` (`id`, `ma_vach`, `ten_san_pham`, `gia_tang`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `mo_ta`, `trang_thai`) VALUES
(2, 'GHAHA', 'ffdsfsdf', 3213213, '2013-04-20', '2013-05-23', NULL, 0),
(3, 'dadsadsa', 'adas', 3333, '2013-04-16', '2013-04-25', NULL, 1),
(4, 'rwer', 'werfdf', 24324, '2013-04-21', '2013-04-23', NULL, 1),
(5, 'adsad', 'asd', 543543, '2013-04-08', '2013-04-24', NULL, 1),
(6, 'gdf', 'sfds', 344, '2013-04-16', '2013-04-17', NULL, 0),
(7, 'dsavv', 'dd', 22, '2013-04-14', '2013-04-17', NULL, 0),
(8, 'asdcc', 's', 333, '2013-04-14', '2013-04-17', NULL, 1),
(9, 'fff', 'ada', 534, '2013-04-07', '2013-04-16', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamTangChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamTangChiNhanh` (
  `san_pham_tang_id` int(10) NOT NULL DEFAULT '0',
  `chi_nhanh_id` int(10) NOT NULL,
  `so_ton` int(10) DEFAULT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`chi_nhanh_id`),
  KEY `FKtbl_SanPha299705` (`san_pham_tang_id`),
  KEY `FKtbl_SanPha601534` (`chi_nhanh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ThongTinCongTy`
--

CREATE TABLE IF NOT EXISTS `tbl_ThongTinCongTy` (
  `ten_cong_ty` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_ThongTinCongTy`
--

INSERT INTO `tbl_ThongTinCongTy` (`ten_cong_ty`, `dia_chi`, `dien_thoai`, `fax`, `email`, `website`) VALUES
('Công ty TNHH An Phước ', '45 Nguyễn Trãi - P5 - Q10 ', '(08) 3848439', '(08) 3848440', 'anphuoc@hcm.vn', 'www.anphuoc.vn ');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ChiNhanh`
--
ALTER TABLE `tbl_ChiNhanh`
  ADD CONSTRAINT `FKtbl_ChiNha197094` FOREIGN KEY (`truc_thuoc_id`) REFERENCES `tbl_ChiNhanh` (`id`),
  ADD CONSTRAINT `FKtbl_ChiNha320112` FOREIGN KEY (`khu_vuc_id`) REFERENCES `tbl_KhuVuc` (`id`),
  ADD CONSTRAINT `FKtbl_ChiNha643812` FOREIGN KEY (`loai_chi_nhanh_id`) REFERENCES `tbl_LoaiChiNhanh` (`id`);

--
-- Constraints for table `tbl_ChiTietHoaDonBan`
--
ALTER TABLE `tbl_ChiTietHoaDonBan`
  ADD CONSTRAINT `FKtbl_ChiTie469808` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_HoaDonBanHang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie898627` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

--
-- Constraints for table `tbl_ChiTietHoaDonTang`
--
ALTER TABLE `tbl_ChiTietHoaDonTang`
  ADD CONSTRAINT `FKtbl_ChiTie468546` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_HoaDonBanHang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie898645` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_SanPhamTang` (`id`);

--
-- Constraints for table `tbl_ChiTietHoaDonTra`
--
ALTER TABLE `tbl_ChiTietHoaDonTra`
  ADD CONSTRAINT `FKtbl_ChiTie11581` FOREIGN KEY (`hoa_don_tra_id`) REFERENCES `tbl_HoaDonTraHang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie916439` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

--
-- Constraints for table `tbl_ChiTietPhieuNhap`
--
ALTER TABLE `tbl_ChiTietPhieuNhap`
  ADD CONSTRAINT `FKtbl_ChiTie125902` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie280924` FOREIGN KEY (`phieu_nhap_id`) REFERENCES `tbl_PhieuNhap` (`id`);

--
-- Constraints for table `tbl_ChiTietPhieuNhapSanPhamTang`
--
ALTER TABLE `tbl_ChiTietPhieuNhapSanPhamTang`
  ADD CONSTRAINT `FKtbl_ChiTie125142` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_SanPhamTang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie280143` FOREIGN KEY (`phieu_nhap_id`) REFERENCES `tbl_PhieuNhap` (`id`);

--
-- Constraints for table `tbl_ChiTietPhieuXuat`
--
ALTER TABLE `tbl_ChiTietPhieuXuat`
  ADD CONSTRAINT `FKtbl_ChiTie259107` FOREIGN KEY (`phieu_xuat_id`) REFERENCES `tbl_PhieuXuat` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie815494` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

--
-- Constraints for table `tbl_ChiTietPhieuXuatSanPhamTang`
--
ALTER TABLE `tbl_ChiTietPhieuXuatSanPhamTang`
  ADD CONSTRAINT `FKtbl_ChiTie280145` FOREIGN KEY (`phieu_xuat_id`) REFERENCES `tbl_PhieuXuat` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie125144` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_SanPhamTang` (`id`);

--
-- Constraints for table `tbl_ChungTu`
--
ALTER TABLE `tbl_ChungTu`
  ADD CONSTRAINT `FKtbl_ChungT392230` FOREIGN KEY (`nhan_vien_id`) REFERENCES `tbl_NhanVien` (`id`),
  ADD CONSTRAINT `FKtbl_ChungT837946` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

--
-- Constraints for table `tbl_GanQuyen`
--
ALTER TABLE `tbl_GanQuyen`
  ADD CONSTRAINT `FKtbl_GanQuy13476` FOREIGN KEY (`quyen_id`) REFERENCES `tbl_Quyen` (`id`),
  ADD CONSTRAINT `FKtbl_GanQuy912194` FOREIGN KEY (`nhan_vien_id`) REFERENCES `tbl_NhanVien` (`id`);

--
-- Constraints for table `tbl_HoaDonBanHang`
--
ALTER TABLE `tbl_HoaDonBanHang`
  ADD CONSTRAINT `FKtbl_HoaDon810063` FOREIGN KEY (`id`) REFERENCES `tbl_ChungTu` (`id`),
  ADD CONSTRAINT `tbl_HoaDonBanHang_ibfk_1` FOREIGN KEY (`khach_hang_id`) REFERENCES `tbl_KhachHang` (`id`);

--
-- Constraints for table `tbl_HoaDonTraHang`
--
ALTER TABLE `tbl_HoaDonTraHang`
  ADD CONSTRAINT `FKtbl_HoaDon696201` FOREIGN KEY (`id`) REFERENCES `tbl_ChungTu` (`id`),
  ADD CONSTRAINT `FKtbl_HoaDon976146` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_HoaDonBanHang` (`id`);

--
-- Constraints for table `tbl_KhachHang`
--
ALTER TABLE `tbl_KhachHang`
  ADD CONSTRAINT `FKtbl_KhachH518685` FOREIGN KEY (`loai_khach_hang_id`) REFERENCES `tbl_LoaiKhachHang` (`id`);

--
-- Constraints for table `tbl_KhuyenMaiChiNhanh`
--
ALTER TABLE `tbl_KhuyenMaiChiNhanh`
  ADD CONSTRAINT `FKtbl_Khuyen292321` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `tbl_KhuyenMai` (`id`),
  ADD CONSTRAINT `FKtbl_Khuyen611439` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

--
-- Constraints for table `tbl_MocGia`
--
ALTER TABLE `tbl_MocGia`
  ADD CONSTRAINT `tbl_MocGia_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

--
-- Constraints for table `tbl_NhanVien`
--
ALTER TABLE `tbl_NhanVien`
  ADD CONSTRAINT `FKtbl_NhanVi521022` FOREIGN KEY (`loai_nhan_vien_id`) REFERENCES `tbl_LoaiNhanVien` (`id`),
  ADD CONSTRAINT `FKtbl_NhanVi835155` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

--
-- Constraints for table `tbl_PhanQuyen`
--
ALTER TABLE `tbl_PhanQuyen`
  ADD CONSTRAINT `FKtbl_PhanQu271131` FOREIGN KEY (`quyen_id`) REFERENCES `tbl_Quyen` (`id`),
  ADD CONSTRAINT `FKtbl_PhanQu387683` FOREIGN KEY (`vai_tro_id`) REFERENCES `tbl_Quyen` (`id`);

--
-- Constraints for table `tbl_PhieuNhap`
--
ALTER TABLE `tbl_PhieuNhap`
  ADD CONSTRAINT `FKtbl_PhieuN233283` FOREIGN KEY (`id`) REFERENCES `tbl_ChungTu` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuN233299` FOREIGN KEY (`nha_cung_cap_id`) REFERENCES `tbl_NhaCungCap` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuN364331` FOREIGN KEY (`chi_nhanh_xuat_id`) REFERENCES `tbl_ChiNhanh` (`id`);

--
-- Constraints for table `tbl_PhieuXuat`
--
ALTER TABLE `tbl_PhieuXuat`
  ADD CONSTRAINT `FKtbl_PhieuX273736` FOREIGN KEY (`chi_nhanh_nhap_id`) REFERENCES `tbl_ChiNhanh` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuX543690` FOREIGN KEY (`id`) REFERENCES `tbl_ChungTu` (`id`);

--
-- Constraints for table `tbl_SanPham`
--
ALTER TABLE `tbl_SanPham`
  ADD CONSTRAINT `FKtbl_SanPha178229` FOREIGN KEY (`nha_cung_cap_id`) REFERENCES `tbl_NhaCungCap` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha69518` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `tbl_KhuyenMai` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha797499` FOREIGN KEY (`loai_san_pham_id`) REFERENCES `tbl_LoaiSanPham` (`id`);

--
-- Constraints for table `tbl_SanPhamChiNhanh`
--
ALTER TABLE `tbl_SanPhamChiNhanh`
  ADD CONSTRAINT `FKtbl_SanPha228435` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha834242` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

--
-- Constraints for table `tbl_SanPhamTangChiNhanh`
--
ALTER TABLE `tbl_SanPhamTangChiNhanh`
  ADD CONSTRAINT `FKtbl_SanPha299705` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_SanPhamTang` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha601534` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
