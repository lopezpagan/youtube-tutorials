-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 22, 2016 at 07:47 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `course` text NOT NULL,
  `course_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `course`, `course_date`) VALUES
(4, 'Ingles', '0000-00-00'),
(2, 'Finanzas', '0000-00-00'),
(3, 'Redes', '2015-09-14'),
(5, 'Historia', '2015-10-05'),
(7, 'Programacion', '2015-10-05'),
(8, 'Estadisticas', '2015-10-05'),
(1, 'Contabilidad', '2015-09-01'),
(0, '', '2015-10-05');
