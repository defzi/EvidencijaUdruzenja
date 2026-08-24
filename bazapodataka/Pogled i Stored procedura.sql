USE `EvidencijaUdruzenja`;

DROP VIEW IF EXISTS `PodaciUdruzenja`;

CREATE VIEW `PodaciUdruzenja` AS
SELECT
	`Udruzenja`.`IDUdruzenja`,
	`Udruzenja`.`NazivUdruzenja`,
	`Udruzenja`.`Adresa`,
	`Udruzenja`.`Grad`,
	`Udruzenja`.`DatumOsnivanja`,
	`Kategorija`.`NazivKategorije`
FROM `Udruzenja`
INNER JOIN `Kategorija` ON `Udruzenja`.`IDKategorije` = `Kategorija`.`IDKategorije`;

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
INSERT INTO `Udruzenja` (`NazivUdruzenja`, `Adresa`, `Grad`, `DatumOsnivanja`, `IDKategorije`)
VALUES (inNazivUdruzenja, inAdresa, inGrad, inDatumOsnivanja, inIDKategorije);
END 
$$
DELIMITER ;
