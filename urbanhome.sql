-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 24 mai 2025 à 22:03
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `urbanhome`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_achat` int NOT NULL AUTO_INCREMENT,
  `id_propriete` int NOT NULL,
  `id_client` int NOT NULL,
  `id_agent` int NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id_achat`),
  UNIQUE KEY `id_propriete` (`id_propriete`),
  KEY `id_client` (`id_client`),
  KEY `id_agent` (`id_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `id_agent` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `mot_de_passe` int NOT NULL,
  PRIMARY KEY (`id_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `bailleur`
--

DROP TABLE IF EXISTS `bailleur`;
CREATE TABLE IF NOT EXISTS `bailleur` (
  `id_bailleur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `raison_social` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bailleur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `bailleur`
--

INSERT INTO `bailleur` (`id_bailleur`, `nom`, `prenom`, `raison_social`, `adresse`, `email`, `telephone`, `mot_de_passe`) VALUES
(3, 'BIYO', 'Cheick O', 'cktech', 'secteur 51,karpala', 'yobibah7295@gmail.com', '54806093', '$2y$10$pfUlM9WZ.yd2a1w71CDsEO34RegZ.8MMbWlGKcewXzv1rEhth12W6'),
(2, 'BA', 'YOUSSSAHOU', 'DJEBA TRAVEL', 'SECTEIUR,58', 'youssahouba.djeba@gmail.com', '64981938', '$2y$10$paLKpLrKSqZEvnQiHf2Kf.nB.vCfZZlZnixuHeFRudW8KhzTIV91u');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `id_agent` int NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `id_agent` (`id_agent`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse`, `email`, `telephone`, `mot_de_passe`, `id_agent`) VALUES
(1, 'Doe', 'John', 'john@example.com', 'password123', '1234567890', '123 Main St', 1),
(2, 'Doe', 'John', 'john@example.com', 'password123', '1234567890', '123 Main St', 2),
(3, 'Doe', 'John', 'john@doe.com', 'password123', '1234567890', '123 Main St', 3),
(4, 'Doe', 'John', 'john@doe.com', 'password123', '1234567890', '123 Main St', 4);

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id_location` int NOT NULL,
  `id_propriete` int NOT NULL,
  `id_client` int NOT NULL,
  `id_agent` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  KEY `id_propriete` (`id_propriete`),
  KEY `id_client` (`id_client`),
  KEY `id_agent` (`id_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `id_manager` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id_manager`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `moyen_paiement`
--

DROP TABLE IF EXISTS `moyen_paiement`;
CREATE TABLE IF NOT EXISTS `moyen_paiement` (
  `id_moyen_paiement` int NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_moyen_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `moyen_paiement`
--

INSERT INTO `moyen_paiement` (`id_moyen_paiement`, `Libelle`) VALUES
(1, 'espece'),
(2, 'paiement mobile'),
(3, 'cheque'),
(4, 'credit');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiement` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `id_propriete` int NOT NULL,
  `id_type_paiement` int NOT NULL,
  `id_bailleur` int NOT NULL,
  `montant` float NOT NULL,
  `date_paiement` date NOT NULL,
  PRIMARY KEY (`id_paiement`),
  KEY `id_client` (`id_client`),
  KEY `id_propriete` (`id_propriete`),
  KEY `id_type_paiement` (`id_type_paiement`),
  KEY `id_bailleur` (`id_bailleur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `propriete`
--

DROP TABLE IF EXISTS `propriete`;
CREATE TABLE IF NOT EXISTS `propriete` (
  `id_propiete` int NOT NULL AUTO_INCREMENT,
  `id_type` int NOT NULL,
  `etat` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `opt` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `situation_geo` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `id_bailleur` int NOT NULL,
  `date_ajout` date NOT NULL,
  PRIMARY KEY (`id_propiete`),
  KEY `id_bailleur` (`id_bailleur`),
  KEY `id_type` (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `propriete`
--

INSERT INTO `propriete` (`id_propiete`, `id_type`, `etat`, `opt`, `situation_geo`, `prix`, `image1`, `image2`, `image3`, `descriptions`, `id_bailleur`, `date_ajout`) VALUES
(1, 1, 'libre', 'Vente', 'Rue 34.01, Zone Résidentielle, Ouaga 2000, Ouagadougou, Burkina Faso', 139750000, 'img_682f3b20bbabf9.57215270.jpg', 'img_682f3b20bbc429.15579442.jpg', 'img_682f3b20bbd758.89170264.jpg', 'À vendre – Charmante maison mitoyenne 4 pièces – Quartier calme et recherché\n\nSituée dans un environnement paisible à proximité des écoles, commerces et transports, cette belle maison mitoyenne de 90 m² offre un cadre de vie idéal pour une famille.\n\nAu rez-de-chaussée, vous découvrirez une pièce de vie lumineuse avec salon et salle à manger ouverte sur une cuisine moderne équipée. À l’étage, trois chambres confortables, une salle de bains et des rangements bien pensés.\n\nVous profiterez également d’un jardin privatif sans vis-à-vis, parfait pour vos moments de détente, ainsi que d’un garage attenant.\n\n✅ Double vitrage\n✅ Chauffage central\n✅ Aucun travaux à prévoir', 2, '2025-05-01'),
(2, 5, 'libre', 'location', 'Rue 12.45, Quartier Zone du Bois, Ouaga 2000, Ouagadougou, Burkina Faso', 450000, 'img_6830cd31eab113.49814667.jpg', 'img_6830cd31ead2e8.29689418.jpg', 'img_6830cd31eaf265.72749555.jpg', 'Offrez-vous le confort d’une belle duplexe moderne située dans un quartier résidentiel calme, sécurisé et bien desservi à Ouaga 2000. Cette propriété spacieuse est idéale pour une famille ou un professionnel recherchant confort, tranquillité et proximité avec les commodités.\r\nSuperficie totale : 320 m²\r\n\r\nNombre de pièces : 5\r\n\r\nChambres : 4 chambres climatisées avec placards intégrés\r\n\r\nSalon : Grand séjour lumineux avec baie vitrée\r\n\r\nCuisine : Cuisine moderne équipée (plaque, four, rangements)\r\n\r\nSalles d’eau : 3 salles de bain + toilettes visiteurs\r\n\r\nBalcon : Oui\r\n\r\nGarage : 2 voitures\r\n\r\nJardin : Petit jardin arboré + espace de détente', 3, '2025-05-23');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `id_propriete` int DEFAULT NULL,
  `date_rdv` date DEFAULT NULL,
  `id_statut` int DEFAULT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `id_client` (`id_client`),
  KEY `id_propriete` (`id_propriete`),
  KEY `id_statut` (`id_statut`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `statut_rendezvous`
--

DROP TABLE IF EXISTS `statut_rendezvous`;
CREATE TABLE IF NOT EXISTS `statut_rendezvous` (
  `id_statut` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(20) NOT NULL,
  PRIMARY KEY (`id_statut`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `statut_rendezvous`
--

INSERT INTO `statut_rendezvous` (`id_statut`, `statut`) VALUES
(1, 'Annule'),
(2, 'Confirme'),
(3, 'Confirme'),
(4, 'reporter');

-- --------------------------------------------------------

--
-- Structure de la table `type_paiement`
--

DROP TABLE IF EXISTS `type_paiement`;
CREATE TABLE IF NOT EXISTS `type_paiement` (
  `id_type_paiement` int NOT NULL AUTO_INCREMENT,
  `id_moyen_paiement` int NOT NULL,
  PRIMARY KEY (`id_type_paiement`),
  KEY `id_moyen_paiement` (`id_moyen_paiement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_propriete`
--

DROP TABLE IF EXISTS `type_propriete`;
CREATE TABLE IF NOT EXISTS `type_propriete` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

--
-- Déchargement des données de la table `type_propriete`
--

INSERT INTO `type_propriete` (`id_type`, `libelle`) VALUES
(1, 'Maison mitoyenne'),
(2, 'Appartement'),
(3, 'Villa'),
(4, 'Studio'),
(5, 'Duplex');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
