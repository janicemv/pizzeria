CREATE TABLE pizzas (
    pizzaId INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100),
    omschrijving TEXT,
    prijs DECIMAL(10, 2),
    promo_prijs DECIMAL(10, 2),
    beschikbaar BOOLEAN DEFAULT TRUE
);
CREATE TABLE plaats (
    plaatsId INT AUTO_INCREMENT PRIMARY KEY,
    code INT UNIQUE,
    gemeente VARCHAR(100),
    bezorging BOOLEAN NOT NULL
);

CREATE TABLE klanten (
    klantId INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100),
    voornaam VARCHAR(100),
    straat VARCHAR(255),
    nummer VARCHAR(10),
    plaatsId INT,
    phone VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    promo_eligible BOOLEAN DEFAULT FALSE,
    bemerkingen TEXT,
    guest BOOLEAN NOT NULL,
    FOREIGN KEY (plaatsId) REFERENCES plaats(plaatsId)
);

 CREATE TABLE statussen (
  statusID int NOT NULL AUTO_INCREMENT,
  status varchar(40) NOT NULL,
  PRIMARY KEY (statusID)
 );
 
CREATE TABLE bestellingen (
    bestelId INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    klantId INT,
    datum DATETIME,
    delivery_address VARCHAR(255),
    delivery_plaatsId INT,
    bemerkingen TEXT,
    status INT NOT NULL DEFAULT 1,
    FOREIGN KEY (klantId) REFERENCES klanten(klantId),
    FOREIGN KEY (delivery_plaatsId) REFERENCES plaats(plaatsId)
    FOREIGN KEY (status) REFERENCES statussen(statusID),
);

CREATE TABLE bestellijnen (
    lijnId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bestelId INT NOT NULL,
    pizzaId INT NOT NULL,
    hoeveel INT NOT NULL,
    prijs DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (bestelId) REFERENCES bestellingen(bestelId),
    FOREIGN KEY (pizzaId) REFERENCES pizzas(pizzaId)
);




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