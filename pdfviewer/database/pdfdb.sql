-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Ara 2021, 20:48:54
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `pdfdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pdf`
--

CREATE TABLE `pdf` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Student_No` varchar(50) DEFAULT NULL,
  `Lesson_Name` varchar(50) DEFAULT NULL,
  `Summary` longtext DEFAULT NULL,
  `Keywords` varchar(50) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Supervisor` varchar(50) DEFAULT NULL,
  `Jury_Member` varchar(50) DEFAULT NULL,
  `Jury_Member2` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Ogretim` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userMail` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` varchar(50) NOT NULL,
  `userType` varchar(50) DEFAULT 'Normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userID`, `userMail`, `userName`, `userPass`, `userType`) VALUES
(1, 'cuneydkurtbas@gmail.com', 'M.Cüneyd Kurtbaş', '123', 'Admin'),
(2, 'ranadudukabak@gmail.com', 'Rana Dudu Kabak', '123', 'Normal'),
(19, 'user@kou.edu.tr', 'user', '123', 'Normal');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `pdf`
--
ALTER TABLE `pdf`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
