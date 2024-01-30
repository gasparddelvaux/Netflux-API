-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 jan. 2024 à 19:42
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `netflux`
--

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `name`, `year`, `director`, `synopsis`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Inception', 2010, 'Christopher Nolan', 'Dom Cobb est un voleur expérimenté, spécialisé dans l\'extraction de secrets enfouis au plus profond du subconscient pendant les rêves.', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_FMjpg_UX1000_.jpg', '2024-01-30 16:45:40', '2024-01-30 18:21:19', NULL),
(2, 'Pulp Fiction', 1994, 'Quentin Tarantino', 'Différentes histoires entrelacées de criminels, de drogue et de violence à Los Angeles.', 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', '2024-01-30 17:01:38', '2024-01-30 18:31:06', NULL),
(3, 'The Dark Knight', 2008, 'Christopher Nolan', 'Batman s\'associe au procureur Harvey Dent pour tenter de démanteler le crime organisé à Gotham, mais les choses tournent mal.', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:52:50', NULL),
(4, 'Forrest Gump', 1994, 'Robert Zemeckis', 'L\'histoire extraordinaire de Forrest Gump, un homme avec un QI inférieur à la moyenne, qui se retrouve involontairement au centre de nombreux événements historiques.', 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 18:08:09', NULL),
(5, 'The Matrix', 1999, 'The Wachowskis', 'Un programmeur informatique découvre que le monde dans lequel il vit n\'est qu\'une simulation contrôlée par des machines intelligentes, et il rejoint une rébellion pour lutter contre elles.', 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:45:10', NULL),
(6, 'The Godfather', 1972, 'Francis Ford Coppola', 'La saga de la famille Corleone, une puissante dynastie criminelle italo-américaine, dirigée par le patriarche Vito Corleone.', 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:46:28', NULL),
(7, 'Schindler\'s List', 1993, 'Steven Spielberg', 'L\'histoire vraie d\'Oskar Schindler, un homme d\'affaires allemand, qui a sauvé la vie de plus de mille juifs pendant l\'Holocauste.', 'https://m.media-amazon.com/images/M/MV5BNDE4OTMxMTctNmRhYy00NWE2LTg3YzItYTk3M2UwOTU5Njg4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:01:38', NULL),
(8, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'Peter Jackson', 'Un jeune hobbit doit détruire un anneau maléfique pour empêcher le seigneur des ténèbres Sauron de conquérir le monde.', 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:01:38', NULL),
(9, 'Fight Club', 1999, 'David Fincher', 'Un employé de bureau insomniaque forme un club clandestin où les hommes peuvent exprimer leur masculinité à travers des combats physiques.', 'https://m.media-amazon.com/images/M/MV5BMmEzNTkxYjQtZTc0MC00YTVjLTg5ZTEtZWMwOWVlYzY0NWIwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg', '2024-01-30 17:01:38', '2024-01-30 17:01:38', NULL),
(10, 'The Shawshank Redemption', 1994, 'Frank Darabont', 'Deux hommes condamnés à la prison à vie se lient d\'amitié au fil des années, trouvant réconfort et rédemption par la musique et l\'espoir.', 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg', '2024-01-30 17:02:39', '2024-01-30 17:44:25', NULL),
(11, 'Barbie', 2023, 'Greta Gerwig', 'A Barbie Land, vous êtes un être parfait dans un monde parfait. Sauf si vous êtes en crise existentielle, ou si vous êtes Ken.', 'https://m.media-amazon.com/images/M/MV5BNjU3N2QxNzYtMjk1NC00MTc4LTk1NTQtMmUxNTljM2I0NDA5XkEyXkFqcGdeQXVyODE5NzE3OTE@._V1_.jpg', '2024-01-30 17:14:27', '2024-01-30 17:47:22', NULL),
(12, 'Kung Fu Panda 4', 2024, 'Mike Mitchell', 'Suivez Po dans ses aventures dans la Chine ancienne, où son amour du kung-fu n\'a d\'égal que son appétit insatiable.', 'https://m.media-amazon.com/images/M/MV5BZDY0YzI0OTctYjVhYy00MTVhLWE0NTgtYTRmYTBmOTE3YTViXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_QL75_UX190_CR0,10,190,281_.jpg', '2024-01-30 18:39:41', '2024-01-30 18:39:48', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
