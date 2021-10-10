-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 02:00 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanak`
--

CREATE TABLE `clanak` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `naslov` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `clanak`
--

INSERT INTO `clanak` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '2021-06-05', '&quot;Das war bei mir das Problem diese Saison&quot;', 'Mit dem FC Chelsea gewann Timo Werner zuletzt die Champions League. Dennoch lief sein erstes Jahr in England nicht optimal. Und im DFB-Team ist er zum EM-Start wohl auch erstmal nur Joker. ', 'Handball-Europameister wird Timo Werner sicher nicht mehr in seinem Leben. Aber zumindest glitt dem frisch gekürten Champions-League-Sieger (natürlich im Fußball) der Ball nicht aus den Händen, als die deutschen EM-Kicker am Samstag im Training kurz die Sportart wechseln mussten: Fangen und Werfen mit mehreren Bällen, Kommunikation, schnelles Reagieren standen auf dem Stundenplan.', 'mit-chelsea-gewann-timo-werner.jpg', 'sport', 0),
(2, '2021-06-08', '&quot;Ich kann gar nicht glauben, dass ich einen Titel geholt ha', 'Barbora Krejcikova setzt sich im Finale der French Open gegen Anastasia Pawljutschenkowa durch. Fast niemand hatte auf sie gesetzt ? nach ihrem Sieg wurde sie emotional. ', 'Die Tschechin Barbora Krejcikova hat die French Open in Paris gewonnen. Die 25 Jahre alte Tennisspielerin setzte sich am Samstag im Überraschungsfinale gegen die leicht favorisierte Russin Anastasia Pawljutschenkowa mit 6:1, 2:6, 6:4 durch und feierte damit den ersten Grand-Slam-Titel ihrer Karriere. Für beide Spielerinnen war es das erste Endspiel bei einem der vier wichtigsten Turniere. Krejcikova verwandelte nach 1:58 Stunden ihren vierten Matchball.', 'erschoepft-und-gluecklich.jpg', 'sport', 0),
(3, '2021-06-08', 'Die Probleme von Belgiens &quot;goldener Generation&quot;', 'Belgien wird oft als Geheimfavorit bei großen Turnieren genannt. Doch ein Titel sprang für De Bruyne, Hazard, Lukaku und Co. bisher nicht heraus. Die Zeit wird knapper. Und vor der EM gibt es Sorgen. ', 'Wer in den vergangenen Wochen Schlagzeilen über Belgien gelesen hat, dürfte an diesem Dauer-Mitfavoriten durchaus Zweifel anmelden. Starspieler Kevin De Bruyne? Wurde im Champions-League-Finale ausgeknockt und unterzog sich anschließend einer Gesichtsoperation. Kapitän Eden Hazard? Hat beinahe chronisch körperliche Probleme und zwischen November 2019 und Juni 2021 kein einziges Länderspiel absolviert. Dortmunds Axel Witsel? Kehrt nach einer schweren Achillessehnenverletzung gerade erst zurück und steht im Kader, obwohl er monatelang keinen Fußballplatz betreten hat.', 'kevin-de-bruyne-fehlt-belgien.jpg', 'sport', 0),
(4, '2021-06-10', 'Ein nachhaltiger Nachbar für den Reichstag', 'Der Bundestag braucht dringend mehr Platz für die Abgeordneten. Die schnellste Lösung war am Ende auch noch klimafreundlich: ein Neubau aus Holz. ', 'Dass politische Prozesse mal eine Weile in der Luft hängen, ist keine Seltenheit. Für die Orte, an denen über solche Prozesse verhandelt wird, gilt das nicht. Allerdings bestätigt auch hier die Ausnahme die Regel. Es ist ein regnerischer Nachmittag Ende Mai, als nordöstlich vom Reichstag ein Mann vier Ketten an einem sogenannten Modul festschraubt. Es besteht im Wesentlichen aus Holz ? tragende Teile, Boden, Wände ? und hat die Form eines großen Containers. Gewicht: etwa sieben Tonnen.', 'gleich-neben-dem-marie.jpg', 'politika', 0),
(5, '2021-06-12', 'Brexit-Störgeräusche für Johnson', 'Eigentlich sollte es beim G-7-Gipfel vor allem um Corona und die Herausforderung durch China und Russland gehen. Doch immer wieder muss sich Gastgeber Boris Johnson auch mit dem Streit mit der EU auseinandersetzen.', 'Früh am Morgen sprang Boris Johnson ins 13 Grad kalte Meer, um sich, wie britische Journalisten mutmaßten, auf sein Gespräch mit Emmanuel Macron vorzubereiten. Der Samstag ist der Tag der bilateralen Treffen auf den G7-Gipfel, und der französische Präsident gilt im Königreich als der härteste Hund in Europa, wo es um die Fragen des Brexit geht.', 'boris-johnson-mit-charles.jpg', 'politika', 0),
(6, '2021-06-12', 'Grüne küren Baerbock zur Kanzlerkandidatin', 'Der Grünen-Parteitag hat Parteichefin Annalena Baerbock als Kanzlerkandidatin bestätigt. In einer einzigen Abstimmung unterstützten 678 von 688 Delegierten das Duo aus den beiden Parteichefs Baerbock und Robert Habeck als Wahlkampf-Team. ', 'Der Grünen-Parteitag hat Annalena Baerbock mit überwältigender Mehrheit als erste grüne Kanzlerkandidatin bestätigt. Zugleich bekräftigten 678 von 688 Online-Delegierten am Samstag die Rolle der beiden Parteichefs Baerbock und Robert Habeck als Wahlkampf-Spitzenduo - das entspricht 98,55 Prozent der abgegebenen Stimmen. Über beide Punkte entschieden die Delegierten in einer einzigen Abstimmung. Zum Vergleich: Bei ihrer Wahl als Parteivorsitzende 2019 hatte Baerbock 97,1 Prozent der Stimmen erhalten, Habeck 90,4 Prozent.', 'gruenen-kanzlerkandidatin.jpg', 'politika', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `prezime` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Mihael', 'Miseric', 'admin', '$2y$10$FKxnP7gac5NBsgaWA6/13OeFJGaUCaf9g1H3hJ8Saf74poK/esK92', 1),
(2, 'ena', 'ena', 'ena', '$2y$10$0.FW9dRovoW8XrXpZ3th9.f8EqR.PyYZBbvXCSreKxTYuOPXei3fe', 0),
(3, 'Petar', 'Petric', 'Petar', '$2y$10$a4c0eY1iiqEieRJTs698q.00IUend/snK5Swxo2cYcgWZmfxSmhiC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijest`
--

CREATE TABLE `vijest` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `naslov` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanak`
--
ALTER TABLE `clanak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijest`
--
ALTER TABLE `vijest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanak`
--
ALTER TABLE `clanak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vijest`
--
ALTER TABLE `vijest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
