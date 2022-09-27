-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 sep. 2022 à 14:07
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
  `author` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `author`, `post_id`, `content`, `status`, `comment_date`) VALUES
(2, 0, 'Sam', 1, 'Quelqu\'un a un avis là-dessus ? Je ne sais pas quoi en penser.', 0, '2022-03-03 13:01:42'),
(3, 0, 'Sam', 2, 'Commentaire', 0, '2022-05-26 18:52:27'),
(4, 0, 'Sam', 1, 'J\'écris un nouveau commentaire', 0, '2022-05-26 18:52:38'),
(5, 0, 'Sam', 1, 'Sympa ce blog !', 0, '2022-05-26 18:53:56'),
(10, 0, 'Sam', 1, 'Test de commentaire\r\n', 0, '2022-06-17 15:29:54'),
(11, 0, 'Diane', 1, '\r\n  $commentRepository->connection = new DatabaseConnection();', 0, '2022-06-22 23:08:46'),
(17, 0, 'Sam', 1, 'Code refactorisé', 0, '2022-06-22 23:52:15'),
(35, 0, 'Diane', 1, 'Preum\'s', 0, '2022-03-03 13:00:42'),
(44, 1, 'Tom', 2, 'Bonjour', 1, '2022-09-23 13:46:24'),
(45, 1, 'Admin', 2, 'Ceci est un test\r\n', 1, '2022-09-23 13:46:34'),
(46, 1, 'Administrateur', 2, 'Je suis l\'admin', 1, '2022-09-23 13:46:41'),
(47, 1, 'Qui ?', 2, 'Bla bla bla', 1, '2022-09-23 13:46:51'),
(48, 1, 'Thierry', 2, 'Comment allez-vous ?', 1, '2022-09-23 13:47:06'),
(49, 1, 'Frédéric', 2, 'Je suis Frédéric', 1, '2022-09-23 13:47:15'),
(50, 1, 'Auteur', 2, 'Commentaire', 1, '2022-09-23 14:07:28');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`, `status`) VALUES
(1, 0, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41', '2022-09-08 14:31:41', 0),
(2, 0, 'L\'AVBN à la conquête du monde !', 'C\'est officiel, le club a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"Association de VolleyBall de Nuelly\". Pas dur, ceci dit entre nous...', '2022-02-17 16:28:42', '2022-09-08 14:31:41', 0),
(3, 1, 'Mon nouvel article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sapien leo, feugiat ut imperdiet in, tempus sit amet libero. Fusce sed nibh nec lorem hendrerit volutpat. Etiam tempor auctor tristique. Nunc tristique viverra porta. Fusce tortor orci, pretium eu eros quis, tempus varius eros. Mauris tristique, magna ac venenatis ornare, leo nunc fringilla risus, a ultricies eros risus ut est. Cras eleifend aliquam libero, in sodales lacus cursus vel. Quisque vehicula odio ut risus vehicula hendrerit. Integer massa est, volutpat eu leo in, bibendum porttitor mauris. Sed ullamcorper, nulla nec eleifend tincidunt, elit libero imperdiet arcu, vitae aliquet dui felis id nibh. Sed aliquet, elit id bibendum consequat, turpis urna lacinia nibh, quis suscipit risus nibh sed ligula.', '2022-09-23 13:14:12', '2022-09-23 13:14:12', 0),
(7, 1, 'Ceci est un nouvel article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sapien leo, feugiat ut imperdiet in, tempus sit amet libero. Fusce sed nibh nec lorem hendrerit volutpat. Etiam tempor auctor tristique. Nunc tristique viverra porta. Fusce tortor orci, pretium eu eros quis, tempus varius eros. Mauris tristique, magna ac venenatis ornare, leo nunc fringilla risus, a ultricies eros risus ut est.', '2022-09-23 15:35:00', '2022-09-23 15:35:00', 1),
(8, 1, 'Titre de l\'article', 'string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status ', '2022-09-23 15:35:55', '2022-09-23 15:35:55', 1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`) VALUES
(1, 'Thierry', 'test@test.com', 'Admin', '123456'),
(2, 'Robert', 'email@email.com', 'User', '1'),
(3, 'Christophe', 'email@email.fr', 'User', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
