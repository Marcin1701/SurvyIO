-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `serwis ankietowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ankieta`
--

CREATE TABLE `ankieta` (
  `id_ankiety` int(10) UNSIGNED NOT NULL,
  `nazwa_ankiety` varchar(50) NOT NULL,
  `data_rozp_ankiety` date NOT NULL,
  `data_zak_ankiety` date NOT NULL,
  `czy_widoczna` tinyint(1) DEFAULT NULL,
  `id_tworcy` int(10) UNSIGNED DEFAULT NULL,
  `id_kategorii` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jed_krot_wybor`
--

CREATE TABLE `jed_krot_wybor` (
  `id_jed_krot_wybor` int(10) UNSIGNED NOT NULL,
  `tresc_odp` int(11) NOT NULL,
  `id_wyboru` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id_kategorii` int(10) UNSIGNED NOT NULL,
  `nazwa_kategorii` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mozliwe_wybory`
--

CREATE TABLE `mozliwe_wybory` (
  `id_wyboru` int(10) UNSIGNED NOT NULL,
  `id_pytania` int(10) UNSIGNED NOT NULL,
  `tresc_opcji` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odp_tekstowa`
--

CREATE TABLE `odp_tekstowa` (
  `id_odp_tekstowej` int(10) UNSIGNED NOT NULL,
  `tresc_odp` varchar(200) NOT NULL,
  `id_pytania` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytanie`
--

CREATE TABLE `pytanie` (
  `id_pytania` int(10) UNSIGNED NOT NULL,
  `tresc_pytania` varchar(50) NOT NULL,
  `id_typu_pytania` int(10) UNSIGNED NOT NULL,
  `id_ankiety` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_pytania`
--

CREATE TABLE `typ_pytania` (
  `id_typu_pytania` int(10) UNSIGNED NOT NULL,
  `opis_typu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `typ_pytania`
--

INSERT INTO `typ_pytania` (`id_typu_pytania`, `opis_typu`) VALUES
(1, 'JW'),
(2, 'WW'),
(3, 'TO'),
(4, 'ZW');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id_uzytkownika` int(10) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `haslo` varchar(30) NOT NULL,
  `czy_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wielo_krot_wybor`
--

CREATE TABLE `wielo_krot_wybor` (
  `id_wiel_wybor` int(10) UNSIGNED NOT NULL,
  `tresc_odp` int(11) NOT NULL,
  `id_wyboru` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zakres_wybor`
--

CREATE TABLE `zakres_wybor` (
  `id_zakresu` int(10) UNSIGNED NOT NULL,
  `tresc_odp` int(11) NOT NULL,
  `id_pytania` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  ADD PRIMARY KEY (`id_ankiety`),
  ADD KEY `id_tworcy` (`id_tworcy`),
  ADD KEY `id_kategorii` (`id_kategorii`);

--
-- Indeksy dla tabeli `jed_krot_wybor`
--
ALTER TABLE `jed_krot_wybor`
  ADD PRIMARY KEY (`id_jed_krot_wybor`),
  ADD KEY `id_wyboru` (`id_wyboru`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id_kategorii`);

--
-- Indeksy dla tabeli `mozliwe_wybory`
--
ALTER TABLE `mozliwe_wybory`
  ADD PRIMARY KEY (`id_wyboru`),
  ADD KEY `id_pytania` (`id_pytania`);

--
-- Indeksy dla tabeli `odp_tekstowa`
--
ALTER TABLE `odp_tekstowa`
  ADD PRIMARY KEY (`id_odp_tekstowej`),
  ADD KEY `id_pytania` (`id_pytania`);

--
-- Indeksy dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  ADD PRIMARY KEY (`id_pytania`),
  ADD KEY `id_ankiety` (`id_ankiety`),
  ADD KEY `id_typu_pytania` (`id_typu_pytania`);

--
-- Indeksy dla tabeli `typ_pytania`
--
ALTER TABLE `typ_pytania`
  ADD PRIMARY KEY (`id_typu_pytania`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indeksy dla tabeli `wielo_krot_wybor`
--
ALTER TABLE `wielo_krot_wybor`
  ADD PRIMARY KEY (`id_wiel_wybor`),
  ADD KEY `id_wyboru` (`id_wyboru`);

--
-- Indeksy dla tabeli `zakres_wybor`
--
ALTER TABLE `zakres_wybor`
  ADD PRIMARY KEY (`id_zakresu`),
  ADD KEY `id_pytania` (`id_pytania`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  MODIFY `id_ankiety` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `jed_krot_wybor`
--
ALTER TABLE `jed_krot_wybor`
  MODIFY `id_jed_krot_wybor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id_kategorii` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `mozliwe_wybory`
--
ALTER TABLE `mozliwe_wybory`
  MODIFY `id_wyboru` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `odp_tekstowa`
--
ALTER TABLE `odp_tekstowa`
  MODIFY `id_odp_tekstowej` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  MODIFY `id_pytania` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `typ_pytania`
--
ALTER TABLE `typ_pytania`
  MODIFY `id_typu_pytania` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id_uzytkownika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `wielo_krot_wybor`
--
ALTER TABLE `wielo_krot_wybor`
  MODIFY `id_wiel_wybor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zakres_wybor`
--
ALTER TABLE `zakres_wybor`
  MODIFY `id_zakresu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  ADD CONSTRAINT `ankieta_ibfk_1` FOREIGN KEY (`id_tworcy`) REFERENCES `uzytkownik` (`id_uzytkownika`) ON DELETE CASCADE,
  ADD CONSTRAINT `ankieta_ibfk_2` FOREIGN KEY (`id_kategorii`) REFERENCES `kategoria` (`id_kategorii`) ON DELETE NO ACTION;

--
-- Ograniczenia dla tabeli `jed_krot_wybor`
--
ALTER TABLE `jed_krot_wybor`
  ADD CONSTRAINT `jed_krot_wybor_ibfk_1` FOREIGN KEY (`id_wyboru`) REFERENCES `mozliwe_wybory` (`id_wyboru`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `mozliwe_wybory`
--
ALTER TABLE `mozliwe_wybory`
  ADD CONSTRAINT `mozliwe_wybory_ibfk_1` FOREIGN KEY (`id_pytania`) REFERENCES `pytanie` (`id_pytania`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `odp_tekstowa`
--
ALTER TABLE `odp_tekstowa`
  ADD CONSTRAINT `odp_tekstowa_ibfk_1` FOREIGN KEY (`id_pytania`) REFERENCES `pytanie` (`id_pytania`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  ADD CONSTRAINT `pytanie_ibfk_1` FOREIGN KEY (`id_ankiety`) REFERENCES `ankieta` (`id_ankiety`) ON DELETE CASCADE,
  ADD CONSTRAINT `pytanie_ibfk_2` FOREIGN KEY (`id_typu_pytania`) REFERENCES `typ_pytania` (`id_typu_pytania`) ON DELETE NO ACTION;

--
-- Ograniczenia dla tabeli `wielo_krot_wybor`
--
ALTER TABLE `wielo_krot_wybor`
  ADD CONSTRAINT `wielo_krot_wybor_ibfk_1` FOREIGN KEY (`id_wyboru`) REFERENCES `mozliwe_wybory` (`id_wyboru`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `zakres_wybor`
--
ALTER TABLE `zakres_wybor`
  ADD CONSTRAINT `zakres_wybor_ibfk_1` FOREIGN KEY (`id_pytania`) REFERENCES `pytanie` (`id_pytania`) ON DELETE CASCADE;
COMMIT;
