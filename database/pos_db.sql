-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2013 at 02:37 PM
-- Server version: 5.5.29
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_ChiNhanh`
--

INSERT INTO `tbl_ChiNhanh` (`id`, `ma_chi_nhanh`, `ten_chi_nhanh`, `dia_chi`, `dien_thoai`, `fax`, `mo_ta`, `trang_thai`, `truc_thuoc_id`, `khu_vuc_id`, `loai_chi_nhanh_id`) VALUES
(10, 'adsad', 'yyyyy', NULL, NULL, NULL, NULL, 1, NULL, 1, 2),
(25, 'dasdsa', 'adsad', 'sadsadsa', NULL, NULL, NULL, 1, 10, 4, 2),
(26, 'adsassdsa', 'adsaasdsa ', 'dxsa', NULL, NULL, NULL, 1, 10, 1, 1),
(27, 'adsadsa', 'adsad', NULL, NULL, NULL, NULL, 0, NULL, 1, 1),
(28, 'BABA', 'adsa', NULL, NULL, NULL, NULL, 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ChiTietHoaDonBan`
--

CREATE TABLE IF NOT EXISTS `tbl_ChiTietHoaDonBan` (
  `san_pham_id` int(10) NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` double NOT NULL,
  `san_pham_tang_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`san_pham_id`,`hoa_don_ban_id`),
  UNIQUE KEY `san_pham_tang_id` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie898627` (`san_pham_id`),
  KEY `FKtbl_ChiTie594649` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie469808` (`hoa_don_ban_id`)
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
  `so_luong` int(10) NOT NULL,
  `gia_nhap` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`phieu_nhap_id`),
  KEY `FKtbl_ChiTie125902` (`san_pham_id`),
  KEY `FKtbl_ChiTie280924` (`phieu_nhap_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_ChungTu`
--

INSERT INTO `tbl_ChungTu` (`id`, `ma_chung_tu`, `ngay_lap`, `tri_gia`, `ghi_chu`, `nhan_vien_id`, `chi_nhanh_id`) VALUES
(1, 'CHT001', '2013-04-03', 200000, '', 2, 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

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
(45, 'sfdsfds', 'sfdsfdsf', NULL),
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
(59, 'dwedde', 'd3ed', '3e43e34e3');

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
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chuong_trinh` (`ma_chuong_trinh`),
  KEY `FKtbl_Khuyen403233` (`chi_nhanh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_LoaiNhanVien`
--

INSERT INTO `tbl_LoaiNhanVien` (`id`, `ma_loai_nhan_vien`, `ten_loai`) VALUES
(1, 'TK', 'Thu Kho');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_LoaiSanPham`
--

INSERT INTO `tbl_LoaiSanPham` (`id`, `ma_loai`, `ten_loai`) VALUES
(1, 'dsa', 'VVVVVV'),
(2, 'gfdgsadsad', 'dadssa'),
(3, 'ada ', 'adfsf'),
(5, 'adasd', 'dadsa');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_MocGia`
--

INSERT INTO `tbl_MocGia` (`id`, `thoi_gian_bat_dau`, `gia_ban`, `san_pham_id`) VALUES
(32, '2013-04-17', 50009, 2),
(33, '2013-04-24', 60000, 2),
(34, '2013-04-29', 800000, 2),
(35, '2013-06-12', 82000, 2),
(38, '2013-07-16', 75000, 2),
(39, '2013-05-15', 99999, 2),
(40, '2013-04-28', 80000, 2),
(41, '2013-04-01', 60100, 2),
(42, '2013-04-12', 38000, 2),
(43, '2013-04-19', 5000, 3),
(44, '2013-04-17', 4000, 3);

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
(2, 'adsa', 'adsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'adsa', NULL, NULL, 1, 26),
(5, 'dsad', 'dsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dsadsa', NULL, NULL, 1, 26);

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
  PRIMARY KEY (`id`),
  KEY `FKtbl_PhieuN364331` (`chi_nhanh_xuat_id`),
  KEY `FKtbl_PhieuN233283` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `trang_thai` tinyint(4) DEFAULT NULL,
  `nha_cung_cap_id` int(10) NOT NULL,
  `loai_san_pham_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_vach` (`ma_vach`),
  KEY `FKtbl_SanPha178229` (`nha_cung_cap_id`),
  KEY `FKtbl_SanPha797499` (`loai_san_pham_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_SanPham`
--

INSERT INTO `tbl_SanPham` (`id`, `ma_vach`, `ten_san_pham`, `ten_tieng_viet`, `han_dung`, `don_vi_tinh`, `ton_toi_thieu`, `huong_dan_su_dung`, `mo_ta`, `trang_thai`, `nha_cung_cap_id`, `loai_san_pham_id`) VALUES
(2, 'BKBH002', 'Banh keo bien Hoa ', NULL, 24, NULL, 6, 'ddddddddddddddddddddd', NULL, 1, 3, 1),
(3, '543534534', 'Bàn ủi điện ', NULL, 24, NULL, 10, NULL, NULL, 0, 4, 2),
(4, 'a', 'dasd', NULL, 1, NULL, 50, NULL, NULL, 0, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamChiNhanh` (
  `chi_nhanh_id` int(10) NOT NULL DEFAULT '0',
  `san_pham_id` int(10) NOT NULL DEFAULT '0',
  `khuyen_mai_id` int(10) DEFAULT NULL,
  `so_ton` int(10) DEFAULT NULL,
  `trang_thai` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`chi_nhanh_id`,`san_pham_id`),
  KEY `FKtbl_SanPha834242` (`chi_nhanh_id`),
  KEY `FKtbl_SanPha228435` (`san_pham_id`),
  KEY `FKtbl_SanPha69518` (`khuyen_mai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_SanPhamChiNhanh`
--

INSERT INTO `tbl_SanPhamChiNhanh` (`chi_nhanh_id`, `san_pham_id`, `khuyen_mai_id`, `so_ton`, `trang_thai`) VALUES
(10, 2, NULL, NULL, NULL),
(26, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamTang`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamTang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_vach` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_san_pham` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_vach` (`ma_vach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_SanPhamTangChiNhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_SanPhamTangChiNhanh` (
  `san_pham_tang_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  `gia_tang` double DEFAULT NULL,
  `thoi_gian_bat_dau` date DEFAULT NULL,
  `thoi_gian_ket_thuc` date DEFAULT NULL,
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
  ADD CONSTRAINT `FKtbl_ChiTie594649` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_SanPhamTang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie898627` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

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
-- Constraints for table `tbl_ChiTietPhieuXuat`
--
ALTER TABLE `tbl_ChiTietPhieuXuat`
  ADD CONSTRAINT `FKtbl_ChiTie259107` FOREIGN KEY (`phieu_xuat_id`) REFERENCES `tbl_PhieuXuat` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie815494` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`);

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
  ADD CONSTRAINT `tbl_HoaDonBanHang_ibfk_1` FOREIGN KEY (`khach_hang_id`) REFERENCES `tbl_KhachHang` (`id`),
  ADD CONSTRAINT `FKtbl_HoaDon810063` FOREIGN KEY (`id`) REFERENCES `tbl_ChungTu` (`id`);

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
-- Constraints for table `tbl_KhuyenMai`
--
ALTER TABLE `tbl_KhuyenMai`
  ADD CONSTRAINT `FKtbl_Khuyen403233` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_ChiNhanh` (`id`);

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
  ADD CONSTRAINT `FKtbl_SanPha797499` FOREIGN KEY (`loai_san_pham_id`) REFERENCES `tbl_LoaiSanPham` (`id`);

--
-- Constraints for table `tbl_SanPhamChiNhanh`
--
ALTER TABLE `tbl_SanPhamChiNhanh`
  ADD CONSTRAINT `FKtbl_SanPha228435` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_SanPham` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha69518` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `tbl_KhuyenMai` (`id`),
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
