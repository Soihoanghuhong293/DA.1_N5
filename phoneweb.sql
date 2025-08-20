-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 20, 2025 lúc 05:37 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phoneweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int(11) NOT NULL,
  `don_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int(11) NOT NULL,
  `gio_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int(11) NOT NULL,
  `ten_chuc_vu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`) VALUES
(16, 'Quần áo & Phụ kiện', 'Trang phục mềm mại, an toàn cho làn da nhạy cảm của bé'),
(17, 'Đồ dùng chăm sóc bé', 'Bình sữa, tã bỉm, khăn tắm... tiện lợi và an toàn'),
(18, 'Đồ chơi & Học tập', 'Đồ chơi an toàn, sách vải, xe tập đi... kích thích giác quan'),
(19, 'Đồ dùng ăn uống', 'Bát, thìa, cốc tập uống, yếm ăn... thiết kế an toàn'),
(20, 'Đồ dùng ngủ', 'Chăn, gối, nệm, túi ngủ... chất liệu mềm mại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int(11) NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `ten_nguoi_nhan` varchar(255) NOT NULL,
  `email_nguoi_nhan` varchar(255) NOT NULL,
  `sdt_nguoi_nhan` varchar(15) NOT NULL,
  `dia_chi_nguoi_nhan` text NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `phuong_thuc_thanh_toan_id` int(11) NOT NULL,
  `trang_thai_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `link_hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` int(11) NOT NULL,
  `ten_phuong_thuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia_san_pham` decimal(10,2) NOT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `so_luong` int(11) NOT NULL,
  `luot_xem` int(11) DEFAULT 0,
  `ngay_nhap` date NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `danh_muc_id` int(11) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `hinh_anh`, `so_luong`, `luot_xem`, `ngay_nhap`, `mo_ta`, `danh_muc_id`, `trang_thai`) VALUES
(35, 'Bộ quần áo sơ sinh cotton 100%', 150000.00, 120000.00, './uploads1755660867uploads1755242410ao-choang-chong-nang-tai-tho-lulaby-hong.jpg', 50, 0, '2024-01-15', 'Bộ quần áo sơ sinh chất liệu cotton 100% mềm mại', 16, 1),
(36, 'Mũ len mùa đông cho bé', 80000.00, 65000.00, NULL, 30, 0, '2024-01-10', 'Mũ len ấm áp, thiết kế dễ thương với tai thỏ', 16, 1),
(37, 'Bình sữa chống sặc', 180000.00, 150000.00, NULL, 25, 0, '2024-01-18', 'Bình sữa 150ml với núm ti chống sặc', 17, 1),
(38, 'Tã bỉm siêu thấm', 280000.00, 220000.00, NULL, 40, 0, '2024-01-14', 'Tã bỉm size M (6-11kg), siêu thấm hút', 17, 1),
(39, 'Xe tập đi đa năng', 350000.00, 290000.00, NULL, 20, 0, '2024-01-19', 'Xe tập đi có nhạc, đèn LED, nhiều chức năng', 18, 1),
(40, 'Sách vải tương tác', 85000.00, 68000.00, NULL, 45, 0, '2024-01-11', 'Sách vải có nhiều chi tiết tương tác', 18, 1),
(41, 'Bộ bát thìa tập ăn', 95000.00, 75000.00, NULL, 40, 0, '2024-01-21', 'Bộ bát thìa nhựa an toàn, thiết kế dễ cầm', 19, 1),
(42, 'Cốc tập uống 360°', 110000.00, 88000.00, NULL, 35, 0, '2024-01-23', 'Cốc tập uống không đổ, thiết kế 360 độ', 19, 1),
(43, 'Chăn mền cotton mềm', 180000.00, 145000.00, NULL, 25, 0, '2024-01-26', 'Chăn mền cotton 100% mềm mại, ấm áp', 20, 1),
(44, 'Gối chống méo đầu', 120000.00, 96000.00, NULL, 30, 0, '2024-01-27', 'Gối chống méo đầu thiết kế đặc biệt', 20, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `ngay_sinh` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(10) NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL DEFAULT 1,
  `dia_chi` text NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `chuc_vu_id` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int(11) NOT NULL,
  `ten_trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
