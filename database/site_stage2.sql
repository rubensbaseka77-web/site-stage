-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 juin 2026 à 16:54
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site-stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `id_candidature` int(11) NOT NULL,
  `date_candidature` date DEFAULT NULL,
  `statut` varchar(200) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_offre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id_candidature`, `date_candidature`, `statut`, `id_etudiant`, `id_offre`) VALUES
(1, '2026-06-05', 'En attente', 1, 1),
(2, '2026-06-05', 'Vue par entreprise', 1, 2),
(3, '2026-06-05', 'Entretien prévu', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom`, `adresse`, `email`, `mot_de_passe`) VALUES
(1, 'Webnova', 'Paris, France', NULL, NULL),
(2, 'CodeLab', 'Lyon, France', NULL, NULL),
(3, 'DesignStudio', 'Bordeaux, France', NULL, NULL),
(4, 'baseka', NULL, 'rubensbaseka77@gmail.com', '$2y$10$atU821.q5NygyJM7pIXpveqImizrjSB6LARTpUkOEAh6rk.R2WgKC');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(1, 'Baseka', 'Rubens', 'rubens@example.com', ''),
(2, 'baseka', 'rubens', 'rubensbaseka77@gmail.com', '$2y$10$FLUdiHlx1XhLAhIe1T6/HeKONmsKZE4t3GKYCKPGrztEGxtrbTg4G'),
(3, 'baseka', 'rubens', 'rubensbaseka772@gmail.com', '$2y$10$hKCPViiSNqQLlWCXXvgRLu42oBz/PiAxkpAjmdkvE/n2OpgSrr8D6');

-- --------------------------------------------------------

--
-- Structure de la table `offre_stage`
--

CREATE TABLE `offre_stage` (
  `id_offre` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offre_stage`
--

INSERT INTO `offre_stage` (`id_offre`, `titre`, `description`, `date_publication`, `id_entreprise`) VALUES
(1, 'Stagiaire Marketing Digital', 'Rejoignez notre équipe marketing et participez à la stratégie digitale.', '2026-06-05', 1),
(2, 'Stagiaire Développeur Web', 'Participation au développement des applications web.', '2026-06-05', 2),
(3, 'Stagiaire UX/UI Designer', 'Conception d’interfaces modernes et expériences utilisateurs.', '2026-06-05', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id_candidature`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD PRIMARY KEY (`id_offre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id_candidature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
