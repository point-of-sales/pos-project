-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2013 at 08:06 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

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
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('NVBanHang', '11', NULL, NULL),
('NVBanHang', '13', NULL, NULL),
('NVBanHang', '2', NULL, 'N;'),
('NVThuKho', '5', NULL, 'N;'),
('NVThuKho', '6', NULL, 'N;'),
('QuanLyChiNhanh', '8', NULL, 'N;'),
('QuanLyHeThong', '1', NULL, NULL),
('QuanLyHeThong', '16', NULL, NULL),
('QuanLyHeThong', '17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('NVBanHang', 2, 'Bán hàng', NULL, 'N;'),
('NVThuKho', 2, 'Thủ kho', NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.CapNhatSoLuong', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.CapNhatTienNhan', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.DongBoDuLieu', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.HoaDon', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.HoaDonMoi', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.InHoaDon', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.LayHangTang', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.LayKhachHang', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.LaySanPhamBan', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.Them', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.Xoa', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.XoaSanPhamBan', 0, NULL, NULL, 'N;'),
('Quanlybanhang.HoaDonBanHang.Xuat', 0, NULL, NULL, 'N;'),
('Quanlybaocao.BaoCao.BanHangChiNhanh', 0, NULL, NULL, 'N;'),
('Quanlybaocao.BaoCao.BanHangSanPham', 0, NULL, NULL, 'N;'),
('Quanlybaocao.BaoCao.BanHangTop', 0, NULL, NULL, 'N;'),
('Quanlybaocao.BaoCao.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlybaocao.BaoCao.NhapXuatTon', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.CauHinh.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.CauHinh.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.CauHinh.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.CauHinh.Them', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.ThongTinCongTy.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.ThongTinCongTy.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.ThongTinCongTy.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlycauhinh.ThongTinCongTy.Them', 0, NULL, NULL, 'N;'),
('QuanLyChiNhanh', 2, 'Quản lý chi nhánh', NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.AjaxActiveStatusProduct', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.Them', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.Xoa', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.ChiNhanh.Xuat', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.Them', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.Xoa', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.KhuVuc.Xuat', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.Them', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.Xoa', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlychinhanh.LoaiChiNhanh.Xuat', 0, NULL, NULL, 'N;'),
('QuanLyHeThong', 2, 'Quản lý hệ thống', NULL, 'N;'),
('Quanlykhachhang.KhachHang.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.Them', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.Xoa', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.KhachHang.Xuat', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.Them', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.Xoa', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlykhachhang.LoaiKhachHang.Xuat', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.CapNhatKhuyenMai', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.KhuyenMaiChiNhanh', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.KhuyenMaiSanPham', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.Them', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.Xoa', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.Xuat', 0, NULL, NULL, 'N;'),
('Quanlykhuyenmai.KhuyenMai.XuatKhuyenMaiSanPham', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.Them', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.Xoa', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlynhacungcap.NhaCungCap.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.Them', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.Xoa', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.LoaiNhanVien.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.AjaxActive', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.Them', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.Xoa', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlynhanvien.NhanVien.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.ChiNhanh.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.ChiNhanh.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.ChiNhanh.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.ChiTietXuatSanPhamTang', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.NhapSanPhamTang', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.ReCheckBeforeSent', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.SyncData', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.Them', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.Xoa', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuNhap.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.ChiTietXuatSanPhamTang', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.LaySoLuongTon', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.LaySoLuongTonSanPhamTang', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.ReCheckBeforeSent', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.SyncData', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.Them', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.Xoa', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.Xuat', 0, NULL, NULL, 'N;'),
('Quanlynhapxuat.PhieuXuat.XuatSanPhamTang', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Assignment.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Assignment.PhanQuyen', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Assignment.Revoke', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Assign', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Create', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Delete', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Generate', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Operations', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Permissions', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.RemoveChild', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Revoke', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Roles', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Sortable', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Tasks', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.AuthItem.Update', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Install.Confirm', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Install.Error', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Install.Ready', 0, NULL, NULL, 'N;'),
('Quanlyphanquyen.Install.Run', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.Them', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.Xoa', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlysanpham.LoaiSanPham.Xuat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.MocGia.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.MocGia.Them', 0, NULL, NULL, 'N;'),
('Quanlysanpham.MocGia.Xoa', 0, NULL, NULL, 'N;'),
('Quanlysanpham.MocGia.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlysanpham.MocGia.Xuat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.Them', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.ThemAjax', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.Xoa', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPham.Xuat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.CapNhat', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.ChiTiet', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.DanhSach', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.Them', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.Xoa', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.XoaGrid', 0, NULL, NULL, 'N;'),
('Quanlysanpham.SanPhamTang.Xuat', 0, NULL, NULL, 'N;'),
('Site.*', 1, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Site.Login', 0, NULL, NULL, 'N;'),
('Site.Logout', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('QuanLyChiNhanh', 'NVBanHang'),
('QuanLyChiNhanh', 'NVThuKho'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.CapNhat'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.CapNhatSoLuong'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.CapNhatTienNhan'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.ChiTiet'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.DanhSach'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.DongBoDuLieu'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.HoaDon'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.HoaDonMoi'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.InHoaDon'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.LayHangTang'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.LayKhachHang'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.LaySanPhamBan'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.Them'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.Xoa'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.XoaGrid'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.XoaSanPhamBan'),
('NVBanHang', 'Quanlybanhang.HoaDonBanHang.Xuat'),
('QuanLyChiNhanh', 'Quanlybaocao.BaoCao.BanHangChiNhanh'),
('QuanLyChiNhanh', 'Quanlybaocao.BaoCao.BanHangSanPham'),
('QuanLyChiNhanh', 'Quanlybaocao.BaoCao.BanHangTop'),
('QuanLyChiNhanh', 'Quanlybaocao.BaoCao.DanhSach'),
('QuanLyChiNhanh', 'Quanlybaocao.BaoCao.NhapXuatTon'),
('NVThuKho', 'Quanlychinhanh.ChiNhanh.AjaxActiveStatusProduct'),
('QuanLyChiNhanh', 'Quanlychinhanh.ChiNhanh.AjaxActiveStatusProduct'),
('QuanLyChiNhanh', 'Quanlychinhanh.ChiNhanh.ChiTiet'),
('NVThuKho', 'Quanlychinhanh.ChiNhanh.DanhSach'),
('QuanLyChiNhanh', 'Quanlychinhanh.ChiNhanh.DanhSach'),
('QuanLyChiNhanh', 'Quanlychinhanh.KhuVuc.ChiTiet'),
('QuanLyChiNhanh', 'Quanlychinhanh.KhuVuc.DanhSach'),
('QuanLyChiNhanh', 'Quanlychinhanh.LoaiChiNhanh.ChiTiet'),
('QuanLyChiNhanh', 'Quanlychinhanh.LoaiChiNhanh.DanhSach'),
('NVBanHang', 'Quanlykhachhang.KhachHang.CapNhat'),
('NVBanHang', 'Quanlykhachhang.KhachHang.ChiTiet'),
('NVBanHang', 'Quanlykhachhang.KhachHang.DanhSach'),
('NVBanHang', 'Quanlykhachhang.KhachHang.Them'),
('NVBanHang', 'Quanlykhachhang.KhachHang.Xoa'),
('NVBanHang', 'Quanlykhachhang.KhachHang.XoaGrid'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.CapNhat'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.ChiTiet'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.DanhSach'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.Them'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.Xoa'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.XoaGrid'),
('NVBanHang', 'Quanlykhachhang.LoaiKhachHang.Xuat'),
('QuanLyChiNhanh', 'Quanlykhuyenmai.KhuyenMai.ChiTiet'),
('QuanLyChiNhanh', 'Quanlykhuyenmai.KhuyenMai.DanhSach'),
('QuanLyChiNhanh', 'Quanlynhacungcap.NhaCungCap.DanhSach'),
('QuanLyChiNhanh', 'Quanlynhacungcap.NhaCungCap.Xuat'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.AjaxActive'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.CapNhat'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.ChiTiet'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.DanhSach'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.Them'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.Xoa'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.XoaGrid'),
('QuanLyChiNhanh', 'Quanlynhanvien.NhanVien.Xuat'),
('NVThuKho', 'Quanlynhapxuat.ChiNhanh.ChiTiet'),
('NVThuKho', 'Quanlynhapxuat.ChiNhanh.DanhSach'),
('NVThuKho', 'Quanlynhapxuat.ChiNhanh.Xuat'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.CapNhat'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.ChiTiet'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.ChiTietXuatSanPhamTang'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.DanhSach'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.NhapSanPhamTang'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.ReCheckBeforeSent'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.SyncData'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.Them'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.Xoa'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.XoaGrid'),
('NVThuKho', 'Quanlynhapxuat.PhieuNhap.Xuat'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.CapNhat'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.ChiTiet'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.ChiTietXuatSanPhamTang'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.DanhSach'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.LaySoLuongTon'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.LaySoLuongTonSanPhamTang'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.ReCheckBeforeSent'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.SyncData'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.Them'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.Xoa'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.XoaGrid'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.Xuat'),
('NVThuKho', 'Quanlynhapxuat.PhieuXuat.XuatSanPhamTang'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.CapNhat'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.ChiTiet'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.DanhSach'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.Them'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.Xoa'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.XoaGrid'),
('NVThuKho', 'Quanlysanpham.LoaiSanPham.Xuat'),
('QuanLyChiNhanh', 'Quanlysanpham.MocGia.CapNhat'),
('QuanLyChiNhanh', 'Quanlysanpham.MocGia.Them'),
('QuanLyChiNhanh', 'Quanlysanpham.MocGia.Xoa'),
('QuanLyChiNhanh', 'Quanlysanpham.MocGia.XoaGrid'),
('QuanLyChiNhanh', 'Quanlysanpham.MocGia.Xuat'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPham.CapNhat'),
('NVThuKho', 'Quanlysanpham.SanPham.ChiTiet'),
('NVBanHang', 'Quanlysanpham.SanPham.DanhSach'),
('NVThuKho', 'Quanlysanpham.SanPham.DanhSach'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPham.Them'),
('NVThuKho', 'Quanlysanpham.SanPham.ThemAjax'),
('NVThuKho', 'Quanlysanpham.SanPham.Xuat'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPhamTang.CapNhat'),
('NVThuKho', 'Quanlysanpham.SanPhamTang.ChiTiet'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPhamTang.ChiTiet'),
('NVBanHang', 'Quanlysanpham.SanPhamTang.DanhSach'),
('NVThuKho', 'Quanlysanpham.SanPhamTang.DanhSach'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPhamTang.DanhSach'),
('NVThuKho', 'Quanlysanpham.SanPhamTang.Them'),
('QuanLyChiNhanh', 'Quanlysanpham.SanPhamTang.Them'),
('NVThuKho', 'Quanlysanpham.SanPhamTang.Xuat'),
('NVBanHang', 'Site.*'),
('NVThuKho', 'Site.*');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`itemname`, `type`, `weight`) VALUES
('NVBanHang', 2, 1),
('NVThuKho', 2, 2),
('QuanLyChiNhanh', 2, 3),
('QuanLyHeThong', 2, 999);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cauhinh`
--

CREATE TABLE IF NOT EXISTS `tbl_cauhinh` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `so_muc_tin_tren_trang` tinyint(4) DEFAULT NULL,
  `so_luong_ton_canh_bao` tinyint(4) DEFAULT NULL,
  `so_ngay_canh_bao_sinh_nhat_khach_hang` tinyint(4) DEFAULT NULL,
  `email_ho_tro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_cauhinh`
--

INSERT INTO `tbl_cauhinh` (`id`, `so_muc_tin_tren_trang`, `so_luong_ton_canh_bao`, `so_ngay_canh_bao_sinh_nhat_khach_hang`, `email_ho_tro`) VALUES
(1, 10, 30, 12, 'pos_support@hcm.vnn.vn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chinhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_chinhanh` (
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
-- Dumping data for table `tbl_chinhanh`
--

INSERT INTO `tbl_chinhanh` (`id`, `ma_chi_nhanh`, `ten_chi_nhanh`, `dia_chi`, `dien_thoai`, `fax`, `mo_ta`, `trang_thai`, `truc_thuoc_id`, `khu_vuc_id`, `loai_chi_nhanh_id`) VALUES
(1, 'OUTSYS', 'Các nguồn bên ngoài hệ thống ', NULL, NULL, NULL, 'Các công ty, tổ chức bên ngoài hệ thống ', 1, NULL, 4, 1),
(10, 'CN0001', 'Siêu thị Trung tâm Sài gòn Times', '1 Trần Hưng Đạo - Q1', NULL, NULL, NULL, 1, NULL, 4, 1),
(25, 'CN9874', 'Trung tâm mua sắm AT ', '63 Yersin - TP.Đà lạt', NULL, NULL, NULL, 1, 27, 6, 2),
(26, 'CN0732', 'Siêu thị Thăng Long ', '55 Hoàng Quốc Việt - Hà Nội', '08-3234324', '08-3234325', NULL, 1, 10, 3, 1),
(27, 'CN0032', 'Siêu thị Mama Baker V', '34 Trần Quốc Thảo - Q3', '08-5464848', '08-5464849', NULL, 1, 10, 4, 1),
(28, 'CN0839', 'Chi nhánh Siêu thị Antec ', '78 Trường Sa - Tân Bình', '08-3444323', '08-3444325', NULL, 1, 10, 4, 2),
(29, 'CN0040', 'Chi nhánh Siêu thị An Bình ', '103 An Bình - Q5', '08-4343433', '08-4343435', NULL, 1, 10, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitiethoadonban`
--

CREATE TABLE IF NOT EXISTS `tbl_chitiethoadonban` (
  `san_pham_id` int(10) NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`hoa_don_ban_id`),
  KEY `FKtbl_ChiTie898627` (`san_pham_id`),
  KEY `FKtbl_ChiTie469808` (`hoa_don_ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitiethoadonban`
--

INSERT INTO `tbl_chitiethoadonban` (`san_pham_id`, `hoa_don_ban_id`, `so_luong`, `don_gia`) VALUES
(6, 56782, 2, 33500),
(6, 56786, 2, 33500),
(6, 56790, 10, 33500),
(6, 56791, 2, 33500),
(6, 56793, 6, 33500),
(6, 56795, 20, 33500),
(6, 56796, 2, 33500),
(6, 56801, 1, 33500),
(6, 56802, 1, 33500),
(6, 56807, 1, 33500),
(8, 56775, 5, 54000),
(8, 56777, 4, 54000),
(8, 56778, 2, 54000),
(8, 56782, 5, 60000),
(8, 56786, 10, 60000),
(8, 56791, 10, 33600),
(8, 56792, 2, 33600),
(8, 56793, 5, 33600),
(8, 56796, 4, 33600),
(8, 56803, 1, 33600),
(8, 56804, 1, 33600),
(8, 56805, 1, 33600),
(8, 56806, 1, 33600),
(8, 56807, 20, 33600),
(9, 56777, 2, 120000),
(9, 56778, 10, 120000),
(9, 56782, 10, 120000),
(9, 56786, 1, 120000),
(9, 56792, 5, 120000),
(9, 56793, 3, 120000),
(9, 56796, 5, 120000),
(10, 56727, 2, 48000),
(10, 56728, 3, 48000),
(10, 56755, 5, 48000),
(10, 56777, 5, 48000),
(10, 56782, 2, 48000),
(10, 56786, 9, 48000),
(10, 56792, 3, 48000),
(10, 56793, 2, 48000),
(10, 56796, 1, 48000),
(17, 56731, 8, 80000),
(17, 56777, 2, 80000),
(17, 56778, 2, 80000),
(17, 56782, 5, 80000),
(17, 56793, 4, 80000),
(17, 56794, 10, 80000),
(17, 56796, 3, 80000),
(18, 56731, 1, 54000),
(18, 56777, 7, 54000),
(18, 56782, 3, 54000),
(18, 56793, 2, 54000),
(18, 56794, 20, 54000),
(20, 56777, 2, 600000),
(20, 56782, 2, 600000),
(20, 56794, 10, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitiethoadontang`
--

CREATE TABLE IF NOT EXISTS `tbl_chitiethoadontang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  `so_luong` int(11) NOT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`hoa_don_ban_id`),
  KEY `FKtbl_ChiTie898645` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie468546` (`hoa_don_ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitiethoadontang`
--

INSERT INTO `tbl_chitiethoadontang` (`san_pham_tang_id`, `hoa_don_ban_id`, `so_luong`) VALUES
(1, 56755, 1),
(1, 56786, 9),
(1, 56790, 1),
(1, 56793, 1),
(3, 56786, 1),
(3, 56790, 1),
(3, 56793, 2),
(4, 56790, 1),
(4, 56793, 3),
(4, 56796, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitiethoadontra`
--

CREATE TABLE IF NOT EXISTS `tbl_chitiethoadontra` (
  `san_pham_id` int(10) NOT NULL,
  `hoa_don_tra_id` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `don_gia` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`hoa_don_tra_id`),
  KEY `FKtbl_ChiTie11581` (`hoa_don_tra_id`),
  KEY `FKtbl_ChiTie916439` (`san_pham_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitiethoadontra`
--

INSERT INTO `tbl_chitiethoadontra` (`san_pham_id`, `hoa_don_tra_id`, `so_luong`, `don_gia`) VALUES
(6, 56797, 20, 33500),
(8, 56776, 3, 54000),
(8, 56779, 4, 54000),
(9, 56779, 2, 120000),
(9, 56780, 10, 120000),
(9, 56785, 5, 120000),
(10, 56779, 5, 48000),
(10, 56784, 2, 48000),
(17, 56779, 2, 80000),
(17, 56784, 5, 80000),
(18, 56779, 7, 54000),
(18, 56784, 3, 54000),
(20, 56779, 2, 600000),
(20, 56783, 2, 600000),
(20, 56798, 10, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieunhap`
--

CREATE TABLE IF NOT EXISTS `tbl_chitietphieunhap` (
  `san_pham_id` int(10) NOT NULL,
  `phieu_nhap_id` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `gia_nhap` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`phieu_nhap_id`),
  KEY `FKtbl_ChiTie125902` (`san_pham_id`),
  KEY `FKtbl_ChiTie280924` (`phieu_nhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitietphieunhap`
--

INSERT INTO `tbl_chitietphieunhap` (`san_pham_id`, `phieu_nhap_id`, `so_luong`, `gia_nhap`) VALUES
(6, 56729, 2000, 230000),
(6, 56788, 20, 230000),
(7, 56763, 450, 6800000),
(7, 56787, 200, 6800000),
(8, 56719, 250, 390000),
(8, 56726, 300, 390000),
(8, 56787, 100, 390000),
(9, 56726, 50, 200000),
(9, 56769, 100, 200000),
(9, 56772, 100, 200000),
(9, 56773, 200, 200000),
(9, 56781, 100, 200000),
(10, 56719, 600, 45000),
(10, 56721, 200, 45000),
(10, 56725, 230, 45000),
(10, 56764, 120, 45000),
(11, 56721, 120, 430000),
(12, 56761, 600, 150000),
(17, 56730, 3730, 50000),
(17, 56762, 100, 50000),
(18, 56730, 3000, 48000),
(18, 56760, 500, 48000),
(18, 56762, 120, 48000),
(20, 56730, 34550, 520000),
(20, 56760, 200, 520000),
(21, 56766, 112, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieunhapsanphamtang`
--

CREATE TABLE IF NOT EXISTS `tbl_chitietphieunhapsanphamtang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `phieu_nhap_id` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`phieu_nhap_id`),
  KEY `FKtbl_ChiTie125142` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie280143` (`phieu_nhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitietphieunhapsanphamtang`
--

INSERT INTO `tbl_chitietphieunhapsanphamtang` (`san_pham_tang_id`, `phieu_nhap_id`, `so_luong`) VALUES
(1, 56720, 100),
(1, 56770, 120),
(1, 56774, 220),
(2, 56799, 100),
(3, 56767, 1000),
(4, 56767, 1000),
(5, 56800, 100),
(6, 56800, 1000),
(7, 56800, 200),
(8, 56800, 100),
(9, 56800, 100),
(10, 56800, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieuxuat`
--

CREATE TABLE IF NOT EXISTS `tbl_chitietphieuxuat` (
  `san_pham_id` int(10) NOT NULL,
  `phieu_xuat_id` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `gia_xuat` double NOT NULL,
  PRIMARY KEY (`san_pham_id`,`phieu_xuat_id`),
  KEY `FKtbl_ChiTie815494` (`san_pham_id`),
  KEY `FKtbl_ChiTie259107` (`phieu_xuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitietphieuxuat`
--

INSERT INTO `tbl_chitietphieuxuat` (`san_pham_id`, `phieu_xuat_id`, `so_luong`, `gia_xuat`) VALUES
(6, 56789, 200, 230000),
(10, 56724, 230, 45000),
(10, 56789, 100, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieuxuatsanphamtang`
--

CREATE TABLE IF NOT EXISTS `tbl_chitietphieuxuatsanphamtang` (
  `san_pham_tang_id` int(10) NOT NULL,
  `phieu_xuat_id` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`phieu_xuat_id`),
  KEY `FKtbl_ChiTie125144` (`san_pham_tang_id`),
  KEY `FKtbl_ChiTie280145` (`phieu_xuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chitietphieuxuatsanphamtang`
--

INSERT INTO `tbl_chitietphieuxuatsanphamtang` (`san_pham_tang_id`, `phieu_xuat_id`, `so_luong`) VALUES
(4, 56768, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chungtu`
--

CREATE TABLE IF NOT EXISTS `tbl_chungtu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_chung_tu` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_lap` datetime NOT NULL,
  `tri_gia` double NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `nhan_vien_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chung_tu` (`ma_chung_tu`),
  KEY `FKtbl_ChungT392230` (`nhan_vien_id`),
  KEY `FKtbl_ChungT837946` (`chi_nhanh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56808 ;

--
-- Dumping data for table `tbl_chungtu`
--

INSERT INTO `tbl_chungtu` (`id`, `ma_chung_tu`, `ngay_lap`, `tri_gia`, `ghi_chu`, `nhan_vien_id`, `chi_nhanh_id`) VALUES
(56719, 'PN0432432', '2013-05-13 00:00:00', 124500000, NULL, 2, 10),
(56720, 'TA321321', '2013-05-13 00:00:00', 0, NULL, 2, 10),
(56721, 'PN321342', '2013-05-13 00:00:00', 60600000, NULL, 6, 28),
(56724, 'PX0435453', '2013-05-13 00:00:00', 10350000, NULL, 2, 10),
(56725, 'PN434535', '2013-05-13 00:00:00', 10350000, NULL, 2, 26),
(56726, 'PN3234234', '2013-05-13 00:00:00', 127000000, NULL, 6, 10),
(56727, 'BH00000000001', '2013-01-15 00:00:00', 96000, NULL, 2, 10),
(56728, 'BH00000000002', '2013-01-15 00:00:00', 144000, NULL, 2, 10),
(56729, 'PN432454', '2013-05-17 00:00:00', 460000000, NULL, 6, 10),
(56730, 'PN005439', '2013-05-17 00:00:00', 18296500000, NULL, 6, 10),
(56731, 'BH00000000003', '2013-02-17 00:00:00', 694000, NULL, 2, 10),
(56755, 'BH00000000004', '2013-02-20 00:00:00', 240000, NULL, 2, 10),
(56760, 'PN432428', '2013-05-20 00:00:00', 128000000, NULL, 6, 29),
(56761, 'PN949484', '2013-05-20 00:00:00', 90000000, NULL, 6, 10),
(56762, 'PN00000949485', '2013-05-22 00:00:00', 10760000, NULL, 5, 26),
(56763, 'PN00000949486', '2013-05-22 00:00:00', 3060000000, NULL, 5, 26),
(56764, 'PN00000949487', '2013-05-31 12:00:00', 5400000, NULL, 1, 10),
(56766, 'PN00000949488', '2013-05-31 12:00:00', 1680000, NULL, 1, 10),
(56767, 'PN00000949489', '2013-06-05 12:00:00', 0, NULL, 1, 10),
(56768, 'PX00000435454', '2013-06-05 12:00:00', 14000000, NULL, 1, 10),
(56769, 'PN00000949490', '2013-06-06 12:00:00', 20000000, NULL, 1, 10),
(56770, 'PN00000949491', '2013-06-06 12:00:00', 0, NULL, 1, 10),
(56772, 'PN00000949492', '2013-06-06 12:00:00', 20000000, NULL, 1, 10),
(56773, 'PN00000949493', '2013-06-06 12:00:00', 40000000, NULL, 1, 10),
(56774, 'PN00000949494', '2013-06-06 12:00:00', 0, NULL, 1, 10),
(56775, 'BH00000000006', '2013-03-07 07:18:36', 270000, NULL, 1, 10),
(56776, 'TH00000000002', '2013-06-07 07:18:56', 162000, NULL, 1, 10),
(56777, 'BH00000000007', '2013-04-07 07:22:05', 2434000, NULL, 1, 10),
(56778, 'BH00000000008', '2013-05-07 07:23:09', 1423960, NULL, 1, 10),
(56779, 'TH00000000003', '2013-06-07 07:51:09', 2434000, NULL, 1, 10),
(56780, 'TH00000000004', '2013-06-07 07:52:18', 1164000, NULL, 1, 10),
(56781, 'PN00000949495', '2013-06-09 12:00:00', 20000000, NULL, 1, 10),
(56782, 'BH00000000009', '2013-06-10 09:49:57', 2911250, NULL, 1, 10),
(56783, 'TH00000000005', '2013-06-10 09:54:50', 1020000, NULL, 1, 10),
(56784, 'TH00000000006', '2013-06-10 09:55:21', 559300, NULL, 1, 10),
(56785, 'TH00000000007', '2013-06-10 09:55:49', 510000, NULL, 1, 10),
(56786, 'BH00000000010', '2013-06-10 01:50:36', 1182430, NULL, 1, 10),
(56787, 'PN00000949496', '2013-06-10 12:00:00', 1399000000, '- nhập số lượng lớn\r\n- ...', 1, 10),
(56788, 'PN00000949497', '2013-06-10 12:00:00', 4600000, NULL, 1, 10),
(56789, 'PX00000435455', '2013-06-10 12:00:00', 50500000, '...', 1, 10),
(56790, 'BH00000000011', '2013-06-12 04:55:02', 335000, NULL, 1, 10),
(56791, 'BH00000000012', '2013-06-14 04:48:37', 403000, NULL, 1, 10),
(56792, 'BH00000000013', '2013-06-14 04:49:45', 811200, NULL, 1, 10),
(56793, 'BH00000000014', '2013-06-14 04:51:44', 1253000, NULL, 1, 10),
(56794, 'BH00000000015', '2013-06-14 04:52:45', 7643600, NULL, 1, 10),
(56795, 'BH00000000016', '2013-06-14 04:54:51', 649900, NULL, 1, 10),
(56796, 'BH00000000017', '2013-06-14 04:57:37', 1089400, NULL, 1, 10),
(56797, 'TH00000000008', '2013-06-14 05:08:03', 649900, NULL, 1, 10),
(56798, 'TH00000000009', '2013-06-14 05:09:00', 5820000, NULL, 1, 10),
(56799, 'PN00000949498', '2013-06-14 12:00:00', 0, NULL, 1, 10),
(56800, 'PN00000949499', '2013-06-14 12:00:00', 0, NULL, 1, 10),
(56801, 'BH00000000018', '2013-06-14 07:40:28', 33500, NULL, 1, 10),
(56802, 'BH00000000019', '2013-06-14 07:45:03', 33500, NULL, 1, 10),
(56803, 'BH00000000020', '2013-06-14 07:49:04', 33600, NULL, 1, 10),
(56804, 'BH00000000021', '2013-06-14 07:55:52', 33600, NULL, 1, 10),
(56805, 'BH00000000022', '2013-06-14 07:57:11', 33600, NULL, 1, 10),
(56806, 'BH00000000023', '2013-06-14 07:58:04', 33600, NULL, 1, 10),
(56807, 'BH00000000024', '2013-06-14 07:59:44', 705500, NULL, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadonbanhang`
--

CREATE TABLE IF NOT EXISTS `tbl_hoadonbanhang` (
  `id` int(10) NOT NULL,
  `chiet_khau` int(10) DEFAULT NULL,
  `khach_hang_id` int(10) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `khach_hang_id` (`khach_hang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_hoadonbanhang`
--

INSERT INTO `tbl_hoadonbanhang` (`id`, `chiet_khau`, `khach_hang_id`, `trang_thai`) VALUES
(56727, 0, 2, 0),
(56728, 0, 2, 0),
(56731, 0, 2, 0),
(56755, 0, 2, 0),
(56775, 0, 2, 1),
(56777, 0, 1, 1),
(56778, 3, 1, 1),
(56782, 15, 1, 1),
(56786, 3, 1, 0),
(56790, 0, 2, 0),
(56791, 0, 3, 0),
(56792, 0, 4, 0),
(56793, 0, 5, 0),
(56794, 3, 5, 1),
(56795, 3, 5, 1),
(56796, 0, 7, 0),
(56801, 0, 3, 0),
(56802, 0, 3, 0),
(56803, 0, 3, 0),
(56804, 0, 3, 0),
(56805, 0, 3, 0),
(56806, 0, 3, 0),
(56807, 0, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadontrahang`
--

CREATE TABLE IF NOT EXISTS `tbl_hoadontrahang` (
  `id` int(10) NOT NULL,
  `ly_do_tra_hang` text COLLATE utf8_unicode_ci NOT NULL,
  `hoa_don_ban_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_HoaDon976146` (`hoa_don_ban_id`),
  KEY `FKtbl_HoaDon696201` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_hoadontrahang`
--

INSERT INTO `tbl_hoadontrahang` (`id`, `ly_do_tra_hang`, `hoa_don_ban_id`) VALUES
(56776, 'abc', 56775),
(56779, 'a', 56777),
(56780, 'a', 56778),
(56783, 'Hàng bị lỗi', 56782),
(56784, 'Hàng bị lỗi', 56782),
(56785, 'Hàng bị lỗi', 56782),
(56797, 'hàng bị hỏng', 56795),
(56798, 'hàng bị hỏng', 56794);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khachhang`
--

CREATE TABLE IF NOT EXISTS `tbl_khachhang` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`id`, `ma_khach_hang`, `ho_ten`, `ngay_sinh`, `dia_chi`, `thanh_pho`, `dien_thoai`, `email`, `mo_ta`, `diem_tich_luy`, `loai_khach_hang_id`) VALUES
(1, 'KH00423', 'Lê Thanh Bình ', '1970-01-06', '8/4 Bà Hạt - Q5', 'TP Hồ Chí Minh', '0904343243', NULL, NULL, 2315340, 4),
(2, 'KHBT', 'Khách hàng mua lẻ', '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 8),
(3, 'KH00000001', 'Lê Cao Trí', '1991-10-02', 'KDC Bình Hưng, Bình Chánh,', 'Hồ Chí Minh', '+843667354453', 'tri@mail.com', NULL, 1209100, 4),
(4, 'KH00000002', 'Lê Bảo Triết', '2013-06-01', 'Q4', 'Hồ Chí Minh', '+843667312312', 'triet@mail.com', NULL, 811200, 8),
(5, 'KH00000003', 'Đăng Thế Điệp', '2013-01-01', '5, Bình Thạnh', 'Hồ Chí Minh', '+8436673321', 'diep@Mail.com', NULL, 3076600, 4),
(6, 'KH00000004', 'Dương Như', '1991-04-04', '5, Nhị Thiên Đường', 'Hồ Chí Minh', '+84366731233', 'nhuduong@mail.com', NULL, NULL, 8),
(7, 'KH00000005', 'Tạ Hà Trung', '1991-01-05', '1, Nguyễn Trãi', 'Hồ Chí Minh', '+8436673567', 'hatrung@Mail.com', NULL, 1089400, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khuvuc`
--

CREATE TABLE IF NOT EXISTS `tbl_khuvuc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_khu_vuc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_khu_vuc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_khu_vuc` (`ma_khu_vuc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_khuvuc`
--

INSERT INTO `tbl_khuvuc` (`id`, `ma_khu_vuc`, `ten_khu_vuc`, `mo_ta`) VALUES
(1, 'MTR', 'Khu vực miền Trung', 'adsadsa '),
(3, 'HNO', 'Khu vực Hà Nội ', 'dssadsad'),
(4, 'HCM', 'Khu vực TP.Hồ Chí Minh', NULL),
(6, 'DNB ', 'Đông Nam Bộ ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khuyenmai`
--

CREATE TABLE IF NOT EXISTS `tbl_khuyenmai` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_chuong_trinh` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_chuong_trinh` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `gia_giam` int(10) NOT NULL,
  `thoi_gian_bat_dau` date NOT NULL,
  `thoi_gian_ket_thuc` date NOT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_chuong_trinh` (`ma_chuong_trinh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_khuyenmai`
--

INSERT INTO `tbl_khuyenmai` (`id`, `ma_chuong_trinh`, `ten_chuong_trinh`, `mo_ta`, `gia_giam`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `trang_thai`) VALUES
(4, 'KM33', 'Khuyến mãi tặng 33%', NULL, 33, '2013-05-10', '2013-06-30', 1),
(5, 'KM44', 'Khuyến mãi tặng 44%', NULL, 44, '2013-05-15', '2013-05-30', 1),
(6, 'KM50', 'Khuyến mãi tặng 50%', NULL, 50, '2013-05-30', '2013-08-30', 1),
(7, 'KM90', 'Khuyến mãi tặng 90%', NULL, 90, '2013-07-18', '2013-09-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khuyenmaichinhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_khuyenmaichinhanh` (
  `khuyen_mai_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`khuyen_mai_id`,`chi_nhanh_id`),
  KEY `FKtbl_Khuyen611439` (`chi_nhanh_id`),
  KEY `FKtbl_Khuyen292321` (`khuyen_mai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_khuyenmaichinhanh`
--

INSERT INTO `tbl_khuyenmaichinhanh` (`khuyen_mai_id`, `chi_nhanh_id`) VALUES
(5, 26),
(4, 27),
(4, 28),
(5, 28),
(7, 28),
(4, 29),
(7, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaichinhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_loaichinhanh` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_chi_nhanh` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai_chi_nhanh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_chi_nhanh` (`ma_loai_chi_nhanh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_loaichinhanh`
--

INSERT INTO `tbl_loaichinhanh` (`id`, `ma_loai_chi_nhanh`, `ten_loai_chi_nhanh`) VALUES
(1, 'L001', 'Chi nhánh loại 1'),
(2, 'L003', 'Chi nhánh loại 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaikhachhang`
--

CREATE TABLE IF NOT EXISTS `tbl_loaikhachhang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_khach_hang` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doanh_so` int(10) DEFAULT NULL,
  `giam_gia` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_khach_hang` (`ma_loai_khach_hang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_loaikhachhang`
--

INSERT INTO `tbl_loaikhachhang` (`id`, `ma_loai_khach_hang`, `ten_loai`, `doanh_so`, `giam_gia`) VALUES
(2, 'KH01', 'Khách hàng loại 1', 30000000, 15),
(3, 'KH02', 'Khách hàng loại 2', 9000000, 5),
(4, 'KH03', 'Khách hàng loại 3', 1000000, 3),
(5, 'VIP001', 'Khách VIP1', 100000000, 20),
(6, 'VIP002', 'Khách VIP2', 80000000, 17),
(7, 'KHBT', 'Khách lẻ', 0, 0),
(8, 'KH00', 'Khách hàng bình thường', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loainhanvien`
--

CREATE TABLE IF NOT EXISTS `tbl_loainhanvien` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_nhan_vien` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_nhan_vien` (`ma_loai_nhan_vien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_loainhanvien`
--

INSERT INTO `tbl_loainhanvien` (`id`, `ma_loai_nhan_vien`, `ten_loai`) VALUES
(1, 'TK1', 'Kế toán 1'),
(3, 'QLCN', 'Quản lý chi nhánh'),
(4, 'BH', 'Bán hàng '),
(5, 'TK', 'Thủ kho '),
(6, 'QTHT', 'Quản trị hệ thống');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loainhapxuat`
--

CREATE TABLE IF NOT EXISTS `tbl_loainhapxuat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai_nhap_xuat` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai_nhap_xuat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai_nhap_xuat` (`ma_loai_nhap_xuat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_loainhapxuat`
--

INSERT INTO `tbl_loainhapxuat` (`id`, `ma_loai_nhap_xuat`, `ten_loai_nhap_xuat`, `loai`) VALUES
(1, 'N001', 'Nhập bán ', 0),
(2, 'N002', 'Nhập mượn', 0),
(3, 'N003', 'Nhập kiểm tra', 0),
(4, 'N004', ' Nhập sản phẩm tặng ', 1),
(5, 'N005', 'Nhập sản phẩm tặng kiểm tra ', 1),
(6, 'X006', 'Xuất bán', 2),
(7, 'X007', 'Xuất cho mượn ', 2),
(8, 'X008', 'Xuất kiểm tra ', 2),
(9, 'X009', 'Xuất sản phẩm tặng', 3),
(10, 'X010', 'Xuất sản phẩm tặng kiểm tra ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaisanpham`
--

CREATE TABLE IF NOT EXISTS `tbl_loaisanpham` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_loai` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_loai` (`ma_loai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_loaisanpham`
--

INSERT INTO `tbl_loaisanpham` (`id`, `ma_loai`, `ten_loai`) VALUES
(1, 'DT', 'Đồ điện tử'),
(2, 'TP', 'Thực phẩm'),
(3, 'GK', 'Nước giải khát-nước ngọt'),
(5, 'RB', 'Rượu bia'),
(6, 'GD', 'Đồ gia dụng'),
(7, 'QA', 'Quần áo hàng may mặc'),
(8, 'QT', 'Đồ trang trí-quà tặng');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mocgia`
--

CREATE TABLE IF NOT EXISTS `tbl_mocgia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thoi_gian_bat_dau` date NOT NULL,
  `gia_ban` double NOT NULL,
  `san_pham_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `san_pham_id` (`san_pham_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_mocgia`
--

INSERT INTO `tbl_mocgia` (`id`, `thoi_gian_bat_dau`, `gia_ban`, `san_pham_id`) VALUES
(1, '2013-05-15', 230000, 9),
(2, '2013-06-21', 250000, 9),
(3, '2013-05-30', 240000, 9),
(4, '2013-05-15', 48000, 10),
(5, '2013-05-17', 80000, 17),
(6, '2013-05-17', 54000, 18),
(7, '2013-05-17', 600000, 20),
(8, '2013-06-09', 50000, 6),
(9, '2013-06-10', 60000, 8),
(10, '2013-06-30', 70000, 8),
(11, '2013-07-31', 75000, 8),
(12, '2013-09-04', 80000, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhacungcap`
--

CREATE TABLE IF NOT EXISTS `tbl_nhacungcap` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_nhacungcap`
--

INSERT INTO `tbl_nhacungcap` (`id`, `ma_nha_cung_cap`, `ten_nha_cung_cap`, `mo_ta`, `dien_thoai`, `email`, `fax`, `trang_thai`) VALUES
(3, 'CC03983', 'Công Ty TNHH Pepsi Việt Nam', NULL, '08-896654', NULL, NULL, 1),
(4, 'CC83239', 'Công ty Sữa Vinamilk ', NULL, '08-3213234', NULL, NULL, 1),
(5, 'CC355324', 'Tập đoàn Nutifoods - Nutifoods Việt Nam', NULL, '08-4324322', NULL, NULL, 1),
(6, 'CC9573432', 'Công ty gốm sứ Sét vàng', NULL, '08-534543', NULL, NULL, 1),
(7, 'CC3653423', 'Điện máy Nguyễn Kim', NULL, '08-3455435', NULL, NULL, 1),
(8, 'CC32434', 'Công ty TNHH May mặc Thiên Hà', NULL, '08-432143', NULL, NULL, 1),
(9, 'CC763838', 'Công ty TTB văn phòng phẩm Duy Hòa', NULL, '(08) 8474742', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhanvien`
--

CREATE TABLE IF NOT EXISTS `tbl_nhanvien` (
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
  `lan_dang_nhap_cuoi` datetime DEFAULT NULL,
  `loai_nhan_vien_id` int(10) NOT NULL,
  `chi_nhanh_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_nhan_vien` (`ma_nhan_vien`),
  KEY `FKtbl_NhanVi521022` (`loai_nhan_vien_id`),
  KEY `FKtbl_NhanVi835155` (`chi_nhanh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`id`, `ma_nhan_vien`, `ho_ten`, `email`, `dien_thoai`, `dia_chi`, `gioi_tinh`, `ngay_sinh`, `trinh_do`, `luong_co_ban`, `chuyen_mon`, `trang_thai`, `mat_khau`, `ngay_vao_lam`, `lan_dang_nhap_cuoi`, `loai_nhan_vien_id`, `chi_nhanh_id`) VALUES
(1, 'QTHT0001', 'Lê Đình Long', NULL, NULL, NULL, 0, '1984-05-08', NULL, NULL, NULL, 1, '202cb962ac59075b964b07152d234b70', '1970-01-01', '2013-06-14 04:23:10', 6, 10),
(2, 'BH001', 'Trần Thụy Diễm My ', NULL, '0974354980', '45/3 Lê Lai - Quận 1 - TPHCM', 1, '1987-01-07', 'Cao Đẳng ', 3200000, 'Bán hàng', 1, '202cb962ac59075b964b07152d234b70', '2010-08-11', '2013-06-10 09:39:34', 4, 26),
(5, 'KT00322', 'Lê Quốc Nam', 'quocnam@hcm.vnn.vn', '4432432', '78/3/2 Thích Quảng Đức - Gò Vấp', 0, '0000-00-00', 'Cao đẳng', 5000000, 'Kế toán kho', 1, '202cb962ac59075b964b07152d234b70', '0000-00-00', '0000-00-00 00:00:00', 1, 26),
(6, 'TK03123', 'Nguyễn Thành Trung', NULL, NULL, '675/3 Trần Xuân Soạn - Q7', 0, '1982-05-21', NULL, NULL, NULL, 1, '202cb962ac59075b964b07152d234b70', '2013-05-23', '1970-01-01 00:00:00', 5, 10),
(8, 'QLCN001', 'Mai Thanh An', NULL, NULL, NULL, 1, '1984-11-16', NULL, NULL, NULL, 1, '202cb962ac59075b964b07152d234b70', '2009-01-10', '1970-01-01 00:00:00', 3, 10),
(16, 'QTHT002', 'Tăng Ngọc Phượng', NULL, NULL, NULL, 1, '1980-01-30', NULL, NULL, NULL, 1, '202cb962ac59075b964b07152d234b70', '2004-06-18', '1970-01-01 00:00:00', 6, 10),
(17, 'QTHT0002', 'Lê Trúc Quỳnh Giang', NULL, NULL, NULL, 1, '1970-01-01', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055', '1970-01-01', '1970-01-01 00:00:00', 6, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieunhap`
--

CREATE TABLE IF NOT EXISTS `tbl_phieunhap` (
  `id` int(10) NOT NULL,
  `loai_nhap_vao` int(10) NOT NULL,
  `chi_nhanh_xuat_id` int(10) NOT NULL,
  `nha_cung_cap_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_PhieuN364331` (`chi_nhanh_xuat_id`),
  KEY `FKtbl_PhieuN233283` (`id`),
  KEY `FKtbl_PhieuN233299` (`nha_cung_cap_id`),
  KEY `loai_nhap_vao` (`loai_nhap_vao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_phieunhap`
--

INSERT INTO `tbl_phieunhap` (`id`, `loai_nhap_vao`, `chi_nhanh_xuat_id`, `nha_cung_cap_id`) VALUES
(56719, 1, 1, 5),
(56720, 4, 1, 4),
(56721, 1, 1, 4),
(56725, 1, 10, 4),
(56726, 1, 1, 5),
(56729, 1, 1, 6),
(56730, 1, 1, 8),
(56760, 1, 1, 8),
(56761, 1, 1, 3),
(56762, 1, 29, 4),
(56763, 1, 1, 7),
(56764, 1, 1, 4),
(56766, 1, 29, 4),
(56767, 4, 1, 9),
(56769, 1, 1, 5),
(56770, 4, 1, 9),
(56772, 1, 29, NULL),
(56773, 1, 1, 5),
(56774, 4, 29, NULL),
(56781, 1, 29, NULL),
(56787, 1, 29, NULL),
(56788, 1, 1, 6),
(56799, 4, 29, NULL),
(56800, 4, 29, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieuxuat`
--

CREATE TABLE IF NOT EXISTS `tbl_phieuxuat` (
  `id` int(10) NOT NULL,
  `ly_do_xuat` text COLLATE utf8_unicode_ci NOT NULL,
  `loai_xuat_ra` int(10) NOT NULL,
  `chi_nhanh_nhap_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtbl_PhieuX543690` (`id`),
  KEY `FKtbl_PhieuX273736` (`chi_nhanh_nhap_id`),
  KEY `loai_xuat_ra` (`loai_xuat_ra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_phieuxuat`
--

INSERT INTO `tbl_phieuxuat` (`id`, `ly_do_xuat`, `loai_xuat_ra`, `chi_nhanh_nhap_id`) VALUES
(56724, 'Mượn để bán', 7, 26),
(56768, 'Xuất cho chi nhánh tặng dịp 1/6 ', 9, 29),
(56789, 'Hàng tồn kho quá nhiều', 6, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE IF NOT EXISTS `tbl_sanpham` (
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
  `trang_thai` tinyint(4) NOT NULL,
  `nha_cung_cap_id` int(10) NOT NULL,
  `loai_san_pham_id` int(10) NOT NULL,
  `khuyen_mai_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_vach` (`ma_vach`),
  KEY `FKtbl_SanPha178229` (`nha_cung_cap_id`),
  KEY `FKtbl_SanPha797499` (`loai_san_pham_id`),
  KEY `FKtbl_SanPha69518` (`khuyen_mai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id`, `ma_vach`, `ten_san_pham`, `ten_tieng_viet`, `han_dung`, `don_vi_tinh`, `ton_toi_thieu`, `huong_dan_su_dung`, `mo_ta`, `gia_goc`, `trang_thai`, `nha_cung_cap_id`, `loai_san_pham_id`, `khuyen_mai_id`) VALUES
(6, '040284', 'Bộ bình trà 16 món - Moriitalia ', 'Bộ bình trà 16 món - Moriitalia ', 0, 'Bộ', 50, NULL, '* Bộ bình trà Moriitalia 16 món.\r\n- Bộ gồm 16 món.\r\n   + 01 Bình trà.\r\n   + 06 Tách trà.\r\n   + 06 Cốc.\r\n   + 01 Hũ đựng đường.\r\n- Thành phần: Sứ cao cấp sản xuất theo tiêu chuẩn của Moriitalia.\r\n- Có thể sử dụng làm quà tặng, rất có ý nghĩa.\r\n- Nhãn hiệu: Morriitalia - Moriitalia chuyên cung cấp đa dạng các sản phẩm hàng gia dụng, đồ dùng nhà bếp, điện gia dụng, quà tặng, đồ trang trí , sản phẩm dùng cho du lịch, dã ngoại ….nổi tiếng thế giới với mức giá cạnh tranh nhất.\r\n- Xuất xứ: Trung Quốc - Sản phẩm được thiết kế và sản xuất theo công nghệ của Italia.', 230000, 1, 6, 6, 4),
(7, '040207', 'Máy xay sinh tố BL619 - Hiệu Osaka ', 'Máy xay sinh tố BL619 - Hiệu Osaka ', 24, 'Cái', 13, NULL, '* Máy xay sinh tố  Osaka BL619.\r\n- Công suất: 300W.\r\n- Dung tích: 1.5 lít.\r\n- Mô tả:\r\n    + Cối được làm bằng hợp chất không bể, không trầy xước.\r\n    + 03 tốc độ.\r\n    + Lọc bằng inox.\r\n    + Motor thế hệ mới vận hành êm.\r\n    + Tự động tắt máy khi quá tải.\r\n    + Xay nhuyễn được đá.\r\n    + Cối nhỏ xay khô.\r\n    + Vỏ nhựa tổng hợp, bền chắc và dễ lau chùi.\r\n- Tính năng: Xay sinh tố. Có cối nhỏ xay khô, có lọc làm sữa đậu nành.\r\n- Sử dụng dễ dàng và nhanh chóng, thời gian thực hiện chỉ tính bằng giây.\r\n- Màu sắc: Màu trắng.\r\n- Bảo hành: 12 tháng.\r\n- Nhãn hiệu: Osaka. Công ty Osaka là công ty chuyên sản xuất các sản phẩm điện gia dụng cao cấp.\r\n- Sản xuất tại Trung Quốc - Sản phẩm được sản xuất theo tiêu chuẩn CE (Châu Âu), và GS (Mỹ).', 6800000, 1, 7, 1, NULL),
(8, '040176', 'Bia Heineken ', 'Bia Heineken ', 12, 'Thùng', 127, NULL, '- Bia Heineken\r\n- Thể tích: 330ml\r\n- Quy cách: 24 lon/thùng\r\n- Cách thức chế biến: Lên men tự nhiên\r\n- Dạng thành phẩm: Đóng lon\r\n- Thương hiệu: Heineken\r\n- Xuất xứ: Việt Nam', 390000, 1, 5, 5, 5),
(9, '900053', 'Bia Sài Gòn 333', 'Bia Sài Gòn 333', 12, 'Thùng', 127, NULL, '- Bia Sài Gòn 333\r\n- Thể tích: 330ml\r\n- Quy cách: 24 lon/thùng\r\n- Dạng thành phẩm: Đóng lon\r\n- Thương hiệu: Bia Sài Gòn 333\r\n- Xuất xứ: Việt Nam', 200000, 1, 5, 5, 6),
(10, '813378', 'Cà phê hòa tan 3 trong 1 Vinacafé', 'Cà phê hòa tan 3 trong 1 Vinacafé', 12, 'Bịch', 50, NULL, '- Cà phê hòa tan 3 trong 1 Vinacafé\r\n- Trọng lượng: 20gr/gói\r\n- Quy cách: 24 gói x 20gr\r\n- Thành phần: Đường, bột kem, cà phê hòa tan (14%)\r\n- Dạng thành phẩm: Gói\r\n- Cách bảo quản: bảo quản nơi khô ráo, thoáng mát\r\n- Sản phẩm đạt chất lượng vệ sinh an toàn thực phẩm, không chứa melamine\r\n- Sản phẩm của Cty Cổ Phần Vinacafé Biên Hòa\r\n- Xuất xứ: Việt Nam', 45000, 1, 4, 3, NULL),
(11, '010302', 'Cà phê Chồn Robusta 51gr-Hộp quà màu đỏ', 'Cà phê Chồn Robusta 51gr-Hộp quà màu đỏ', 12, 'Hộp', 127, '- Cách dùng: \r\n        + Cho khoảng 20g cà phê bột – tương đương khoảng 1.5 muỗng ăn đầy vào buồng phin và san phẳng bằng nắp gài.\r\n        + Đặt phin lên đĩa phin, dùng nắp gài nén thật chặt trước khi châm vào khoảng 40ml nước sôi. Khoảng 3-4 phút, phin sẽ chảy hết.\r\n        + Đặt phin vào trong nồi hấp đang sôi khoảng 5 phút để hơi nước làm bột cà phê trương nở đều trong phin\r\n        + Lót giấy lọc trong lòng phin sạch, đổ cà phê đã pha vào để lọc hết cặn và bụi than trước khi thưởng thức.\r\n        + Bạn sẽ có tách cà phê Chồn hoàn hảo, đủ sánh đặc, nóng và thơm lừng, đủ để đem đến cho bạn những giây phút thưởng thức không thể quên.\r\n- Lưu ý: \r\n        + Túi nhôm khi đã mở, thì nên dùng hết cà phê trong vòng 2 tuần với hạt và 1 tuần với bột. \r\n        + Túi đang dùng nên được gói kín, không để hơi ẩm lọt vào và cần được cất giữ ở nơi mát mẻ, có độ ẩm thấp.\r\n        + Có thể bảo quản trong ngăn mát tủ lạnh.\r\n', '* Hộp quà màu đỏ - Cà phê Chồn Robusta\r\n- Trọng lượng: 17gr / gói\r\n- Quy cách: 3 gói / hộp\r\n- Mô tả:\r\n        + Cà phê Robusta Chồn được làm từ trái cà phê ở vùng Buôn Mê Thuột vốn nổi tiếng vì nước đặc sánh và vị đậm đà.\r\n        + Cà phê Robusta Chồn vẫn giữ lại các đặc tính ấy của cà phê thường, nhưng lại có thêm vị ngọt thanh cộng thêm vị chua trái cây không hề thấy ở loại cà phê Robusta thường, đồng thời có mùi hương thơm hơn hẳn.\r\n- Nhãn hiệu: Legend Revived\r\n- Xuất xứ: Việt Nam\r\n', 430000, 1, 4, 3, 4),
(12, '030031', 'Nước ngọt - Pepsi Light ', 'Nước ngọt - Pepsi Light ', 12, 'Thùng', 127, NULL, '* Nước ngọt - Pepsi Light\r\n- Quy cách: 24 lon/thùng\r\n- Thành phần: Nước bão hòa CO2, đường mía, màu tự nhiên, chất điều chỉnh độ axit, caffein, chất ổn định, hỗn hợp tự nhiên\r\n- Dành chongười ăn kiêng\r\n- Dạng thành phẩm: Lon\r\n- Hạn sử dụng: 12 tháng kể từ ngày sản xuất\r\n- Cách bảo quản: Bảo quản ở nơi thoáng mát, tránh ánh nắng trực tiếp, có thể bảo quản lạnh.\r\n- Sản phẩm của Pepsi\r\n- Xuất xứ: Việt Nam', 150000, 1, 3, 3, NULL),
(17, '810200', 'Gối tựa 50x50cm cotton xốp màu thêu*Thiên Hà', NULL, 0, NULL, 20, NULL, NULL, 50000, 1, 8, 1, NULL),
(18, '490221', 'Khăn HM42 - 34x42', NULL, 0, NULL, 10, NULL, NULL, 48000, 1, 8, 7, NULL),
(20, '550112', 'Bộ Drap gối cao cấp 1.2x2m cotton hoa*Thiên Hà', NULL, 0, NULL, 45, NULL, NULL, 520000, 1, 8, 7, NULL),
(21, '060327', 'Sữa tươi tiệt trùng hương dâu 180ml*Vinamilk ', NULL, 6, 'Lốc/6 Cái', 50, NULL, NULL, 15000, 1, 4, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanphamchinhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_sanphamchinhanh` (
  `chi_nhanh_id` int(10) NOT NULL DEFAULT '0',
  `san_pham_id` int(10) NOT NULL DEFAULT '0',
  `so_ton` int(10) DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`chi_nhanh_id`,`san_pham_id`),
  KEY `FKtbl_SanPha834242` (`chi_nhanh_id`),
  KEY `FKtbl_SanPha228435` (`san_pham_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sanphamchinhanh`
--

INSERT INTO `tbl_sanphamchinhanh` (`chi_nhanh_id`, `san_pham_id`, `so_ton`, `trang_thai`) VALUES
(10, 6, 1753, 1),
(10, 7, 200, 1),
(10, 8, 572, 1),
(10, 9, 497, 1),
(10, 10, 344, 1),
(10, 12, 600, 1),
(10, 17, 3689, 1),
(10, 18, 2957, 1),
(10, 20, 34522, 1),
(10, 21, 112, 1),
(26, 7, 450, 1),
(26, 10, 230, 0),
(26, 17, 100, 1),
(26, 18, 120, 1),
(28, 10, 200, 1),
(28, 11, 120, 1),
(29, 18, 500, 1),
(29, 20, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanphamtang`
--

CREATE TABLE IF NOT EXISTS `tbl_sanphamtang` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_sanphamtang`
--

INSERT INTO `tbl_sanphamtang` (`id`, `ma_vach`, `ten_san_pham`, `gia_tang`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `mo_ta`, `trang_thai`) VALUES
(1, 'TA0000000000006', 'Gấu Panda HUAHUA', 150000, '2013-05-15', '2013-07-31', NULL, 1),
(2, 'TA0000000000005', 'Poster T-ara', 300000, '2013-06-04', '2013-06-30', NULL, 1),
(3, 'TA0000000000004', 'Thú mỏ vịt Luna', 150000, '2013-06-04', '2013-07-25', NULL, 1),
(4, 'TA0000000000003', 'Sổ tay CK5', 280000, '2013-06-04', '2013-06-23', NULL, 1),
(5, 'TA0000000000001', 'bộ tẩy trang mini +Pocket Tissue Sunguard', 500000, '2013-06-15', '2013-06-30', 'HÓA ĐƠN 1000k KH được tặng bộ tẩy trang mini + túi khăn giấy Pocket Tissue Sunguard', 1),
(6, 'TA0000000000002', 'lọ sữa tắm Sweet Appleade Body Wash', 1000000, '2013-06-15', '2013-06-30', 'HÓA ĐƠN 350k KH được tặng bộ đôi khăn mặt + lọ sữa tắm Sweet Appleade Body Wash  ', 1),
(7, 'TA0000000000007', 'bộ dưỡng da mini Aqua Sherbet', 700000, '2013-06-15', '2013-06-30', 'HÓA ĐƠN 750k KH được tặng bộ dưỡng da mini Aqua Sherbet  \r\n', 1),
(8, 'TA0000000000008', 'móc chìa khóa kem nền Precious Mineral BB Cream', 200000, '2013-06-15', '2013-06-30', 'móc chìa khóa kem nền Precious Mineral BB Cream', 1),
(9, 'TA0000000000009', 'VIP GIRL EYE SECRET Yellow purple LP', 1000000, '2013-06-15', '2013-06-30', 'VIP GIRL EYE SECRET Yellow purple LP', 1),
(10, 'TA0000000000010', 'JUICY POP TUBE #01', 400000, '2013-06-15', '2013-06-30', 'JUICY POP TUBE #01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanphamtangchinhanh`
--

CREATE TABLE IF NOT EXISTS `tbl_sanphamtangchinhanh` (
  `san_pham_tang_id` int(10) NOT NULL DEFAULT '0',
  `chi_nhanh_id` int(10) NOT NULL,
  `so_ton` int(10) NOT NULL,
  PRIMARY KEY (`san_pham_tang_id`,`chi_nhanh_id`),
  KEY `FKtbl_SanPha299705` (`san_pham_tang_id`),
  KEY `FKtbl_SanPha601534` (`chi_nhanh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sanphamtangchinhanh`
--

INSERT INTO `tbl_sanphamtangchinhanh` (`san_pham_tang_id`, `chi_nhanh_id`, `so_ton`) VALUES
(1, 10, 428),
(2, 10, 100),
(3, 10, 996),
(4, 10, 944),
(5, 10, 100),
(6, 10, 1000),
(7, 10, 200),
(8, 10, 100),
(9, 10, 100),
(10, 10, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongtincongty`
--

CREATE TABLE IF NOT EXISTS `tbl_thongtincongty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_cong_ty` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_thongtincongty`
--

INSERT INTO `tbl_thongtincongty` (`id`, `ten_cong_ty`, `dia_chi`, `dien_thoai`, `fax`, `email`, `website`) VALUES
(1, 'Công ty TNHH An Phước ', '45 Nguyễn Trãi - P5 - Q5', '(08) 3848441', '(08) 3848440', 'anphuoc@hcm.vnn.vn', 'www.anphuoc.com.vn');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_chinhanh`
--
ALTER TABLE `tbl_chinhanh`
  ADD CONSTRAINT `FKtbl_ChiNha197094` FOREIGN KEY (`truc_thuoc_id`) REFERENCES `tbl_chinhanh` (`id`),
  ADD CONSTRAINT `FKtbl_ChiNha320112` FOREIGN KEY (`khu_vuc_id`) REFERENCES `tbl_khuvuc` (`id`),
  ADD CONSTRAINT `FKtbl_ChiNha643812` FOREIGN KEY (`loai_chi_nhanh_id`) REFERENCES `tbl_loaichinhanh` (`id`);

--
-- Constraints for table `tbl_chitiethoadonban`
--
ALTER TABLE `tbl_chitiethoadonban`
  ADD CONSTRAINT `FKtbl_ChiTie469808` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_hoadonbanhang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie898627` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Constraints for table `tbl_chitiethoadontang`
--
ALTER TABLE `tbl_chitiethoadontang`
  ADD CONSTRAINT `FKtbl_ChiTie468546` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_hoadonbanhang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie898645` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_sanphamtang` (`id`);

--
-- Constraints for table `tbl_chitiethoadontra`
--
ALTER TABLE `tbl_chitiethoadontra`
  ADD CONSTRAINT `FKtbl_ChiTie11581` FOREIGN KEY (`hoa_don_tra_id`) REFERENCES `tbl_hoadontrahang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie916439` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Constraints for table `tbl_chitietphieunhap`
--
ALTER TABLE `tbl_chitietphieunhap`
  ADD CONSTRAINT `FKtbl_ChiTie125902` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie280924` FOREIGN KEY (`phieu_nhap_id`) REFERENCES `tbl_phieunhap` (`id`);

--
-- Constraints for table `tbl_chitietphieunhapsanphamtang`
--
ALTER TABLE `tbl_chitietphieunhapsanphamtang`
  ADD CONSTRAINT `FKtbl_ChiTie125142` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_sanphamtang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie280143` FOREIGN KEY (`phieu_nhap_id`) REFERENCES `tbl_phieunhap` (`id`);

--
-- Constraints for table `tbl_chitietphieuxuat`
--
ALTER TABLE `tbl_chitietphieuxuat`
  ADD CONSTRAINT `FKtbl_ChiTie259107` FOREIGN KEY (`phieu_xuat_id`) REFERENCES `tbl_phieuxuat` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie815494` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Constraints for table `tbl_chitietphieuxuatsanphamtang`
--
ALTER TABLE `tbl_chitietphieuxuatsanphamtang`
  ADD CONSTRAINT `FKtbl_ChiTie125144` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_sanphamtang` (`id`),
  ADD CONSTRAINT `FKtbl_ChiTie280145` FOREIGN KEY (`phieu_xuat_id`) REFERENCES `tbl_phieuxuat` (`id`);

--
-- Constraints for table `tbl_chungtu`
--
ALTER TABLE `tbl_chungtu`
  ADD CONSTRAINT `FKtbl_ChungT392230` FOREIGN KEY (`nhan_vien_id`) REFERENCES `tbl_nhanvien` (`id`),
  ADD CONSTRAINT `FKtbl_ChungT837946` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_chinhanh` (`id`);

--
-- Constraints for table `tbl_hoadonbanhang`
--
ALTER TABLE `tbl_hoadonbanhang`
  ADD CONSTRAINT `FKtbl_HoaDon810063` FOREIGN KEY (`id`) REFERENCES `tbl_chungtu` (`id`),
  ADD CONSTRAINT `tbl_HoaDonBanHang_ibfk_1` FOREIGN KEY (`khach_hang_id`) REFERENCES `tbl_khachhang` (`id`);

--
-- Constraints for table `tbl_hoadontrahang`
--
ALTER TABLE `tbl_hoadontrahang`
  ADD CONSTRAINT `FKtbl_HoaDon696201` FOREIGN KEY (`id`) REFERENCES `tbl_chungtu` (`id`),
  ADD CONSTRAINT `FKtbl_HoaDon976146` FOREIGN KEY (`hoa_don_ban_id`) REFERENCES `tbl_hoadonbanhang` (`id`);

--
-- Constraints for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD CONSTRAINT `FKtbl_KhachH518685` FOREIGN KEY (`loai_khach_hang_id`) REFERENCES `tbl_loaikhachhang` (`id`);

--
-- Constraints for table `tbl_khuyenmaichinhanh`
--
ALTER TABLE `tbl_khuyenmaichinhanh`
  ADD CONSTRAINT `FKtbl_Khuyen292321` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `tbl_khuyenmai` (`id`),
  ADD CONSTRAINT `FKtbl_Khuyen611439` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_chinhanh` (`id`);

--
-- Constraints for table `tbl_mocgia`
--
ALTER TABLE `tbl_mocgia`
  ADD CONSTRAINT `tbl_MocGia_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Constraints for table `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD CONSTRAINT `FKtbl_NhanVi521022` FOREIGN KEY (`loai_nhan_vien_id`) REFERENCES `tbl_loainhanvien` (`id`),
  ADD CONSTRAINT `FKtbl_NhanVi835155` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_chinhanh` (`id`);

--
-- Constraints for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD CONSTRAINT `FKtbl_PhieuN233283` FOREIGN KEY (`id`) REFERENCES `tbl_chungtu` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuN233299` FOREIGN KEY (`nha_cung_cap_id`) REFERENCES `tbl_nhacungcap` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuN364331` FOREIGN KEY (`chi_nhanh_xuat_id`) REFERENCES `tbl_chinhanh` (`id`),
  ADD CONSTRAINT `tbl_PhieuNhap_ibfk_1` FOREIGN KEY (`loai_nhap_vao`) REFERENCES `tbl_loainhapxuat` (`id`);

--
-- Constraints for table `tbl_phieuxuat`
--
ALTER TABLE `tbl_phieuxuat`
  ADD CONSTRAINT `FKtbl_PhieuX273736` FOREIGN KEY (`chi_nhanh_nhap_id`) REFERENCES `tbl_chinhanh` (`id`),
  ADD CONSTRAINT `FKtbl_PhieuX543690` FOREIGN KEY (`id`) REFERENCES `tbl_chungtu` (`id`),
  ADD CONSTRAINT `tbl_PhieuXuat_ibfk_1` FOREIGN KEY (`loai_xuat_ra`) REFERENCES `tbl_loainhapxuat` (`id`);

--
-- Constraints for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `FKtbl_SanPha178229` FOREIGN KEY (`nha_cung_cap_id`) REFERENCES `tbl_nhacungcap` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha69518` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `tbl_khuyenmai` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha797499` FOREIGN KEY (`loai_san_pham_id`) REFERENCES `tbl_loaisanpham` (`id`);

--
-- Constraints for table `tbl_sanphamchinhanh`
--
ALTER TABLE `tbl_sanphamchinhanh`
  ADD CONSTRAINT `FKtbl_SanPha228435` FOREIGN KEY (`san_pham_id`) REFERENCES `tbl_sanpham` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha834242` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_chinhanh` (`id`);

--
-- Constraints for table `tbl_sanphamtangchinhanh`
--
ALTER TABLE `tbl_sanphamtangchinhanh`
  ADD CONSTRAINT `FKtbl_SanPha299705` FOREIGN KEY (`san_pham_tang_id`) REFERENCES `tbl_sanphamtang` (`id`),
  ADD CONSTRAINT `FKtbl_SanPha601534` FOREIGN KEY (`chi_nhanh_id`) REFERENCES `tbl_chinhanh` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
