/* Kreiranje baze */

CREATE DATABASE IF NOT EXISTS `EvidencijaUdruzenja`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `EvidencijaUdruzenja`;

/* Kategorija udruzenja */
CREATE TABLE `Kategorija` (
	`IDKategorije`	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`NazivKategorije` VARCHAR(60) NOT NULL,
	`BrojKategorije` INT NOT NULL
);

/* Tabela udruzenja */

CREATE TABLE `Udruzenja` (
    `IDUdruzenja` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `NazivUdruzenja` VARCHAR(60) NOT NULL,
    `Adresa` VARCHAR(60) NOT NULL,
    `Grad` VARCHAR(30) NOT NULL,
    `DatumOsnivanja` DATETIME,
    `IDKategorije` INT NOT NULL,

    CONSTRAINT `UQ_Udruzenja_Naziv`
        UNIQUE (`NazivUdruzenja`),

    CONSTRAINT `FK_pripada`
        FOREIGN KEY (`IDKategorije`)
        REFERENCES `Kategorija` (`IDKategorije`)
);

/* Korisnik */

CREATE TABLE `Korisnik` (
	`IDKorisnika`	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`Ime`			VARCHAR(30) NOT NULL,
	`Prezime`		VARCHAR(40) NOT NULL,
	`Email`			VARCHAR(60) NOT NULL,
	`KorisnickoIme`	VARCHAR(30) NOT NULL,
	`Lozinka`		VARCHAR(32) NOT NULL,
	`URLSlike`		VARCHAR(256) NOT NULL,
	`StatusKorisnika` VARCHAR(30) NOT NULL
);

/* Ubacivanje kategorija u bazu podataka */

INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Humanitarno', 1);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Sportsko', 2);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Naučno', 3);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Kulturno', 4);

/* Podaci za korisnike. 1 administrator i 1 korisnik */

INSERT INTO `Korisnik` (`Prezime`, `Ime`, `Email`, `KorisnickoIme`, `Lozinka`, `URLSlike`, `StatusKorisnika`)
VALUES ('Jovanov', 'Dragan', 'dragan.jovanov@tfzr.rs', 'admin', 'rts', 'Jovanov.jpg', 'admin');

INSERT INTO `Korisnik` (`Prezime`, `Ime`, `Email`, `KorisnickoIme`, `Lozinka`, `URLSlike`, `StatusKorisnika`)
VALUES ('Petrovic', 'Petar', 'petar.petrovic@yahoo.com', 'korisnik', '123', 'Korisnik.jpg', 'korisnik');

/* Ubacujemo dva udruzenja da lista ne bude prazna */

INSERT INTO `Udruzenja` (`NazivUdruzenja`, `Adresa`, `Grad`, `DatumOsnivanja`, `IDKategorije`)
VALUES ('Udruženje mladih volontera', 'Ulica Slobode 12', 'Zrenjanin', '2015-03-10', 1);

INSERT INTO `Udruzenja` (`NazivUdruzenja`, `Adresa`, `Grad`, `DatumOsnivanja`, `IDKategorije`)
VALUES ('Udruženje Crvenog krsta', 'Trg Republike 5', 'Novi Sad', '2010-06-22', 1);
