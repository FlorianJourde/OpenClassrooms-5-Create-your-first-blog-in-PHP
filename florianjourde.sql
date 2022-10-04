-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 oct. 2022 à 15:23
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

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
  `status` tinyint(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `status`, `creation_date`) VALUES
(3, 3, 2, 'Commentaires', 0, '2022-05-26 18:52:27'),
(4, 2, 1, 'J\'écris un nouveau commentaire', 0, '2022-05-26 18:52:38'),
(5, 2, 1, 'Sympa ce blog !', 1, '2022-05-26 18:53:56'),
(10, 2, 1, 'Contenu de l\'articleee', 1, '2022-06-17 15:29:54'),
(11, 2, 1, '\r\n  $commentRepository->connection = new DatabaseConnection();', 1, '2022-06-22 23:08:46'),
(17, 2, 1, 'Code refactoriséddcdc', 1, '2022-06-22 23:52:15'),
(35, 2, 7, 'Preum\'s', 0, '2022-03-03 13:00:42'),
(44, 1, 2, 'Bonjour', 1, '2022-09-23 13:46:24'),
(45, 1, 7, 'Ceci est un test\r\n', 1, '2022-09-23 13:46:34'),
(47, 1, 2, 'Bla bla bla', 1, '2022-09-23 13:46:51'),
(48, 1, 2, 'Comment allez-vous ?', 1, '2022-09-23 13:47:06'),
(49, 1, 2, 'Je suis Frédéricc', 1, '2022-09-23 13:47:15'),
(50, 1, 2, 'Commentaire', 1, '2022-09-23 14:07:28'),
(51, 1, 8, 'Commentaires', 1, '2022-09-23 16:16:55'),
(52, 1, 8, 'Qui suis-je ?', 1, '2022-09-26 22:49:14'),
(56, 1, 9, 'ok', 1, '2022-09-27 22:17:44'),
(57, 1, 9, 'ok', 1, '2022-09-27 22:17:46'),
(61, 1, 11, 'Commentaire', 1, '2022-09-27 23:27:11'),
(62, 1, 8, 'Commentaire d\'essai', 1, '2022-09-29 12:45:01'),
(64, 1, 11, 'comm', 1, '2022-09-30 00:00:08'),
(65, 1, 14, 'Premier commentaire', 1, '2022-09-30 01:23:46'),
(66, 1, 14, 'Deuxième commentaire', 1, '2022-09-30 01:23:53'),
(67, 2, 14, 'Suis-je authentifié ?', 1, '2022-09-30 01:24:22'),
(68, 1, 15, 'commentairessss', 1, '2022-09-30 01:32:51'),
(72, 2, 15, 'Commentaire de Robertss', 1, '2022-09-30 01:43:35'),
(75, 1, 15, 'sdcdsc', 1, '2022-09-30 01:55:55'),
(77, 2, 15, 'sdccdssdc', 1, '2022-09-30 02:28:41'),
(78, 1, 15, 'dfvdfvfv', 0, '2022-09-30 12:21:17'),
(79, 1, 16, 'Commentaire', 1, '2022-09-30 13:17:00'),
(80, 1, 16, 'comm', 1, '2022-09-30 13:17:07'),
(81, 1, 16, 'comsdcsdcdsc', 1, '2022-09-30 13:17:58'),
(82, 1, 16, 'dsdvdvfd', 1, '2022-09-30 13:18:00'),
(83, 1, 16, 'dfvdfdsdcdfv', 1, '2022-09-30 13:18:20'),
(87, 1, 7, 'DSSDCDSC', 0, '2022-09-30 13:32:25'),
(88, 1, 7, 'Bonjour je m\'appelle Thierry', 1, '2022-09-30 13:32:31'),
(91, 1, 19, 'Ajouter un commentaire', 1, '2022-09-30 14:38:25'),
(92, 1, 19, 'Commentaire', 1, '2022-09-30 14:52:14'),
(94, 1, 21, 'ds', 0, '2022-09-30 18:22:56'),
(95, 4, 19, 'testdvdfv', 1, '2022-09-30 18:29:37'),
(96, 1, 21, 'Ajout de commentaire', 1, '2022-10-04 11:16:08'),
(97, 1, 21, 'dfdffd', 1, '2022-10-04 11:29:08'),
(98, 1, 21, '1235465132', 1, '2022-10-04 11:29:39'),
(99, 1, 21, '88888', 1, '2022-10-04 11:32:20'),
(100, 1, 21, '88888', 1, '2022-10-04 11:32:49'),
(102, 1, 21, '5555', 0, '2022-10-04 11:33:56'),
(107, 1, 21, 'test', 1, '2022-10-04 11:42:20'),
(109, 1, 21, 'Bonjout', 1, '2022-10-04 11:42:41'),
(111, 4, 21, 'Je suis Gérard', 1, '2022-10-04 11:44:20'),
(112, 1, 22, 'Bonjour', 1, '2022-10-04 11:53:48'),
(113, 1, 22, 'Essai ?', 1, '2022-10-04 12:01:58'),
(114, 1, 22, 'Bonjour', 1, '2022-10-04 12:03:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`, `status`, `image`) VALUES
(1, 2, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41', '2022-09-08 14:31:41', 0, NULL),
(2, 2, 'L\'AVBN à la conquête du monde !', 'C\'est officiel, le club a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"Association de VolleyBall de Nuelly\". Pas dur, ceci dit entre nous...', '2022-02-17 16:28:42', '2022-09-08 14:31:41', 0, NULL),
(7, 1, 'Ceci est un nouvel article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sapien leo, feugiat ut imperdiet in, tempus sit amet libero. Fusce sed nibh nec lorem hendrerit volutpat. Etiam tempor auctor tristique. Nunc tristique viverra porta. Fusce tortor orci, pretium eu eros quis, tempus varius eros. Mauris tristique, magna ac venenatis ornare, leo nunc fringilla risus, a ultricies eros risus ut est.', '2022-09-23 15:35:00', '2022-09-23 15:35:00', 1, NULL),
(8, 1, 'Titre de l\'articlessssssssSS', 'string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status string $user_id, string $title, string $content, bool $status ', '2022-09-23 15:35:55', '2022-09-23 15:35:55', 1, NULL),
(11, 1, 'Article ajouté', 'Contenu', '2022-09-29 13:03:25', '2022-09-29 13:03:25', 1, NULL),
(14, 1, 'Titre', 'Contenu222', '2022-09-30 01:19:26', '2022-09-30 01:19:26', 1, NULL),
(15, 1, 'Titresdcsdc', 'Contenuss', '2022-09-30 01:29:53', '2022-09-30 01:29:53', 1, NULL),
(16, 1, 'Add post', 'Post content ', '2022-09-30 13:15:34', '2022-09-30 13:15:34', 1, NULL),
(19, 1, 'sdcdscsdcsdc sdcsdcsd', 'sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd sdcdscsdcsdc sdcsdcsd ', '2022-09-30 13:20:53', '2022-09-30 13:20:53', 1, NULL),
(21, 1, 'I am the adminssddfdcds', 'I am the admindxsdc', '2022-09-30 15:14:03', '2022-09-30 15:14:03', 1, NULL),
(22, 1, 'Titre', 'Contenu', '2022-10-04 11:46:00', '2022-10-04 11:46:00', 1, NULL),
(25, 1, 'test', 'test', '2022-10-04 12:38:05', '2022-10-04 12:38:05', 1, NULL),
(26, 1, 'Titre article image', 'Contenu article image', '2022-10-04 15:01:19', '2022-10-04 15:01:19', 1, '633c2e9f5685d9.26974915.jpg');

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
(1, 'Thierry', 'email@email.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(2, 'Robert', 'test@test.com', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(3, 'Christophe', 'email@email.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(4, 'Gérard', 'test@test.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
