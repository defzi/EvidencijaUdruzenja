<?php
class DBKategorija extends Tabela
{
public $IDKategorije;
public $NazivKategorije;
public $BrojKategorije;

public function UcitajKolekcijuSvihKategorija()
{
	$SQL = "select * from `".$this->NazivBazePodataka."`.`Kategorija` ORDER BY IDKategorije ASC";
	$this->UcitajSvePoUpitu($SQL);
}

}
?>
