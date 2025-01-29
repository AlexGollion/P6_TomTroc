-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 29 jan. 2025 à 09:42
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
(1, 'admin_test'),
(2, 'test2_admin');

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
(1, 'The Kinkfolk table', 'Nathan Williams', 'The_Kinkfolk_table_Nathan_Williams_1738143027.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 1, 1, '2025-01-29 09:30:27'),
(2, 'Milk & honey', 'Rupi Kaur', 'Milk_&_honey_Rupi_Kaur_1738143370.png', 'Milk & honey de Rupi Kaur', 0, 2, '2025-01-29 09:36:10'),
(3, 'Esther', 'Alabaster', 'Esther_Alabaster_1738143404.png', 'Esther de Alabaster', 1, 2, '2025-01-29 09:36:44'),
(4, 'Wabi Sabi', 'Beth Kempton', 'Wabi_Sabi_Beth_Kempton_1738143523.png', 'Wabi Sabi de Beth Kempton', 1, 2, '2025-01-29 09:38:43');

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
(1, 'Un  loooooooooooooooooooooooooong message', '2025-01-29 09:39:18', 1, 2, 1),
(2, 'Bonjour', '2025-01-29 09:39:54', 2, 3, 1);

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
(1, 1),
(1, 2),
(2, 2),
(2, 3);

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
(1, 'test', 'test@gmail.com', '$2y$10$g6KkeZvzWCQTmxAutpQK6.eYxakx0HWVGSqDD2d9GmUoAq5W5Mkk6', 'test_1738142917.png', '2025-01-29 09:28:13'),
(2, 'admin', 'admin@gmail.com', '$2y$10$YJIpH3zoEjP6Oa28h..M1.Ars8lako/Nj3/ja2n9qoumWhzaPwFo6', 'admin_1738143328.png', '2025-01-29 09:35:18'),
(3, 'test2', 'test2@gmail.com', '$2y$10$dpqV/2.N4sWuNE7oP1AREO0Y6qnVktEwWtzBqc/jM7G5e8lWjNROm', NULL, '2025-01-29 09:39:40');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
