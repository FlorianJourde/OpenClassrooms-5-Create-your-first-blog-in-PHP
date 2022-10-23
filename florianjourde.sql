-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 oct. 2022 à 18:35
-- Version du serveur : 10.5.17-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u718790758_florian_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `status`, `creation_date`) VALUES
(163, 1, 55, 'Intéressant, je ne connaissais pas la deuxième règle !', 1, '2022-10-16 14:50:40'),
(164, 1, 52, 'Qu\'en est-il de D3.js ?', 1, '2022-10-16 14:55:16'),
(165, 1, 53, 'Très beaux bureaux !', 1, '2022-10-16 15:20:33'),
(166, 1, 52, 'Slick.js, ma bibliothèque préférée !', 1, '2022-10-16 15:20:59'),
(167, 2, 55, 'Super, je vais devenir un pro avec ça !', 1, '2022-10-16 15:22:04'),
(168, 2, 55, 'Je trouve la quatrième règle très moderne !', 1, '2022-10-16 15:22:29'),
(169, 2, 54, 'Sympa, plus qu\'à les appliquer, maintenant...', 1, '2022-10-16 15:22:43'),
(170, 2, 54, 'Comme pour chaque syntaxe, il y a un temps d\'adaptation.', 1, '2022-10-16 15:23:19'),
(171, 2, 53, 'J\'aime bien l\'esprit minimaliste du dernier bureau', 1, '2022-10-16 15:23:45'),
(172, 2, 53, 'Ils sont tous très cools !', 0, '2022-10-16 15:24:04'),
(173, 1, 53, 'Wow !', 0, '2022-10-16 15:32:52'),
(174, 1, 52, 'Qui est l\'auteur de cet article ?', 0, '2022-10-16 15:33:06');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`, `status`, `image`) VALUES
(52, 1, '7 librairies Javascript à essayer pour tous les développeurs', '<h1>Remarque</h1>\n\n<p>Le contenu de cet article n\'est pas original. Il est utilisé à titre d\'exemple, dans l\'attente de l\'alimentation du blog par des contenus véritables.</p>\n\n<p>Vous pourrez consulter l\'article original dans son intégralité à l\'adresse suivante : <a href=\"https://medium.com/technology-hits/7-javascript-library-to-try-for-every-developer-d5b8f6bf6058\">7 Javascript Library to Try for Every Developer</a></p>\n\n<hr />\n\n<h2>FullPage.js</h2>\n\n<p><strong>FullPage.js</strong> is simple and easy to use a library that creates <strong>fullscreen scrolling websites</strong> (also known as single page websites or one-page sites) and <strong>adds landscape</strong> sliders inside the sections of the site. It is fully functional on all modern browsers, as well as some old ones such as Internet Explorer 9, Opera 12, etc.</p>\n\n<p>It works with browsers with <strong>CSS3</strong> support and with the ones which don’t have it, making it ideal for old browsers compatibility. It also provides touch support for mobile phones, tablets and touch screen computers.</p>\n\n<p><code>npm install fullpage.js</code></p>\n\n<h2>Anime.js</h2>\n\n<p><strong>Anime.js is a lightweight JavaScript animation library with a simple, yet powerful API</strong>. It works with CSS properties, SVG, DOM attributes and JavaScript Objects. Anime’s built-in staggering system makes <strong>complex follow through and overlapping animations simple</strong>. It can be used on both timings and properties. <strong>Animate multiple CSS transforms properties</strong> with different timings simultaneously on a single HTML element. Play, pause, control, reverse and trigger events in sync using the complete built-in callbacks and controls functions.</p>\n\n<p><code>npm install animejs --save</code></p>\n\n<h2>ScreenFull.js</h2>\n\n<p>Simple wrapper for cross-browser usage of the JavaScript Fullscreen API, which lets you bring the page or any element into fullscreen. <strong>Smoothens out the browser implementation differences</strong>, so you don’t have to. It helps to work with full-Screen feature, instead of <strong>FullScreen</strong> API because of its cross-browser efficiency.</p>\n\n<p><code>npm install screenfull</code></p>\n\n<h2>Moment.js</h2>\n\n<p>A JavaScript date library for <strong>parsing, validating, manipulating, and formatting dates</strong>.Moment.js is a legacy project, now in maintenance mode. In most cases, you should choose a different library.</p>\n\n<p><code>npm install moment --save</code></p>\n\n<h2>Slick.js</h2>\n\n<p><strong>Slick</strong> is a fresh new jQuery plugin for creating fully customizable, responsive and <strong>mobile-friendly carousels/sliders</strong> that work with any HTML elements.</p>\n\n<h3>Features</h3>\n\n<ul>\n<li>Fully responsive. Scales with its container.</li>\n<li>Uses CSS3 when available. Fully functional when not.</li>\n<li>Swipe enabled. Or disabled, if you prefer.</li>\n<li>Infinite looping.</li>\n<li>Autoplay, dots, arrows, callbacks, etc…</li>\n</ul>\n\n<p><code>npm install slick-carousel</code></p>\n\n<h2>Popper.js</h2>\n\n<p>Popper.js is a Scroll the container (or the whole page) to see the tooltip stay within the boundary. Once the opposite edges of the popcorn and tooltip are aligned, the tooltip is allowed to overflow to prevent detachment. Scroll the container (or the whole page) to see the tooltip flip to the opposite side once it’s about to overflow the visible area. Once enough space is detected on its preferred side, it will flip back. With the CSS drawbacks out of the way, we now move on to Popper in the JavaScript space itself.</p>\n\n<p><code>npm i @popperjs/core</code></p>\n\n<h2>Leaflet.js</h2>\n\n<p>The leaflet is the leading open-source JavaScript library for mobile-friendly interactive maps. Weighing just about 39 KB of JS, it has all the mapping features most developers ever need.</p>\n\n<p>The leaflet is designed with simplicity, performance and usability in mind. It works efficiently across all major desktop and mobile platforms, can be extended with lots of plugins, has a beautiful, easy to use and well-documented API and a simple library.</p>\n\n<p><code>npm i leaflet</code></p>\n', '2022-10-16 13:44:03', '2022-10-16 13:44:03', 1, '634bee83acb5c0.00352188.jpeg'),
(53, 1, 'Les 10 plus beaux setup de développeurs', '<h1>Remarque</h1>\n\n<p>Le contenu de cet article n\'est pas original. Il est utilisé à titre d\'exemple, dans l\'attente de l\'alimentation du blog par des contenus véritables.</p>\n\n<p>Vous pourrez consulter l\'article original dans son intégralité à l\'adresse suivante : <a href=\"http://www.home-designing.com/workstation-setup-ideas-photos\">40 Workstation Setups That We Really Like</a></p>\n\n<hr />\n\n<p>Our computer <strong>workstation setups</strong> are one of the most important <strong>areas of our homes</strong>. They’ve become the place where we spend the most time–even surpassing our beds. However, these spaces often aren’t given their due attention on the design front, and some aren’t even optimised for comfort. Could you pull your workstation out from a <strong>neglected dusty corner with some fresh slick aesthetics</strong> ? Should you soup up your user experience with new tech and ergonomic additions? We’ve whipped up a collection of 50 workstation setups that we really like, and we’re sure that you will too. Log in and get set to reprogram how you <strong>think about your home workspace</strong> !</p>\n\n<p><img src=\"http://cdn.home-designing.com/wp-content/uploads/2020/11/computer-workstation-setup.jpg\" alt=\"Computer workstation setup\" /></p>\n\n<p>We wouldn’t know whether to look at our Surface Studio or gaze out at the water if we had this spectacularly situated workstation. See more workspaces with views that wow !</p>\n\n<p><img src=\"http://cdn.home-designing.com/wp-content/uploads/2020/11/beautiful-speakers.jpg\" alt=\"Beautiful speakers\" /></p>\n\n<p>All present and correct. Each piece of tech is homed on warm timber and cognac planes across this desk, including a set of rather beautiful speakers.</p>\n\n<p><img src=\"http://cdn.home-designing.com/wp-content/uploads/2020/11/headphone-stand.jpg\" alt=\"Headphones stand\" /></p>\n\n<p>Pyrography depicts the home owners’ passion and adds attractive natural tone to the room. A wooden headphone stand blends elegantly with the surroundings.</p>\n\n<p><img src=\"http://cdn.home-designing.com/wp-content/uploads/2020/11/widescreen-monitor.jpg\" alt=\"Indoor plants\" /></p>\n\n<p>An ultrawide monitor spans a large stand with storage, under which the keyboard can tuck away when not in use. Indoor plants make up for a grey city view.</p>\n\n<p><img src=\"http://cdn.home-designing.com/wp-content/uploads/2020/11/minimalist-home-office.jpg\" alt=\"Minimalist home office\" /></p>\n\n<p>A minimalist home office is all productivity and no nonsense. Even the desktop plant is on the minimal side.</p>\n', '2022-10-16 14:00:23', '2022-10-16 14:00:23', 1, '634bf257cd0651.01957411.jpg'),
(54, 1, 'Les commandes indispensables en Markdown', '<h1>Remarque</h1>\n\n<p>Le contenu de cet article n\'est pas original. Il est utilisé à titre d\'exemple, dans l\'attente de l\'alimentation du blog par des contenus véritables.</p>\n\n<p>Vous pourrez consulter l\'article original dans son intégralité à l\'adresse suivante : <a href=\"https://medium.com/featurepreneur/most-useful-markdown-commands-3ee31a8e2466\">Most useful Markdown commands</a></p>\n\n<hr />\n\n<p>Markdown is a lightweight markup language that you can use to add formatting elements to plaintext text documents. When you create a Markdown-formatted file, you add Markdown syntax to the text to indicate which words and phrases should look different.</p>\n\n<p><img src=\"https://miro.medium.com/max/1400/0*q0wBOoYmo-ETVpHq\" alt=\"Mardown syntax\" /></p>\n\n<h2>Headings</h2>\n\n<p>To create a heading, add number signs (#) in front of a word or phrase. The number of ‘#’ you use should correspond to the heading level. For example, to create a heading level three (### ), use three number signs (e.g., ### My Header). Always leave a blank space between the hash # and the text next to it, otherwise, it won\'t render properly.</p>\n\n<p><code># Heading H1</code></p>\n\n<p><code>## Heading H2</code></p>\n\n<p><code>### Heading H3</code></p>\n\n<h2>Bold</h2>\n\n<p>To bold text, add two asterisks or underscores before and after a word or phrase. To bold the middle of a word for emphasis, add two asterisks without spaces around the letters.</p>\n\n<p><code>This is **bold**</code></p>\n\n<h2>Italic</h2>\n\n<p>To italicize text, add one asterisk or underscore before and after a word or phrase. To italicize the middle of a word for emphasis, add one asterisk without spaces around the letters.</p>\n\n<p><code>This is _italic_</code></p>\n\n<h2>Blockquotes</h2>\n\n<p>To create a blockquote, add a &gt; in front of a paragraph.</p>\n\n<p><code>&gt; This is a blockquote</code></p>\n\n<h2>Ordered List</h2>\n\n<p>To create an ordered list, add line items with numbers followed by periods. The numbers don’t have to be in numerical order, but the list should start with the number one.</p>\n\n<p><code>1. First</code></p>\n\n<p><code>2. Second</code></p>\n\n<p><code>3. Third</code></p>\n\n<h2>Unordered List</h2>\n\n<p>To create an unordered list, add dashes (-), asterisks (&#42;), or plus signs (+) in front of line items. Indent one or more items to create a nested list.</p>\n\n<p><code>- First</code></p>\n\n<p><code>- Second</code></p>\n\n<p><code>- Third</code></p>\n\n<h2>Additional breaks</h2>\n\n<p>In case you need an additional break (or some extra space between lines), you can simply use the HTML break tag<br />\n, leaving blank lines above and below it:</p>\n\n<p><code>&lt;br&gt;</code></p>\n\n<h2>Horizontal lines</h2>\n\n<p>A sequence of three or more dashes will produce a horizontal line, but let’s use always 4 as standard. Leave blank lines after and before it:</p>\n\n<p><code>---</code></p>\n\n<h2>Images</h2>\n\n<p>To insert images to your markdown file, use the image markup. The path can either be relative to the website, or a full URL for an external image. The supported formats are .png, .jpg, .gif. You might be able to use some .svg files too, depending on their structure.</p>\n\n<p><code>![Featurepreneur Logo!](http://d1cb7w4cvia6lb.cloudfront.net/featurepreneur/recording/logo.png “Featurepreneur Logo”)</code></p>\n\n<h2>Links</h2>\n\n<p>To create a link, enclose the link text in brackets and then follow it immediately with the URL in parentheses.</p>\n\n<p><code>[Medium](https://medium.com).</code></p>\n', '2022-10-16 14:18:21', '2022-10-16 14:18:21', 1, '634bf68d8b8226.98145365.jpg'),
(55, 1, '7 astuces pour exceller en design', '<h1>Remarque</h1>\n\n<p>Le contenu de cet article n\'est pas original. Il est utilisé à titre d\'exemple, dans l\'attente de l\'alimentation du blog par des contenus véritables.</p>\n\n<p>Vous pourrez consulter l\'article original dans son intégralité à l\'adresse suivante : <a href=\"https://medium.com/refactoring-ui/7-practical-tips-for-cheating-at-design-40c736799886\">7 Practical Tips for Cheating at Design</a></p>\n\n<hr />\n\n<p>Every web developer inevitably runs into situations where they need to make visual design decisions, whether they like it or not.</p>\n\n<p>Maybe the company you work for doesn’t have a full-time designer and you need to implement the UI for a new feature on your own. Or maybe you’re hacking on a side-project and you want it to look better than yet-another-Bootstrap-site.</p>\n\n<p>It’s easy to throw your hands up and say, “I’ll never be able to make this look good, I’m not an artist!” but it turns out there are a ton of tricks you can use to level up your work that don’t require a background in graphic design.</p>\n\n<p>Here are seven simple ideas you can use to improve your designs today.</p>\n\n<h2>Use color and weight to create hierarchy instead of size</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*KYZikUrx9F02cJU9kpn_gQ.png\" alt=\"Color weight\" /></p>\n\n<h2>Don’t use grey text on colored backgrounds</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*ajjrhpp-l3GDG7ne7Am8fw.png\" alt=\"Grey text color background\" /></p>\n\n<h2>Offset your shadows</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*LisFGBtYOvR-3cwFTzTDUw.png\" alt=\"Offset your shadows\" /></p>\n\n<h2>Use fewer borders</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*fNm6hXxnBvIcHGp9DQRdRQ.png\" alt=\"Use fewer borders\" /></p>\n\n<h2>Don’t blow up icons that are meant to be small</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*57g05Gl-FjDtcCUtaPPOLw.png\" alt=\"Small icons\" /></p>\n\n<h2>Use accent borders to add color to a bland design</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*uwsVo34TWzKM91Gyqsh88Q.png\" alt=\"Accent colors\" /></p>\n\n<h2>Not every button needs a background color</h2>\n\n<p><img src=\"https://miro.medium.com/max/1400/1*SIfuJd-3ZFYyA_W1Nme1Yw.png\" alt=\"Button background color\" /></p>\n', '2022-10-16 14:49:33', '2022-10-16 14:49:33', 1, '634bfdddabbdc6.47285436.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `token`) VALUES
(1, 'Admin', 'admin@admin.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', '84c47d2d56155b1ec77a9b97166701e7'),
(2, 'User', 'user@user.com', 'User', 'e10adc3949ba59abbe56e057f20f883e', 'e85f6ab0565725072c9e40aba11fe7fd'),
(5, '<html><a href=\"https://google.com\"><img src=\"https://blogger.googleusercontent.com/img/a/AVvXsEgXM4x', 'satelkagashkin+114391@mail.ru', 'User', 'e1f758043a9964675a6c2590a74785bd', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
