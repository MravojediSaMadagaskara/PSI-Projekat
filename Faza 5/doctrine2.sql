-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2016 at 07:01 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doctrine2`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `Tekst` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Datum_i_vreme` datetime NOT NULL,
  `Vidjen` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3A09B17B2714722E` (`korisnik_id`),
  KEY `IDX_3A09B17B4B89032C` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `korisnik_id`, `post_id`, `Tekst`, `Datum_i_vreme`, `Vidjen`) VALUES
(2, 3, 2, 'Pozdrav i vama', '2016-06-02 14:21:48', 'Ne'),
(3, 5, 1, 'Dosta pozdravljanja', '2016-06-20 06:47:02', 'Ne'),
(4, 5, 4, 'Novi komentar', '2016-06-20 06:47:24', 'Ne'),
(5, 3, 3, 'Eee da :D', '2016-06-20 06:52:49', 'Ne'),
(6, 3, 5, 'Nije', '2016-06-20 06:53:05', 'Ne');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Korisnicko_ime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Lozinka` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Ime_i_prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `E_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Godiste` int(11) NOT NULL,
  `Vrsta` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_12096718A9C6F440` (`Korisnicko_ime`),
  UNIQUE KEY `UNIQ_1209671824761132` (`E_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `Korisnicko_ime`, `Lozinka`, `Ime_i_prezime`, `E_mail`, `Pol`, `Godiste`, `Vrsta`) VALUES
