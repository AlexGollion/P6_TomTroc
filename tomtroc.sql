-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 10 jan. 2025 à 13:36
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
(4, 'admintest_'),
(5, 'test2test_');

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
(22, 'The Kinkfolk table', 'Nathan Williams', 'The_Kinkfolk_table_Nathan_Williams_1734686506.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.                ', 0, 1, '2024-12-20 09:21:46'),
(23, 'Wabi Sabi', 'Beth Kempton', 'Wabi_Sabi_Beth_Kempton_1734686847.png', 'Wabi Sabi de Beth Kempton', 1, 1, '2024-12-20 09:27:27'),
(24, 'Milk & honey', 'Rupi Kaur', 'Milk_&_honey_Rupi_Kaur_1734686976.png', 'Milk & honey de Rupi Kaur', 1, 2, '2024-12-20 09:29:36'),
(25, 'Esther', 'Alabster', 'Esther_Alabster_1734687402.png', 'Esther de Alabster', 1, 2, '2024-12-20 09:36:42'),
(26, 'Wabi Sabi', 'Beth Kempton', 'Wabi_Sabi_Beth_Kempton_1735291699.png', 'new description                                                ', 0, 2, '2024-12-27 09:28:19');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_creation` datetime NOT NULL,
  `conversation_id` int NOT NULL,
  `id_expediteur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `date_creation`, `conversation_id`, `id_expediteur`) VALUES
(1, 'test', '2024-12-11 16:46:52', 4, 2),
(2, 'test', '2024-12-11 16:50:16', 4, 2),
(3, 'test', '2024-12-11 16:51:07', 4, 2),
(4, 'test', '2024-12-11 16:51:36', 4, 2),
(5, 'test', '2024-12-11 16:52:08', 4, 2),
(6, 'test', '2024-12-11 16:59:55', 4, 2),
(7, 'test', '2024-12-11 17:00:30', 4, 2),
(8, 'test', '2024-12-11 17:01:49', 4, 2),
(9, 'test', '2024-12-11 17:02:21', 4, 2),
(10, 'test', '2024-12-11 17:03:54', 4, 2),
(11, 'new test', '2024-12-19 13:26:10', 4, 1),
(12, 'new test', '2024-12-19 13:27:40', 4, 1),
(13, 'new test', '2024-12-19 13:28:13', 4, 1),
(14, 'test', '2025-01-07 13:12:21', 5, 3),
(15, 'Un  loooooooooooooooooooooooooong message', '2025-01-10 09:33:55', 4, 1),
(16, 'test messagerie', '2025-01-10 09:38:09', 4, 1),
(17, 'Autre test', '2025-01-10 09:38:15', 5, 1);

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
(4, 1),
(4, 2),
(5, 1),
(5, 3);

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
(1, 'test', 'test@gmail.com', '$2y$10$ChmaRn22DUZSBvCP1cguNOofETIWbEG1wwvYEneZ8zAng.LKxI0NS', 'test_1734513684.png', '2024-11-26 10:44:01'),
(2, 'admin', 'admin@gmail.com', '$2y$10$BHjhH3rsbiFblxzDprYi8ea30HaSHhq.fT5bvA5yRpqmfTz8.v82m', NULL, '2024-12-05 09:30:36'),
(3, 'test2', 'test2@gmail.com', '$2y$10$iZI.59P9LMXpjdTjMlus4eVp7dwv5nfgj5GEX3cV6uYHZFoCIUiRK', NULL, '2025-01-07 12:42:58'),
(4, 'test2', 'test2@gmail.com', '$2y$10$hBKT4u862VIsyIrI5vy1g.yYTbM38orF7gha9emSQHgukGpg4TvE2', NULL, '2025-01-07 12:49:33');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
