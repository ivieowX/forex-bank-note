-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 05:17 AM
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
-- Database: `banknotes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banknotes`
--

CREATE TABLE `banknotes` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `flag_url` varchar(500) NOT NULL,
  `banknote_image_1` varchar(500) DEFAULT NULL,
  `banknote_image_2` varchar(500) DEFAULT NULL,
  `banknote_image_3` varchar(500) DEFAULT NULL,
  `banknote_image_4` varchar(500) DEFAULT NULL,
  `banknote_image_5` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banknotes`
--

INSERT INTO `banknotes` (`id`, `country_name`, `flag_url`, `banknote_image_1`, `banknote_image_2`, `banknote_image_3`, `banknote_image_4`, `banknote_image_5`, `created_at`) VALUES
(1, 'USD ดอลลาร์สหรัฐ', 'https://flagcdn.com/w40/us.png', 'uploads/usd1.1.jpg', 'uploads/usd2.jpg', '', '', '', '2025-02-10 07:49:35'),
(2, 'EUR ยูโร', 'https://flagcdn.com/w40/eu.png', 'uploads/eur1.1.jpg', 'uploads/eur1.2.jpg', '', '', '', '2025-02-10 07:50:48'),
(3, 'GBP ปอนด์สเตอร์ลิง', 'https://flagcdn.com/w40/gb.png', 'uploads/gbp1.1.jpg', 'uploads/gbp1.2.jpg', '', '', '', '2025-02-10 07:52:06'),
(4, 'AUD ออสเตรเลีย', 'https://flagcdn.com/w40/au.png', 'uploads/aud1.1.jpg', 'uploads/aud1.2.jpg', '', '', '', '2025-02-10 07:53:34'),
(5, 'CHF สวิตเซอร์แลนด์', 'https://flagcdn.com/w40/ch.png', 'uploads/chf.jpg', '', '', '', '', '2025-02-10 07:54:04'),
(6, 'JPY เยน', 'https://flagcdn.com/w40/jp.png', 'uploads/jpy1.1.jpg', '', '', '', '', '2025-02-10 08:01:23'),
(7, 'SGD ดอลลาร์สิงคโปร์', 'https://flagcdn.com/w40/sg.png', 'uploads/sgd1.1.jpg', 'uploads/sgd1.2.jpg', '', '', '', '2025-02-10 08:02:17'),
(8, 'MYR ริงกิต', 'https://flagcdn.com/w40/my.png', 'uploads/myr1.1.jpg', 'uploads/myr1.2.jpg', '', '', '', '2025-02-10 08:02:57'),
(9, 'HKD ดอลลาร์ฮ่องกง', 'https://flagcdn.com/w40/hk.png', 'uploads/hkd1.1.jpg', 'uploads/hkd1.2.jpg', 'uploads/hkd1.3.jpg', '', '', '2025-02-10 08:03:42'),
(10, 'BND ดอลลาร์บรูไน', 'https://flagcdn.com/w40/bn.png', 'uploads/bnd1.1.jpg', 'uploads/bnd1.2.jpg', '', '', '', '2025-02-10 08:04:12'),
(11, 'CNY หยวน', 'https://flagcdn.com/w40/cn.png', 'uploads/cny1.1.jpg', 'uploads/cny1.2.jpg', '', '', '', '2025-02-10 08:04:41'),
(12, 'VND ดอง', 'https://flagcdn.com/w40/vn.png', 'uploads/vnd.jpg', '', '', '', '', '2025-02-10 08:05:20'),
(13, 'CAD ดอลลาร์แคนาดา', 'https://flagcdn.com/w40/ca.png', 'uploads/cad.jpg', '', '', '', '', '2025-02-10 08:05:56'),
(14, 'KRW วอน', 'https://flagcdn.com/w40/kr.png', 'uploads/krw1.1.jpg', '', '', '', '', '2025-02-10 08:06:25'),
(15, 'SEK โครนาสวีเดน', 'https://flagcdn.com/w40/se.png', 'uploads/sek.jpg', '', '', '', '', '2025-02-10 08:09:45'),
(16, 'DKK โครนเดนมาร์ก', 'https://flagcdn.com/w40/dk.png', 'uploads/dkk.jpg', '', '', '', '', '2025-02-10 08:12:46'),
(17, 'NOK โครนนอร์เวย์', 'https://flagcdn.com/w40/no.png', 'uploads/nok.jpg', '', '', '', '', '2025-02-10 09:31:53'),
(18, 'TWD ดอลลาร์ไต้หวัน', 'https://flagcdn.com/w40/tw.png', 'uploads/twd1.1.jpg', '', '', '', '', '2025-02-10 09:32:24'),
(19, 'AED เดอร์แฮม', 'https://flagcdn.com/w40/ae.png', 'uploads/aed1.1.jpg', 'uploads/aed1.2.jpg', '', '', '', '2025-02-10 09:32:55'),
(20, 'OMR เรียลโอมาน', 'https://flagcdn.com/w40/om.png', 'uploads/omr.jpg', '', '', '', '', '2025-02-10 09:33:28'),
(21, 'RUB รูเบิล', 'https://flagcdn.com/w40/ru.png', 'uploads/rub1.1.jpg', 'uploads/rub1.2.jpg', '', '', '', '2025-02-10 09:34:12'),
(22, 'NZD ดอลลาร์นิวซีแลนด์', 'https://flagcdn.com/w40/nz.png', 'uploads/nzd1.1.jpg', 'uploads/nzd1.2.jpg', '', '', '', '2025-02-10 09:34:51'),
(23, 'PHP เปโซ', 'https://flagcdn.com/w40/ph.png', 'uploads/php.jpg', '', '', '', '', '2025-02-10 09:35:26'),
(24, 'SAR ริยาล', 'https://flagcdn.com/w40/sa.png', 'uploads/sar1.1.jpg', 'uploads/sar1.2.jpg', '', '', '', '2025-02-10 09:35:54'),
(25, 'BHD ดีนาร์บาห์เรน', 'https://flagcdn.com/w40/bh.png', 'uploads/bhd1.1.jpg', 'uploads/bhd1.2.jpg', '', '', '', '2025-02-10 09:36:31'),
(26, 'INR รูปี', 'https://flagcdn.com/w40/in.png', 'uploads/inr1.1.jpg', 'uploads/inr1.2.jpg', '', '', '', '2025-02-10 09:37:01'),
(27, 'MOP ปาตากา', 'https://flagcdn.com/w40/mo.png', 'uploads/mop.jpg', 'uploads/mop1.jpg', '', '', '', '2025-02-10 09:38:33'),
(28, 'IDR รูเปียห์', 'https://flagcdn.com/w40/id.png', 'uploads/idr1.1.jpg', 'uploads/idr1.2.jpg', 'uploads/idr1.3.jpg', '', '', '2025-02-10 09:39:11'),
(29, 'KWD ดีนาร์คูเวต', 'https://flagcdn.com/w40/kw.png', 'uploads/kwd.jpg', '', '', '', '', '2025-02-10 09:39:37'),
(30, 'ZAR แรนด์', 'https://flagcdn.com/w40/za.png', 'uploads/zar.jpg', '', '', '', '', '2025-02-10 09:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(2, 'adminstafy', 'admin@stafy.co.th', 'f47edaf25e7399ec46767542a583f9e7', '2025-01-26 11:34:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banknotes`
--
ALTER TABLE `banknotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banknotes`
--
ALTER TABLE `banknotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
