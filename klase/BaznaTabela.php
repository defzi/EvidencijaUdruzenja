<?php
class Tabela{

public $OtvorenaKonekcija;
public $veza;
public $NazivBazePodataka;
public $NazivTabele;
public $Kolekcija;
public $BrojZapisa;
public $ListaZapisa;

public function __construct($konekcijaObj, $nazivTabele)
{
	$this->OtvorenaKonekcija = $konekcijaObj;
	$this->veza = $konekcijaObj->link;
	$this->NazivBazePodataka = $konekcijaObj->KompletanNazivBazePodataka;
	$this->NazivTabele = $nazivTabele;
	$this->Kolekcija = array();
	$this->BrojZapisa = 0;
	$this->ListaZapisa = array();
}

public function UcitajSvePoUpitu($sql)
{
	$this->Kolekcija = array();
	$this->BrojZapisa = 0;
	$rezultat = mysqli_query($this->veza, $sql);
	if ($rezultat)
	{
		while ($red = mysqli_fetch_row($rezultat))
		{
			$this->Kolekcija[] = $red;
			$this->BrojZapisa++;
		}
	}
}

public function IzvrsiAktivanSQLUpit($sql)
{
	$rezultat = mysqli_query($this->veza, $sql);
	if (!$rezultat)
	{
		return mysqli_error($this->veza);
	}
	return null;
}

public function DajVrednostPoRednomBrojuZapisaPoRBPolja($kolekcija, $redniBrojZapisa, $redniBrojPolja)
{
	if (isset($kolekcija[$redniBrojZapisa][$redniBrojPolja]))
	{
		return $kolekcija[$redniBrojZapisa][$redniBrojPolja];
	}
	return null;
}

public function PrebaciKolekcijuUListu($kolekcija)
{
	$this->ListaZapisa = $kolekcija;
}

}
?>
