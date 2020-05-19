-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 19 mai 2020 à 08:20
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `P4`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `episode_id` int(11) NOT NULL,
  `moderate` tinyint(1) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `deletComment`
--

CREATE TABLE `deletComment` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `episode_id` int(11) NOT NULL,
  `removalDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `deletedEpisode`
--

CREATE TABLE `deletedEpisode` (
  `id` int(11) NOT NULL,
  `oldId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `comments` int(11) NOT NULL,
  `removalDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `deletUsers`
--

CREATE TABLE `deletUsers` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `lastConnection` datetime NOT NULL,
  `removalDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE `episode` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` int(4) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`id`, `title`, `content`, `createdAt`, `comments`, `likes`) VALUES
(1, '<h2>Bienvenue sur Mon blog</h2>', '<p>Ce blog est dédié à mon prochain roman Billet simple pour l\'Alaska.\r\nJe publierai les épisodes au fur et à mesure pour que vous puissiez avancer dans votre lecture en même temps que j\'avance dans la rédaction.\r\nBonne lecture à tous</p>', '2020-04-22 16:10:32', 0, 0),
(2, '<h2>1er episode</h2>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis vestibulum dictum. In hac habitasse platea dictumst. Suspendisse tincidunt sed arcu ac condimentum. Phasellus porta elit a arcu mattis fermentum. Integer in suscipit purus. Donec tincidunt vehicula lectus ac rhoncus. Aenean vitae eleifend ipsum, ac congue odio. Donec vel semper mauris. Suspendisse sollicitudin sollicitudin nibh vel iaculis. Ut elementum, nunc sit amet varius consequat, est urna pellentesque leo, a mollis nibh ex eu turpis. Suspendisse id sapien tortor. Suspendisse potenti. Donec sit amet lacus a augue cursus tristique. Aliquam sagittis odio nibh, nec fermentum lectus laoreet ac.</p>\r\n\r\n<p>Suspendisse sagittis venenatis metus, at elementum ex facilisis id. Vestibulum ornare, nisl quis tincidunt fringilla, massa erat rutrum risus, sed congue purus turpis vel urna. Phasellus finibus felis sit amet nibh venenatis lobortis. Mauris eget faucibus libero. Donec in elementum nisl. Pellentesque tristique ut eros eget pellentesque. Praesent tincidunt est eu nisi blandit luctus porttitor ut eros.</p>\r\n\r\n<p>Sed convallis dolor vel fermentum ultrices. Integer ut aliquet felis. Pellentesque vitae lacus pellentesque, tristique nulla at, dapibus urna. Quisque ante nisl, vehicula id dictum nec, elementum vitae felis. Vestibulum ultricies dolor ex, eget tincidunt mi auctor non. Ut tempus mi risus, ut consectetur risus ornare at. Vivamus vitae sapien fringilla, sollicitudin turpis at, posuere augue. Praesent nec facilisis ante. Fusce eu tellus nec dolor feugiat commodo. Praesent pellentesque tincidunt libero. Nullam vel dapibus nibh. Donec mollis nisi id mi porttitor, id dapibus felis tempus.</p>\r\n\r\n<p>Integer aliquam fermentum lacus, at blandit ex lobortis ac. Nunc non nisl consequat, interdum nunc fringilla, suscipit sapien. Vestibulum blandit leo commodo, efficitur odio vitae, accumsan justo. Proin finibus convallis ante, ac porta dui dignissim ut. Cras pretium sagittis pellentesque. Curabitur venenatis metus tincidunt, gravida ligula a, tempor enim. Vivamus lorem odio, condimentum vel dictum in, efficitur id sem. Donec luctus eget nibh nec consectetur. Suspendisse elementum id ligula eu sodales.</p>\r\n\r\n<p>In libero nunc, ullamcorper at volutpat eu, egestas et lacus. Nunc egestas urna a augue accumsan, non congue sapien congue. Nullam id eleifend lorem, sed porta neque. Aliquam luctus quam blandit nulla lacinia vulputate. Suspendisse potenti. Maecenas mattis nec augue dignissim bibendum. Aenean porta auctor tristique. Ut euismod sollicitudin mi, at gravida tortor ornare ultricies. Phasellus neque odio, sodales sed pulvinar a, aliquam at elit. Nulla dignissim turpis leo. Nam consequat lectus varius, dictum mauris ut, tincidunt erat. Mauris elementum nec neque in tincidunt. Integer laoreet erat in massa tempor ornare. Praesent vel aliquam tortor.</p>', '2020-04-24 15:52:28', 0, 1),
(3, '<h2>2ème épisode</h2>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ex dolor, mollis vel tristique ut, porttitor nec ipsum. Etiam sit amet porttitor libero. Duis ac dapibus lacus. Fusce imperdiet cursus eros, ut feugiat ligula laoreet et. Praesent malesuada suscipit maximus. Vestibulum finibus vitae ipsum non suscipit. Duis euismod neque sed tristique vehicula. Nunc luctus mattis massa, vel eleifend lectus interdum consequat. Nam maximus pellentesque magna et fringilla. Mauris viverra vehicula tortor nec condimentum. In hac habitasse platea dictumst. Aenean fermentum mauris quis elit tincidunt egestas.</p>\r\n\r\n<p>Nullam elementum facilisis ante, non faucibus mauris. Aenean id maximus tellus. Mauris non nibh vitae tortor tincidunt vulputate. Duis feugiat urna urna, scelerisque semper elit tempus sed. Maecenas commodo tortor eu ante cursus lobortis. Ut a enim in nibh commodo cursus. In interdum ligula urna, in pretium ante dictum nec. Vivamus quis purus quis diam venenatis placerat. Duis orci massa, hendrerit vel diam sit amet, dictum rutrum erat. In nec egestas dolor, ac fringilla dolor. Sed malesuada sed enim sagittis pulvinar. Cras vehicula lectus at luctus tristique. Suspendisse fringilla nisi et turpis blandit faucibus. Donec dolor felis, malesuada sit amet tincidunt sit amet, scelerisque vulputate justo. Integer at felis porttitor, maximus arcu lacinia, iaculis ipsum. Cras blandit nisi ex, non luctus elit sagittis non.</p>\r\n\r\n<p>Maecenas et lacus aliquet, sollicitudin nulla a, volutpat odio. Sed sed nibh non nibh pellentesque fermentum. Nam eu tempus ipsum. Praesent mattis, turpis quis dapibus accumsan, arcu ligula tincidunt augue, non consectetur erat orci ac nunc. Pellentesque dignissim tellus a sollicitudin tincidunt. Phasellus purus ligula, feugiat nec cursus quis, pellentesque quis eros. Suspendisse potenti. Nam non rutrum orci. Morbi viverra vel lectus at blandit. Nullam vitae lectus eu lorem ultrices egestas. Duis laoreet iaculis nisi nec aliquam. Phasellus non condimentum nisl, et elementum tellus. Etiam nec sapien vel purus laoreet consectetur ac non lorem. Phasellus rhoncus urna nulla, non cursus velit cursus dapibus.</p>\r\n\r\n<p>Sed mi quam, pretium sed dolor vitae, venenatis dapibus nunc. Vivamus diam nulla, venenatis eu suscipit sed, maximus at nisi. Duis porta eu leo quis tincidunt. Sed imperdiet ultrices luctus. Sed vel egestas elit. Integer nec pretium dolor. Vivamus mi tellus, blandit nec dolor vitae, scelerisque bibendum enim. Nullam sagittis dolor augue, non maximus turpis feugiat facilisis. Cras eu nisi in metus viverra fermentum.</p>\r\n\r\n<p>Sed luctus euismod tortor, et vestibulum metus consectetur sed. Donec turpis eros, rutrum id turpis eget, dapibus imperdiet nulla. Maecenas semper, eros vel pulvinar aliquet, sapien urna ullamcorper magna, sit amet malesuada ligula ante vel libero. Donec a turpis semper turpis sagittis tempor. Ut semper augue eget orci posuere, vitae dignissim turpis dictum. Duis molestie blandit nulla a pretium. Etiam tristique risus arcu, eleifend interdum arcu tempus quis.</p>', '2020-04-27 16:51:55', 0, 0),
(4, '<h2>Nouvel épisode</h2>', '<p>Duis ac eleifend nisi, in egestas diam. Proin faucibus mi vitae ex vestibulum, et porta nisi accumsan. Ut porttitor mi metus, et ullamcorper dolor aliquet id. Nullam sed rhoncus arcu. Aenean tincidunt ultrices tellus. Nulla accumsan tortor est, sit amet rhoncus nibh facilisis quis. Vestibulum gravida lobortis turpis nec bibendum. Maecenas lectus purus, porttitor at vehicula eget, accumsan vitae velit. Vestibulum eleifend pharetra nibh eget consequat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam vitae facilisis metus. Ut consectetur sapien a ultricies ullamcorper. Morbi eget bibendum lacus. Praesent faucibus id lacus nec tristique. Vivamus luctus ultrices maximus.</p>\r\n<p>Suspendisse et congue lorem, vel tempor nulla. Mauris ac facilisis felis. Vestibulum porttitor mauris nec fermentum luctus. Aenean vitae consequat neque. Suspendisse rhoncus sem mi, non suscipit enim pulvinar in. Integer rutrum odio vel lacus elementum, vel tincidunt est rutrum. Vivamus auctor odio eget eros condimentum ornare bibendum vitae mauris. Mauris at lacus in leo ornare vehicula. Duis varius lacus vitae cursus sollicitudin. Mauris hendrerit sit amet ex ac pharetra. Vivamus eget nulla eget ante dignissim sagittis. Nulla posuere orci non arcu malesuada, sit amet mollis sapien congue.</p>\r\n<p>Mauris non dolor vehicula, egestas purus sed, aliquet tortor. Aliquam accumsan, eros quis faucibus ultrices, leo ligula finibus tortor, id malesuada purus nibh lacinia lacus. Suspendisse potenti. Cras ultrices nisi non mi consequat ornare. Pellentesque pellentesque urna vel porta dignissim. Nullam cursus nisi tincidunt nulla pretium, eget feugiat justo molestie. Praesent ligula massa, cursus at maximus vel, laoreet eget elit. Morbi lacinia sollicitudin sollicitudin. Ut feugiat mauris sit amet libero condimentum, ac laoreet quam interdum.</p>\r\n<p>Sed laoreet at leo sit amet viverra. Nulla quam quam, tristique nec hendrerit sit amet, rutrum dignissim lectus. Cras et dui quis lectus fermentum malesuada. Nam et est ac ligula congue pharetra sed eget nulla. Morbi ut tincidunt eros. Praesent faucibus luctus eros eget venenatis. Cras ultricies lorem accumsan lacus ultrices aliquam. Aliquam erat volutpat. Etiam at eros id lacus facilisis viverra. Pellentesque sit amet massa viverra ligula suscipit sagittis. Ut ultricies sed sem dictum pretium. Nam nec convallis felis. Ut at mauris dui.</p>\r\n<p>Sed vitae tempus lacus, quis consectetur metus. Etiam at nisl et risus fermentum molestie. In imperdiet leo sit amet imperdiet tincidunt. Nam congue nulla ac nisi auctor efficitur. Suspendisse consectetur leo tristique nisi consequat vehicula. Nunc vehicula, ligula nec ultricies tempus, mi velit bibendum orci, sed cursus odio felis fermentum ex. Nam vitae maximus nunc. Nulla dictum risus non scelerisque rhoncus. Nam pharetra eleifend metus. Maecenas tristique ante sed pellentesque pulvinar. Sed purus quam, tincidunt quis suscipit id, placerat sed massa. Phasellus turpis risus, porta non lacus vel, maximus tempus leo. Vivamus ut dolor ante. Donec lobortis urna eu nisi sodales faucibus. Duis sed elit ut sapien malesuada facilisis quis at diam.\r\n</p>', '2020-05-01 09:13:23', 0, 7),
(7, '<h2>Episode 5</h2>', '<p>ergzrtg&eacute;dsf efvkl!lk &euml;;,bn</p>', '2020-05-01 14:41:33', 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastConnection` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `role_id`, `createdAt`, `lastConnection`) VALUES
(19, 'Admin', '$2y$10$uUoV9j8ErqUaZKsUUUFspuP/H03rYd59NCgRaGvpQNoI6joGFa3k.', 'Admin@unbillet.com', 1, '2020-05-11 09:06:38', '2020-05-15 17:10:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `deletComment`
--
ALTER TABLE `deletComment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `deletedEpisode`
--
ALTER TABLE `deletedEpisode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `deletUsers`
--
ALTER TABLE `deletUsers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `deletComment`
--
ALTER TABLE `deletComment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `deletedEpisode`
--
ALTER TABLE `deletedEpisode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `deletUsers`
--
ALTER TABLE `deletUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `episode`
--
ALTER TABLE `episode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
