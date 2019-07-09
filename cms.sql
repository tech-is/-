-- SQL Dump
-- version 4.8.5
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `customer_kana` varchar(200) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `zip_adress` int(7) DEFAULT NULL,
  `adress` varchar(200) DEFAULT NULL,
  `mail` varchar(190) DEFAULT NULL,
  `magazine` int(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `magazine_setting`
--

CREATE TABLE `magazine_setting` (
  `magazine_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `mail_subject` text,
  `mail_detail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `kana` varchar(64) NOT NULL,
  `tel` int(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `year` int(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass_tmp` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `kana`, `tel`, `email`, `year`, `password`, `pass_tmp`, `created_at`, `updated_at`, `delete_flag`) VALUES
(1, 'admin', '', 0, 'Cipher_GALM01@outlook.jp', 0, '$2y$10$7TxchmzBa6wgGVi/nYMdzenIf6l9AnMDcN8abmZ/6ImWQURrLB1cK', '', '0000-00-00 00:00:00', '2019-06-20 06:16:18', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `old_sended`
--

CREATE TABLE `old_sended` (
  `sended_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `sender_id` int(5) NOT NULL,
  `sended_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mail_subject` text,
  `mail_detail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `reset_pass`
--

CREATE TABLE `reset_pass` (
  `members_id` int(11) NOT NULL,
  `tmp_key` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `magazine_setting`
--
ALTER TABLE `magazine_setting`
  ADD PRIMARY KEY (`magazine_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `old_sended`
--
ALTER TABLE `old_sended`
  ADD PRIMARY KEY (`sended_id`);

--
-- Indexes for table `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD UNIQUE KEY `members_id` (`members_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `magazine_setting`
--
ALTER TABLE `magazine_setting`
  MODIFY `magazine_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `old_sended`
--
ALTER TABLE `old_sended`
  MODIFY `sended_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
