-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 17 jan. 2025 à 10:09
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `nom`) VALUES
(6, 'testadmin_'),
(7, 'dernierTestadmin_');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int NOT NULL,
  `titre` varchar(150) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `image`, `description`, `statut`, `user_id`, `date_creation`) VALUES
(29, 'The Kinkfolk table', 'Nathan Williams', 'The_Kinkfolk_table_Nathan_Williams_1736936559.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.                ', 0, 6, '2025-01-15 10:22:39');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_creation` datetime NOT NULL,
  `conversation_id` int NOT NULL,
  `id_expediteur` int NOT NULL,
  `read_statut` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `date_creation`, `conversation_id`, `id_expediteur`, `read_statut`) VALUES
(18, 'test', '2025-01-15 10:28:27', 6, 7, 1),
(19, 'Un  loooooooooooooooooooooooooong message', '2025-01-15 10:28:56', 6, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pivot_conversation`
--

CREATE TABLE `pivot_conversation` (
  `id_conversation` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pivot_conversation`
--

INSERT INTO `pivot_conversation` (`id_conversation`, `id_user`) VALUES
(6, 6),
(6, 7),
(7, 6),
(7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `photo`, `date_creation`) VALUES
(6, 'admin', 'admin@gmail.com', '$2y$10$6u5NL3lEEAXmEDDWf9.PX.cLrwJLIvnz2LD2Sk26heGFldrB55VLq', 'admin_1737107404.png', '2025-01-15 10:15:50'),
(7, 'test', 'test@gmail.com', '$2y$10$enL4Hjx5yIpSQvG2tO8Z2OeQGd9kTIApbqAJmBuZrA7BdwNA1cjE2', NULL, '2025-01-15 10:23:12'),
(8, 'dernierTest', 'dernierTest@gmail.com', '$2y$10$erh2NWUMRMJt4nOyzgx1r.ngjlzFvW0K8vDRn1NsSx.kWalQ/z7sm', NULL, '2025-01-15 10:32:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_user_id` (`user_id`) USING BTREE;

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_conversation_id` (`conversation_id`),
  ADD KEY `link_id_expediteur` (`id_expediteur`);

--
-- Index pour la table `pivot_conversation`
--
ALTER TABLE `pivot_conversation`
  ADD PRIMARY KEY (`id_conversation`,`id_user`),
  ADD KEY `link_id_conversation` (`id_conversation`),
  ADD KEY `link_id_user` (`id_user`) USING BTREE;

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
