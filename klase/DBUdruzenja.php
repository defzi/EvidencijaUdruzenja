<?php
class DBUdruzenja extends Tabela
{
public $IDUdruzenja;
public $NazivUdruzenja;
public $Adresa;
public $Grad;
public $DatumOsnivanja;
public $IDKategorije;

public function DajKolekcijuSvihUdruzenja()
{
	$SQL = "select * from `".$this->NazivBazePodataka."`.`Udruzenja` ORDER BY IDUdruzenja ASC";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}

public function UcitajUdruzenjePoId($idUdruzenja)
{
	$SQL = "select * from `".$this->NazivBazePodataka."`.`Udruzenja` where `IDUdruzenja`='".$idUdruzenja."'";
	$this->UcitajSvePoUpitu($SQL);
}

public function DodajNovoUdruzenje()
{
	$SQL = "INSERT INTO `".$this->NazivBazePodataka."`.`Udruzenja` (NazivUdruzenja, Adresa, Grad, DatumOsnivanja, IDKategorije) VALUES ('$this->NazivUdruzenja','$this->Adresa','$this->Grad','$this->DatumOsnivanja', $this->IDKategorije)";
	return $this->IzvrsiAktivanSQLUpit($SQL);
}

public function ObrisiUdruzenje($IDZaBrisanje)
{
	$SQL = "DELETE FROM `".$this->NazivBazePodataka."`.`Udruzenja` WHERE IDUdruzenja='".$IDZaBrisanje."'";
	return $this->IzvrsiAktivanSQLUpit($SQL);
}

public function IzmeniUdruzenje($stariID, $NazivUdruzenja, $Adresa, $Grad, $DatumOsnivanja, $IDKategorije)
{
	$SQL = "UPDATE `".$this->NazivBazePodataka."`.`Udruzenja` SET NazivUdruzenja='$NazivUdruzenja', Adresa='$Adresa', Grad='$Grad', DatumOsnivanja='$DatumOsnivanja', IDKategorije='$IDKategorije' WHERE IDUdruzenja = $stariID";
	return $this->IzvrsiAktivanSQLUpit($SQL);
}

}
?>
