-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 mai 2024 à 10:56
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcadiatest`
--

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state_id` int DEFAULT NULL,
  `breed_id` int NOT NULL,
  `habitat_id` int NOT NULL,
  `feed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `feed_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `animals_ibfk_2` (`habitat_id`),
  KEY `animals_ibfk_1` (`breed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animals`
--

INSERT INTO `animals` (`id`, `name`, `state_id`, `breed_id`, `habitat_id`, `feed`, `feed_date`) VALUES
(31, 'Joris', NULL, 2, 2, NULL, NULL),
(32, 'Kevin', NULL, 1, 2, NULL, NULL),
(33, 'Henri', NULL, 2, 2, 'Viande hachée, 180g', '2024-05-15 10:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `animal_reports`
--

DROP TABLE IF EXISTS `animal_reports`;
CREATE TABLE IF NOT EXISTS `animal_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state_detail` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `food` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `animal_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `animal_id` (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal_reports`
--

INSERT INTO `animal_reports` (`id`, `date`, `state`, `state_detail`, `food`, `user_id`, `animal_id`) VALUES
(10, '2024-05-14', 'Bonne santé', 'Il semble heureux', 'viande rouge, 200g', 2, 33);

-- --------------------------------------------------------

--
-- Structure de la table `breeds`
--

DROP TABLE IF EXISTS `breeds`;
CREATE TABLE IF NOT EXISTS `breeds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `breeds`
--

INSERT INTO `breeds` (`id`, `name`) VALUES
(1, 'lion'),
(2, 'tigre'),
(3, 'crocodile'),
(4, 'giraffe');

-- --------------------------------------------------------

--
-- Structure de la table `habitats`
--

DROP TABLE IF EXISTS `habitats`;
CREATE TABLE IF NOT EXISTS `habitats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note_detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `title`, `content`, `note_detail`, `note`) VALUES
(1, 'jungle', 'Plongez dans la jungle, un monde luxuriant et mystérieux où la vie déborde dans une explosion de couleurs et de mouvements. Explorez ses sentiers sinueux, émerveillez-vous devant la richesse de sa biodiversité, des félins furtifs aux singes espiègles.', NULL, 0),
(2, 'Savane', 'Explorez la savane, un paysage majestueux où la vie s&#039;épanouit sous un ciel infini. De lions majestueux à des troupeaux d&#039;antilopes élégants, chaque moment révèle la beauté brute de la nature. Venez découvrir la magie de la savane avec nous...', NULL, 0),
(3, 'marais', 'Immergez-vous dans les marais, un écosystème mystérieux où la vie prospère dans un paysage tranquille et serein. Découvrez une biodiversité fascinante, des oiseaux élégants aux grenouilles agiles. Rejoignez-nous pour découvrir la magie des marais.', 'cool', 4);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` int UNSIGNED NOT NULL,
  `status` enum('published','pending','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `nickname`, `content`, `note`, `status`) VALUES
(1, 'Steve Johnson', 'Une expérience incroyable au Zoo Arcadia ! J\'ai adoré explorer les différents habitats et rencontrer les animaux fascinants. Le personnel était extrêmement sympathique et compétent, et l\'engagement envers l\'écologie est vraiment inspirant. Je recommande vivement cette expérience à tous les amoureux de la nature !', 5, 'published'),
(2, 'Anna Lee', 'Une journée inoubliable au Zoo Arcadia ! La visite guidée était très informative et divertissante. Les habitats sont bien aménagés et les animaux semblent très bien pris en charge. Je suis particulièrement impressionné par l\'engagement écologique du zoo. Je reviendrai certainement et je le recommande à tous ceux qui recherchent une expérience enrichissante en plein air.', 5, 'published'),
(4, 'Marc Talot', 'Une journée fantastique à Arcadia ! Les habitats étaient superbes et bien entretenus, les animaux semblaient heureux et en bonne santé. Les guides étaient très instructifs et sympathiques. L\'engagement envers l\'écologie est admirable. Je recommande vivement cette expérience !', 4, 'published'),
(5, 'Pauline Lefebvre', 'Une expérience incroyable ! Le Zoo Arcadia est un endroit magique où j\'ai passé une journée inoubliable en famille. Les animaux sont magnifiques et bien soignés, et les habitats sont très bien conçus. Nous avons particulièrement apprécié la visite guidée qui était informative et divertissante. C\'est un endroit idéal pour les amoureux de la nature de tous âges. Nous reviendrons certainement !', 5, 'published'),
(6, 'Jean Dupont', 'Le Zoo Arcadia est un véritable joyau de la région ! J\'y suis allé avec mes enfants et nous avons passé une journée extraordinaire. Les animaux sont en excellente santé et les habitats sont très bien entretenus. Nous avons également beaucoup apprécié la visite guidée, très instructive et interactive. Une expérience à ne pas manquer !', 4, 'published'),
(7, 'Sophie Martin', 'Une journée inoubliable au Zoo Arcadia ! Les animaux sont magnifiques et semblent très bien traités. Les installations sont propres et bien entretenues, et le personnel est très accueillant. La visite guidée était très intéressante, nous avons beaucoup appris sur les différentes espèces. Je recommande vivement cette expérience à tous les amoureux de la nature !', 3, 'published'),
(8, 'Pierre Dubois', 'Le Zoo Arcadia est un lieu exceptionnel pour passer une journée en famille. Les enfants ont adoré découvrir les différents animaux et en apprendre davantage sur eux grâce à la visite guidée. Les habitats sont spacieux et bien aménagés, et l\'ambiance générale du zoo est très agréable. Une expérience enrichissante pour petits et grands !', 1, 'published');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'veterinaire'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `about` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `title`, `about`, `content`) VALUES
(1, 'restaurant', 'Gastronome', 'Succombez à une expérience culinaire exceptionnelle dans l\'un de nos restaurants. Chacun de nos restaurants vous propose une cuisine et un cadre uniques, mettant en valeur des ingrédients frais et locaux. Venez savourer une escapade gustative inoubliable.'),
(2, 'train', 'Voyageur', 'Embarquez pour une aventure captivante avec notre Tour en Petit Train. Laissez-vous conduire à travers les merveilles de notre zoo dans le confort de notre train pittoresque. Découvrez la beauté de notre faune et de notre flore avec des commentaires informatifs de nos guides expérimentés. Rejoignez-nous pour une exploration mémorable de la nature.'),
(3, 'visite', 'Curieux', 'Plongez dans une expérience immersive avec notre Visite Guidée Gratuite. Laissez-vous guider à travers les merveilles de notre zoo par nos experts passionnés. Découvrez la richesse de notre faune, des majestueux lions aux curieux singes, dans un cadre naturel exceptionnel. Rejoignez-nous pour une exploration inoubliable de la nature.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`) VALUES
(1, 'user@test.fr', '$2y$10$mKNpWkS1FdRsDN1dNrbD1OAUtOcEgOLddyX85AkvCh.n9GUntoaKO', 1),
(2, 'veto@veto.fr', '$2y$10$D7nS0YtHYWEx9SWQylsSSu6jdr4MYaQ9yo9dZvxgm4keH/u6M2dji', 2),
(5, 'employe@employe.fr', '$2y$10$16RpOMgpIfMLoz5NmnPpo.U0gyGz3J2QM7zIxh9SE18jMUN/aFCiy', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breeds` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `animals_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `animals_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `animal_reports` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `animal_reports`
--
ALTER TABLE `animal_reports`
  ADD CONSTRAINT `animal_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `animal_reports_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
