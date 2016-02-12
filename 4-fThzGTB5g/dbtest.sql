-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 09, 2015 at 06:08 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(11) NOT NULL,
  `course` text NOT NULL,
  `course_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `course`, `course_date`) VALUES
(4, 'Ingles', '0000-00-00'),
(2, 'Finanzas', '0000-00-00'),
(3, 'Redes', '2015-09-14'),
(5, 'Historia', '2015-10-05'),
(7, 'Programacion', '2015-10-05'),
(8, 'Estadisticas', '2015-10-05'),
(1, 'Contabilidad', '2015-09-01'),
(0, '', '2015-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(30) NOT NULL,
  `client_id` bigint(30) NOT NULL,
  `campaign_id` bigint(30) NOT NULL,
  `post_data` longtext NOT NULL,
  `post_date` datetime NOT NULL,
  `post_status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `client_id`, `campaign_id`, `post_data`, `post_date`, `post_status`) VALUES
(1, 1000, 1000, 'title::Esto EstÃ¡ Brutal!!|details::Ac velit nostra pretium nec lectus mus eros penatibus a fermentum a in justo in nascetur leo mi enim hac a.Vulputate integer pharetra dictumst lacus penatibus parturient adipiscing porttitor ultrices arcu luctus quis feugiat ultricies ullamcorper hendrerit in elementum ullamcorper.Sociosqu a nunc donec nunc montes sodales montes nam tincidunt dictum blandit dui euismod a.A.|picture::/media/profile-pic.png|network::Facebook|date::2015-10-08 20:06:29', '2015-10-08 14:07:08', 1),
(5, 1000, 1001, 'title::We Are Awesome.|link::http://lopezpagan.com|details::Scelerisque orci elementum volutpat mus euismod donec mus a cubilia quis nunc leo vestibulum a suspendisse facilisi.|picture::/media/profile-pic.png|network::Facebook|date::2015-10-08 21:02:34', '2015-10-08 15:04:11', 1);

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
(6, 'Liderazgo', '2015-10-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;