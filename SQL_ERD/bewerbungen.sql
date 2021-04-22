/* Database export results for db tklustig */

/* Preserve session variables */
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS=0;

/* Export data */

/* Table structure for bewerbungen */
CREATE TABLE `bewerbungen` (
  `bew_id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `firma` varchar(100) NOT NULL,
  `rechtsart` int(11) DEFAULT NULL,
  `stadt` varchar(100) NOT NULL,
  `plz` int(11) NOT NULL,
  `strasse_nr` varchar(100) DEFAULT NULL,
  `ansprech_person` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` int(11) DEFAULT NULL,
  `bemerkung` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`bew_id`),
  KEY `feedback` (`feedback`),
  KEY `rechtsart` (`rechtsart`),
  CONSTRAINT `bewerbungen_ibfk_1` FOREIGN KEY (`feedback`) REFERENCES `nachricht` (`id_message`),
  CONSTRAINT `bewerbungen_ibfk_2` FOREIGN KEY (`rechtsart`) REFERENCES `rechtsform` (`id_recht`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/* Table structure for nachricht */
CREATE TABLE `nachricht` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `notiz` varchar(25) NOT NULL,
  PRIMARY KEY (`id_message`),
  UNIQUE KEY `notiz` (`notiz`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/* data for Table nachricht */
INSERT INTO `nachricht` VALUES (1,"Ja");
INSERT INTO `nachricht` VALUES (2,"Nein");
INSERT INTO `nachricht` VALUES (3,"steht noch aus");

/* Table structure for rechtsform */
CREATE TABLE `rechtsform` (
  `id_recht` int(11) NOT NULL AUTO_INCREMENT,
  `art` varchar(20) NOT NULL,
  PRIMARY KEY (`id_recht`),
  UNIQUE KEY `art` (`art`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/* data for Table rechtsform */
INSERT INTO `rechtsform` VALUES (6,"AG");
INSERT INTO `rechtsform` VALUES (8,"eG");
INSERT INTO `rechtsform` VALUES (1,"Einzelunternehmen");
INSERT INTO `rechtsform` VALUES (2,"GbR");
INSERT INTO `rechtsform` VALUES (7,"GmbH");
INSERT INTO `rechtsform` VALUES (3,"GmbH & Co.KG");
INSERT INTO `rechtsform` VALUES (4,"KG");
INSERT INTO `rechtsform` VALUES (9,"KGaA");
INSERT INTO `rechtsform` VALUES (5,"OHG");
INSERT INTO `rechtsform` VALUES (10,"Stiftung");

/* Restore session variables to original values */
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
