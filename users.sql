-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 08:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth_ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(255) NOT NULL,
  `tokenexp` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `token`, `tokenexp`) VALUES
(4, 'Sumaiya', 'sumu', 'sumu232@gmail.com', '$2y$10$.v3KLNmsSbpYDCcjLFgkiOPlIlVtCDudN55x3HL157SGHvLyCWfgC', '2021-12-13 18:00:00', '', '2021-12-14 19:03:43.510383'),
(5, 'Iqbal Hossen', 'iqbal', 'jmiqbal2019@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2021-12-26 19:33:51', '', '2021-12-26 19:38:08.000000'),
(6, 'Iqbal Hossen', 'iqbal7265', 'jmiqbal7265@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2021-12-26 19:32:22', '', '2021-12-26 19:35:56.000000'),
(7, 'abcd', 'abcd', 'abcd@gmail.com', '$2y$10$SVDHIFfmAtlGRZAgVPpHVuIoXO9PhpB0gUwetmxizEgwZk1SdY8Ue', '2021-12-13 18:00:00', '', '2021-12-14 19:08:58.622487'),
(8, 'xyz', 'xyz', 'xyz@gmail.com', '$2y$10$7gRolxf44mo4UpdLcGHl4umSxM334Ks6KvjiQDwCVUbwtXm4oc53m', '2021-12-13 18:00:00', '', '2021-12-14 19:11:27.190353'),
(9, 'fgh', 'fgh', 'fgh@gmail.com', '$2y$10$wkX9MeL2EK/neP6WNVIEsOE37/MtuNAhK6hWKlwl5ygwQlu9xBhEy', '2021-12-13 18:00:00', '', '2021-12-14 19:28:11.241456'),
(14, 'Admin', 'admin', 'admin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2021-12-24 18:00:00', '', '2021-12-25 16:58:34.705158'),
(15, 'Iqbal Hossen', 'mdiqbal', 'jmiqbal20158@gmail.com', '444528fc68f99ea0f4fe027cb6cbd262f2a707fe', '2021-12-25 18:00:00', '', '2021-12-26 15:29:15.215496');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
