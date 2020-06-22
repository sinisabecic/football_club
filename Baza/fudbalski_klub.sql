-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 06:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fudbalski_klub`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(999) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `user_id`, `title`, `content`, `timestamp`, `image`) VALUES
(1, 1, 'Evo problema: Vest Hem je Äuo ne, ovo bi moglo da se desi i ostalima!', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<br>', '2020-06-10 02:14:11', 'dist/img/uploads/vuXo9upK_400x400.jpg'),
(3, 1, 'Vest Hem Junajted â€“ poÄetak nove ere', 'U prestonici Engleske postoji mnogo veÄ‡ih klubova, ali u samom Londonu najviÅ¡e navijaÄa ima upravo fudbalski klub Vest Hem Junajted. Jedino objaÅ¡njenje je to Å¡to je fudbal nekada bio igra i zabava radniÄke, da ne zvuÄi pregrubo, â€œniÅ¾eâ€ klase stanovniÅ¡tva. Upravo oni su i osnovali ÄŒekiÄ‡are, Å¡to je najpoznatiji nadimak tima iz Njuhema u IstoÄnom Londonu. Prvo ime kluba bilo je Temz Ajronvorks F.C. a kao glavni inicijatori pominju se lokalni fudbalski sudija Dejv Tejlor i biznismen Arnold Hils.\r\n\r\n\r\nPreimenovanje se desilo 1900., a 1904. godine klub je premeÅ¡ten  na stadion Bolin Graund (ili Apton Park), na kom joÅ¡ uvek igra. Trenutni kapacitet tribina je 35,016 mesta. Pripalo im je pravo na Olimpijski stadion u Londonu, gde je trebalo da preÄ‘u posle Igara 2012., ali zbog tuÅ¾be gradskog rivala Totenhema , to nije ozvaniÄeno. 22.marta 2013. objavljeno je da je klub ipak dobio Olimpijski stadion kapaciteta 80,000 mesta , na 99 godina, a na njega Ä‡e preÄ‡i uoÄi sezon', '2020-06-14 12:20:19', 'dist/img/uploads/West_Ham_Vs_Birkrikara_(19933880632).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `blog_id` int(3) NOT NULL,
  `content` varchar(999) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `parent` varchar(999) NOT NULL,
  `odobren` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fudbaler`
--

CREATE TABLE `fudbaler` (
  `id` int(3) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `datum_rodjenja` varchar(255) NOT NULL,
  `pozicija` varchar(255) NOT NULL,
  `broj_dresa` int(3) NOT NULL,
  `tim_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fudbaler`
--

INSERT INTO `fudbaler` (`id`, `ime`, `prezime`, `datum_rodjenja`, `pozicija`, `broj_dresa`, `tim_id`) VALUES
(1, 'Antonio', 'Valencia', '1.1.1994', 'cf', 8, 1),
(5, 'Chicarito', 'Hernandez', '18.6.1992', 'ss', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kolo`
--

CREATE TABLE `kolo` (
  `k_id` int(3) NOT NULL,
  `broj_kola` int(3) NOT NULL,
  `id_prvenstva` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kolo`
--

INSERT INTO `kolo` (`k_id`, `broj_kola`, `id_prvenstva`) VALUES
(5, 4, 1),
(6, 5, 1),
(7, 6, 1),
(8, 7, 1),
(9, 8, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prvenstvo`
--

CREATE TABLE `prvenstvo` (
  `id` int(3) NOT NULL,
  `godina_pocetka` int(11) NOT NULL,
  `godina_svrsetka` int(11) NOT NULL,
  `finished` int(2) NOT NULL,
  `winner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prvenstvo`
--

INSERT INTO `prvenstvo` (`id`, `godina_pocetka`, `godina_svrsetka`, `finished`, `winner`) VALUES
(1, 2014, 2015, 1, '1'),
(9, 2016, 2017, 1, '1'),
(10, 2015, 2016, 1, '3'),
(11, 2017, 2018, 1, '3'),
(12, 2011, 2022, 1, '3'),
(13, 2014, 2015, 1, '3'),
(14, 1, 2, 1, '1'),
(15, 2201, 1120, 1, '1'),
(16, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `statistika`
--

CREATE TABLE `statistika` (
  `id` int(3) NOT NULL,
  `utakmica_id` int(3) NOT NULL,
  `fudbaler_id` int(3) NOT NULL,
  `br_golova` int(3) NOT NULL,
  `br_asistencija` int(3) NOT NULL,
  `zuti_karton` int(3) NOT NULL,
  `crveni_karton` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistika`
--

INSERT INTO `statistika` (`id`, `utakmica_id`, `fudbaler_id`, `br_golova`, `br_asistencija`, `zuti_karton`, `crveni_karton`) VALUES
(1, 1, 1, 3, 0, 0, 0),
(2, 1, 1, 27, 14, 5, 1),
(3, 1, 1, 4, 5, 6, 7),
(4, 1, 1, 7, 4, 15, 7),
(5, 1, 5, 2, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(3) NOT NULL,
  `ime_tima` varchar(255) NOT NULL,
  `osnovan` varchar(255) NOT NULL,
  `is_me` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `ime_tima`, `osnovan`, `is_me`) VALUES
(1, 'West Ham', '1895', '1'),
(3, 'Celzi', '1905', '0'),
(5, 'Arsenal', '18.5.1922', '0');

-- --------------------------------------------------------

--
-- Table structure for table `userspass`
--

CREATE TABLE `userspass` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userspass`
--

INSERT INTO `userspass` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'admin', 'admin@admin.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `utakmica`
--

CREATE TABLE `utakmica` (
  `id` int(3) NOT NULL,
  `id_kola` int(3) NOT NULL,
  `domacin_id` int(3) NOT NULL,
  `gost_id` int(3) NOT NULL,
  `rezultat_domaci` int(3) NOT NULL,
  `rezultat_gost` int(3) NOT NULL,
  `datum` date NOT NULL,
  `odigrana` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utakmica`
--

INSERT INTO `utakmica` (`id`, `id_kola`, `domacin_id`, `gost_id`, `rezultat_domaci`, `rezultat_gost`, `datum`, `odigrana`) VALUES
(1, 11, 1, 3, 3, 0, '2019-06-17', 1),
(3, 7, 1, 3, 7, 1, '2019-06-04', 1),
(4, 7, 5, 3, 4, 5, '2019-06-04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fudbaler`
--
ALTER TABLE `fudbaler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kolo`
--
ALTER TABLE `kolo`
  ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `prvenstvo`
--
ALTER TABLE `prvenstvo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistika`
--
ALTER TABLE `statistika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userspass`
--
ALTER TABLE `userspass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utakmica`
--
ALTER TABLE `utakmica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kola` (`id_kola`),
  ADD KEY `domacin_id` (`domacin_id`),
  ADD KEY `gost_id` (`gost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fudbaler`
--
ALTER TABLE `fudbaler`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kolo`
--
ALTER TABLE `kolo`
  MODIFY `k_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `prvenstvo`
--
ALTER TABLE `prvenstvo`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `statistika`
--
ALTER TABLE `statistika`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userspass`
--
ALTER TABLE `userspass`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `utakmica`
--
ALTER TABLE `utakmica`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `utakmica`
--
ALTER TABLE `utakmica`
  ADD CONSTRAINT `utakmica_ibfk_1` FOREIGN KEY (`id_kola`) REFERENCES `kolo` (`k_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utakmica_ibfk_2` FOREIGN KEY (`domacin_id`) REFERENCES `tim` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utakmica_ibfk_3` FOREIGN KEY (`gost_id`) REFERENCES `tim` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
