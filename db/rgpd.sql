-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `adminusers`;
CREATE TABLE `adminusers` (
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `adminusers` (`UserName`, `Password`, `Name`) VALUES
('Caro',	'321456',	'Caro Merran'),
('eric',	'321456',	'gggg');

DROP TABLE IF EXISTS `audits-1`;
CREATE TABLE `audits-1` (
  `SIRET` varchar(14) NOT NULL,
  `Q15` varchar(5) NOT NULL,
  `Q16` bit(1) NOT NULL,
  `Q16_1` varchar(250) NOT NULL,
  `Q16_2` bit(1) NOT NULL,
  `Q16_2_1` varchar(250) NOT NULL,
  `Q16_2_2` text NOT NULL,
  `Q16_2_3` bit(1) NOT NULL,
  `Q16_2_4` text NOT NULL,
  `Q16_3` bit(1) NOT NULL,
  `Q16_3_1` varchar(250) NOT NULL,
  `Q16_4` varchar(100) NOT NULL,
  `Q16_5` varchar(100) NOT NULL,
  `Q17` varchar(100) NOT NULL,
  `Q18` bit(1) NOT NULL,
  `Q18_1` varchar(250) NOT NULL,
  `Q18_2` text NOT NULL,
  `Q18_3` varchar(25) NOT NULL,
  `Q18_3_1` bit(1) NOT NULL,
  `Q18_3_2` bit(1) NOT NULL,
  `Q18_4` varchar(200) NOT NULL,
  `Q18_5` bit(1) NOT NULL,
  `Q18_5_1` varchar(100) NOT NULL,
  `Q18_5_2` bit(1) NOT NULL,
  `Q18_5_3` varchar(100) NOT NULL,
  `Q19` bit(1) NOT NULL,
  `Q19_1` varchar(100) NOT NULL,
  `Q19_2` varchar(100) NOT NULL,
  `Q19_3` text NOT NULL,
  `Q19_4` bit(1) NOT NULL,
  `Q19_4_1` bit(1) NOT NULL,
  `Q19_4_2` bit(1) NOT NULL,
  `Q19_4_3` bit(1) NOT NULL,
  `Q19_4_3_1` varchar(100) NOT NULL,
  `Q19_5` varchar(200) NOT NULL,
  `Q19_6` bit(1) NOT NULL,
  `Q19_6_1` varchar(200) NOT NULL,
  `Q19_6_2` bit(1) NOT NULL,
  `Q19_6_3` varchar(100) NOT NULL,
  `Q20` bit(1) NOT NULL,
  `Q20_1` text NOT NULL,
  `Q20_2` text NOT NULL,
  PRIMARY KEY (`SIRET`),
  CONSTRAINT `audits-1_ibfk_1` FOREIGN KEY (`SIRET`) REFERENCES `clients` (`SIRET`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `audits-2`;
CREATE TABLE `audits-2` (
  `SIRET` varchar(14) NOT NULL,
  `Q21` bit(1) NOT NULL,
  `Q22` bit(1) NOT NULL,
  `Q22_1` bit(1) NOT NULL,
  `Q22_1_1` text NOT NULL,
  `Q22_2` varchar(100) NOT NULL,
  `Q22_3` varchar(100) NOT NULL,
  `Q23` bit(1) NOT NULL,
  `Q24` bit(1) NOT NULL,
  `Q25` bit(1) NOT NULL,
  `Q25_1` varchar(100) NOT NULL,
  `Q26` varchar(100) NOT NULL,
  `Q27` text NOT NULL,
  `Q28` bit(1) NOT NULL,
  `Q28_1` bit(1) NOT NULL,
  `Q29` bit(1) NOT NULL,
  `Q31` varchar(100) NOT NULL,
  `Q32` varchar(250) NOT NULL,
  `Q33` varchar(20) NOT NULL,
  `Q34` varchar(100) NOT NULL,
  `Q35` bit(1) NOT NULL,
  `Q36` varchar(30) NOT NULL,
  PRIMARY KEY (`SIRET`),
  CONSTRAINT `audits-2_ibfk_1` FOREIGN KEY (`SIRET`) REFERENCES `clients` (`SIRET`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `SIRET` varchar(14) NOT NULL,
  `Regie_id` int(11) NOT NULL,
  `Denomination` varchar(50) NOT NULL,
  `Adresse` varchar(120) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Pays` varchar(50) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  `Nom` varchar(30) DEFAULT NULL,
  `Prenom` varchar(30) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY (`SIRET`),
  KEY `Regie_id` (`Regie_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`Regie_id`) REFERENCES `regies` (`Regie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `clients` (`SIRET`, `Regie_id`, `Denomination`, `Adresse`, `Zip`, `Ville`, `Pays`, `DateCreation`, `Nom`, `Prenom`, `email`) VALUES
('12345',	415,	'chez joe',	'hamahteret 30, pob 9136',	'40500',	'Even Yehuda',	'Israel',	NULL,	'Eric Merran',	'Eric',	'eric.merran@gmail.com'),
('456789',	415,	'chez joepp',	'hamahteret 30, pob 9136',	'40500',	'Even Yehuda',	'Israel',	NULL,	'Eric Merran',	'Eric',	'eric.merran@gmail.com');

DROP TABLE IF EXISTS `factures`;
CREATE TABLE `factures` (
  `SIRET` varchar(14) NOT NULL,
  `Facture_id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Produit` varchar(120) DEFAULT NULL,
  `PrixHT` varchar(10) DEFAULT NULL,
  `PrixTTC` varchar(10) NOT NULL,
  `Status_id` int(11) NOT NULL,
  PRIMARY KEY (`Facture_id`),
  KEY `SIRET` (`SIRET`),
  KEY `Status_id` (`Status_id`),
  CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`SIRET`) REFERENCES `clients` (`SIRET`),
  CONSTRAINT `factures_ibfk_3` FOREIGN KEY (`Status_id`) REFERENCES `status` (`Status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `factures` (`SIRET`, `Facture_id`, `Date`, `Produit`, `PrixHT`, `PrixTTC`, `Status_id`) VALUES
('12345',	5000,	'2018-11-05',	'registre',	'450',	'500',	1),
('12345',	5001,	'2018-11-08',	'registre',	'450',	'550',	2),
('456789',	5003,	'2018-11-12',	NULL,	'500',	'600',	3);

DROP TABLE IF EXISTS `regies`;
CREATE TABLE `regies` (
  `Regie_id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  PRIMARY KEY (`Regie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `regies` (`Regie_id`, `Name`) VALUES
(415,	'test 12'),
(512,	'test 2');

DROP TABLE IF EXISTS `regieusers`;
CREATE TABLE `regieusers` (
  `Regie_id` int(11) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UserName`),
  KEY `Regie_id` (`Regie_id`),
  CONSTRAINT `regieusers_ibfk_1` FOREIGN KEY (`Regie_id`) REFERENCES `regies` (`Regie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `regieusers` (`Regie_id`, `UserName`, `Password`, `Name`) VALUES
(415,	'reguser',	'321456',	'0');

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `Status_id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) NOT NULL,
  PRIMARY KEY (`Status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `status` (`Status_id`, `Nom`) VALUES
(1,	'Payée'),
(2,	'Annulée'),
(3,	'Attente');

-- 2018-11-25 03:23:01
