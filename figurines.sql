-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 09 avr. 2021 à 07:15
-- Version du serveur :  5.7.32
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `figurines`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES
(1, 'Animation'),
(2, 'Manga');

-- --------------------------------------------------------

--
-- Structure de la table `figurine`
--

CREATE TABLE `figurine` (
  `id_fig` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(50) NOT NULL,
  `taille` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `annee` date NOT NULL,
  `description` text NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `figurine`
--

INSERT INTO `figurine` (`id_fig`, `nom`, `prix`, `image`, `taille`, `quantite`, `annee`, `description`, `id_cat`) VALUES
(1, 'Goku SS4', 39.95, 'gokuss4.jpg', 17.5, 0, '2019-03-14', 'Figurine Dragon Ball Z - Dokkan Battle 4th anniversary - représentant Son Goku en Super Saiyan 4. Cette figurine est signée Banpresto!', 2),
(2, 'Dead Kenny', 20.99, 'deadkenny.jpg', 8, 23, '2020-06-10', 'Figurine Mini South Park Dead Kenny- Ultime Figurine de Kenny écorché, malmené', 1),
(7, 'Inosuke', 29.99, 'inosuke.webp', 16, 33, '2020-10-30', 'Cette figurine de Inosuke du Manga Demon Slayer est fabriquée avec un grand soin. Elle fait ressortir une apparence vivante et réaliste.', 2),
(8, 'Statue Goku Kaio-ken', 699, 'gokukayowebp.webp', 37, 12, '2021-04-14', 'Statue Dragon Ball Z Goku Kaio-ken HQS by Tsume', 2),
(9, 'Buste Natsu', 1290, 'natsu.webp', 75, 3, '2021-04-28', 'Nous assistons ici au combat entre Natsu et Gajil de Fairy Tail et les Dragons jumeaux de Saber Tooth ayant lieu durant les Grands Jeux.\r\nAlors que Sting et Rog semblent finalement prendre le dessus grâce à leur Pouvoir du Dragon,\r\nNatsu décide d’écarter Gajil du combat en le poussant dans un chariot qui s’en va au loin.\r\nIl va à présent pouvoir affronter seul ses deux adversaires !', 2);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id_stat` int(11) NOT NULL,
  `nom_stat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id_stat`, `nom_stat`) VALUES
(1, 'Super Admin'),
(2, 'Administrateur'),
(3, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_u` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_statut` int(11) NOT NULL,
  `actif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_u`, `nom`, `prenom`, `identifiant`, `password`, `email`, `id_statut`, `actif`) VALUES
(1, 'Sub', 'Nojoke', 'Sub_Nojoke', '2ec6c372ed539452c64705e8dfe1106b', 'd4t0y@outlook.com', 1, 1),
(2, 'Peter', 'Parker', 'SpiderMan', '04c727a23a5da4f41f432dad68e22f72', 'spiderman@gmail.com', 2, 1),
(7, 'User', 'User', 'User', '8f9bfe9d1345237cb3b2b205864da075', 'user@gmail.com', 3, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `figurine`
--
ALTER TABLE `figurine`
  ADD PRIMARY KEY (`id_fig`),
  ADD KEY `fk_id_cat` (`id_cat`) USING BTREE;

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id_stat`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `fk_id_statut` (`id_statut`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `figurine`
--
ALTER TABLE `figurine`
  MODIFY `id_fig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_stat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `figurine`
--
ALTER TABLE `figurine`
  ADD CONSTRAINT `figurine_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id_stat`);