(1, 'Gost', 'gost', 'Gost', 'gost@mail.com', 'Muski', 1990, 'Gost'),
(2, 'Kor1', 'password', 'Ivana Ivkovic', 'kor1@mail.com', 'Zenski', 1992, 'Obican'),
(3, 'Kor2', 'password', 'Pera Peric', 'kor2@mail.com', 'Muski', 1995, 'Obican'),
(4, 'Kor3', 'password', 'Milos Milosevic', 'kor3@mail.com', 'Muski', 1989, 'Obican'),
(5, 'Ur1', 'password', 'Jovana Jovanovic', 'ur1@mail.com', 'Zenski', 1980, 'Urednik'),
(6, 'Ur2', 'password', 'Luka Lukic', 'ur2@mail.com', 'Muski', 1985, 'Urednik'),
(7, 'Admin', 'admin', 'Admin Adminovic', 'admin@mail.com', 'Zenski', 1979, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `obrisani`
--

CREATE TABLE IF NOT EXISTS `obrisani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `E_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5D87B8F424761132` (`E_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `obrisani`
--

INSERT INTO `obrisani` (`id`, `E_mail`) VALUES
(1, 'zabranjeni@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pitanje`
--

CREATE TABLE IF NOT EXISTS `pitanje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) DEFAULT NULL,
  `Tekst` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Odgovor_1` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Odgovor_2` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Odgovor_3` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Odgovor_4` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Tacan_odgovor` int(11) NOT NULL,
  `Status_aktivno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status_prijavljeno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Vidjeno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31B4777E2714722E` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pitanje`
--

INSERT INTO `pitanje` (`id`, `korisnik_id`, `Tekst`, `Odgovor_1`, `Odgovor_2`, `Odgovor_3`, `Odgovor_4`, `Tacan_odgovor`, `Status_aktivno`, `Status_prijavljeno`, `Vidjeno`) VALUES
(1, 2, 'Sta biste koristili da prikazete prazan karakter na veb stranici?', '& gt;', '& lt;', '& reg;', '& nbsp;', 4, 'Ne', 'Ne', 'Ne'),
(2, 3, 'Koji protokol se koristi za prosledjivanje podataka sa veb servera do veb pretrazivaca?', 'SMTP', 'SSH', 'FTP', 'HTTP', 4, 'Da', 'Ne', 'Ne'),
(3, 4, 'Koji interfejs u Javi biste koristili da obradite dogadjaj kliktanja na text box?', 'FocusListener', 'ActionListener', 'WindowListener', 'KeyListener', 1, 'Da', 'Ne', 'Ne'),
(4, 5, '\r\nU kom opsegu ce biti broj generisan iz ovog Java koda: double randNumber = (int) (Math.random() * 40 + 20); ?', '20-60', '20-40', '0-40', '0-60', 1, 'Da', 'Da', 'Ne'),
(5, 3, 'Koji projektni uzorak dozvoljava da se algoritam menja nezavisno od korisnika?', 'Medijator', 'Strategija', 'Stanje', 'Memento', 2, 'Da', 'Da', 'Ne'),
(6, 4, 'Operacija obrade svakog elementa u listi se zove:', 'Sortiranje', 'Umetanje', 'Obilazak', 'Spajanje', 3, 'Ne', 'Ne', 'Ne'),
(7, 6, 'Kako se zove proveravanje da li komjuterski program ima greske?', 'Bagovanje', 'Debagovanje', 'Ispravljanje', 'Sintaksiranje', 2, 'Da', 'Ne', 'Ne'),
(8, 5, 'Koji jezik koristi kompjuter?', 'Prirodni', 'Asembler', 'Masinski', 'Visi programski', 3, 'Da', 'Da', 'Ne'),
(9, 2, 'Kako se pise broj 9 u binarnom sistemu?', '9', '1001', 'A', '100', 2, 'Ne', 'Ne', 'Ne'),
(10, 5, 'Kako se pise broj 15 u heksadecimalnom sistemu?', '1A', '1111', 'F', '15', 3, 'Ne', 'Ne', 'Ne');

-- --------------------------------------------------------

--
-- Table structure for table `pitanje_rezultat`
--

CREATE TABLE IF NOT EXISTS `pitanje_rezultat` (
  `pitanje_id` int(11) NOT NULL,
  `rezultat_id` int(11) NOT NULL,
  PRIMARY KEY (`pitanje_id`,`rezultat_id`),
  KEY `IDX_6BFC763F945C18FF` (`pitanje_id`),
  KEY `IDX_6BFC763F7E905F07` (`rezultat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pitanje_rezultat`
--

INSERT INTO `pitanje_rezultat` (`pitanje_id`, `rezultat_id`) VALUES
(1, 9),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(3, 6),
(3, 9),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 9),
(5, 1),
(5, 2),
(5, 3),
(5, 7),
(5, 9),
(7, 4),
(8, 1),
(8, 5),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) DEFAULT NULL,
  `Tekst` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Datum_i_vreme` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8D2714722E` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `korisnik_id`, `Tekst`, `Datum_i_vreme`) VALUES
(1, 2, 'Cao', '2016-06-15 07:23:19'),
(2, 5, 'Pozdrav od urednika', '2016-06-09 13:12:45'),
(3, 3, 'Bas je kul igrica :)', '2016-06-01 21:10:07'),
(4, 5, 'Novi post', '2016-06-20 06:47:16'),
(5, 3, 'Dobro jutro', '2016-06-20 06:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE IF NOT EXISTS `prijava` (
  `korisnik_id` int(11) NOT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE IF NOT EXISTS `rezultat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL,
  `Broj_poena` int(11) NOT NULL,
  `Datum_i_vreme` datetime NOT NULL,
  `Trenutno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C0D40C2A2714722E` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`id`, `korisnik_id`, `Broj_poena`, `Datum_i_vreme`, `Trenutno`) VALUES
(1, 2, 2, '2016-06-20 06:39:55', 1),
(2, 3, 2, '2016-06-20 06:53:10', 2),
(3, 3, 0, '2016-06-20 06:53:25', 2),
(4, 3, 0, '2016-06-20 06:53:53', 2),
(5, 3, 0, '2016-06-20 06:54:12', 3),
(6, 3, 0, '2016-06-20 06:54:23', 1),
(7, 3, 0, '2016-06-20 06:54:32', 2),
(8, 3, 0, '2016-06-20 06:55:04', 3),
(9, 1, 1, '2016-06-20 07:00:52', 2);

-- --------------------------------------------------------

--
-- Table structure for table `upozorenje`
--

CREATE TABLE IF NOT EXISTS `upozorenje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL,
  `Poruka` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Tekst_posta` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Datum_i_vreme_posta` datetime NOT NULL,
  `Vidjeno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D45121CC2714722E` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `upozorenje`
--

INSERT INTO `upozorenje` (`id`, `korisnik_id`, `Poruka`, `Tekst_posta`, `Datum_i_vreme_posta`, `Vidjeno`) VALUES
(1, 2, 'Los komentar', 'Neki tekst', '2016-06-15 09:25:13', 'Ne'),
(2, 2, 'Neprimereno ponasanje', 'Tekst', '2016-06-11 05:46:34', 'Ne'),
(3, 5, 'Upozorenje!', 'Cao i vama', '2016-06-10 09:16:41', 'Ne');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `FK_3A09B17B4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3A09B17B2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pitanje`
--
ALTER TABLE `pitanje`
  ADD CONSTRAINT `FK_31B4777E2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pitanje_rezultat`
--
ALTER TABLE `pitanje_rezultat`
  ADD CONSTRAINT `FK_6BFC763F7E905F07` FOREIGN KEY (`rezultat_id`) REFERENCES `rezultat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6BFC763F945C18FF` FOREIGN KEY (`pitanje_id`) REFERENCES `pitanje` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `FK_FD928F6D2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD CONSTRAINT `FK_C0D40C2A2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `upozorenje`
--
ALTER TABLE `upozorenje`
  ADD CONSTRAINT `FK_D45121CC2714722E` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
