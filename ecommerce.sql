-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2026 at 04:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234'),
(1, 'admin', '1234'),
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `nom`, `email`, `adresse`, `total`, `date_commande`) VALUES
(4, 'Mounassef Aziz', 'azizmounassef778@gmail.com', 'Hay Sidi Othmane', 2299.97, '2026-05-05 12:50:45'),
(5, 'achraf sabiri', 'azizmounassef778@gmail.com', 'hay chemaaou', 700.00, '2026-05-08 15:25:29'),
(4, 'Mounassef Aziz', 'azizmounassef778@gmail.com', 'Hay Sidi Othmane', 2299.97, '2026-05-05 12:50:45'),
(5, 'achraf sabiri', 'azizmounassef778@gmail.com', 'hay chemaaou', 700.00, '2026-05-08 15:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `commande_items`
--

CREATE TABLE `commande_items` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande_items`
--

INSERT INTO `commande_items` (`id`, `commande_id`, `produit_id`, `quantite`, `prix`) VALUES
(9, 4, 3, 1, 700.00),
(10, 4, 4, 1, 299.99),
(11, 4, 5, 1, 299.99),
(12, 4, 6, 1, 999.99),
(13, 5, 3, 1, 700.00),
(9, 4, 3, 1, 700.00),
(10, 4, 4, 1, 299.99),
(11, 4, 5, 1, 299.99),
(12, 4, 6, 1, 999.99),
(13, 5, 3, 1, 700.00);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `image`, `description`) VALUES
(3, 'Maillot finale 2008 de Man United (Cristiano Ronaldo).', 700.00, 'ronaldoback.jpg,\r\nronaldofront.jpg', 'Maillot final 2008 de Manchester United porté par Cristiano Ronaldo : rouge iconique avec sponsor AIG, détails dorés et inscription de la finale, symbole d’une saison historique.'),
(4, 'Maillot domicile 2006 de l’Brazil national football team (Ronaldinho).', 299.99, 'ronaldinhoback.jpg,\r\nronaldinhofront.jpg', 'Le maillot 2006 de l’Brazil national football team porté par Ronaldinho est emblématique, avec son jaune vif, ses touches vertes et un style fluide qui reflète le jeu spectaculaire du Brésil.'),
(5, 'Maillot domicile 2007 de AC Milan (Kaká)', 299.99, 'acmilaneback.jpg,\r\nacmilanefront.jpg', 'Le maillot 2007 de AC Milan porté par Kaká est iconique, avec ses rayures rouges et noires, un design classique et élégant qui symbolise la domination du club cette saison-là.'),
(6, 'Maillot domicile 2011 du FC Barcelona (La pulga).', 999.99, 'messiback.jpg,messifront.jpg', 'Le maillot 2011 du FC Barcelona porté par Lionel Messi est emblématique, avec ses bandes blaugrana rouge et bleu, un design épuré et élégant qui reflète l’âge d’or du club.'),
(7, 'Maillot domicile 2015 de Liverpool FC (Steven Gerrard).', 500.00, 'gerrardback.jpg,gerrardfront.jpg', 'Le maillot 2014/2015 du Liverpool FC porté par Steven Gerrard est élégant et classique, avec un rouge profond, des détails blancs et un design sobre qui rend hommage à la dernière saison de Gerrard au club.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
