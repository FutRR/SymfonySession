-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour symfonysessionfutterer
CREATE DATABASE IF NOT EXISTS `symfonysessionfutterer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `symfonysessionfutterer`;

-- Listage de la structure de table symfonysessionfutterer. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.categorie : ~4 rows (environ)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
	(1, 'Back-End'),
	(2, 'Front-End'),
	(3, 'Design'),
	(4, 'Traitement');

-- Listage de la structure de table symfonysessionfutterer. formateur
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_formateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_formateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.formateur : ~3 rows (environ)
DELETE FROM `formateur`;
INSERT INTO `formateur` (`id`, `nom_formateur`, `prenom_formateur`, `email_formateur`) VALUES
	(1, 'Murmann', 'Mickael', 'm.murmann@test.fr'),
	(2, 'Mathieu', 'Quentin', 'q.mathieu@test.fr'),
	(3, 'Smail', 'Stéphane', 's.smail@test.fr');

-- Listage de la structure de table symfonysessionfutterer. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre_formation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.formation : ~3 rows (environ)
DELETE FROM `formation`;
INSERT INTO `formation` (`id`, `titre_formation`) VALUES
	(1, 'Développement Web'),
	(2, 'Bureautique'),
	(4, 'Esthétique'),
	(10, 'Commerce');

-- Listage de la structure de table symfonysessionfutterer. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.messenger_messages : ~0 rows (environ)
DELETE FROM `messenger_messages`;

-- Listage de la structure de table symfonysessionfutterer. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int NOT NULL,
  `unite_id` int NOT NULL,
  `nb_jours` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  KEY `IDX_3DDCB9FFEC4A74AB` (`unite_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFEC4A74AB` FOREIGN KEY (`unite_id`) REFERENCES `unite` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.programme : ~4 rows (environ)
DELETE FROM `programme`;
INSERT INTO `programme` (`id`, `session_id`, `unite_id`, `nb_jours`) VALUES
	(2, 2, 3, 20),
	(3, 2, 1, 50),
	(4, 2, 2, 40),
	(6, 3, 9, 5),
	(25, 16, 8, 30);

-- Listage de la structure de table symfonysessionfutterer. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int NOT NULL,
  `formateur_id` int NOT NULL,
  `nom_session` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `nb_places` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  KEY `IDX_D044D5D4155D8F51` (`formateur_id`),
  CONSTRAINT `FK_D044D5D4155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.session : ~4 rows (environ)
DELETE FROM `session`;
INSERT INTO `session` (`id`, `formation_id`, `formateur_id`, `nom_session`, `date_debut`, `date_fin`, `nb_places`, `description`) VALUES
	(1, 1, 2, 'Initiation PHP', '2024-04-29 08:30:00', '2024-05-11 17:00:00', 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse semper laoreet enim, in sodales ligula malesuada id. Nam consectetur dapibus.'),
	(2, 1, 1, 'Full-Stack Avancé', '2024-05-13 08:30:00', '2025-01-11 17:00:00', 15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse semper laoreet enim, in sodales ligula malesuada id. Nam consectetur dapibus.'),
	(3, 2, 3, 'Initiation Photoshop', '2024-04-29 08:30:00', '2024-05-04 17:00:00', 4, 'photoshop'),
	(12, 4, 2, 'Initiation JeSaisPasDuTout', '2024-06-10 08:30:00', '2024-06-19 17:00:00', 0, 'jsp'),
	(16, 10, 3, 'Initiation Vente au détail', '2024-07-11 09:00:00', '2024-09-06 17:00:00', 28, 'vente');

-- Listage de la structure de table symfonysessionfutterer. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_stagiaire` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_stagiaire` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_stagiaire` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.stagiaire : ~3 rows (environ)
DELETE FROM `stagiaire`;
INSERT INTO `stagiaire` (`id`, `nom_stagiaire`, `prenom_stagiaire`, `email_stagiaire`, `date_naissance`, `telephone`, `ville`) VALUES
	(1, 'FUTTERER', 'Maxime', 'futterermaxime@gmail.com', '2000-08-29', '06 52 39 73 60', 'Strasbourg'),
	(2, 'Test', 'Testeur', 'test@test.test', '1997-08-10', NULL, NULL),
	(3, 'Fouzi', 'Riyad', 'riyadfouzi@gmail.com', '2001-02-21', NULL, 'Montbéliard');

-- Listage de la structure de table symfonysessionfutterer. stagiaire_session
CREATE TABLE IF NOT EXISTS `stagiaire_session` (
  `stagiaire_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`session_id`),
  KEY `IDX_D32D02D4BBA93DD6` (`stagiaire_id`),
  KEY `IDX_D32D02D4613FECDF` (`session_id`),
  CONSTRAINT `FK_D32D02D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D32D02D4BBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.stagiaire_session : ~7 rows (environ)
DELETE FROM `stagiaire_session`;
INSERT INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 3),
	(1, 12),
	(1, 16),
	(2, 1),
	(2, 3),
	(3, 2),
	(3, 3),
	(3, 12),
	(3, 16);

-- Listage de la structure de table symfonysessionfutterer. unite
CREATE TABLE IF NOT EXISTS `unite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_unite` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D64C118BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_unite_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.unite : ~10 rows (environ)
DELETE FROM `unite`;
INSERT INTO `unite` (`id`, `nom_unite`, `categorie_id`) VALUES
	(1, 'PHP', 1),
	(2, 'SQL', 1),
	(3, 'CSS', 2),
	(4, 'HTML', 2),
	(6, 'JavaScript', 2),
	(7, 'Word', 4),
	(8, 'Excel', 4),
	(9, 'Photoshop', 3),
	(10, 'Illustrator', 3),
	(11, 'inDesign', 3);

-- Listage de la structure de table symfonysessionfutterer. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_utilisateur` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL_UTILISATEUR` (`email_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table symfonysessionfutterer.user : ~2 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `email_utilisateur`, `roles`, `password`, `role`) VALUES
	(1, 'exemple@exemple.com', '["ROLE_ADMIN"]', '$2y$13$KWFqs9veYinG4y7j5p.ZneOVMrFuI2GAOBASFs5VCankUdKRo2tey', NULL),
	(2, 'guest@test.fr', '[]', '$2y$13$SpMRrakNTIkSb3KzGA21P.gVlNsEav7k4K3hA/K/PW7S7MN4f8M/O', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
