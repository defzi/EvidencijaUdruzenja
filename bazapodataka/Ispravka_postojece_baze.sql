-- ============================================================
-- ISPRAVKA postojeće baze (pokreni ovo umesto ponovnog importa
-- od nule — ne gubiš postojeće podatke o korisnicima)
-- ============================================================

USE `evidencijaudruzenja`;

-- 1) Kategorija: kolona je trebalo da bude vrsta udruženja, ne ime
ALTER TABLE `kategorija` CHANGE COLUMN `imeudruzenja` `nazivkategorije` VARCHAR(60) NOT NULL;

-- 2) Udruzenja: "vrsta" je zapravo trebalo da bude naziv udruženja
ALTER TABLE `udruzenja` CHANGE COLUMN `vrstaudruzenja` `nazivudruzenja` VARCHAR(60) NOT NULL;

-- 3) Ispravi postojeće vrednosti u Kategoriji na stvarne tipove
UPDATE `kategorija` SET `nazivkategorije`='Humanitarno' WHERE `brojkategorije`=1;
UPDATE `kategorija` SET `nazivkategorije`='Sportsko'    WHERE `brojkategorije`=2;
UPDATE `kategorija` SET `nazivkategorije`='Naučno'      WHERE `brojkategorije`=3;
UPDATE `kategorija` SET `nazivkategorije`='Kulturno'    WHERE `brojkategorije`=4;

-- 4) Ponovo napravi pogled sa novim nazivima kolona
DROP VIEW IF EXISTS `podaciudruzenja`;
CREATE VIEW `podaciudruzenja` AS
SELECT
	`udruzenja`.`idudruzenja`,
	`udruzenja`.`nazivudruzenja`,
	`udruzenja`.`adresa`,
	`udruzenja`.`grad`,
	`udruzenja`.`datumosnivanja`,
	`kategorija`.`nazivkategorije`
FROM `udruzenja`
INNER JOIN `kategorija` ON `udruzenja`.`idkategorije` = `kategorija`.`idkategorije`;

-- 5) Ponovo napravi stored proceduru sa novim imenom parametra
DROP PROCEDURE IF EXISTS `DodajUdruzenje`;
DELIMITER $$
CREATE PROCEDURE `DodajUdruzenje` (
	IN inNazivUdruzenja VARCHAR(60),
	IN inAdresa VARCHAR(60),
	IN inGrad VARCHAR(30),
	IN inDatumOsnivanja DATE,
	IN inIDKategorije INT
)
BEGIN
	INSERT INTO `udruzenja` (`nazivudruzenja`, `adresa`, `grad`, `datumosnivanja`, `idkategorije`)
	VALUES (inNazivUdruzenja, inAdresa, inGrad, inDatumOsnivanja, inIDKategorije);
END $$
DELIMITER ;
