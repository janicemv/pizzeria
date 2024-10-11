CREATE TABLE `pizzas` (
  `pizzaId` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(100) NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `promo_prijs` decimal(10,2) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pizzaId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `plaats` (
  `plaatsId` int NOT NULL AUTO_INCREMENT,
  `code` int NOT NULL,
  `gemeente` varchar(100) NOT NULL,
  `bezorging` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`plaatsId`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `statussen` (
  `statusID` int NOT NULL AUTO_INCREMENT,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `klanten` (
  `klantId` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(100) NOT NULL,
  `voornaam` varchar(100) NOT NULL,
  `straat` varchar(255) NOT NULL,
  `nummer` varchar(10) NOT NULL,
  `plaatsId` int NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `promo_eligible` tinyint(1) DEFAULT '0',
  `bemerkingen` text,
  `guest` tinyint(1) NOT NULL,
  PRIMARY KEY (`klantId`),
  UNIQUE KEY `email` (`email`),
  KEY `klanten_ibfk_1` (`plaatsId`),
  CONSTRAINT `klanten_ibfk_1` FOREIGN KEY (`plaatsId`) REFERENCES `plaats` (`plaatsId`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `bestellingen` (
  `bestelId` int NOT NULL AUTO_INCREMENT,
  `klantId` int NOT NULL,
  `datum` datetime NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivery_plaatsId` int NOT NULL,
  `bemerkingen` text,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`bestelId`),
  KEY `status` (`status`),
  KEY `bestellingen_ibfk_1` (`klantId`),
  KEY `bestellingen_ibfk_2` (`delivery_plaatsId`),
  CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`),
  CONSTRAINT `bestellingen_ibfk_2` FOREIGN KEY (`delivery_plaatsId`) REFERENCES `plaats` (`plaatsId`),
  CONSTRAINT `bestellingen_ibfk_3` FOREIGN KEY (`status`) REFERENCES `statussen` (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `bestellijnen` (
  `lijnId` int NOT NULL AUTO_INCREMENT,
  `bestelId` int NOT NULL,
  `pizzaId` int NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `hoeveel` int NOT NULL,
  PRIMARY KEY (`lijnId`),
  KEY `bestelId` (`bestelId`),
  KEY `pizzaId` (`pizzaId`),
  CONSTRAINT `bestellijnen_ibfk_1` FOREIGN KEY (`bestelId`) REFERENCES `bestellingen` (`bestelId`),
  CONSTRAINT `bestellijnen_ibfk_2` FOREIGN KEY (`pizzaId`) REFERENCES `pizzas` (`pizzaId`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




INSERT INTO pizzas (naam, omschrijving, prijs, promo_prijs, beschikbaar) VALUES
('Margherita', 'Klassieke pizza met tomatensaus, verse mozzarella, basilicum en extra vierge olijfolie.', 8.50, 7.00, TRUE),
('Pepperoni', 'Pizza met tomatensaus, mozzarella en royale plakken licht pittige pepperoni.', 9.00, 6.50, TRUE),
('Quattro Formaggi', 'Combinatie van vier kazen: mozzarella, gorgonzola, Parmezaanse kaas en provolone op een tomatensausbasis.', 10.50, 8.50, TRUE),
('Capricciosa', 'Tomatensaus, mozzarella, ham, artisjokken, zwarte olijven en verse champignons.', 11.00, 9.00, TRUE),
('Hawaiian', 'Een zoet-zoute mix van tomatensaus, mozzarella, ham en ananas.', 9.50, 8.00, TRUE),
('Diavola', 'Pittige pizza met tomatensaus, mozzarella, pittige salami, chilipeper en oregano.', 10.00, 8.00, TRUE),
('Vegetariana', 'Tomatensaus, mozzarella, paprika, champignons, ui, olijven en gegrilde aubergine.', 9.50, 8.50, TRUE),
('Prosciutto e Funghi', 'Pizza met tomatensaus, mozzarella, gekookte ham en verse champignons.', 10.00, 7.50, TRUE),
('Tonno e Cipolla', 'Tomatensaus, mozzarella, tonijn en rode uiringen.', 9.50, 7.00, TRUE),
('Calabrese', 'Tomatensaus, mozzarella, pittige Calabrische worst en ui.', 10.00, 8.00, TRUE);

INSERT INTO plaats (code, gemeente, bezorging) VALUES 
('3000', 'Leuven', 1),
('3001', 'Heverlee', 1),
('3010', 'Kessel-Lo (Leuven)', 1),
('3012', 'Wilsele', 1),
('3018', 'Wijgmaal (Brabant)', 0),
('3020', 'Herent', 1),
('3040', 'Huldenberg', 0),
('3050', 'Oud-Heverlee', 1),
('3053', 'Haasrode', 1),
('3054', 'Vaalbeek', 0),
('3060', 'Bertem', 1),
('3061', 'Leefdaal', 1),
('3070', 'Kortenberg', 1),
('3078', 'Everberg', 0),
('3080', 'Duisburg', 0),
('3090', 'Overijse', 0),
('3110', 'Rots', 0);

INSERT INTO statussen (statusID, status) VALUES
(1, 'Besteld'),
(2, 'Gemaakt'),
(3, 'Bezorgd');
