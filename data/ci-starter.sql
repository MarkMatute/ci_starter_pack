-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 16, 2018 at 03:04 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-starter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`id`, `email`, `password`, `isActive`, `updated`, `created`) VALUES
(6, 'markernest.matute@gmail.com', 'lkP9/YtifDlqxm8yu4KiANInzAZDmYZIzLlsTzDOPLIpQzcJL2p96c4hjx4qEincFZOD7FQSjtAIVz+E5X9nzQ==', 1, '2018-03-16 02:19:55', '2018-03-13 20:11:44'),
(9, '2@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(10, '3@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(11, '4@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(12, '5@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(13, '6@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(14, '7@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(15, '8@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(16, '9@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(17, '10@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(18, '11@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(19, '12@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(20, '13@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(21, '14@gmail.com', 'Password', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(22, 'asdasd@asd.com', 'sUxa0K2FrZA+6k0eZpbZ5mCzGlZaYZLKomC4zJGb6FE28GQsLnKzakgKKnAxSX2r+DRxmQYXWOFXrcE3WWB15g==', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(23, 'asd@asdad.com', 'uWdfouG76DbmEF3ua85XgF5p5GCx7GSo8AzcmyIhoP0v5C8ArgtMuN5futNXvy7tHNHfaD43UDcAf9k49g8vkw==', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(24, 'markernest.matute@gmail.com', 'KxJ8WLGxEKMm0BciaRmclLykisUjofGigAdy+We/+XqMRktc1H8AMad3qCv1OJUFGLALz3W6TxETaiYNrU5Dww==', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(25, 'markernest.matute@gmail.com', '1Hv4dcuXvmVIyC5HFD+vMoH3u5Qn/uRpd1refdsih91ACQKoq6kYlfDFKvc9mRkBbRyPE2ID3M3ulcmkY42VOw==', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(26, '123@123.com', 'E2+unifCnLF+wv7UblylWbzqzbO0T+is6qZBP84Gi5v2PBfKfEi52qGsx32SpazlwVsRc6swBCHEzbMp0t9leg==', 1, '2018-03-16 00:37:57', '0000-00-00 00:00:00'),
(27, 'tester@tester.com', 'qdsdlocF/EOE6J2ImvVsczjI93IDcIG+/bk1kox72IVL8P52YImtEuhE0yb3OYPMA8HKD+hAuOeVZRfMRsIanA==', 0, '2018-03-16 02:52:50', '0000-00-00 00:00:00'),
(28, 'tester@tester.com', 'vgEHviEghy/NEWj7PAUF3WhUh+97TBDRcBHn9s5W5kX1WhCAL7F7LO/kkt5lvorVxFWNl4ZsnoKiYtQbzSKw8g==', 0, '2018-03-16 02:54:42', '0000-00-00 00:00:00'),
(29, 'gago@gago.com', 'ZgdxZctCLIYzG2Tz1MIeu7z0TwWVRHZB7PGuqTVHFJ515dd+NLgOl5r3BwUMKNyEzo5mRAVDSHBcALUNpVTSNA==', 1, '2018-03-15 19:55:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isActive` tinyint(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`id`, `name`, `isActive`, `created`, `updated`) VALUES
(1, 'Admin', 1, '2018-03-16 02:27:21', '2018-03-15 19:27:21'),
(4, 'Guest', 1, '2018-03-16 02:33:13', '2018-03-15 19:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `RoleMapping`
--

CREATE TABLE `RoleMapping` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RoleMapping`
--

INSERT INTO `RoleMapping` (`account_id`, `role_id`) VALUES
(6, 1),
(28, 4),
(29, 1),
(29, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
