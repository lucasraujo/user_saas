CREATE TABLE `ci4db`.`users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `HASH` varchar(200) NOT NULL,
  `NAME` varchar(120) NOT NULL,
  `EMAIL` varchar(120) NOT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `FK_USER_TYPE` int NOT NULL DEFAULT '2',
  `DTHR_INSERT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_INSERT` int DEFAULT NULL,
  `DTHR_UPDATE` datetime DEFAULT NULL,
  `USER_UPDATE` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`),
  KEY `type_user_idx` (`FK_USER_TYPE`)
);

CREATE TABLE `ci4db`.`type_user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `HASH` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
);
