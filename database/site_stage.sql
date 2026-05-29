-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 mai 2026 à 21:57
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
-- Base de données : `site_stage`
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

-- --------------------------------------------------------

--
-- Structure de la table `convention_stage`
--

CREATE TABLE `convention_stage` (
  `id_convention` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_signature` date DEFAULT NULL,
  `statut` varchar(200) DEFAULT NULL,
  `type_convention` varchar(200) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_stage` int(11) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `departement` varchar(200) DEFAULT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `specialite` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `secteur` varchar(200) DEFAULT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `formation` varchar(200) DEFAULT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `niveau` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id_historique` int(11) NOT NULL,
  `date_consultation` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_offre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jury`
--

CREATE TABLE `jury` (
  `id_jury` int(11) NOT NULL,
  `nom_jury` varchar(200) DEFAULT NULL,
  `fonction` varchar(200) DEFAULT NULL,
  `session` varchar(200) DEFAULT NULL,
  `commentaire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `maitre_stage`
--

CREATE TABLE `maitre_stage` (
  `id_maitre` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_stage`
--

CREATE TABLE `offre_stage` (
  `id_offre` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `soutenance`
--

CREATE TABLE `soutenance` (
  `id_soutenance` int(11) NOT NULL,
  `date_soutenance` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `salle` varchar(200) DEFAULT NULL,
  `type_soutenance` varchar(200) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id_stage` int(11) NOT NULL,
  `sujet` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `type_stage` int(11) DEFAULT NULL,
  `lieu` varchar(200) DEFAULT NULL,
  `id_maitre` int(11) DEFAULT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  `id_offre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id_candidature`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_offre` (`id_offre`);

--
-- Index pour la table `convention_stage`
--
ALTER TABLE `convention_stage`
  ADD PRIMARY KEY (`id_convention`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_stage` (`id_stage`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`);

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
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id_historique`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_offre` (`id_offre`);

--
-- Index pour la table `jury`
--
ALTER TABLE `jury`
  ADD PRIMARY KEY (`id_jury`);

--
-- Index pour la table `maitre_stage`
--
ALTER TABLE `maitre_stage`
  ADD PRIMARY KEY (`id_maitre`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id_soutenance`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `id_maitre` (`id_maitre`),
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_offre` (`id_offre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id_candidature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `convention_stage`
--
ALTER TABLE `convention_stage`
  MODIFY `id_convention` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jury`
--
ALTER TABLE `jury`
  MODIFY `id_jury` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `maitre_stage`
--
ALTER TABLE `maitre_stage`
  MODIFY `id_maitre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id_soutenance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offre_stage` (`id_offre`);

--
-- Contraintes pour la table `convention_stage`
--
ALTER TABLE `convention_stage`
  ADD CONSTRAINT `convention_stage_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `convention_stage_ibfk_2` FOREIGN KEY (`id_stage`) REFERENCES `stage` (`id_stage`),
  ADD CONSTRAINT `convention_stage_ibfk_3` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `historique_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offre_stage` (`id_offre`);

--
-- Contraintes pour la table `maitre_stage`
--
ALTER TABLE `maitre_stage`
  ADD CONSTRAINT `maitre_stage_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD CONSTRAINT `offre_stage_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD CONSTRAINT `soutenance_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`id_maitre`) REFERENCES `maitre_stage` (`id_maitre`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`id_offre`) REFERENCES `offre_stage` (`id_offre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
