<?php
class DBUdruzenja extends Tabela
{
public $NazivUdruzenja;
public $Adresa;
public $Grad;
public $DatumOsnivanja;
public $IDKategorije;

public function DodajNovoUdruzenje()
{
	$GreskaPar1 = $this->IzvrsiAktivanSQLUpit("SET @NazivUdruzenjaParametar='".$this->NazivUdruzenja."'");
	$GreskaPar2 = $this->IzvrsiAktivanSQLUpit("SET @AdresaParametar='".$this->Adresa."'");
	$GreskaPar3 = $this->IzvrsiAktivanSQLUpit("SET @GradParametar='".$this->Grad."'");
	$GreskaPar4 = $this->IzvrsiAktivanSQLUpit("SET @DatumOsnivanjaParametar='".$this->DatumOsnivanja."'");
	$GreskaPar5 = $this->IzvrsiAktivanSQLUpit("SET @IDKategorijeParametar=".$this->IDKategorije);

	$GreskaCall = $this->IzvrsiAktivanSQLUpit("CALL `DodajUdruzenje`(@NazivUdruzenjaParametar, @AdresaParametar, @GradParametar, @DatumOsnivanjaParametar, @IDKategorijeParametar);");

	return $GreskaPar1.$GreskaPar2.$GreskaPar3.$GreskaPar4.$GreskaPar5.$GreskaCall;
}

}
?>
