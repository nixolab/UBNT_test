CREATE SCHEMA `db_ubnt_test`;
USE `db_ubnt_test`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table album
# ------------------------------------------------------------

CREATE TABLE `album` (
  `id_album` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_typ_zanr` int(10) unsigned NOT NULL,
  `nazev` varchar(256) NOT NULL,
  `datum_vydani` date NOT NULL,
  PRIMARY KEY (`id_album`),
  FOREIGN KEY (`id_typ_zanr`) REFERENCES `typ_zanr` (`id_typ_zanr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `album` (`id_album`, `id_typ_zanr`, `nazev`, `datum_vydani`)
VALUES
	(1,1,'Yellow Submarine','1969-01-13'),
	(2,2,'Let It Be','1970-05-08'),
	(3,3,'Steamin\' with the Miles Davis Quintet','1961-05-12'),
	(4,4,'Trans-Europe Express','1977-03-09'),
	(5,4,'Kraftwerk 2','1972-01-27');


# Dump of table album_interpret
# ------------------------------------------------------------

CREATE TABLE `album_interpret` (
  `id_album_interpret` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_album` int(10) unsigned NOT NULL,
  `id_interpret` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_album_interpret`),
  FOREIGN KEY (`id_interpret`) REFERENCES `interpret` (`id_interpret`),
  FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `album_interpret` (`id_album_interpret`, `id_album`, `id_interpret`)
VALUES
	(1,1,3),
	(2,2,3),
	(3,3,1),
	(4,4,2),
	(5,5,2);


# Dump of table album_skladba
# ------------------------------------------------------------

CREATE TABLE `album_skladba` (
  `id_album_skladba` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cislo_stopy` int(10) unsigned NOT NULL,
  `id_album` int(10) unsigned NOT NULL,
  `id_skladba` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_album_skladba`),
  FOREIGN KEY (`id_skladba`) REFERENCES `skladba` (`id_skladba`),
  FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `album_skladba` (`id_album_skladba`, `cislo_stopy`, `id_album`, `id_skladba`)
VALUES
	(1,1,1,1),
	(2,2,1,2),
	(3,3,1,3),
	(4,4,1,4),
	(5,5,1,5),
	(6,6,1,6),
	(7,1,2,7),
	(8,2,2,8),
	(9,3,2,9),
	(10,4,2,10),
	(11,1,3,11),
	(12,2,3,12),
	(13,3,3,13),
	(14,4,3,14),
	(15,5,3,15),
	(16,6,3,16),
	(17,1,4,17),
	(18,2,4,18),
	(19,3,4,19),
	(20,4,4,20),
	(21,1,5,21),
	(22,2,5,22),
	(23,3,5,23),
	(24,4,5,24),
	(25,5,5,25),
	(26,6,5,26);


# Dump of table interpret
# ------------------------------------------------------------

CREATE TABLE `interpret` (
  `id_interpret` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(256) NOT NULL,
  `id_typ_narodnost` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_interpret`),
  FOREIGN KEY (`id_typ_narodnost`) REFERENCES `typ_narodnost` (`id_typ_narodnost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `interpret` (`id_interpret`, `nazev`, `id_typ_narodnost`)
VALUES
	(1,'Miles Davis',3),
	(2,'Kraftwerk',2),
	(3,'The Beatles',1);


# Dump of table skladba
# ------------------------------------------------------------

CREATE TABLE `skladba` (
  `id_skladba` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(256) NOT NULL,
  `delka` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_skladba`),
	KEY (`delka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `skladba` (`id_skladba`, `nazev`, `delka`)
VALUES
	(1,'Yellow Submarine',160),
	(2,'Only a Northern Song',204),
	(3,'All Together Now',131),
	(4,'Hey Bulldog',191),
	(5,'It\'s All Too Much',385),
	(6,'All You Need Is Love',231),
	(7,'Two of Us',217),
	(8,'Dig a Pony',235),
	(9,'Across the Universe',228),
	(10,'I Me Mine',146),
	(11,'Surrey with the Fringe on Top',545),
	(12,'Salt Peanuts',369),
	(13,'Something I Dreamed Last Night',375),
	(14,'Diane',469),
	(15,'Well, You Needn\'t',379),
	(16,'When I Fall in Love',263),
	(17,'Europe Endless',580),
	(18,'The Hall of Mirrors',476),
	(19,'Showroom Dummies',375),
	(20,'Trans-Europe Express',412),
	(21,'Klingklang',1056),
	(22,'Atem',177),
	(23,'Strom',232),
	(24,'Spule 4',320),
	(25,'Wellenlange',540),
	(26,'Harmonika',197);


# Dump of table typ_narodnost
# ------------------------------------------------------------

CREATE TABLE `typ_narodnost` (
  `id_typ_narodnost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(256) NOT NULL,
  PRIMARY KEY (`id_typ_narodnost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `typ_narodnost` (`id_typ_narodnost`, `nazev`)
VALUES
	(1,'British'),
	(2,'German'),
	(3,'American');


# Dump of table typ_zanr
# ------------------------------------------------------------

CREATE TABLE `typ_zanr` (
  `id_typ_zanr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(256) NOT NULL,
  PRIMARY KEY (`id_typ_zanr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `typ_zanr` (`id_typ_zanr`, `nazev`)
VALUES
	(1,'Rock'),
	(2,'Blues'),
	(3,'Jazz'),
	(4,'Electronic');


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;