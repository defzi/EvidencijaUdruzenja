<?php
class DBUdruzenja extends Tabela
// rad sa pogledom PodaciUdruzenja
{

public function DajSvePodatkeOUdruzenjima($filterParametar)
{
	if (isset($filterParametar) && $filterParametar !== null && $filterParametar !== "")
	{
		$upit="select * from `".$this->NazivBazePodataka."`.`PodaciUdruzenja` where `Grad`='".$filterParametar."'";
	}
	else
	{
		$upit="select * from `".$this->NazivBazePodataka."`.`PodaciUdruzenja`";
	}
	$this->UcitajSvePoUpitu($upit);
}

}
?>
