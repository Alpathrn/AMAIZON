-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 30, 2019 at 12:29 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `amaizon`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `promotion` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `nom`, `prix`, `description`, `categorie`, `promotion`) VALUES
(1, 'Air Max 95', 110, 'Baskets sportives et élégantes', 3, 0),
(2, 'iPad', 959, 'Superbe tablette', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Livres'),
(2, 'Musique'),
(3, 'Vêtements'),
(4, 'Sports & Loisirs');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `taille` varchar(10) DEFAULT NULL,
  `couleur` varchar(30) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(20) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `codepostal` varchar(10) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `pays` varchar(60) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `carte` tinyint(1) NOT NULL,
  `numcarte` int(30) NOT NULL,
  `nomcarte` varchar(60) NOT NULL,
  `expiration` date NOT NULL,
  `cvv` int(3) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `codepostal`, `ville`, `pays`, `telephone`, `type`, `carte`, `numcarte`, `nomcarte`, `expiration`, `cvv`, `admin`) VALUES
(1, 'Sorcelle', 'Leonie', 'leonie.sorcelle@edu.ece.fr', 'bravo', 'rue du jardin', '75016', 'Paris', 'France', '601120033', 0, 1, 9887762, 'sorcelle', '2020-09-01', 98, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
