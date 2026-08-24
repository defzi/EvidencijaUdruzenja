USE `evidencijaudruzenja`;


ALTER TABLE `kategorija` CHANGE COLUMN `imeudruzenja` `nazivkategorije` VARCHAR(60) NOT NULL;
ALTER TABLE `udruzenja` CHANGE COLUMN `vrstaudruzenja` `nazivudruzenja` VARCHAR(60) NOT NULL;

UPDATE `kategorija` SET `nazivkategorije`='Humanitarno' WHERE `brojkategorije`=1;
UPDATE `kategorija` SET `nazivkategorije`='Sportsko'    WHERE `brojkategorije`=2;
UPDATE `kategorija` SET `nazivkategorije`='Naučno'      WHERE `brojkategorije`=3;
UPDATE `kategorija` SET `nazivkategorije`='Kulturno'    WHERE `brojkategorije`=4;

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
