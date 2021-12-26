-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 30 mai 2019 à 08:25
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'Gap', 1, 2),
(2, 'Forever 21', 1, 2),
(3, 'Gap', 1, 2),
(4, 'Forever 21', 1, 2),
(5, 'Adidas', 1, 2),
(6, 'Gap', 1, 2),
(7, 'Forever 21', 1, 2),
(8, 'Adidas', 1, 2),
(9, 'Gap', 1, 2),
(10, 'Forever 21', 1, 2),
(11, 'Adidas', 1, 2),
(12, 'Gap', 1, 2),
(13, 'Forever 21', 1, 1),
(14, 'ahla', 1, 2),
(15, 'Adidas', 1, 2),
(16, 'Adidas', 1, 1),
(17, 'Gap', 1, 2),
(18, 'Gap', 1, 2),
(19, 'New Balance', 1, 1),
(20, 'Other', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(7, 'Casual wear', 1, 1),
(8, 'Sports ', 1, 1),
(9, 'Other', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(255) DEFAULT NULL,
  `shippingaddress` varchar(255) DEFAULT NULL,
  `phonenumber` int(11) DEFAULT NULL,
  `products` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `notes` text NOT NULL,
  `checkoutdate` date NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `checkout`
--

INSERT INTO `checkout` (`id`, `Fullname`, `shippingaddress`, `phonenumber`, `products`, `total`, `notes`, `checkoutdate`, `status`, `user_id`) VALUES
(1, 'Ahmed Mhadhbi', '13 rue ettaamir 2', 27277228, 'makka,', 302.5, 'note', '2019-05-28', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Kids'),
(9, 'Women'),
(7, 'Men');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `gender_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dateadded` date DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `price`, `active`, `status`, `gender_id`, `size_id`, `description`, `user_id`, `dateadded`, `discount`) VALUES
(1, 'Half pant', '../assests/images/stock/2847957892502c7200.jpg', 1, 2, '19', 1500, 2, 2, NULL, 0, NULL, NULL, NULL, 0),
(2, 'T-Shirt', '../assests/images/stock/163965789252551575.jpg', 2, 2, '9', 1200, 2, 2, NULL, 0, NULL, NULL, NULL, 0),
(3, 'Half Pant', '../assests/images/stock/13274578927924974b.jpg', 5, 3, '18', 1200, 2, 2, NULL, 0, NULL, NULL, NULL, 0),
(4, 'T-Shirt', '../assests/images/stock/12299578927ace94c5.jpg', 6, 3, '29', 1000, 2, 2, NULL, 0, NULL, NULL, NULL, 0),
(5, 'Half Pant', '../assests/images/stock/24937578929c13532e.jpg', 8, 5, '17', 1200, 2, 1, NULL, 0, NULL, NULL, NULL, 0),
(6, 'Polo T-Shirt', '../assests/images/stock/10222578929f733dbf.jpg', 9, 5, '29', 1200, 2, 1, NULL, 0, NULL, NULL, NULL, 0),
(8, 'Polo', '../assests/images/stock/136715789347d1aea6.jpg', 12, 7, '10', 12, 1, 1, 1, 1, NULL, NULL, NULL, 0),
(9, 'chemise', '../assests/images/stock/142485ce8e71e7aacb.jpg', 11, 7, '14', 44, 2, 1, 1, 0, NULL, NULL, NULL, 0),
(10, 't-shirt', '../assests/images/stock/222585ce8ed3ab0a01.jpg', 19, 7, '1', 100, 1, 1, 1, 1, 'new new', 2, '2019-05-01', 8),
(11, 'bermuda', '../assests/images/stock/289955ce8f1417123e.jpg', 11, 7, '45', 45, 2, 1, 1, 0, NULL, NULL, '2019-05-14', 4),
(12, 'a', '../assests/images/stock/49235ce90dfdaf625.jpg', 20, 7, '23', 85, 1, 1, 7, 8, 'Serwel kesah', NULL, '2019-05-22', 15),
(13, 'zz', '../assests/images/stock/219605cebbc64610d1.jpg', 13, 7, '25', 12, 1, 1, 1, 1, NULL, NULL, '2019-05-27', 2),
(14, 'Pantalon', '../assests/images/stock/98255cebbd2cd729f.jpg', 19, 7, '25', 75, 2, 1, 7, 1, 'Pantalon heyel', NULL, '2019-05-27', 16),
(18, 'makka', '../assests/images/stock/55295cec059d64673.jpg', 200, 9, '5', 125, 1, 1, 9, 1, 'MAKKKAa', NULL, '2019-05-27', 50),
(19, 'Wled', '../assests/images/stock/36475cec0a9eccdde.JPG', 20, 7, '35', 150, 1, 1, 1, 9, 'EKHIIIIIIIIT', NULL, '2019-05-27', 0),
(20, '3id', '../assests/images/stock/294525cec0ac8a9e6d.jpg', 20, 9, '7', 75, 1, 1, 7, 9, 'Hallel', NULL, '2019-05-03', 25);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateadded` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `firstname`, `lastname`, `email`, `subject`, `message`, `dateadded`, `user_id`) VALUES
(8, 'Ahmed', 'Mhadhbi', '27277228', 'zvze', 'zaesqd', '2019-05-29', 2);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `daterev` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `content`, `daterev`, `user_id`, `product_id`) VALUES
(2, 'ahla', '2019-05-28', 3, 19);

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `size`) VALUES
(1, 'M'),
(2, 'S'),
(9, 'XS'),
(8, 'L'),
(10, 'XL');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `profilepic` text,
  `gender` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phonenumber`, `address`, `birthday`, `profilepic`, `gender`, `firstname`, `lastname`) VALUES
(1, 'ahmed', '32aa2fd87338e241978c48ab319641bc', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ahmed.mhadhbi', '202cb962ac59075b964b07152d234b70', 'ahmed.mhadhbi@esprit.tn', 27277228, '13 rue ettaamir 2', '2019-05-01', 'assets/images/profilepic/107245ceb64597637b.jpg', 'Female', 'Ahmed', 'Mhadhbii'),
(3, 'melek', '202cb962ac59075b964b07152d234b70', 'melek@gmail.com', 27277228, '13 rue ettaamir 2', '2019-05-02', 'assets/images/profilepic/121745ceb81ecf0188.jpg', 'female', 'Melek', 'Salah');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
