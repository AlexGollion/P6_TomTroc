-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 13 déc. 2024 à 09:28
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
(4, 'admintest_');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int NOT NULL,
  `titre` varchar(150) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `image`, `description`, `statut`, `user_id`) VALUES
(20, 'The Kinkfolk table', 'Nathan Williams', 'The_Kinkfolk_table_Nathan_Williams_1733145530.png', 'modification de la descritpion                    ', 1, 1),
(21, 'test', 'test', 'test_test_1733146788.png', 'test', 1, 1);

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
(10, 'test', '2024-12-11 17:03:54', 4, 2);

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
(4, 2);

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
(1, 'test', 'test@gmail.com', '$2y$10$ChmaRn22DUZSBvCP1cguNOofETIWbEG1wwvYEneZ8zAng.LKxI0NS', 'test2_1734032153.', '2024-11-26 10:44:01'),
(2, 'admin', 'admin@gmail.com', '$2y$10$BHjhH3rsbiFblxzDprYi8ea30HaSHhq.fT5bvA5yRpqmfTz8.v82m', NULL, '2024-12-05 09:30:36');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
