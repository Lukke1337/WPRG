-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Cze 2023, 21:08
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_polish_ci NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment`, `created_date`, `user_id`) VALUES
(37, 11, 'grggegeg', '2023-06-25 18:55:35', 0),
(38, 11, 'sdsdddddddddd', '2023-06-25 18:56:58', 0),
(39, 11, 'ssssssssssssssssssss', '2023-06-25 18:57:21', 0),
(40, 11, 'khjk', '2023-06-25 19:06:39', 3),
(42, 8, '???', '2023-06-25 19:12:49', 3),
(43, 11, 'ŻABAAAAA', '2023-06-25 19:32:39', 3),
(45, 11, 'HALO', '2023-06-25 21:07:28', 1),
(46, 11, ':DDD', '2023-06-25 21:07:37', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `message` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`) VALUES
(1, 'DUPSLIK', 'lukasz@pocztaxd.pl', 'Siema siema'),
(2, 'BOMBEL', 'lukasz@pocztaxd.pl', 'SIEMA GEAGA'),
(3, 'Rostek', 'rostek@rostekpoczta.org', 'Najlepszy blog ever');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `published_date` datetime DEFAULT current_timestamp(),
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `published_date`, `author_id`) VALUES
(8, 'ROSTEK JEST NAJLEPSZY', 'Tak wygląda prawdziwy Gigachad:', 'images/chad.png', '2023-06-25 14:10:23', 2),
(9, 'Pierwszy post na blogu!', 'Witaj na moim blogu! O to pierwszy post początkujący całą historię bloga. Liczę, że wspólnie zbudujemy tutaj fajną społeczność! :D', 'images/OIP.png', '2023-06-20 13:22:47', 1),
(11, 'Jak robią żaby?', 'RERE\r\nKUMKUM', 'images/832705210136395827.png', '2023-06-25 15:55:06', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `role` enum('admin','author','user') COLLATE utf8_polish_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(0, 'Gość', '$2y$10$LWqVxE3mYRFCmlr07THkTO847BFOsU4UNWZ1VApwVNLcX2wv8qGOW', 'user'),
(1, 'admin', '$2y$10$nrF1ica/5W6CGi2tfiWuGugBPOgEcMnpUKYSO2.oCzG4BCCoUFPmm', 'admin'),
(2, 'rostek', '$2y$10$phaQCZzONX2eS8uZVZxfluOqhSQdo7vd8iPVIlEpPLCxd8kVKwldi', 'admin'),
(3, 'gostek', '$2y$10$81qApGj1iaoVJFw4noAnKOg1b.Lih/yc9ibPgsYAqTN5X4T5q8m6.', 'author'),
(7, 'test', '$2y$10$pN.nw3zTZFQyQW1EYYrxa.mhQ8sdABSUXEvGmJwMCcFaz3EqDiHI.', 'user'),
(9, 'JACEK2', '$2y$10$z841MgfJl5y0/Q2qm7yrNeCK5.tq5HzpTtZiKdMkJNAi0qMVDPJWa', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
