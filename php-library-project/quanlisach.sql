-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 04:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlisach`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ma_chi_tiet_hoa_don` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `tong_tien` float NOT NULL,
  `ma_sach` int(11) NOT NULL,
  `ma_hoa_don` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`ma_chi_tiet_hoa_don`, `so_luong`, `tong_tien`, `ma_sach`, `ma_hoa_don`) VALUES
(38, 5, 120000, 3, 34),
(40, 4, 96000, 3, 36),
(41, 2, 48000, 3, 37),
(42, 3, 300000, 2, 37),
(43, 7, 700000, 2, 39);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `ma_hoa_don` int(11) NOT NULL,
  `ngay_lap` date NOT NULL,
  `tong_tien` float NOT NULL DEFAULT 0,
  `ma_nhan_vien` int(11) NOT NULL,
  `ma_khach_hang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`ma_hoa_don`, `ngay_lap`, `tong_tien`, `ma_nhan_vien`, `ma_khach_hang`) VALUES
(34, '2020-05-31', 120000, 1, 2),
(36, '2020-06-18', 96000, 1, 2),
(37, '2020-06-18', 348000, 1, 2),
(39, '2020-06-18', 700000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `ma_khach_hang` int(11) NOT NULL,
  `ten_khach_hang` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `so_dien_thoai` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`ma_khach_hang`, `ten_khach_hang`, `gioi_tinh`, `ngay_sinh`, `so_dien_thoai`, `dia_chi`, `email`) VALUES
(1, 'Khách Vãng Lai', 'Nam', '2020-05-30', '113', 'Hà Nội', 'kvlai@gmail.com'),
(2, 'Sơn', 'Nam', '2020-05-21', '12313', 'ádasd', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `ma_loai_sach` int(11) NOT NULL,
  `ten_loai_sach` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`ma_loai_sach`, `ten_loai_sach`) VALUES
(1, 'Thiếu nhi'),
(2, 'Tiểu thuyết'),
(3, 'Truyện ma');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ma_nhan_vien` int(11) NOT NULL,
  `ten_nhan_vien` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `so_dien_thoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai_lam_viec` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`ma_nhan_vien`, `ten_nhan_vien`, `gioi_tinh`, `ngay_sinh`, `so_dien_thoai`, `dia_chi`, `trang_thai_lam_viec`, `mat_khau`, `type`) VALUES
(1, 'Nguyễn Hữu Tín', 'Nam', '2020-05-27', '0766899363', 'An Giang', 'Còn Làm', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(8, 'user 1', 'Nữ', '2020-05-27', '0766899364', 'Cần Thơ', 'Còn Làm', '21232f297a57a5a743894a0e4a801fc3', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `manxb` int(11) NOT NULL,
  `tennxb` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`manxb`, `tennxb`) VALUES
(1, 'Kim Đồng'),
(7, 'Huấn Hoa Hồng');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `ma_sach` int(11) NOT NULL,
  `ten_sach` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` float NOT NULL,
  `mo_ta` varchar(1991) COLLATE utf8_unicode_ci NOT NULL,
  `nam_xuat_ban` date NOT NULL,
  `ma_tac_gia` int(11) NOT NULL,
  `ma_nha_xuat_ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`ma_sach`, `ten_sach`, `so_luong`, `don_gia`, `mo_ta`, `nam_xuat_ban`, `ma_tac_gia`, `ma_nha_xuat_ban`) VALUES
(2, 'Sách Có Làm Mới Có Ăn', 90, 100000, 'Có làm thì mới có ăn Không làm mà đòi ăn thì chỉ có ăn đầu b*i ăn c*t', '2020-05-27', 8, 7),
(3, 'Đoraemon Tập 152', 49, 24000, 'Sách thiếu nhi kể về câu chuyện chú mèo máy đến từ tương lại là doraemon', '2020-05-30', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `ma_tac_gia` int(11) NOT NULL,
  `ten_tac_gia` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`ma_tac_gia`, `ten_tac_gia`) VALUES
(6, 'Sơn 123'),
(8, 'Tín');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`ma_chi_tiet_hoa_don`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ma_hoa_don`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`ma_loai_sach`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ma_nhan_vien`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`manxb`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`ma_sach`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`ma_tac_gia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `ma_chi_tiet_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loaisach`
--
ALTER TABLE `loaisach`
  MODIFY `ma_loai_sach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ma_nhan_vien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `manxb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `ma_sach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `ma_tac_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
