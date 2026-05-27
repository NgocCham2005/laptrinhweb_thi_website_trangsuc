-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2026 at 04:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop_trangsuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `MaBanner` varchar(10) NOT NULL,
  `TenBanner` varchar(100) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`MaBanner`, `TenBanner`, `HinhAnh`, `TrangThai`) VALUES
('BN01', 'Banner 1', 'banner_1.png', 1),
('BN02', 'Banner 2', 'banner_2.png', 1),
('BN03', 'Banner 3', 'banner_3.png', 1),
('BN04', 'Banner 4', 'banner_4.png', 1),
('BN05', 'Banner 5', 'banner_5.png', 1),
('BN06', 'Banner 6', 'banner_6.png', 1),
('BN07', 'Banner 7', 'banner_7.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `MaDonHang` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`MaDonHang`, `MaSanPham`, `SoLuong`, `DonGia`) VALUES
('DH0001', 'SP001', 1, 9200000.00),
('DH0001', 'SP012', 2, 1400000.00),
('DH0002', 'SP003', 1, 19500000.00),
('DH0002', 'SP020', 1, 1050000.00),
('DH0002', 'SP025', 2, 900000.00),
('DH0003', 'SP007', 1, 23500000.00),
('DH0004', 'SP010', 2, 10500000.00),
('DH0004', 'SP021', 1, 7600000.00),
('DH0005', 'SP015', 3, 780000.00),
('DH0005', 'SP030', 1, 1050000.00),
('DH0006', 'SP018', 2, 1600000.00),
('DH0006', 'SP022', 1, 1400000.00),
('DH0006', 'SP041', 1, 4500000.00),
('DH0007', 'SP027', 1, 21500000.00),
('DH0007', 'SP032', 2, 980000.00),
('DH0008', 'SP035', 1, 1150000.00),
('DH0008', 'SP042', 2, 680000.00),
('DH0009', 'SP039', 1, 13500000.00),
('DH0009', 'SP048', 3, 580000.00),
('DH0010', 'SP014', 1, 14500000.00),
('DH0010', 'SP050', 2, 520000.00);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `MaGio` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_gio_hang`
--

INSERT INTO `chi_tiet_gio_hang` (`MaGio`, `MaSanPham`, `SoLuong`) VALUES
('G0001', 'SP001', 1),
('G0001', 'SP012', 2),
('G0002', 'SP003', 1),
('G0002', 'SP021', 2),
('G0002', 'SP045', 1),
('G0003', 'SP010', 2),
('G0004', 'SP005', 1),
('G0004', 'SP018', 2),
('G0004', 'SP033', 1),
('G0005', 'SP002', 3),
('G0005', 'SP025', 1),
('G0006', 'SP007', 1),
('G0006', 'SP014', 1),
('G0006', 'SP027', 2),
('G0007', 'SP009', 2),
('G0008', 'SP016', 1),
('G0008', 'SP022', 1),
('G0008', 'SP035', 2),
('G0009', 'SP004', 1),
('G0009', 'SP019', 2),
('G0010', 'SP006', 2),
('G0010', 'SP030', 1),
('G0010', 'SP040', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_phan_hoi`
--

CREATE TABLE `chi_tiet_phan_hoi` (
  `MaDanhGia` varchar(10) NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL,
  `NoiDungPhanHoi` varchar(255) NOT NULL,
  `NgayPhanHoi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_phan_hoi`
--

INSERT INTO `chi_tiet_phan_hoi` (`MaDanhGia`, `MaTaiKhoan`, `NoiDungPhanHoi`, `NgayPhanHoi`) VALUES
('DG0001', 'TK005', 'Cảm ơn bạn đã đánh giá, chúc bạn mua sắm vui vẻ!', '2026-05-04 22:18:29'),
('DG0002', 'TK005', 'Shop rất vui khi bạn hài lòng về sản phẩm.', '2026-05-04 22:18:29'),
('DG0003', 'TK005', 'Cảm ơn góp ý của bạn, shop sẽ cải thiện tốt hơn.', '2026-05-04 22:18:29'),
('DG0004', 'TK005', 'Rất cảm ơn phản hồi tích cực từ bạn!', '2026-05-04 22:18:29'),
('DG0005', 'TK005', 'Shop ghi nhận ý kiến và sẽ nâng cao chất lượng.', '2026-05-04 22:18:29'),
('DG0006', 'TK005', 'Cảm ơn bạn đã tin tưởng và ủng hộ shop.', '2026-05-04 22:18:29'),
('DG0007', 'TK005', 'Phản hồi của bạn là động lực để shop phát triển.', '2026-05-04 22:18:29'),
('DG0008', 'TK005', 'Cảm ơn bạn, hy vọng sẽ phục vụ bạn lần sau.', '2026-05-04 22:18:29'),
('DG0009', 'TK005', 'Shop xin ghi nhận và sẽ cải thiện tốt hơn.', '2026-05-04 22:18:29'),
('DG0010', 'TK005', 'Cảm ơn bạn đã mua hàng và đánh giá!', '2026-05-04 22:18:29'),
('DG0011', 'TK005', 'Shop rất vui khi bạn hài lòng, cảm ơn bạn!', '2026-05-04 22:18:29'),
('DG0012', 'TK005', 'Cảm ơn bạn đã góp ý, shop sẽ cải thiện thêm.', '2026-05-04 22:18:29'),
('DG0013', 'TK005', 'Hy vọng bạn sẽ tiếp tục ủng hộ shop trong tương lai.', '2026-05-04 22:18:29'),
('DG0014', 'TK005', 'Cảm ơn phản hồi tích cực từ bạn!', '2026-05-04 22:18:29'),
('DG0015', 'TK005', 'Shop luôn cố gắng mang lại trải nghiệm tốt nhất.', '2026-05-04 22:18:29'),
('DG0016', 'TK005', 'Cảm ơn bạn đã đánh giá sản phẩm của shop.', '2026-05-04 22:18:29'),
('DG0017', 'TK005', 'Ý kiến của bạn rất quan trọng với shop.', '2026-05-04 22:18:29'),
('DG0018', 'TK005', 'Shop rất vui khi nhận được phản hồi từ bạn.', '2026-05-04 22:18:29'),
('DG0019', 'TK005', 'Cảm ơn bạn đã tin tưởng lựa chọn sản phẩm.', '2026-05-04 22:18:29'),
('DG0020', 'TK005', 'Hy vọng bạn hài lòng với sản phẩm đã mua.', '2026-05-04 22:18:29'),
('DG0021', 'TK005', 'Cảm ơn bạn, chúc bạn một ngày tốt lành!', '2026-05-04 22:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `MaDanhGia` varchar(10) NOT NULL,
  `BinhLuan` varchar(255) DEFAULT NULL,
  `XepHang` tinyint(4) NOT NULL,
  `NgayTao` datetime DEFAULT current_timestamp(),
  `TrangThai` tinyint(4) NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL,
  `MaDonHang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danh_gia`
--

INSERT INTO `danh_gia` (`MaDanhGia`, `BinhLuan`, `XepHang`, `NgayTao`, `TrangThai`, `MaTaiKhoan`, `MaSanPham`, `MaDonHang`) VALUES
('DG0001', 'Nhẫn đẹp, rất hài lòng', 5, '2026-05-04 22:16:20', 1, 'TK006', 'SP001', 'DH0001'),
('DG0002', 'Dây chuyền ổn, giá hợp lý', 4, '2026-05-04 22:16:20', 1, 'TK006', 'SP012', 'DH0001'),
('DG0003', 'Kim cương rất đẹp, xứng đáng', 5, '2026-05-04 22:16:20', 1, 'TK007', 'SP003', 'DH0002'),
('DG0004', 'Sản phẩm bình thường', 4, '2026-05-04 22:16:20', 1, 'TK007', 'SP020', 'DH0002'),
('DG0005', 'Bông tai xinh, nhẹ', 5, '2026-05-04 22:16:20', 1, 'TK007', 'SP025', 'DH0002'),
('DG0006', 'Nhẫn rất sang trọng', 5, '2026-05-04 22:16:20', 1, 'TK008', 'SP007', 'DH0003'),
('DG0007', 'Nhẫn đẹp, lấp lánh blink blink', 4, '2026-05-04 22:16:20', 1, 'TK009', 'SP010', 'DH0004'),
('DG0008', 'Bông tai đẹp, giao nhanh', 5, '2026-05-04 22:16:20', 1, 'TK009', 'SP021', 'DH0004'),
('DG0009', 'Dây chuyền xinh', 5, '2026-05-04 22:16:20', 1, 'TK010', 'SP015', 'DH0005'),
('DG0010', 'Chất lượng ổn', 4, '2026-05-04 22:16:20', 1, 'TK010', 'SP030', 'DH0005'),
('DG0011', 'Dây chuyền đẹp', 5, '2026-05-04 22:16:20', 1, 'TK011', 'SP018', 'DH0006'),
('DG0012', 'Bông tai bình thường', 4, '2026-05-04 22:16:20', 1, 'TK011', 'SP022', 'DH0006'),
('DG0013', 'Mặt dây rất xinh', 5, '2026-05-04 22:16:20', 1, 'TK011', 'SP041', 'DH0006'),
('DG0014', 'Sản phẩm cao cấp, rất đẹp', 5, '2026-05-04 22:16:20', 1, 'TK012', 'SP027', 'DH0007'),
('DG0015', 'Lắc tay ổn', 4, '2026-05-04 22:16:20', 1, 'TK012', 'SP032', 'DH0007'),
('DG0016', 'Lắc tay đẹp', 5, '2026-05-04 22:16:20', 1, 'TK013', 'SP035', 'DH0008'),
('DG0017', 'Mặt dây dễ thương', 5, '2026-05-04 22:16:20', 1, 'TK013', 'SP042', 'DH0008'),
('DG0018', 'Lắc tay đẹp, chắc chắn', 5, '2026-05-04 22:16:20', 1, 'TK014', 'SP039', 'DH0009'),
('DG0019', 'Mặt dây ok', 4, '2026-05-04 22:16:20', 1, 'TK014', 'SP048', 'DH0009'),
('DG0020', 'Giá rẻ, ổn áp', 4, '2026-05-04 22:16:20', 1, 'TK015', 'SP050', 'DH0010'),
('DG0021', 'Dây chuyền vàng đẹp', 5, '2026-05-04 22:16:20', 1, 'TK015', 'SP014', 'DH0010');

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `MaDanhMuc` varchar(10) NOT NULL,
  `TenDanhMuc` varchar(50) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`MaDanhMuc`, `TenDanhMuc`, `TrangThai`) VALUES
('DM01', 'Nhẫn', 1),
('DM02', 'Dây chuyền', 1),
('DM03', 'Bông tai', 1),
('DM04', 'Lắc tay', 1),
('DM05', 'Mặt dây chuyền', 1);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `MaDonHang` varchar(10) NOT NULL,
  `NgayDatHang` datetime NOT NULL,
  `NgayThanhToan` datetime DEFAULT NULL,
  `PTTT` varchar(50) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `TenNguoiNhan` varchar(50) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `DiaChiGiaoHang` varchar(255) NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL,
  `MaVoucher` varchar(20) DEFAULT NULL,
  `GiaTriApDung` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`MaDonHang`, `NgayDatHang`, `NgayThanhToan`, `PTTT`, `TrangThai`, `TenNguoiNhan`, `SoDienThoai`, `DiaChiGiaoHang`, `MaTaiKhoan`, `MaVoucher`, `GiaTriApDung`) VALUES
('DH0001', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Thanh toán khi nhận hàng', 1, 'Nguyễn Văn An', '0987654321', 'Hà Nội', 'TK006', 'VC002', 100000.00),
('DH0002', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Trả trước', 1, 'Trần Thị Bình', '0978123456', 'Hà Nội', 'TK007', 'VC001', 50000.00),
('DH0003', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Thanh toán khi nhận hàng', 1, 'Lê Văn Cường', '0969234567', 'Hà Nội', 'TK008', 'VC004', 30000.00),
('DH0004', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Trả trước', 1, 'Phạm Thị Dung', '0981345678', 'Hà Nội', 'TK009', 'VC001', 50000.00),
('DH0005', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Thanh toán khi nhận hàng', 1, 'Hoàng Văn Em', '0972456789', 'Hà Nội', 'TK010', 'VC002', 100000.00),
('DH0006', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Trả trước', 1, 'Nguyễn Thị Hạnh', '0963567890', 'Hà Nội', 'TK011', 'VC005', 30000.00),
('DH0007', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Thanh toán khi nhận hàng', 1, 'Trần Văn Hùng', '0984678901', 'Hà Nội', 'TK012', 'VC002', 100000.00),
('DH0008', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Trả trước', 1, 'Lê Thị Lan', '0975789012', 'Hà Nội', 'TK013', 'VC001', 50000.00),
('DH0009', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Thanh toán khi nhận hàng', 1, 'Phạm Văn Minh', '0966890123', 'Hà Nội', 'TK014', 'VC004', 30000.00),
('DH0010', '2026-05-04 22:06:43', '2026-05-04 22:06:43', 'Trả trước', 1, 'Hoàng Thị Ngọc', '0987901234', 'Hà Nội', 'TK015', 'VC005', 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `MaGio` varchar(10) NOT NULL,
  `NgayTao` datetime NOT NULL,
  `MaTaiKhoan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`MaGio`, `NgayTao`, `MaTaiKhoan`) VALUES
('G0001', '2026-05-04 21:50:42', 'TK006'),
('G0002', '2026-05-04 21:50:42', 'TK007'),
('G0003', '2026-05-04 21:50:42', 'TK008'),
('G0004', '2026-05-04 21:50:42', 'TK009'),
('G0005', '2026-05-04 21:50:42', 'TK010'),
('G0006', '2026-05-04 21:50:42', 'TK011'),
('G0007', '2026-05-04 21:50:42', 'TK012'),
('G0008', '2026-05-04 21:50:42', 'TK013'),
('G0009', '2026-05-04 21:50:42', 'TK014'),
('G0010', '2026-05-04 21:50:42', 'TK015');

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_sp`
--

CREATE TABLE `hinh_anh_sp` (
  `MaHinhAnh` varchar(10) NOT NULL,
  `DuongDan` varchar(255) NOT NULL,
  `MaSanPham` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hinh_anh_sp`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `MaSanPham` varchar(10) NOT NULL,
  `TenSanPham` varchar(150) NOT NULL,
  `GiaBan` decimal(12,2) NOT NULL,
  `ChatLieu` varchar(20) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `SoLuongTon` int(11) NOT NULL DEFAULT 0,
  `TrangThai` tinyint(4) NOT NULL,
  `MaDanhMuc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`MaSanPham`, `TenSanPham`, `GiaBan`, `ChatLieu`, `MoTa`, `SoLuongTon`, `TrangThai`, `MaDanhMuc`) VALUES
('SP001', 'Nhẫn vàng 18K Elegance CZ Ring', 9200000.00, 'Vàng', 'Thiết kế thanh lịch, phong cách hiện đại', 19, 1, 'DM01'),
('SP002', 'Nhẫn bạc Radiant Sparkle', 1300000.00, 'Bạc', 'Lấp lánh trẻ trung', 35, 1, 'DM01'),
('SP003', 'Nhẫn kim cương Diamond Aura 14K', 19500000.00, 'Kim cương', 'Cao cấp sang trọng', 10, 1, 'DM01'),
('SP004', 'Nhẫn vàng 24K Classic Heritage', 15500000.00, 'Vàng', 'Truyền thống tinh tế', 15, 1, 'DM01'),
('SP005', 'Nhẫn vàng trắng Celestial Blue Topaz', 6800000.00, 'Vàng trắng', 'Lấy cảm hứng bầu trời', 12, 1, 'DM01'),
('SP006', 'Nhẫn bạc Minimal Line', 720000.00, 'Bạc', 'Tối giản hiện đại', 40, 1, 'DM01'),
('SP007', 'Nhẫn kim cương Halo Shine 18K', 23500000.00, 'Kim cương', 'Halo sang trọng', 8, 1, 'DM01'),
('SP008', 'Nhẫn vàng Ruby Passion 18K', 13800000.00, 'Vàng', 'Ruby quyến rũ', 10, 1, 'DM01'),
('SP009', 'Nhẫn bạc Sweet Heart CZ', 950000.00, 'Bạc', 'Hình trái tim', 30, 1, 'DM01'),
('SP010', 'Nhẫn vàng trắng Diamond Line', 10500000.00, 'Kim cương', 'Đính đá tinh xảo', 18, 1, 'DM01'),
('SP011', 'Dây chuyền vàng Love Charm 18K', 9800000.00, 'Vàng', 'Nữ tính thanh lịch', 20, 1, 'DM02'),
('SP012', 'Dây chuyền bạc Silver Shine', 1400000.00, 'Bạc', 'Đơn giản tinh tế', 24, 1, 'DM02'),
('SP013', 'Dây chuyền Diamond Aura Necklace', 17800000.00, 'Kim cương', 'Cao cấp', 12, 1, 'DM02'),
('SP014', 'Dây chuyền vàng Golden Heritage 24K', 14500000.00, 'Vàng', 'Truyền thống', 10, 1, 'DM02'),
('SP015', 'Dây chuyền bạc Initial T Charm', 780000.00, 'Bạc', 'Cá tính', 25, 1, 'DM02'),
('SP016', 'Dây chuyền vàng trắng Light Drop', 6500000.00, 'Vàng trắng', 'Hình giọt nước', 18, 1, 'DM02'),
('SP017', 'Dây chuyền kim cương Royal Shine', 22500000.00, 'Kim cương', 'Sang trọng', 8, 1, 'DM02'),
('SP018', 'Dây chuyền bạc Pearl Grace', 1600000.00, 'Bạc', 'Ngọc trai', 20, 1, 'DM02'),
('SP019', 'Dây chuyền vàng Ruby Light', 13200000.00, 'Vàng', 'Ruby nổi bật', 15, 1, 'DM02'),
('SP020', 'Dây chuyền bạc Korean Style', 1050000.00, 'Bạc', 'Trẻ trung', 30, 1, 'DM02'),
('SP021', 'Bông tai vàng Sparkle CZ 18K', 7600000.00, 'Vàng', 'Lấp lánh tinh tế', 20, 1, 'DM03'),
('SP022', 'Bông tai bạc Pearl Drop', 1400000.00, 'Bạc', 'Ngọc trai rơi', 25, 1, 'DM03'),
('SP023', 'Bông tai kim cương Diamond Star', 16800000.00, 'Kim cương', 'Hình sao', 10, 1, 'DM03'),
('SP024', 'Bông tai vàng Classic Gold 24K', 11500000.00, 'Vàng', 'Cổ điển', 12, 1, 'DM03'),
('SP025', 'Bông tai bạc Star Shine', 900000.00, 'Bạc', 'Trẻ trung', 30, 1, 'DM03'),
('SP026', 'Bông tai vàng trắng Blue Topaz Glow', 6000000.00, 'Vàng trắng', 'Màu xanh nổi bật', 15, 1, 'DM03'),
('SP027', 'Bông tai kim cương Halo Light', 21500000.00, 'Kim cương', 'Halo cao cấp', 8, 1, 'DM03'),
('SP028', 'Bông tai bạc Minimal Drop', 680000.00, 'Bạc', 'Tối giản', 35, 1, 'DM03'),
('SP029', 'Bông tai vàng Ruby Glow', 12800000.00, 'Vàng', 'Ruby sang trọng', 10, 1, 'DM03'),
('SP030', 'Bông tai bạc Crystal Shine', 1050000.00, 'Bạc', 'Hiện đại', 28, 1, 'DM03'),
('SP031', 'Lắc tay vàng Elegance CZ', 11000000.00, 'Vàng', 'Sang trọng', 18, 1, 'DM04'),
('SP032', 'Lắc tay bạc Silver Chain', 980000.00, 'Bạc', 'Đơn giản', 30, 1, 'DM04'),
('SP033', 'Lắc tay kim cương Diamond Line', 19000000.00, 'Kim cương', 'Cao cấp', 10, 1, 'DM04'),
('SP034', 'Lắc tay vàng Golden Heritage 24K', 22500000.00, 'Vàng', 'Truyền thống', 8, 1, 'DM04'),
('SP035', 'Lắc tay bạc CZ Charm', 1150000.00, 'Bạc', 'Trẻ trung', 25, 1, 'DM04'),
('SP036', 'Lắc tay vàng trắng Light Touch', 7000000.00, 'Vàng trắng', 'Tinh tế', 15, 1, 'DM04'),
('SP037', 'Lắc tay kim cương Royal Bracelet', 25000000.00, 'Kim cương', 'Cao cấp', 6, 1, 'DM04'),
('SP038', 'Lắc tay bạc Korean Trend', 820000.00, 'Bạc', 'Hàn Quốc', 35, 1, 'DM04'),
('SP039', 'Lắc tay vàng Ruby Shine', 13500000.00, 'Vàng', 'Ruby nổi bật', 12, 1, 'DM04'),
('SP040', 'Lắc tay bạc Charm Style', 920000.00, 'Bạc', 'Cá tính', 28, 1, 'DM04'),
('SP041', 'Mặt dây vàng Love Heart 18K', 4500000.00, 'Vàng', 'Hình trái tim', 20, 1, 'DM05'),
('SP042', 'Mặt dây bạc Crystal Drop', 680000.00, 'Bạc', 'Giọt nước', 30, 1, 'DM05'),
('SP043', 'Mặt dây kim cương Diamond Aura', 9800000.00, 'Kim cương', 'Cao cấp', 10, 1, 'DM05'),
('SP044', 'Mặt dây vàng Heritage Gold 24K', 9000000.00, 'Vàng', 'Truyền thống', 12, 1, 'DM05'),
('SP045', 'Mặt dây bạc Pearl Light', 1300000.00, 'Bạc', 'Ngọc trai', 25, 1, 'DM05'),
('SP046', 'Mặt dây vàng trắng Light Stone', 3700000.00, 'Vàng trắng', 'Tinh xảo', 18, 1, 'DM05'),
('SP047', 'Mặt dây kim cương Royal Drop', 13000000.00, 'Kim cương', 'Cao cấp', 8, 1, 'DM05'),
('SP048', 'Mặt dây bạc Minimal Star', 580000.00, 'Bạc', 'Ngôi sao', 30, 1, 'DM05'),
('SP049', 'Mặt dây vàng Ruby Flame', 8000000.00, 'Vàng', 'Ruby đỏ', 15, 1, 'DM05'),
('SP050', 'Mặt dây bạc Youth Style', 520000.00, 'Bạc', 'Trẻ trung', 35, 1, 'DM05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BOx7OIBw8LhngdbVPcmBhT3HY0JByaBaohLV9ovo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYm9sUmlYV3JRRlRzcGd3Y2pXMkxLUTBqbHJtcEFGTkRxc3RKWW1hSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779889831),
('WINxVfnId8HjCz3PX15ePIJnQEXm6osSvgaxSHZ5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmVnYk0yMEQ0Y2tyT1V1Z3d4STFaM0FHa0kyQXBNRWQ1MVZncjlhYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92b3VjaGVycy9jcmVhdGUiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLnZvdWNoZXJzLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779787881);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `MaTaiKhoan` varchar(10) NOT NULL,
  `TenDangNhap` varchar(20) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `VaiTro` varchar(10) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `HoTen`, `SoDienThoai`, `DiaChi`, `Email`, `VaiTro`, `TrangThai`, `created_at`, `updated_at`) VALUES
('TK001', 'admin01', '123456', 'Nguyễn Thị Ngọc Châm', '0981111111', 'Hà Nội', 'admin01@gmail.com', 'admin', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK002', 'admin02', '123456', 'Vàng Thị Nguyên', '0982222222', 'Hà Nội', 'admin02@gmail.com', 'admin', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK003', 'admin03', '123456', 'Đặng Thị Quyên', '0983333333', 'Hà Nội', 'admin03@gmail.com', 'admin', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK004', 'admin04', '123456', 'Nguyễn Thị Phương Thảo', '0984444444', 'Hà Nội', 'admin04@gmail.com', 'admin', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK005', 'admin05', '123456', 'Nguyễn Thu Trang', '0985555555', 'Hà Nội', 'admin05@gmail.com', 'admin', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK006', 'user0001', '123456', 'Nguyễn Văn An', '0987654321', 'Hà Nội', 'nguyenvanan@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK007', 'user0002', '123456', 'Trần Thị Bình', '0978123456', 'Hà Nội', 'tranthibinh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK008', 'user0003', '123456', 'Lê Văn Cường', '0969234567', 'Hà Nội', 'levancuong@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK009', 'user0004', '123456', 'Phạm Thị Dung', '0981345678', 'Hà Nội', 'phamthidung@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK010', 'user0005', '123456', 'Hoàng Văn Em', '0972456789', 'Hà Nội', 'hoangvanem@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK011', 'user0006', '123456', 'Nguyễn Thị Hạnh', '0963567890', 'Hà Nội', 'nguyenthihanh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK012', 'user0007', '123456', 'Trần Văn Hùng', '0984678901', 'Hà Nội', 'tranvanhung@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK013', 'user0008', '123456', 'Lê Thị Lan', '0975789012', 'Hà Nội', 'lethilan@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK014', 'user0009', '123456', 'Phạm Văn Minh', '0966890123', 'Hà Nội', 'phamvanminh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK015', 'user0010', '123456', 'Hoàng Thị Ngọc', '0987901234', 'Hà Nội', 'hoangthingoc@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK016', 'user0011', '123456', 'Đỗ Văn Phúc', '0979012345', 'TP.HCM', 'dovanphuc@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK017', 'user0012', '123456', 'Nguyễn Thị Quỳnh', '0960123456', 'TP.HCM', 'nguyenthiquynh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK018', 'user0013', '123456', 'Trần Văn Sơn', '0981234567', 'TP.HCM', 'tranvanson@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK019', 'user0014', '123456', 'Lý Thị Trang', '0972345678', 'TP.HCM', 'lythitrang@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK020', 'user0015', '123456', 'Phan Văn Tuấn', '0963456789', 'TP.HCM', 'phanvantuan@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK021', 'user0016', '123456', 'Vũ Thị Uyên', '0984567890', 'TP.HCM', 'vuthiuuyen@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK022', 'user0017', '123456', 'Bùi Văn Việt', '0975678901', 'TP.HCM', 'buivanviet@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK023', 'user0018', '123456', 'Đặng Thị Xuân', '0966789012', 'TP.HCM', 'dangthixuan@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK024', 'user0019', '123456', 'Ngô Văn Yên', '0987890123', 'TP.HCM', 'ngovanyen@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK025', 'user0020', '123456', 'Phạm Thị Ánh', '0978901234', 'TP.HCM', 'phamthianh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK026', 'user0021', '123456', 'Trịnh Văn Bắc', '0969012345', 'Đà Nẵng', 'trinhvanbac@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK027', 'user0022', '123456', 'Nguyễn Thị Chi', '0980123456', 'Đà Nẵng', 'nguyenthichi@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK028', 'user0023', '123456', 'Lê Văn Duy', '0971234567', 'Đà Nẵng', 'levanduy@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK029', 'user0024', '123456', 'Hoàng Thị Giang', '0962345678', 'Đà Nẵng', 'hoangthigiang@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK030', 'user0025', '123456', 'Phan Văn Hải', '0983456789', 'Đà Nẵng', 'phanvanhai@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK031', 'user0026', '123456', 'Võ Thị Hòa', '0974567890', 'Đà Nẵng', 'vothihoa@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK032', 'user0027', '123456', 'Đỗ Văn Khánh', '0965678901', 'Đà Nẵng', 'dovankhanh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK033', 'user0028', '123456', 'Bùi Thị Linh', '0986789012', 'Đà Nẵng', 'buithilinh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK034', 'user0029', '123456', 'Nguyễn Văn Nam', '0977890123', 'Đà Nẵng', 'nguyenvannam@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40'),
('TK035', 'user0030', '123456', 'Trần Thị Oanh', '0968901234', 'Đà Nẵng', 'tranthioanh@gmail.com', 'user', 1, '2026-05-23 07:40:40', '2026-05-23 07:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `MaVoucher` varchar(20) NOT NULL,
  `TenVoucher` varchar(50) NOT NULL,
  `DieuKien` text DEFAULT NULL,
  `GiaTriGiamToiDa` decimal(12,2) NOT NULL,
  `SoLanSuDung` tinyint(4) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`MaVoucher`, `TenVoucher`, `DieuKien`, `GiaTriGiamToiDa`, `SoLanSuDung`, `TrangThai`, `created_at`, `updated_at`) VALUES
('VC001', 'Giảm 50K đơn từ 300K', '300000', 50000.00, 100, 1, NULL, NULL),
('VC002', 'Giảm 100K đơn từ 1 triệu', '500000', 100000.00, 80, 1, NULL, NULL),
('VC003', 'Giảm 30K đơn từ 200K', '1000000', 30000.00, 120, 1, NULL, NULL),
('VC004', 'Giảm 70K đơn từ 700K', '1500000', 70000.00, 70, 1, NULL, NULL),
('VC005', 'Giảm 150K đơn từ 2 triệu', '2000000', 150000.00, 50, 1, NULL, NULL),
('VC006', 'Giảm 20K đơn từ 100K', '3000000', 20000.00, 127, 1, NULL, NULL),
('VC007', 'Giảm 40K đơn từ 500K', '5000000', 40000.00, 127, 1, NULL, NULL),
('VC008', 'Giảm 80K đơn từ 800K', '7000000', 80000.00, 90, 1, NULL, NULL),
('VC009', 'Giảm 120K đơn từ 1.5 triệu', '10000000', 120000.00, 60, 1, NULL, NULL),
('VC010', 'Giảm 200K đơn từ 3 triệu', '15000000', 200000.00, 30, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`MaBanner`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSanPham`),
  ADD KEY `fk_ctdh_sanpham` (`MaSanPham`);

--
-- Indexes for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`MaGio`,`MaSanPham`),
  ADD KEY `fk_ctgh_sanpham` (`MaSanPham`);

--
-- Indexes for table `chi_tiet_phan_hoi`
--
ALTER TABLE `chi_tiet_phan_hoi`
  ADD PRIMARY KEY (`MaDanhGia`,`MaTaiKhoan`),
  ADD KEY `fk_ctph_taikhoan` (`MaTaiKhoan`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `fk_danhgia_taikhoan` (`MaTaiKhoan`),
  ADD KEY `fk_danhgia_sanpham` (`MaSanPham`),
  ADD KEY `fk_danhgia_donhang` (`MaDonHang`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `fk_donhang_taikhoan` (`MaTaiKhoan`),
  ADD KEY `fk_donhang_voucher` (`MaVoucher`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`MaGio`),
  ADD KEY `fk_giohang_taikhoan` (`MaTaiKhoan`);

--
-- Indexes for table `hinh_anh_sp`
--
ALTER TABLE `hinh_anh_sp`
  ADD PRIMARY KEY (`MaHinhAnh`),
  ADD KEY `fk_hinhanh_sanpham` (`MaSanPham`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `fk_sanpham_danhmuc` (`MaDanhMuc`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`MaTaiKhoan`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`MaVoucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `fk_ctdh_donhang` FOREIGN KEY (`MaDonHang`) REFERENCES `don_hang` (`MaDonHang`),
  ADD CONSTRAINT `fk_ctdh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Constraints for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `fk_ctgh_giohang` FOREIGN KEY (`MaGio`) REFERENCES `gio_hang` (`MaGio`),
  ADD CONSTRAINT `fk_ctgh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Constraints for table `chi_tiet_phan_hoi`
--
ALTER TABLE `chi_tiet_phan_hoi`
  ADD CONSTRAINT `fk_ctph_danhgia` FOREIGN KEY (`MaDanhGia`) REFERENCES `danh_gia` (`MaDanhGia`),
  ADD CONSTRAINT `fk_ctph_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Constraints for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `fk_danhgia_donhang` FOREIGN KEY (`MaDonHang`) REFERENCES `don_hang` (`MaDonHang`),
  ADD CONSTRAINT `fk_danhgia_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`),
  ADD CONSTRAINT `fk_danhgia_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `fk_donhang_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`),
  ADD CONSTRAINT `fk_donhang_voucher` FOREIGN KEY (`MaVoucher`) REFERENCES `voucher` (`MaVoucher`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `fk_giohang_taikhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tai_khoan` (`MaTaiKhoan`);

--
-- Constraints for table `hinh_anh_sp`
--
ALTER TABLE `hinh_anh_sp`
  ADD CONSTRAINT `fk_hinhanh_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `san_pham` (`MaSanPham`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danh_muc` (`MaDanhMuc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
