-- Kreiranje baze podataka
CREATE DATABASE IF NOT EXISTS `EvidencijaUdruzenja`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `EvidencijaUdruzenja`;

-- Kreiranje tabele "Kategorija"
CREATE TABLE `Kategorija` (
	`IDKategorije`	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`NazivKategorije` VARCHAR(60) NOT NULL,
	`BrojKategorije` INT NOT NULL
);

-- Kreiranje tabele udruzenja
CREATE TABLE `Udruzenja` (
	`IDUdruzenja`	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`NazivUdruzenja` VARCHAR(60) NOT NULL,
	`Adresa`		VARCHAR(60) NOT NULL,
	`Grad`			VARCHAR(30) NOT NULL,
	`DatumOsnivanja` DATETIME,
	`IDKategorije`	INT NOT NULL,
	CONSTRAINT `FK_pripada` FOREIGN KEY (`IDKategorije`)
		REFERENCES `Kategorija` (`IDKategorije`)
);

-- Kreiranje tabele korisnika
CREATE TABLE `Korisnik` 
(
	`IDKorisnika`	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`Ime`			VARCHAR(30) NOT NULL,
	`Prezime`		VARCHAR(40) NOT NULL,
	`Email`			VARCHAR(60) NOT NULL,
	`KorisnickoIme`	VARCHAR(30) NOT NULL,
	`Lozinka`		VARCHAR(32) NOT NULL,
	`StatusKorisnika` VARCHAR(30) NOT NULL
);

-- Unos kategorija udruzenja u tabelu "Kategorija"
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Humanitarno', 1);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Sportsko', 2);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Naučno', 3);
INSERT INTO `Kategorija` (`NazivKategorije`, `BrojKategorije`) VALUES ('Kulturno', 4);

-- Unos admin naloga i korisnickog naloga u tabelu "Korisnik"
INSERT INTO `Korisnik` (`Prezime`, `Ime`, `Email`, `KorisnickoIme`, `Lozinka`, `URLSlike`, `StatusKorisnika`)
VALUES ('Jovanov', 'Dragan', 'dragan.jovanov@tfzr.rs', 'admin', 'rts', 'Jovanov.jpg', 'admin');

INSERT INTO `Korisnik` (`Prezime`, `Ime`, `Email`, `KorisnickoIme`, `Lozinka`, `URLSlike`, `StatusKorisnika`)
VALUES ('Petrovic', 'Petar', 'petar.petrovic@yahoo.com', 'korisnik', '123', 'Korisnik.jpg', 'korisnik');

-- Unos udruzenja u bazu
INSERT INTO `Udruzenja` (`NazivUdruzenja`, `Adresa`, `Grad`, `DatumOsnivanja`, `IDKategorije`)
VALUES ('Udruženje mladih volontera', 'Ulica Slobode 12', 'Zrenjanin', '2015-03-10', 1);

INSERT INTO `Udruzenja` (`NazivUdruzenja`, `Adresa`, `Grad`, `DatumOsnivanja`, `IDKategorije`)
VALUES ('Udruženje Crvenog krsta', 'Trg Republike 5', 'Novi Sad', '2010-06-22', 1);
