-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 01, 2019 at 09:03 PM
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
  `vendeur_id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `promotion` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `vendeur_id`, `nom`, `prix`, `description`, `categorie`, `promotion`) VALUES
(1, 7, 'Air Max 95', 110, 'Baskets sportives et élégantes', 3, 0),
(2, 7, 'iPad', 959, 'Superbe tablette', 4, 0),
(3, 7, 'Sweat Capuche', 25, 'Capuche grise et inscription niveau clavicule', 3, 0),
(7, 7, 'Lunettes pour cyclope', 347, 'Objet rare et extrêmement utile pour les cyclopes souffrants de myopie.', 3, 0),
(8, 7, 'BD Game of Thrones', 15, 'Premier tome de la série en bande dessinée', 1, 0);

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

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `article_id`, `taille`, `couleur`, `stock`) VALUES
(1, 1, '38', 'Grises/Bleues', 30),
(3, 3, 'M', 'Noir', 126),
(4, 3, 'M', 'Bleu', 80),
(5, 2, '128GB', '', 3),
(6, 2, '256GB', '', 9),
(8, 7, 'Standard', 'Noir', 5),
(9, 7, 'XL', 'Blanc', 0),
(10, 8, 'A4', 'Normal', 104),
(11, 1, '42', 'Noires', 6);

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
  `adresse` text NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `numcarte` varchar(20) NOT NULL,
  `nomcarte` varchar(60) NOT NULL,
  `expiration` varchar(10) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `telephone`, `type`, `numcarte`, `nomcarte`, `expiration`, `cvv`, `admin`) VALUES
(1, 'Sorcelle', 'Leonie', 'leonie.sorcelle@edu.ece.fr', 'bravo', 'rue du jardin', '0601120033', 'deux', '9887762', 'sorcelle', '2020-09-01', '98', 1),
(7, 'Thirouin', 'Alpaïde', 'thirouinalpaide@gmail.com', 'tilikum', '50 Avenue de la Bourdonnais\r\n75007 PARIS', '0651222517', 'deux', '0987654312123456', 'Alpa', '2020-02', '456', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
