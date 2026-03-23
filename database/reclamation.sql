-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 mars 2026 à 11:50
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
-- Base de données : `reclamation`
--

-- --------------------------------------------------------

--
-- Structure de la table `caidat`
--

CREATE TABLE `caidat` (
  `id` int(11) NOT NULL,
  `nomCercle` varchar(300) NOT NULL,
  `nomCaidat` varchar(300) NOT NULL,
  `idCercle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `caidat`
--

INSERT INTO `caidat` (`id`, `nomCercle`, `nomCaidat`, `idCercle`) VALUES
(1, 'باشوية سطات', 'الملحقة الإدارية الأولى سطات', 1),
(2, 'باشوية سطات', 'الملحقة الإدارية الثانية سطات', 1),
(3, 'باشوية سطات', 'الملحقة الإدارية الثالثة سطات', 1),
(4, 'باشوية سطات', 'الملحقة الإدارية الرابعة سطات', 1),
(5, 'باشوية سطات', 'الملحقة الإدارية الخامسة سطات', 1),
(6, 'باشوية سطات', 'الملحقة الإدارية السادسة سطات', 1),
(7, 'باشوية ابن احمد', 'الملحقة الإدارية الأولى ابن احمد', 2),
(8, 'باشوية ابن احمد', 'الملحقة الإدارية الثانية ابن احمد', 2),
(9, 'باشوية البروج', 'الملحقة الإدارية الأولى البروج', 3),
(10, 'باشوية البروج', 'الملحقة الإدارية الثانية البروج', 3),
(11, 'باشوية لولاد', 'باشوية لولاد', 4),
(12, 'باشوية أولاد امراح', 'باشوية أولاد امراح', 5),
(13, 'دائرة بن أحمد الشمالية', 'قيادة انخيلة - لخزازرة', 6),
(14, 'دائرة بن أحمد الشمالية', 'قيادة المعاريف أولاد امحمد', 6),
(15, 'دائرة بن أحمد الشمالية', 'قيادة ملال', 6),
(16, 'دائرة بن أحمد الجنوبية', 'قيادة سيدي حجاج', 7),
(17, 'دائرة بن أحمد الجنوبية', 'قيادة أولاد فارس', 7),
(18, 'دائرة بن أحمد الجنوبية', 'قيادة رأس العين', 7),
(19, 'دائرة البروج', 'قيادة بني مسكين الشرقية', 8),
(20, 'دائرة البروج', 'قيادة لقراقرة - أولاد عامر', 8),
(21, 'دائرة البروج', 'قيادة بني مسكين الغربية', 8),
(22, 'دائرة البروج', 'قيادة أولاد افريحة - عين بلال', 8),
(23, 'دائرة البروج', 'قيادة دار الشافعي', 8),
(24, 'دائرة سطات الجنوبية', 'قيادة كيسر', 9),
(25, 'دائرة سطات الجنوبية', 'قيادة أولاد الصغير- أولاد عفيف', 9),
(26, 'دائرة سطات الجنوبية', 'قيادة بني يكرين', 9),
(27, 'دائرة سطات الجنوبية', 'قيادة أولاد بوزيري', 9),
(28, 'دائرة سطات الشمالية', 'قيادة مزامزة', 10),
(29, 'دائرة سطات الشمالية', 'قيادة سيدي العايدي', 10),
(30, 'دائرة سطات الشمالية', 'قيادة امزورة', 10),
(31, 'دائرة سطات الشمالية', 'قيادة أولاد سعيد', 10);

-- --------------------------------------------------------

--
-- Structure de la table `cercle`
--

CREATE TABLE `cercle` (
  `numCercle` int(11) NOT NULL,
  `nomCercle` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cercle`
--

INSERT INTO `cercle` (`numCercle`, `nomCercle`) VALUES
(1, 'باشوية سطات'),
(2, 'باشوية ابن احمد'),
(3, 'باشوية البروج'),
(4, 'باشوية لولاد'),
(5, 'باشوية أولاد امراح'),
(6, 'دائرة بن أحمد الشمالية'),
(7, 'دائرة بن أحمد الجنوبية'),
(8, 'دائرة البروج'),
(9, 'دائرة سطات الجنوبية'),
(10, 'دائرة سطات الشمالية');

-- --------------------------------------------------------

--
-- Structure de la table `rappel`
--

CREATE TABLE `rappel` (
  `numRapp` varchar(30) NOT NULL,
  `dateRapp` date NOT NULL,
  `NumReclamation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rappel`
--

INSERT INTO `rappel` (`numRapp`, `dateRapp`, `NumReclamation`) VALUES
('1231', '2025-05-15', '444 '),
('5555', '2025-06-03', '4554'),
('89', '2026-03-29', '23232323 ');

-- --------------------------------------------------------

--
-- Structure de la table `reclamant`
--

CREATE TABLE `reclamant` (
  `id` int(11) NOT NULL,
  `CIN` varchar(30) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `reclamant` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamant`
--

INSERT INTO `reclamant` (`id`, `CIN`, `Adresse`, `tel`, `reclamant`) VALUES
(1, 'w123456', 'settat llkkjj', '0612354869', 'charafi karim'),
(2, 'W456636', 'je suis', '00000000', 'gfgfgf hjhjhjhj'),
(3, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(4, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(5, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(6, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(7, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(8, 'W456636', '3jikjkkj', '+212769160742', 'gfgfgf hjhjhjhj'),
(9, '12055', '', '', ''),
(10, '', '', '', 'ipioil uiyyuuyuyuyuuu'),
(11, '', '', '', 'uioppouio ooooo'),
(12, '', '', '', 'jhgjh lkjmlk'),
(13, '', '', '', 'ppp ooooo'),
(14, 'w12121212', '', '', 'ppp ooooo'),
(15, 'w123456', 'settat llkkjj', '0612354869', 'ppp uiyyuuyuyuyuuu'),
(16, '', '', '', 'ipioil uiyyuuyuyuyuuu'),
(17, '', '', '', 'ppp maryam'),
(18, 'W4893522', '', '', 'ايمان بن خليف'),
(19, '', '', '', 'محمد بن العربي '),
(20, '', '', '', '47 444'),
(21, '', '', '', 'gfgfgf احمد'),
(22, '', '', '', 'أحمد السملالي'),
(23, '25524', '', '', 'مريم قطين و من معه'),
(24, '', '', '', ''),
(25, 'io010', '', '00000', 'كوثر المسكيني'),
(26, 'io010', '', '00000', 'iooiio'),
(27, '12', 'TRHRTRH', '12121212', '1'),
(28, 'D12121', '', '', 'FJFJFJFJFJFFJFJFJFJFJFJFJFFFJJF');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `numR` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `sujet` text NOT NULL,
  `source` varchar(300) NOT NULL,
  `defendeur` varchar(200) NOT NULL,
  `region` varchar(300) NOT NULL,
  `numEnvois` varchar(100) NOT NULL,
  `dateEnvois` date NOT NULL,
  `etatRec` varchar(255) DEFAULT 'قيد المعالجة',
  `reclamant` int(11) NOT NULL,
  `chemin` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`numR`, `date`, `sujet`, `source`, `defendeur`, `region`, `numEnvois`, `dateEnvois`, `etatRec`, `reclamant`, `chemin`) VALUES
('23232323', '0000-00-00', '', '', '', 'دائرة بن أحمد الشمالية / قيادة ملال', '', '0000-00-00', 'معالجة', 28, 'uploads/1774259146.pdf'),
('444', '2025-05-17', '', 'dkhi', '', 'دائرة بن أحمد الجنوبية / قيادة سيدي حجاج', '1233', '2025-05-30', 'قيد المعالجة', 9, ''),
('45454', '2025-05-22', '', 'uijkuiiu', '', '', '14111111', '2025-05-30', 'معالجة', 25, ''),
('4554', '2025-05-24', '', 'jkjk', '', 'دائرة بن أحمد الشمالية / قيادة ملال', '122112', '2025-05-30', 'معالجة', 19, ''),
('455445', '2025-05-17', '', 'gfggfgffgf', '', 'دائرة بن أحمد الشمالية / قيادة المعاريف أولاد امحمد', '123221', '2025-05-30', 'قيد المعالجة', 22, ''),
('5775', '2025-05-06', 'نزاع حول أرض الارث', 'جماعة اولاد مراح', 'jjf,g', 'باشوية أولاد امراح / باشوية أولاد امراح', '52427', '2025-05-19', 'معالجة', 23, ''),
('7777', '2025-05-16', '', 'dsffs', '', '', '858', '2025-05-23', 'معالجة', 18, '');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `numRep` varchar(300) NOT NULL,
  `dateRep` date NOT NULL,
  `resume` text NOT NULL,
  `remarque` text NOT NULL,
  `NumReclamation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`numRep`, `dateRep`, `resume`, `remarque`, `NumReclamation`) VALUES
('1234', '2024-05-19', 'résumé THRGFB', 'remarque', '444'),
('3434', '2025-11-16', '', '', '4554'),
('45445', '2025-05-23', 'otyoityhjkjhlkj', 'jhgjhfjkghjhfkj', '45454'),
('6335', '2025-05-23', 'تم احالتها على الجهة المعنية', 'لا توجد', '5775'),
('78', '2026-03-28', '', '', '23232323'),
('9856', '2025-05-21', '', '', '7777');

--
-- Déclencheurs `reponse`
--
DELIMITER $$
CREATE TRIGGER `update_etatRec_after_insert` AFTER INSERT ON `reponse` FOR EACH ROW BEGIN
    UPDATE reclamation
    SET etatRec = 'معالجة'
    WHERE numR = NEW.NumReclamation;
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caidat`
--
ALTER TABLE `caidat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caidat_cercle` (`idCercle`);

--
-- Index pour la table `cercle`
--
ALTER TABLE `cercle`
  ADD PRIMARY KEY (`numCercle`);

--
-- Index pour la table `rappel`
--
ALTER TABLE `rappel`
  ADD PRIMARY KEY (`numRapp`),
  ADD KEY `reclamation_Reponse` (`NumReclamation`);

--
-- Index pour la table `reclamant`
--
ALTER TABLE `reclamant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`numR`),
  ADD KEY `fk_reclamant_id` (`reclamant`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`numRep`),
  ADD KEY `Reponse` (`NumReclamation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caidat`
--
ALTER TABLE `caidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `cercle`
--
ALTER TABLE `cercle`
  MODIFY `numCercle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reclamant`
--
ALTER TABLE `reclamant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `caidat`
--
ALTER TABLE `caidat`
  ADD CONSTRAINT `fk_caidat_cercle` FOREIGN KEY (`idCercle`) REFERENCES `cercle` (`numCercle`);

--
-- Contraintes pour la table `rappel`
--
ALTER TABLE `rappel`
  ADD CONSTRAINT `reclamation_Rappel` FOREIGN KEY (`NumReclamation`) REFERENCES `reclamation` (`numR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reclamation_Reponse` FOREIGN KEY (`NumReclamation`) REFERENCES `reclamation` (`numR`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `fk_reclamant_id` FOREIGN KEY (`reclamant`) REFERENCES `reclamant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `Reponse` FOREIGN KEY (`NumReclamation`) REFERENCES `reclamation` (`numR`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
