-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 05, 2019 at 07:47 PM
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
  `promotion` int(3) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `vendeur_id`, `nom`, `prix`, `description`, `categorie`, `promotion`, `visible`) VALUES
(1, 3, 'Air Max 95', 110, 'Baskets sportives, stylées pour la vie de tous les jours et appréciées également pour les randonnées.', 3, 0, 0),
(2, 2, 'iPad', 959, 'Tablette high-tech et pratique quotidiennement pour le travail ou le loisir.', 4, 0, 1),
(3, 2, 'Sweat Capuche', 25, 'Avec sa capuche grise et son inscription au niveau de la clavicule, ce sweat sera vous rendre encore plus beau.', 3, 0, 1),
(7, 3, 'Lunettes pour cyclope', 347, 'Objet rare et extrêmement utile pour les cyclopes souffrants de myopie.', 3, 0, 0),
(8, 3, 'BD Game of Thrones', 15, 'Premier tome de la série en bande dessinée pour se plonger dans cet univers si peu commun.', 1, 0, 0),
(9, 1, 'Dune sombre', 3, 'Album de bruit de nature pour vous apaiser après une grosse journée.', 2, 0, 1),
(10, 2, 'Les fondamentaux de la prise de vue', 30, 'Livre sur les fondamentaux de la prise de vue : une aide très importante avant la prise en main de votre appareil.', 1, 0, 1),
(11, 2, 'Ballon de Football', 24, 'Détente entre copains ou match très important : ce ballon sera indispensable à vos sorties sportives.', 4, 0, 1),
(13, 1, 'Les misérables - Victor Hugo', 5, 'Une des oeuvres les plus emblématiques de la littérature française, à lire absolument. ', 1, 0, 1),
(14, 1, 'Livret Sushi Shop', 40, 'Livre de recettes, de créations et de conception des plus grands chefs étoilés.', 1, 0, 1),
(15, 1, 'Vivre avec un chinchilla', 10, 'Livre pour connaître, nourrir et soigner ces petites bêtes affectueuses. ', 1, 0, 1),
(16, 2, 'Comprendre le PHP', 30, 'Livre pour comprendre et savoir coder ce langage universel.', 1, 0, 1),
(17, 1, 'Lunettes aviateur', 6, 'Jolies lunettes pour voler dans les airs.', 3, 50, 1),
(19, 1, 'Sneakers Balenciaga ', 695, 'Une des paires les plus connues de sneakers, on aime ou on aime pas.', 3, 0, 1),
(20, 1, 'Stan Smith pour bébé', 31, 'La paire classique mais indémodable, à toujours avoir dans son placard.', 3, 30, 1),
(21, 1, 'Bomber militaire', 50, 'Bomber militaire US aviateur avec écussons. ', 3, 50, 1),
(22, 1, 'Trottinette électrique', 399, 'Pour parcourir les rues de votre ville avec fluidité et plaisir, en préservant l\'environnement.', 4, 0, 1),
(23, 3, 'Huawei Pro', 549, 'Un des derniers smartphones pour améliorer votre quotidien.', 4, 0, 0),
(24, 3, 'Peinture acrylique', 23, 'Peinture pour décorer ou simplement vous amuser avec vos enfants, multiples coloris pour satisfaire tout le monde.', 4, 0, 0),
(25, 3, 'Gants de foot ', 23, 'Pour que le gardien de votre équipe arrête toutes les balles.', 4, 0, 0),
(26, 3, 'Album - 47Ter', 10, 'Un des derniers artistes en vogue, entre freestyle et composition originale.', 2, 0, 0),
(27, 2, '150 comptines', 11, 'Comptines et chansons pour endormir et apaiser votre bébé.', 2, 0, 1),
(28, 2, 'Album - Birkin & Gainsbourg', 7, 'Le symphonique : un album reconnu dans le monde entier.', 2, 0, 1),
(29, 2, 'Soundtrack - A star is born', 15, 'Après le succès du film, redécouvrez les musiques qui ont fait sa réputation.', 2, 0, 1),
(30, 2, 'Album - Angèle', 14, 'Brol : le premier album d\'une artiste jeune et engagée.', 2, 0, 1),
(31, 3, 'Brassards canard pour bébé', 25, 'Joli accessoire fashion et de survie pour vos enfants dès le plus bas âge. ', 4, 0, 0),
(32, 1, 'Album - Jacques Brel', 22, 'Laissez vous porter par les paroles d\'un des plus grands interprètes de la chanson française.', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `nomsimple` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `nomsimple`) VALUES
(1, 'Livres', 'livres'),
(2, 'Musique', 'musique'),
(3, 'Vêtements', 'vetements'),
(4, 'Sports & Loisirs', 'sportsloisirs');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `prix_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `prenom`, `nom`, `adresse`, `telephone`, `date`, `prix_total`) VALUES
(8, 1, 'Alpaïde', 'THIROUIN', '50 avenue de la bourdonnais 75007 Paris', '+33651222517', 1556898891, 44);

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

CREATE TABLE `paniers` (
  `id` int(11) NOT NULL,
  `panier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paniers`
--

INSERT INTO `paniers` (`id`, `panier`) VALUES
(1, 'a:0:{}'),
(13, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `taille` varchar(20) NOT NULL DEFAULT 'Taille unique',
  `couleur` varchar(30) NOT NULL DEFAULT 'Couleur unique',
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `article_id`, `taille`, `couleur`, `stock`) VALUES
(1, 1, '38', 'Grises/Bleues', 30),
(3, 3, 'M', 'Noir', 3),
(4, 3, 'M', 'Bleu', 18),
(5, 2, '128GB', 'Couleur unique', 3),
(6, 2, '256GB', 'Couleur unique', 9),
(8, 7, 'Taille unique', 'Noir', 0),
(10, 8, 'Taille unique', 'Couleur unique', 0),
(11, 1, '42', 'Noires', 6),
(12, 10, 'Taille unique', 'Couleur unique', 9),
(13, 11, 'Taillle unique', 'Couleur unique', 22),
(15, 13, 'Taille unique', 'Couleur unique', 5),
(16, 14, 'Taille unique', 'Couleur unique', 2),
(17, 15, 'Taille unique', 'Couleur unique', 130),
(18, 16, 'Taille unique', 'Couleur unique', 29),
(19, 17, 'Taille unique', 'Cuivre', 28),
(20, 18, '39', 'Blanche', 2),
(22, 18, '36', 'Blanche', 1),
(23, 20, '19', 'Blanche', 4),
(24, 21, '10', 'Kaki', 0),
(25, 22, 'Taille unique', 'Noir', 24),
(26, 23, 'Taille unique', 'Multicolore', 7),
(27, 24, 'Taille unique', 'Couleur unique', 9),
(28, 25, 'Taille unique', 'Rouge ', 14),
(29, 26, 'Taille unique', 'Couleur unique', 48),
(30, 27, 'Taille unique', 'Couleur unique', 23),
(31, 28, 'Taille unique', 'Couleur unique', 5),
(32, 29, 'Taille unique', 'Couleur unique', 101),
(33, 30, 'Taille unique', 'Couleur unique', 35),
(34, 31, 'Taille unique', 'Jaune', 32),
(35, 32, 'Taille unique', 'Couleur unique', 15),
(36, 17, 'Taille unique', 'Marron', 3),
(37, 22, 'Taille unique', 'Argent', 3);

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
  `typecarte` varchar(30) NOT NULL,
  `numcarte` varchar(20) NOT NULL,
  `nomcarte` varchar(60) NOT NULL,
  `expiration` varchar(10) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `telephone`, `type`, `typecarte`, `numcarte`, `nomcarte`, `expiration`, `cvv`, `admin`, `actif`) VALUES
(1, 'Thirouin', 'Alpaïde', 'alpaide.thirouin@edu.ece.fr', 'alp', '50 avenue de la bourdonnais 75007 Paris', '+33651222517', 'deux', 'Visa', '1234123412341234', 'Alpaïde Thirouin', '2019-11', '123', 1, 1),
(2, 'Sorcelle', 'Leonie', 'leonie.sorcelle@edu.ece.fr', 'leo', '7 rue du commandant guilbauld 75016 Paris', '+33601172202', 'deux', 'American Express', '1234567812345678', 'Leonie Sorcelle', '2019-09', '456', 1, 1),
(3, 'Sabot', 'Alice', 'alice.sabot@edu.ece.fr', 'ali', '5 rue rébeval 75019 Paris', '+33699656852', 'deux', 'Paypal', '5678567856785678', 'Alice Sabot', '2019-04', '789', 1, 0),
(11, 'Rohart', 'Margaux', 'margaux.rohart@edu.ece.fr', 'mar', '14 rue du 16 octobre 1914 59890 Quesnoy-sur-Deûle', '+33615437318', 'vendeur', 'Visa', '1212121212121212', 'Margaux Rohart', '2019-08', '123', 0, 1),
(12, 'Le Dain', 'Hadrien', 'hadrien.ledain@edu.ece.fr', 'had', '10 rue lecourbe 75015 Paris', '+33769157402', 'vendeur', 'Visa', '2323232323232323', 'Hadrien Le Dain', '2019-08', '123', 0, 1),
(13, 'Lurati', 'Clément', 'clement.lurati@edu.ece.fr', 'cle', '5 rue edgar faure 75015 Paris', '+33680815308', 'acheteur', 'Mastercard', '3434343434343434', 'Clément Lurati', '2019-10', '123', 0, 1),
(14, 'Dreyfus', 'Eva', 'eva.dreyfus@edu.ece.fr', 'eva', '30 rue de la rochefoucauld 92100 Boulogne ', '+33623748939', 'acheteur', 'Mastercard', '4545454545454545', 'Eva Dreyfus ', '2019-12', '123', 0, 1),
(15, 'Cluzeau', 'Valentin', 'valentin.cluzeau@edu.ece.fr', 'val', '132 rue damrémont 75018 Paris ', '+33650246029', 'deux', 'Paypal', '1234567890098765', 'Valentin Cluzeau', '2020-01', '123', 0, 1),
(17, 'Thirouin', 'Hervé', 'herve.thirouin@edu.ece.fr', 'her', 'Rue Grosille PLAILLY', '0607080910', 'vendeur', 'Visa', '0000000000000000', '-', '2019-05', '000', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ventes`
--

INSERT INTO `ventes` (`id`, `article_id`, `stock_id`, `commande_id`, `utilisateur_id`, `quantite`, `prix`) VALUES
(10, 16, 18, 8, 1, 1, 30),
(11, 30, 33, 8, 1, 1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
