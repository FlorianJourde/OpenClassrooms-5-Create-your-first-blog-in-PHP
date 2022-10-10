-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 oct. 2022 à 00:02
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `florianjourde`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `status`, `creation_date`) VALUES
(4, 2, 1, 'J\'écris un nouveau commentaire', 0, '2022-05-26 18:52:38'),
(5, 2, 1, 'Sympa ce blog !', 1, '2022-05-26 18:53:56'),
(10, 2, 1, 'Contenu de l\'articleee', 1, '2022-06-17 15:29:54'),
(11, 2, 1, '\r\n  $commentRepository->connection = new DatabaseConnection();', 1, '2022-06-22 23:08:46'),
(17, 2, 1, 'Code refactoriséddcdc', 1, '2022-06-22 23:52:15'),
(35, 2, 1, 'Preum\'s', 1, '2022-03-03 13:00:42'),
(56, 1, 9, 'ok', 1, '2022-09-27 22:17:44'),
(57, 1, 9, 'ok', 1, '2022-09-27 22:17:46'),
(106, 1, 24, 'bla bla bla', 1, '2022-10-07 15:00:12'),
(107, 1, 24, 'Un nouveau commentaire est apparaît sur le blog !', 1, '2022-10-07 15:00:25'),
(108, 1, 25, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum dolor, varius eu tortor et, iaculis convallis magna. Etiam a nulla eu justo rutrum suscipit. Vestibulum sit amet turpis in ipsum bibendum scelerisque. In hac habitasse platea dictumst.', 1, '2022-10-07 15:02:25'),
(109, 1, 25, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum dolor, varius eu tortor et, iaculis convallis magna. Etiam a nulla eu justo rutrum suscipit. Vestibulum sit amet turpis in ipsum bibendum scelerisque. In hac habitasse platea dictumst. Mauris mollis dolor quis est gravida auctor. Sed condimentum vestibulum leo, dapibus vulputate enim porttitor sed. Sed non nulla sed odio consectetur ornare vel in est.', 1, '2022-10-07 15:02:29'),
(110, 1, 25, 'Mauris mollis dolor quis est gravida auctor. Sed condimentum vestibulum leo, dapibus vulputate enim porttitor sed. Sed non nulla sed odio consectetur ornare vel in est. Vivamus imperdiet, sapien eu venenatis lobortis, eros risus eleifend augue, non aliquet velit turpis blandit nisl. Duis feugiat mollis purus eu posuere. Pellentesque malesuada ut justo a pretium.', 1, '2022-10-07 15:02:35'),
(111, 1, 25, 'Commentaire !', 1, '2022-10-07 15:02:43'),
(112, 1, 24, 'C\'est ça, le nouvel article ?', 0, '2022-10-07 20:20:12'),
(113, 1, 25, 'Ajout d\'un commentaire', 0, '2022-10-07 20:22:24'),
(114, 1, 25, 'Ajout d\'un commentaire', 0, '2022-10-07 20:22:46'),
(115, 1, 25, 'sdcsdcdc', 1, '2022-10-07 20:23:26'),
(116, 1, 25, 'Bonjour', 1, '2022-10-07 20:24:21'),
(117, 1, 25, 'Ok ok ok', 1, '2022-10-07 20:24:55'),
(118, 1, 25, 'dfvdsfvsfdv', 0, '2022-10-07 20:25:07'),
(119, 1, 25, 'dfvdsfvsfdv', 1, '2022-10-07 20:27:36'),
(120, 1, 25, 'dfvdfvfdv', 1, '2022-10-07 20:27:40');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`, `status`, `image`) VALUES
(1, 2, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41', '2022-09-08 14:31:41', 0, NULL),
(23, 1, 'Titre de l\'article', 'Contenu', '2022-10-07 11:26:32', '2022-10-07 11:26:32', 1, '633ff0c84ae012.53960942.jpg'),
(24, 1, 'Un nouvel article apparaît sur le blog !', 'Voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu... voici son contenu........', '2022-10-07 15:00:02', '2022-10-07 15:00:02', 1, '634022d2c9c967.04720386.jpg'),
(25, 1, 'Article avec image', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum dolor, varius eu tortor et, iaculis convallis magna. Etiam a nulla eu justo rutrum suscipit. Vestibulum sit amet turpis in ipsum bibendum scelerisque. In hac habitasse platea dictumst. Mauris mollis dolor quis est gravida auctor. Sed condimentum vestibulum leo, dapibus vulputate enim porttitor sed. Sed non nulla sed odio consectetur ornare vel in est. Vivamus imperdiet, sapien eu venenatis lobortis, eros risus eleifend augue, non aliquet velit turpis blandit nisl. Duis feugiat mollis purus eu posuere. Pellentesque malesuada ut justo a pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum dolor, varius eu tortor et, iaculis convallis magna. Etiam a nulla eu justo rutrum suscipit. Vestibulum sit amet turpis in ipsum bibendum scelerisque. In hac habitasse platea dictumst. Mauris mollis dolor quis est gravida auctor. Sed condimentum vestibulum leo, dapibus vulputate enim porttitor sed. Sed non nulla sed odio consectetur ornare vel in est. Vivamus imperdiet, sapien eu venenatis lobortis, eros risus eleifend augue, non aliquet velit turpis blandit nisl. Duis feugiat mollis purus eu posuere. Pellentesque malesuada ut justo a pretium.', '2022-10-07 15:02:13', '2022-10-07 15:02:13', 1, '634023558d8f27.34258472.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `token`) VALUES
(1, 'Thierry', 'email@email.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', '29fddbb41bf72b4f92cd77b97cd01e64'),
(2, 'Robert', 'test@test.com', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(3, 'Christophe', 'email@email.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(4, 'Gérard', 'test@test.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
