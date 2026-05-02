-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 02, 2026 lúc 09:02 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanly_trangsuc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `MaBanner` varchar(10) NOT NULL,
  `TenBanner` varchar(100) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`MaBanner`, `TenBanner`, `HinhAnh`, `MaTaiKhoan`) VALUES
('BN01', 'Banner Trang Chủ', 'banner_1.png', 'TK01'),
('BN02', 'Khuyến mãi mùa hè', 'banner_2.png', 'TK02'),
('BN03', 'Sale 50% toàn shop', 'banner_3.png', 'TK03'),
('BN04', 'Bộ sưu tập mới', 'banner_4.png', 'TK04'),
('BN05', 'Ưu đãi khách VIP', 'banner_5.png', 'TK05'),
('BN06', 'Freeship toàn quốc', 'banner_6.png', 'TK06'),
('BN07', 'Giảm giá cuối tuần', 'banner_7.png', 'TK07'),
('BN08', 'Flash Sale', 'banner_8.png', 'TK08'),
('BN09', 'Khuyến mãi cuối năm', 'banner_9.png', 'TK09'),
('BN10', 'Combo ưu đãi', 'banner_10.png', 'TK10'),
('BN11', 'Khuyến mãi mùa hè', 'banner_3.png', 'TK11'),
('BN12', 'Sale 50% toàn shop', 'banner_5.png', 'TK12'),
('BN13', 'Bộ sưu tập mới', 'banner_2.png', 'TK13'),
('BN14', 'Ưu đãi khách VIP', 'banner_4.png', 'TK14'),
('BN15', 'Freeship toàn quốc', 'banner_1.png', 'TK15'),
('BN16', 'Giảm giá cuối tuần', 'banner_7.png', 'TK16'),
('BN17', 'Flash Sale', 'banner_6.png', 'TK17'),
('BN18', 'Khuyến mãi cuối năm', 'banner_8.png', 'TK18'),
('BN19', 'Combo ưu đãi', 'banner_9.png', 'TK19'),
('BN20', 'Banner Trang Chủ', 'banner_10.png', 'TK20'),
('BN21', 'Ưu đãi khách VIP', 'banner_2.png', 'TK21'),
('BN22', 'Freeship toàn quốc', 'banner_4.png', 'TK22'),
('BN23', 'Sale 50% toàn shop', 'banner_6.png', 'TK23'),
('BN24', 'Khuyến mãi mùa hè', 'banner_8.png', 'TK24'),
('BN25', 'Bộ sưu tập mới', 'banner_10.png', 'TK25'),
('BN26', 'Flash Sale', 'banner_1.png', 'TK26'),
('BN27', 'Combo ưu đãi', 'banner_3.png', 'TK27'),
('BN28', 'Khuyến mãi cuối năm', 'banner_5.png', 'TK28'),
('BN29', 'Giảm giá cuối tuần', 'banner_7.png', 'TK29'),
('BN30', 'Banner Trang Chủ', 'banner_9.png', 'TK30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `MaDonHang` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `MaGio` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_phan_hoi`
--

CREATE TABLE `chi_tiet_phan_hoi` (
  `MaDanhGia` varchar(10) NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL,
  `NoiDungPhanHoi` varchar(255) NOT NULL,
  `NgayPhanHoi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `MaDanhGia` varchar(10) NOT NULL,
  `BinhLuan` varchar(255) DEFAULT NULL,
  `XepHang` tinyint(4) NOT NULL,
  `NgayTao` datetime DEFAULT current_timestamp(),
  `TrangThai` tinyint(4) NOT NULL,
  `MaKhachHang` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `MaDonHang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `MaDanhMuc` varchar(10) NOT NULL,
  `TenDanhMuc` varchar(50) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`MaDanhMuc`, `TenDanhMuc`, `TrangThai`) VALUES
('DM01', 'Nhẫn', 1),
('DM02', 'Dây chuyền', 1),
('DM03', 'Bông tai', 1),
('DM04', 'Lắc tay', 1),
('DM05', 'Mặt dây chuyền', 1),
('DM06', 'Trang sức cao cấp', 1),
('DM07', 'Trang sức bạc', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `MaDonHang` varchar(10) NOT NULL,
  `NgayDatHang` datetime NOT NULL,
  `NgayThanhToan` datetime DEFAULT NULL,
  `PTTT` varchar(50) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `DiaChiGiaoHang` varchar(255) NOT NULL,
  `MaKhachHang` varchar(10) NOT NULL,
  `MaVoucher` varchar(20) DEFAULT NULL,
  `GiaTriApDung` decimal(12,2) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `MaGio` varchar(10) NOT NULL,
  `NgayTao` datetime NOT NULL,
  `MaKhachHang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_sp`
--

CREATE TABLE `hinh_anh_sp` (
  `MaHinhAnh` varchar(10) NOT NULL,
  `DuongDan` varchar(255) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_sp`
--

INSERT INTO `hinh_anh_sp` (`MaHinhAnh`, `DuongDan`, `MaSanPham`) VALUES
('HA001', 'sp001_1.png', 'SP001'),
('HA002', 'sp001_2.png', 'SP001'),
('HA003', 'sp001_3.png', 'SP001'),
('HA004', 'sp002_1.png', 'SP002'),
('HA005', 'sp002_2.png', 'SP002'),
('HA006', 'sp002_3.png', 'SP002'),
('HA007', 'sp003_1.png', 'SP003'),
('HA008', 'sp003_2.png', 'SP003'),
('HA009', 'sp003_3.png', 'SP003'),
('HA010', 'sp004_1.png', 'SP004'),
('HA011', 'sp004_2.png', 'SP004'),
('HA012', 'sp004_3.png', 'SP004'),
('HA013', 'sp005_1.png', 'SP005'),
('HA014', 'sp005_2.png', 'SP005'),
('HA015', 'sp005_3.png', 'SP005'),
('HA016', 'sp006_1.png', 'SP006'),
('HA017', 'sp006_2.png', 'SP006'),
('HA018', 'sp006_3.png', 'SP006'),
('HA019', 'sp007_1.png', 'SP007'),
('HA020', 'sp007_2.png', 'SP007'),
('HA021', 'sp007_3.png', 'SP007'),
('HA022', 'sp008_1.png', 'SP008'),
('HA023', 'sp008_2.png', 'SP008'),
('HA024', 'sp008_3.png', 'SP008'),
('HA025', 'sp009_1.png', 'SP009'),
('HA026', 'sp009_2.png', 'SP009'),
('HA027', 'sp009_3.png', 'SP009'),
('HA028', 'sp010_1.png', 'SP010'),
('HA029', 'sp010_2.png', 'SP010'),
('HA030', 'sp010_3.png', 'SP010'),
('HA031', 'sp011_1.png', 'SP011'),
('HA032', 'sp011_2.png', 'SP011'),
('HA033', 'sp011_3.png', 'SP011'),
('HA034', 'sp012_1.png', 'SP012'),
('HA035', 'sp012_2.png', 'SP012'),
('HA036', 'sp012_3.png', 'SP012'),
('HA037', 'sp013_1.png', 'SP013'),
('HA038', 'sp013_2.png', 'SP013'),
('HA039', 'sp013_3.png', 'SP013'),
('HA040', 'sp014_1.png', 'SP014'),
('HA041', 'sp014_2.png', 'SP014'),
('HA042', 'sp014_3.png', 'SP014'),
('HA043', 'sp015_1.png', 'SP015'),
('HA044', 'sp015_2.png', 'SP015'),
('HA045', 'sp015_3.png', 'SP015'),
('HA046', 'sp016_1.png', 'SP016'),
('HA047', 'sp016_2.png', 'SP016'),
('HA048', 'sp016_3.png', 'SP016'),
('HA049', 'sp017_1.png', 'SP017'),
('HA050', 'sp017_2.png', 'SP017'),
('HA051', 'sp017_3.png', 'SP017'),
('HA052', 'sp018_1.png', 'SP018'),
('HA053', 'sp018_2.png', 'SP018'),
('HA054', 'sp018_3.png', 'SP018'),
('HA055', 'sp019_1.png', 'SP019'),
('HA056', 'sp019_2.png', 'SP019'),
('HA057', 'sp019_3.png', 'SP019'),
('HA058', 'sp020_1.png', 'SP020'),
('HA059', 'sp020_2.png', 'SP020'),
('HA060', 'sp020_3.png', 'SP020'),
('HA061', 'sp021_1.png', 'SP021'),
('HA062', 'sp021_2.png', 'SP021'),
('HA063', 'sp021_3.png', 'SP021'),
('HA064', 'sp022_1.png', 'SP022'),
('HA065', 'sp022_2.png', 'SP022'),
('HA066', 'sp022_3.png', 'SP022'),
('HA067', 'sp023_1.png', 'SP023'),
('HA068', 'sp023_2.png', 'SP023'),
('HA069', 'sp023_3.png', 'SP023'),
('HA070', 'sp024_1.png', 'SP024'),
('HA071', 'sp024_2.png', 'SP024'),
('HA072', 'sp024_3.png', 'SP024'),
('HA073', 'sp025_1.png', 'SP025'),
('HA074', 'sp025_2.png', 'SP025'),
('HA075', 'sp025_3.png', 'SP025'),
('HA076', 'sp026_1.png', 'SP026'),
('HA077', 'sp026_2.png', 'SP026'),
('HA078', 'sp026_3.png', 'SP026'),
('HA079', 'sp027_1.png', 'SP027'),
('HA080', 'sp027_2.png', 'SP027'),
('HA081', 'sp027_3.png', 'SP027'),
('HA082', 'sp028_1.png', 'SP028'),
('HA083', 'sp028_2.png', 'SP028'),
('HA084', 'sp028_3.png', 'SP028'),
('HA085', 'sp029_1.png', 'SP029'),
('HA086', 'sp029_2.png', 'SP029'),
('HA087', 'sp029_3.png', 'SP029'),
('HA088', 'sp030_1.png', 'SP030'),
('HA089', 'sp030_2.png', 'SP030'),
('HA090', 'sp030_3.png', 'SP030'),
('HA091', 'sp031_1.png', 'SP031'),
('HA092', 'sp031_2.png', 'SP031'),
('HA093', 'sp031_3.png', 'SP031'),
('HA094', 'sp032_1.png', 'SP032'),
('HA095', 'sp032_2.png', 'SP032'),
('HA096', 'sp032_3.png', 'SP032'),
('HA097', 'sp033_1.png', 'SP033'),
('HA098', 'sp033_2.png', 'SP033'),
('HA099', 'sp033_3.png', 'SP033'),
('HA100', 'sp034_1.png', 'SP034'),
('HA101', 'sp034_2.png', 'SP034'),
('HA102', 'sp034_3.png', 'SP034'),
('HA103', 'sp035_1.png', 'SP035'),
('HA104', 'sp035_2.png', 'SP035'),
('HA105', 'sp035_3.png', 'SP035'),
('HA106', 'sp036_1.png', 'SP036'),
('HA107', 'sp036_2.png', 'SP036'),
('HA108', 'sp036_3.png', 'SP036'),
('HA109', 'sp037_1.png', 'SP037'),
('HA110', 'sp037_2.png', 'SP037'),
('HA111', 'sp037_3.png', 'SP037'),
('HA112', 'sp038_1.png', 'SP038'),
('HA113', 'sp038_2.png', 'SP038'),
('HA114', 'sp038_3.png', 'SP038'),
('HA115', 'sp039_1.png', 'SP039'),
('HA116', 'sp039_2.png', 'SP039'),
('HA117', 'sp039_3.png', 'SP039'),
('HA118', 'sp040_1.png', 'SP040'),
('HA119', 'sp040_2.png', 'SP040'),
('HA120', 'sp040_3.png', 'SP040'),
('HA121', 'sp041_1.png', 'SP041'),
('HA122', 'sp041_2.png', 'SP041'),
('HA123', 'sp041_3.png', 'SP041'),
('HA124', 'sp042_1.png', 'SP042'),
('HA125', 'sp042_2.png', 'SP042'),
('HA126', 'sp042_3.png', 'SP042'),
('HA127', 'sp043_1.png', 'SP043'),
('HA128', 'sp043_2.png', 'SP043'),
('HA129', 'sp043_3.png', 'SP043'),
('HA130', 'sp044_1.png', 'SP044'),
('HA131', 'sp044_2.png', 'SP044'),
('HA132', 'sp044_3.png', 'SP044'),
('HA133', 'sp045_1.png', 'SP045'),
('HA134', 'sp045_2.png', 'SP045'),
('HA135', 'sp045_3.png', 'SP045'),
('HA136', 'sp046_1.png', 'SP046'),
('HA137', 'sp046_2.png', 'SP046'),
('HA138', 'sp046_3.png', 'SP046'),
('HA139', 'sp047_1.png', 'SP047'),
('HA140', 'sp047_2.png', 'SP047'),
('HA141', 'sp047_3.png', 'SP047'),
('HA142', 'sp048_1.png', 'SP048'),
('HA143', 'sp048_2.png', 'SP048'),
('HA144', 'sp048_3.png', 'SP048'),
('HA145', 'sp049_1.png', 'SP049'),
('HA146', 'sp049_2.png', 'SP049'),
('HA147', 'sp049_3.png', 'SP049'),
('HA148', 'sp050_1.png', 'SP050'),
('HA149', 'sp050_2.png', 'SP050'),
('HA150', 'sp050_3.png', 'SP050');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `MaKhachHang` varchar(10) NOT NULL,
  `TenKhachHang` varchar(50) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_voucher`
--

CREATE TABLE `loai_voucher` (
  `MaLoaiVoucher` varchar(10) NOT NULL,
  `TenLoaiVoucher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_voucher`
--

INSERT INTO `loai_voucher` (`MaLoaiVoucher`, `TenLoaiVoucher`) VALUES
('LV01', 'Giảm theo phần trăm'),
('LV02', 'Giảm tiền trực tiếp'),
('LV03', 'Miễn phí vận chuyển'),
('LV04', 'Giảm cho khách hàng mới'),
('LV05', 'Giảm theo đơn hàng tối thiểu'),
('LV06', 'Voucher sinh nhật'),
('LV07', 'Voucher sự kiện / khuyến mãi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `MaSanPham` varchar(10) NOT NULL,
  `TenSanPham` varchar(150) NOT NULL,
  `GiaBan` decimal(12,2) NOT NULL,
  `ChatLieu` varchar(20) NOT NULL CHECK (`ChatLieu` in ('Vàng','Bạc','Vàng trắng','Kim cương')),
  `MoTa` text DEFAULT NULL,
  `SoLuongTon` int(11) NOT NULL DEFAULT 0,
  `TrangThai` tinyint(4) NOT NULL,
  `MaDanhMuc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`MaSanPham`, `TenSanPham`, `GiaBan`, `ChatLieu`, `MoTa`, `SoLuongTon`, `TrangThai`, `MaDanhMuc`) VALUES
('SP001', 'Nhẫn vàng 18K', 8000000.00, 'Vàng', 'Nhẫn vàng', 10, 1, 'DM01'),
('SP002', 'Nhẫn bạc đính đá', 900000.00, 'Bạc', 'Nhẫn bạc', 20, 1, 'DM01'),
('SP003', 'Nhẫn kim cương', 15000000.00, 'Kim cương', 'Nhẫn cao cấp', 5, 1, 'DM01'),
('SP004', 'Nhẫn vàng trắng', 7000000.00, 'Vàng trắng', 'Nhẫn đẹp', 8, 1, 'DM01'),
('SP005', 'Nhẫn bạc đơn giản', 500000.00, 'Bạc', 'Nhẫn basic', 25, 1, 'DM01'),
('SP006', 'Nhẫn vàng 24K', 12000000.00, 'Vàng', 'Nhẫn cao cấp', 6, 1, 'DM01'),
('SP007', 'Nhẫn kim cương nhỏ', 9000000.00, 'Kim cương', 'Nhẫn xinh', 7, 1, 'DM01'),
('SP008', 'Dây chuyền vàng', 9000000.00, 'Vàng', 'Dây chuyền', 9, 1, 'DM02'),
('SP009', 'Dây chuyền bạc', 1500000.00, 'Bạc', 'Dây chuyền bạc', 18, 1, 'DM02'),
('SP010', 'Dây chuyền kim cương', 18000000.00, 'Kim cương', 'Cao cấp', 4, 1, 'DM02'),
('SP011', 'Dây chuyền vàng trắng', 8000000.00, 'Vàng trắng', 'Đẹp', 10, 1, 'DM02'),
('SP012', 'Dây chuyền bạc đá', 2000000.00, 'Bạc', 'Dây chuyền', 14, 1, 'DM02'),
('SP013', 'Dây chuyền vàng mặt đá', 12000000.00, 'Vàng', 'Cao cấp', 6, 1, 'DM02'),
('SP014', 'Dây chuyền bạc cao cấp', 3000000.00, 'Bạc', 'Đẹp', 11, 1, 'DM02'),
('SP015', 'Bông tai vàng', 7000000.00, 'Vàng', 'Bông tai', 12, 1, 'DM03'),
('SP016', 'Bông tai bạc', 800000.00, 'Bạc', 'Bông tai bạc', 22, 1, 'DM03'),
('SP017', 'Bông tai kim cương', 14000000.00, 'Kim cương', 'Cao cấp', 5, 1, 'DM03'),
('SP018', 'Bông tai vàng trắng', 6000000.00, 'Vàng trắng', 'Đẹp', 9, 1, 'DM03'),
('SP019', 'Bông tai bạc đá', 1200000.00, 'Bạc', 'Bông tai', 17, 1, 'DM03'),
('SP020', 'Bông tai vàng đính đá', 9000000.00, 'Vàng', 'Cao cấp', 6, 1, 'DM03'),
('SP021', 'Bông tai bạc cao cấp', 2000000.00, 'Bạc', 'Đẹp', 13, 1, 'DM03'),
('SP022', 'Lắc tay vàng', 11000000.00, 'Vàng', 'Lắc tay', 7, 1, 'DM04'),
('SP023', 'Lắc tay bạc', 1300000.00, 'Bạc', 'Lắc tay bạc', 16, 1, 'DM04'),
('SP024', 'Lắc tay kim cương', 16000000.00, 'Kim cương', 'Cao cấp', 3, 1, 'DM04'),
('SP025', 'Lắc tay vàng trắng', 9000000.00, 'Vàng trắng', 'Đẹp', 8, 1, 'DM04'),
('SP026', 'Lắc tay bạc đá', 1800000.00, 'Bạc', 'Lắc tay', 19, 1, 'DM04'),
('SP027', 'Lắc tay vàng cao cấp', 15000000.00, 'Vàng', 'Cao cấp', 5, 1, 'DM04'),
('SP028', 'Lắc tay bạc đẹp', 2000000.00, 'Bạc', 'Đẹp', 12, 1, 'DM04'),
('SP029', 'Mặt dây chuyền vàng', 5000000.00, 'Vàng', 'Mặt dây', 10, 1, 'DM05'),
('SP030', 'Mặt dây chuyền bạc', 900000.00, 'Bạc', 'Mặt dây', 21, 1, 'DM05'),
('SP031', 'Mặt dây kim cương', 12000000.00, 'Kim cương', 'Cao cấp', 4, 1, 'DM05'),
('SP032', 'Mặt dây vàng trắng', 7000000.00, 'Vàng trắng', 'Đẹp', 9, 1, 'DM05'),
('SP033', 'Mặt dây bạc đá', 1500000.00, 'Bạc', 'Mặt dây', 18, 1, 'DM05'),
('SP034', 'Mặt dây vàng đẹp', 8000000.00, 'Vàng', 'Cao cấp', 6, 1, 'DM05'),
('SP035', 'Trang sức kim cương VIP', 30000000.00, 'Kim cương', 'Siêu cao cấp', 2, 1, 'DM06'),
('SP036', 'Trang sức vàng cao cấp', 25000000.00, 'Vàng', 'VIP', 3, 1, 'DM06'),
('SP037', 'Trang sức vàng trắng VIP', 22000000.00, 'Vàng trắng', 'VIP', 3, 1, 'DM06'),
('SP038', 'Trang sức kim cương nhỏ', 18000000.00, 'Kim cương', 'Cao cấp', 4, 1, 'DM06'),
('SP039', 'Trang sức vàng đặc biệt', 27000000.00, 'Vàng', 'VIP', 2, 1, 'DM06'),
('SP040', 'Trang sức bạc cao cấp', 3000000.00, 'Bạc', 'Bạc đẹp', 15, 1, 'DM07'),
('SP041', 'Trang sức bạc đơn giản', 800000.00, 'Bạc', 'Bạc', 25, 1, 'DM07'),
('SP042', 'Trang sức bạc đính đá', 1500000.00, 'Bạc', 'Đẹp', 18, 1, 'DM07'),
('SP043', 'Trang sức bạc thời trang', 1200000.00, 'Bạc', 'Trẻ', 20, 1, 'DM07'),
('SP044', 'Trang sức bạc đẹp', 2000000.00, 'Bạc', 'Hot', 17, 1, 'DM07'),
('SP045', 'Trang sức bạc cao cấp 2', 3500000.00, 'Bạc', 'VIP', 10, 1, 'DM07'),
('SP046', 'Trang sức bạc basic', 600000.00, 'Bạc', 'Rẻ', 30, 1, 'DM07'),
('SP047', 'Trang sức bạc mini', 500000.00, 'Bạc', 'Nhỏ', 35, 1, 'DM07'),
('SP048', 'Trang sức bạc nữ', 900000.00, 'Bạc', 'Nữ', 22, 1, 'DM07'),
('SP049', 'Trang sức bạc xinh', 1100000.00, 'Bạc', 'Xinh', 19, 1, 'DM07'),
('SP050', 'Trang sức bạc sang', 2500000.00, 'Bạc', 'Sang', 12, 1, 'DM07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `MaTaiKhoan` varchar(10) NOT NULL,
  `TenHienThi` varchar(50) NOT NULL,
  `TenDangNhap` varchar(20) NOT NULL,
  `MatKhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`MaTaiKhoan`, `TenHienThi`, `TenDangNhap`, `MatKhau`) VALUES
('TK01', 'Nguyễn Văn An', 'user01', '123456'),
('TK02', 'Trần Thị Bình', 'user02', '123456'),
('TK03', 'Lê Văn Cường', 'user03', '123456'),
('TK04', 'Phạm Thị Dung', 'user04', '123456'),
('TK05', 'Hoàng Văn Em', 'user05', '123456'),
('TK06', 'Nguyễn Thị Hạnh', 'user06', '123456'),
('TK07', 'Trần Văn Hùng', 'user07', '123456'),
('TK08', 'Lê Thị Lan', 'user08', '123456'),
('TK09', 'Phạm Văn Minh', 'user09', '123456'),
('TK10', 'Hoàng Thị Ngọc', 'user10', '123456'),
('TK11', 'Đỗ Văn Phúc', 'user11', '123456'),
('TK12', 'Nguyễn Thị Quỳnh', 'user12', '123456'),
('TK13', 'Trần Văn Sơn', 'user13', '123456'),
('TK14', 'Lý Thị Trang', 'user14', '123456'),
('TK15', 'Phan Văn Tuấn', 'user15', '123456'),
('TK16', 'Vũ Thị Uyên', 'user16', '123456'),
('TK17', 'Bùi Văn Việt', 'user17', '123456'),
('TK18', 'Đặng Thị Xuân', 'user18', '123456'),
('TK19', 'Ngô Văn Yên', 'user19', '123456'),
('TK20', 'Phạm Thị Ánh', 'user20', '123456'),
('TK21', 'Trịnh Văn Bắc', 'user21', '123456'),
('TK22', 'Nguyễn Thị Chi', 'user22', '123456'),
('TK23', 'Lê Văn Duy', 'user23', '123456'),
('TK24', 'Hoàng Thị Giang', 'user24', '123456'),
('TK25', 'Phan Văn Hải', 'user25', '123456'),
('TK26', 'Võ Thị Hòa', 'user26', '123456'),
('TK27', 'Đỗ Văn Khánh', 'user27', '123456'),
('TK28', 'Bùi Thị Linh', 'user28', '123456'),
('TK29', 'Nguyễn Văn Nam', 'user29', '123456'),
('TK30', 'Trần Thị Oanh', 'user30', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `MaVoucher` varchar(20) NOT NULL,
  `TenVoucher` varchar(50) NOT NULL,
  `DoiTuongApDung` varchar(100) DEFAULT NULL,
  `GiaTriGiamToiDa` decimal(12,2) NOT NULL,
  `NgayBatDau` datetime NOT NULL,
  `NgayKetThuc` datetime NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL,
  `MaLoaiVoucher` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`MaVoucher`, `TenVoucher`, `DoiTuongApDung`, `GiaTriGiamToiDa`, `NgayBatDau`, `NgayKetThuc`, `MaTaiKhoan`, `MaLoaiVoucher`) VALUES
('VC001', 'Giảm 10% toàn shop', 'Tất cả khách hàng', 100000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK01', 'LV01'),
('VC002', 'Giảm 50K đơn từ 200K', 'Tất cả khách hàng', 50000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK02', 'LV02'),
('VC003', 'Freeship đơn từ 100K', 'Tất cả khách hàng', 30000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK03', 'LV03'),
('VC004', 'Giảm 20% khách mới', 'Khách hàng mới', 150000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK04', 'LV01'),
('VC005', 'Giảm 100K đơn từ 1 triệu', 'Tất cả khách hàng', 100000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK05', 'LV02'),
('VC006', 'Giảm 15% dịp lễ', 'Tất cả khách hàng', 120000.00, '2026-04-01 00:00:00', '2026-05-01 00:00:00', 'TK06', 'LV01'),
('VC007', 'Giảm 200K khách VIP', 'Khách VIP', 200000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK07', 'LV02'),
('VC008', 'Freeship toàn quốc', 'Tất cả khách hàng', 25000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK08', 'LV03'),
('VC009', 'Giảm 30% sinh nhật', 'Khách sinh nhật', 300000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK09', 'LV01'),
('VC010', 'Giảm 70K đơn từ 500K', 'Tất cả khách hàng', 70000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK10', 'LV02'),
('VC011', 'Giảm 5% đơn nhỏ', 'Tất cả khách hàng', 50000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK11', 'LV01'),
('VC012', 'Giảm 120K đơn lớn', 'Tất cả khách hàng', 120000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK12', 'LV02'),
('VC013', 'Freeship nhanh', 'Tất cả khách hàng', 40000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK13', 'LV03'),
('VC014', 'Giảm 25% khách VIP', 'Khách VIP', 250000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK14', 'LV01'),
('VC015', 'Giảm 80K dịp sale', 'Tất cả khách hàng', 80000.00, '2026-06-01 00:00:00', '2026-06-30 00:00:00', 'TK15', 'LV02'),
('VC016', 'Giảm 10% mùa hè', 'Tất cả khách hàng', 100000.00, '2026-06-01 00:00:00', '2026-08-31 00:00:00', 'TK16', 'LV01'),
('VC017', 'Giảm 150K đơn VIP', 'Khách VIP', 150000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK17', 'LV02'),
('VC018', 'Freeship đơn nhỏ', 'Tất cả khách hàng', 20000.00, '2026-01-01 00:00:00', '2026-12-31 00:00:00', 'TK18', 'LV03'),
('VC019', 'Giảm 18% đặc biệt', 'Tất cả khách hàng', 180000.00, '2026-03-01 00:00:00', '2026-03-31 00:00:00', 'TK19', 'LV01'),
('VC020', 'Giảm 90K cuối năm', 'Tất cả khách hàng', 90000.00, '2026-11-01 00:00:00', '2026-12-31 00:00:00', 'TK20', 'LV02');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`MaBanner`),
  ADD KEY `fk_banner_taikhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSanPham`),
  ADD KEY `fk_ctdh_sanpham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`MaGio`,`MaSanPham`),
  ADD KEY `fk_ctgh_sanpham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `chi_tiet_phan_hoi`
--
ALTER TABLE `chi_tiet_phan_hoi`
  ADD PRIMARY KEY (`MaDanhGia`,`MaTaiKhoan`),
  ADD KEY `fk_ctph_taikhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `fk_danhgia_khachhang` (`MaKhachHang`),
  ADD KEY `fk_danhgia_sanpham` (`MaSanPham`),
  ADD KEY `fk_danhgia_donhang` (`MaDonHang`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `fk_donhang_khachhang` (`MaKhachHang`),
  ADD KEY `fk_donhang_voucher` (`MaVoucher`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`MaGio`),
  ADD KEY `fk_giohang_khachhang` (`MaKhachHang`);

--
-- Chỉ mục cho bảng `hinh_anh_sp`
--
ALTER TABLE `hinh_anh_sp`
  ADD PRIMARY KEY (`MaHinhAnh`),
  ADD KEY `fk_hinhanh_sanpham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`MaKhachHang`),
  ADD KEY `fk_khachhang_taikhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `loai_voucher`
--
ALTER TABLE `loai_voucher`
  ADD PRIMARY KEY (`MaLoaiVoucher`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `fk_sanpham_danhmuc` (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`MaVoucher`),
  ADD KEY `fk_voucher_taikhoan` (`MaTaiKhoan`),
  ADD KEY `fk_voucher_loaivoucher` (`MaLoaiVoucher`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `fk_banner_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `fk_ctdh_donhang` FOREIGN KEY (`MaDonHang`) REFERENCES `don_hang` (`MaDonHang`),
  ADD CONSTRAINT `fk_ctdh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `fk_ctgh_giohang` FOREIGN KEY (`MaGio`) REFERENCES `gio_hang` (`MaGio`),
  ADD CONSTRAINT `fk_ctgh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `chi_tiet_phan_hoi`
--
ALTER TABLE `chi_tiet_phan_hoi`
  ADD CONSTRAINT `fk_ctph_danhgia` FOREIGN KEY (`MaDanhGia`) REFERENCES `danh_gia` (`MaDanhGia`),
  ADD CONSTRAINT `fk_ctph_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `fk_danhgia_donhang` FOREIGN KEY (`MaDonHang`) REFERENCES `don_hang` (`MaDonHang`),
  ADD CONSTRAINT `fk_danhgia_khachhang` FOREIGN KEY (`MaKhachHang`) REFERENCES `khach_hang` (`MaKhachHang`),
  ADD CONSTRAINT `fk_danhgia_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `fk_donhang_khachhang` FOREIGN KEY (`MaKhachHang`) REFERENCES `khach_hang` (`MaKhachHang`),
  ADD CONSTRAINT `fk_donhang_voucher` FOREIGN KEY (`MaVoucher`) REFERENCES `voucher` (`MaVoucher`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `fk_giohang_khachhang` FOREIGN KEY (`MaKhachHang`) REFERENCES `khach_hang` (`MaKhachHang`);

--
-- Các ràng buộc cho bảng `hinh_anh_sp`
--
ALTER TABLE `hinh_anh_sp`
  ADD CONSTRAINT `fk_hinhanh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `fk_khachhang_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danh_muc` (`MaDanhMuc`);

--
-- Các ràng buộc cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `fk_voucher_loaivoucher` FOREIGN KEY (`MaLoaiVoucher`) REFERENCES `loai_voucher` (`MaLoaiVoucher`),
  ADD CONSTRAINT `fk_voucher_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
