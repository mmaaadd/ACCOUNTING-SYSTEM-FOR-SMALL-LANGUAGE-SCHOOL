-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 11 Lis 2018, 18:05
-- Wersja serwera: 5.6.36
-- Wersja PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mayahoo_baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres_firmy`
--

CREATE TABLE `adres_firmy` (
  `ID_adresu` int(11) NOT NULL,
  `Linia1` tinytext CHARACTER SET latin2,
  `Linia2` tinytext CHARACTER SET latin2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `excel`
--

CREATE TABLE `excel` (
  `ID` int(10) NOT NULL,
  `miesiac` int(2) NOT NULL,
  `rok` int(4) NOT NULL,
  `naglowek` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszty`
--

CREATE TABLE `koszty` (
  `id_kosztu` int(11) NOT NULL,
  `Data` date DEFAULT NULL,
  `id_sklepu` int(11) DEFAULT NULL,
  `ndk` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `opis` varchar(160) CHARACTER SET utf8 DEFAULT NULL,
  `koszt` decimal(12,2) DEFAULT NULL,
  `sam` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kwota_wolna`
--

CREATE TABLE `kwota_wolna` (
  `id` int(10) NOT NULL DEFAULT '0',
  `za_rok` int(10) DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kwota_wolna`
--

INSERT INTO `kwota_wolna` (`id`, `za_rok`, `kwota`) VALUES
(1, 2010, '556.02'),
(2, 2011, '556.02'),
(3, 2012, '556.02'),
(4, 2013, '556.02'),
(5, 2014, '556.02'),
(6, 2015, '556.02'),
(7, 2016, '556.02'),
(8, 2017, '556.02'),
(9, 2018, '556.02');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `podatek`
--

CREATE TABLE `podatek` (
  `id_podatku` int(10) NOT NULL,
  `data_przelewu` date DEFAULT NULL,
  `za_okres` date DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rachunek`
--

CREATE TABLE `rachunek` (
  `id_rachunku` int(10) NOT NULL,
  `id_szkoly` int(10) DEFAULT '0',
  `data_wystawienia` date DEFAULT NULL,
  `data_dostarczenia` date DEFAULT NULL,
  `termin_platnosci` date DEFAULT NULL,
  `nr_rachunku` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  `tytul_1` varchar(255) CHARACTER SET utf8 DEFAULT '	\\r\\n\\r\\nProwadzenie Szkoleń z Języka Angielskiego',
  `minuty_1` int(11) DEFAULT NULL,
  `cena_1` decimal(10,0) DEFAULT NULL,
  `ilosc_1` decimal(10,1) DEFAULT NULL,
  `tytul_2` varchar(255) CHARACTER SET utf8 DEFAULT '	\\r\\n\\r\\nProwadzenie Szkoleń z Języka Angielskiego',
  `minuty_2` int(11) DEFAULT NULL,
  `cena_2` decimal(10,0) DEFAULT NULL,
  `ilosc_2` decimal(10,1) DEFAULT NULL,
  `tytul_3` varchar(255) CHARACTER SET utf8 DEFAULT '	\r\n\r\nProwadzenie Szkoleń z Języka Angielskiego',
  `minuty_3` int(11) DEFAULT NULL,
  `cena_3` decimal(10,0) DEFAULT NULL,
  `ilosc_3` decimal(10,1) DEFAULT NULL,
  `tytul_4` varchar(255) CHARACTER SET utf8 DEFAULT '	\r\n\r\nProwadzenie Szkoleń z Języka Angielskiego',
  `minuty_4` int(11) DEFAULT NULL,
  `cena_4` decimal(10,0) DEFAULT NULL,
  `ilosc_4` decimal(10,1) DEFAULT NULL,
  `tytul_5` varchar(255) CHARACTER SET utf8 DEFAULT '	\r\n\r\nProwadzenie Szkoleń z Języka Angielskiego',
  `minuty_5` int(50) DEFAULT NULL,
  `cena_5` decimal(10,0) DEFAULT NULL,
  `ilosc_5` decimal(10,1) DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT '0.00',
  `kwota_netto` decimal(10,2) DEFAULT NULL,
  `za_etat` int(11) DEFAULT '0',
  `tytulem` text COLLATE utf8_polish_ci,
  `adres_id` int(10) UNSIGNED DEFAULT '2',
  `miejscowosc` varchar(50) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Błonie'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklepy`
--

CREATE TABLE `sklepy` (
  `id_sklepu` int(10) NOT NULL,
  `nazwa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `miejscowosc` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `ulica` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `kod_pocztowy` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `aktywna` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzet`
--

CREATE TABLE `sprzet` (
  `id_sprzetu` int(10) NOT NULL,
  `nazwa_sprzetu` text COLLATE utf8_polish_ci NOT NULL,
  `data_zakupu` date DEFAULT NULL,
  `data_utylizacji` date DEFAULT NULL,
  `na_stanie` tinyint(3) UNSIGNED NOT NULL,
  `ndk` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stawki`
--

CREATE TABLE `stawki` (
  `id_stawki` int(10) NOT NULL,
  `id_szkoly` int(10) DEFAULT '0',
  `nazwa_stawki` varchar(30) CHARACTER SET utf8 DEFAULT '0',
  `kwota` decimal(10,2) DEFAULT '0.00',
  `czas` int(10) DEFAULT '0',
  `aktywna` int(11) NOT NULL DEFAULT '1',
  `tytul` varchar(255) COLLATE utf8_roman_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkoly`
--

CREATE TABLE `szkoly` (
  `id_szkoly` int(10) NOT NULL,
  `nazwa` varchar(100) CHARACTER SET utf8 DEFAULT '0',
  `ulica` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `miejscowosc` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `kod_pocztowy` varchar(6) CHARACTER SET utf8 DEFAULT '0',
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `regon` varchar(50) CHARACTER SET utf8 DEFAULT '0',
  `aktywna` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `t_komorki`
--

CREATE TABLE `t_komorki` (
  `ID` int(10) NOT NULL,
  `data_d` date NOT NULL,
  `string` varchar(50) NOT NULL,
  `ID_nagl_to_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `t_naglowek`
--

CREATE TABLE `t_naglowek` (
  `ID` int(10) NOT NULL,
  `nazwa` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `t_nagl_to_data`
--

CREATE TABLE `t_nagl_to_data` (
  `ID` int(10) NOT NULL,
  `ID_nagl` int(10) NOT NULL DEFAULT '0',
  `data_m` date DEFAULT NULL,
  `rok` int(4) NOT NULL,
  `miesiac` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ubez_sp`
--

CREATE TABLE `ubez_sp` (
  `id_uz` int(10) NOT NULL,
  `data_przelewu` date DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT NULL,
  `opis` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ubez_zdr`
--

CREATE TABLE `ubez_zdr` (
  `id_uz` int(10) NOT NULL,
  `data_przelewu` date DEFAULT NULL,
  `kwota` decimal(10,2) DEFAULT NULL,
  `opis` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zajecia`
--

CREATE TABLE `zajecia` (
  `id_zajec` int(10) NOT NULL,
  `data` date DEFAULT NULL,
  `id_stawki` int(10) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `opis` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `excel_id` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres_firmy`
--
ALTER TABLE `adres_firmy`
  ADD KEY `Indeks 1` (`ID_adresu`);

--
-- Indeksy dla tabeli `excel`
--
ALTER TABLE `excel`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `koszty`
--
ALTER TABLE `koszty`
  ADD PRIMARY KEY (`id_kosztu`);

--
-- Indeksy dla tabeli `kwota_wolna`
--
ALTER TABLE `kwota_wolna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `podatek`
--
ALTER TABLE `podatek`
  ADD KEY `Index 1` (`id_podatku`);

--
-- Indeksy dla tabeli `rachunek`
--
ALTER TABLE `rachunek`
  ADD KEY `Index 1` (`id_rachunku`);

--
-- Indeksy dla tabeli `sklepy`
--
ALTER TABLE `sklepy`
  ADD UNIQUE KEY `id_sklepu` (`id_sklepu`),
  ADD KEY `Index 1` (`id_sklepu`);

--
-- Indeksy dla tabeli `sprzet`
--
ALTER TABLE `sprzet`
  ADD KEY `Index 1` (`id_sprzetu`);

--
-- Indeksy dla tabeli `stawki`
--
ALTER TABLE `stawki`
  ADD KEY `Index 1` (`id_stawki`);

--
-- Indeksy dla tabeli `szkoly`
--
ALTER TABLE `szkoly`
  ADD KEY `Index 1` (`id_szkoly`);

--
-- Indeksy dla tabeli `t_komorki`
--
ALTER TABLE `t_komorki`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `t_naglowek`
--
ALTER TABLE `t_naglowek`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `t_nagl_to_data`
--
ALTER TABLE `t_nagl_to_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `ubez_sp`
--
ALTER TABLE `ubez_sp`
  ADD KEY `Index 1` (`id_uz`);

--
-- Indeksy dla tabeli `ubez_zdr`
--
ALTER TABLE `ubez_zdr`
  ADD KEY `Index 1` (`id_uz`);

--
-- Indeksy dla tabeli `zajecia`
--
ALTER TABLE `zajecia`
  ADD UNIQUE KEY `id_zajec` (`id_zajec`),
  ADD KEY `Index 1` (`id_zajec`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres_firmy`
--
ALTER TABLE `adres_firmy`
  MODIFY `ID_adresu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `excel`
--
ALTER TABLE `excel`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `koszty`
--
ALTER TABLE `koszty`
  MODIFY `id_kosztu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1233;

--
-- AUTO_INCREMENT dla tabeli `podatek`
--
ALTER TABLE `podatek`
  MODIFY `id_podatku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT dla tabeli `rachunek`
--
ALTER TABLE `rachunek`
  MODIFY `id_rachunku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708;

--
-- AUTO_INCREMENT dla tabeli `sklepy`
--
ALTER TABLE `sklepy`
  MODIFY `id_sklepu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT dla tabeli `sprzet`
--
ALTER TABLE `sprzet`
  MODIFY `id_sprzetu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT dla tabeli `stawki`
--
ALTER TABLE `stawki`
  MODIFY `id_stawki` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `szkoly`
--
ALTER TABLE `szkoly`
  MODIFY `id_szkoly` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `t_komorki`
--
ALTER TABLE `t_komorki`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT dla tabeli `t_naglowek`
--
ALTER TABLE `t_naglowek`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `t_nagl_to_data`
--
ALTER TABLE `t_nagl_to_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `ubez_sp`
--
ALTER TABLE `ubez_sp`
  MODIFY `id_uz` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT dla tabeli `ubez_zdr`
--
ALTER TABLE `ubez_zdr`
  MODIFY `id_uz` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT dla tabeli `zajecia`
--
ALTER TABLE `zajecia`
  MODIFY `id_zajec` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68687190;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
