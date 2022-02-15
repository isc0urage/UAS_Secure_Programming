-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 11:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secprog_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `n2_users`
--

CREATE TABLE `n2_users` (
  `ID User` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Last Login` varchar(255) NOT NULL,
  `Last Access Features` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `n2_users`
--

INSERT INTO `n2_users` (`ID User`, `Username`, `Password`, `Last Login`, `Last Access Features`) VALUES
('user002', 'febibiola', 'jangannyontekbosku', 'Wednesday, 26 May 2001', 'Finance'),
('user003', 'andradhani', 'passwordkuluarbiasa', 'Tuesday, 07 September 2021', 'Human Resource'),
('user004', 'fredyangkara', 'fredykeren', 'Tuesday, 21 September 2021', 'RnD'),
('user005', 'antahpurnama', 'purnamamurakasi', 'Sunday, 14 March 2021', 'Accounting'),
('user006', 'saktimandraguna', 'saktisekaligunawan', 'Thursday, 21 October 2021', 'User Management');

-- --------------------------------------------------------

--
-- Table structure for table `n2_usersdeleted`
--

CREATE TABLE `n2_usersdeleted` (
  `ID User` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Last Login` varchar(255) NOT NULL,
  `Last Access Features` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `n2_usersdeleted`
--

INSERT INTO `n2_usersdeleted` (`ID User`, `Username`, `Password`, `Last Login`, `Last Access Features`) VALUES
('user001', 'budihartanto', 'A$b12345678', 'Thursday, 26 August 2001', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `n2_usersoldpassword`
--

CREATE TABLE `n2_usersoldpassword` (
  `ID User` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Last Login` varchar(255) NOT NULL,
  `Last Access Features` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `n2_usersoldpassword`
--

INSERT INTO `n2_usersoldpassword` (`ID User`, `Username`, `Password`, `Last Login`, `Last Access Features`) VALUES
('user001', 'budihartanto', 'jangannyontek', 'Thursday, 26 August 2001', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Bplace` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `NIK` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Married` varchar(255) NOT NULL,
  `NPWP` varchar(255) NOT NULL,
  `Kelurahan` varchar(255) NOT NULL,
  `Kecamatan` varchar(255) NOT NULL,
  `Kota` varchar(255) NOT NULL,
  `Propinsi` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `Pph` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Fname`, `Lname`, `Bplace`, `Birthday`, `NIK`, `Gender`, `Married`, `NPWP`, `Kelurahan`, `Kecamatan`, `Kota`, `Propinsi`, `Salary`, `Pph`) VALUES
('pandy', 'herman', 'jakarta', '2001-08-16', '2301866113123456', 'Female', 'No', '09.254.294.3-407.123', 'Jl. Latumenten', 'Grogol Petamburan', 'Jakarta', 'Aceh', '72000000', 900000),
('pandy', 'herman', 'jakarta', '2001-08-16', '2301866113123456', 'Female', 'No', '09.254.294.3-407.123', 'Jl. Latumenten', 'Grogol Petamburan', 'Jakarta', 'Aceh', '72000000', 900000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
