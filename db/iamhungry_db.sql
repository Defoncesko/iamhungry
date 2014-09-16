-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 11 Septembre 2014 à 03:30
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `iamhungry_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `autheurs`
--

CREATE TABLE `autheurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `autheurs`
--

INSERT INTO `autheurs` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Igloo', '2014-09-10 21:46:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categorieIngredients`
--

CREATE TABLE `categorieIngredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorieIngredients`
--

INSERT INTO `categorieIngredients` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Pour la pate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Pour la garniture', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categoriePrepas`
--

CREATE TABLE `categoriePrepas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categoriePrepas`
--

INSERT INTO `categoriePrepas` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Préparation de la pate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Préparation de la garniture', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(3, 'Entrée', '2014-09-11 01:56:11', '2014-09-11 01:56:11');

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `countries`
--

INSERT INTO `countries` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'France', '2014-09-11 02:40:40', '2014-09-11 02:40:40'),
(2, 'Belgique', '2014-09-11 02:40:40', '2014-09-11 02:40:40'),
(3, 'USA', '2014-09-11 02:40:40', '2014-09-11 02:40:40');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(4, 'sel', '2014-09-11 02:22:13', '2014-09-11 02:22:13'),
(5, 'poivre', '2014-09-11 02:22:13', '2014-09-11 02:22:13'),
(6, 'farine', '2014-09-11 02:22:13', '2014-09-11 02:22:13'),
(7, 'levure', '2014-09-11 02:22:13', '2014-09-11 02:22:13');

-- --------------------------------------------------------

--
-- Structure de la table `link_recette_author`
--

CREATE TABLE `link_recette_author` (
  `idRecette` int(11) NOT NULL,
  `idAutheur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `link_recette_author`
--

INSERT INTO `link_recette_author` (`idRecette`, `idAutheur`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `link_recette_categorie`
--

CREATE TABLE `link_recette_categorie` (
  `idRecette` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `link_recette_categorie`
--

INSERT INTO `link_recette_categorie` (`idRecette`, `idCategorie`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `link_Recette_Ingred`
--

CREATE TABLE `link_Recette_Ingred` (
  `IdRecette` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `idIngredient` int(11) NOT NULL,
  `idQuantite` int(11) NOT NULL,
  `Ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `link_Recette_Ingred`
--

INSERT INTO `link_Recette_Ingred` (`IdRecette`, `idCategorie`, `idIngredient`, `idQuantite`, `Ordre`) VALUES
(1, 1, 1, 1, 1),
(1, 1, 2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `link_recette_photo`
--

CREATE TABLE `link_recette_photo` (
  `idRecette` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `link_recette_photo`
--

INSERT INTO `link_recette_photo` (`idRecette`, `idPhoto`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `link_recette_preparation`
--

CREATE TABLE `link_recette_preparation` (
  `idRecette` int(11) NOT NULL,
  `idCatPrepa` int(11) NOT NULL,
  `idPhrasePrepa` int(11) NOT NULL,
  `Ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `link_recette_preparation`
--

INSERT INTO `link_recette_preparation` (`idRecette`, `idCatPrepa`, `idPhrasePrepa`, `Ordre`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_09_10_144510_create_Recettes_table', 1),
('2014_09_10_144717_create_Photos_table', 2),
('2014_09_10_144745_create_Autheurs_table', 3),
('2014_09_10_144814_create_Categories_table', 4),
('2014_09_10_144840_create_CategoriePrepas_table', 5),
('2014_09_10_144906_create_CategorieIngredients_table', 6),
('2014_09_10_144931_create_Ingredients_table', 7),
('2014_09_10_144954_create_QuantiteIngredients_table', 8),
('2014_09_10_210249_create_Countries_table', 9),
('2014_09_10_213346_create_PhrasePrepas_table', 10);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'photo1.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'photo2.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `phrasePrepas`
--

CREATE TABLE `phrasePrepas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `phrasePrepas`
--

INSERT INTO `phrasePrepas` (`id`, `phrase`, `created_at`, `updated_at`) VALUES
(1, 'étaler la pate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'retourner la pate', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `quantiteIngredients`
--

CREATE TABLE `quantiteIngredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `quantiteIngredients`
--

INSERT INTO `quantiteIngredients` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, '15g', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '30g', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPays` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  ` tpsprepa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tpscuisson` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbpersonne` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diff` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `recettes`
--

INSERT INTO `recettes` (`id`, `idPays`, `titre`, ` tpsprepa`, `tpscuisson`, `nbpersonne`, `diff`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tarte à la praline', '40', '34', '4', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
