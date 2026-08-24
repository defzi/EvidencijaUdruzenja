<?php
class DBKorisnik extends Tabela{

public $IDKorisnika;
public $Prezime;
public $Ime;
public $Email;
public $KorisnickoIme;
public $Sifra;

public function DaLiPostojiKorisnik($loginusername,$loginpassword)
{
	$SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Korisnik` WHERE KorisnickoIme='".$loginusername."' AND Lozinka='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
	return ($this->BrojZapisa>0) ? "DA" : "NE";
}

public function DajImePrezimePrijavljenogKorisnika($loginusername,$loginpassword)
{
	$SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Korisnik` WHERE KorisnickoIme='".$loginusername."' AND Lozinka='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
	$korisnik='NEPOZNAT KORISNIK';
	if ($this->BrojZapisa>0)
	{
		foreach ($this->Kolekcija as $red)
		{
			$korisnik=$red[1].' '.$red[2]; // Ime Prezime
		}
	}
	return $korisnik;
}

public function DajStatusPrijavljenogKorisnika($loginusername,$loginpassword)
{
	$SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Korisnik` WHERE KorisnickoIme='".$loginusername."' AND Lozinka='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
	$status='korisnik';
	if ($this->BrojZapisa>0)
	{
		foreach ($this->Kolekcija as $red)
		{
			$status=$red[7]; // StatusKorisnika
		}
	}
	return $status;
}

}
?>
