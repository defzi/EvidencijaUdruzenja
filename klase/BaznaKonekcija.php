<?php
class Konekcija{

public $host;
public $korisnik;
public $sifra;
public $prefiksNazivaBazePodataka;
public $nazivBazePodatakaBezPrefiksa;
public $KompletanNazivBazePodataka;
public $konekcijaDB;
public $link;

public function __construct($xmlPutanja)
{
	$xml = simplexml_load_file($xmlPutanja);
	$this->host = (string)$xml->host;
	$this->korisnik = (string)$xml->korisnik;
	$this->sifra = (string)$xml->sifra;
	$this->prefiksNazivaBazePodataka = (string)$xml->prefiks_baze_podataka;
	$this->nazivBazePodatakaBezPrefiksa = (string)$xml->naziv_baze_podataka;
	$this->KompletanNazivBazePodataka = $this->prefiksNazivaBazePodataka.$this->nazivBazePodatakaBezPrefiksa;
}

public function connect()
{
	$this->link = mysqli_connect($this->host, $this->korisnik, $this->sifra, $this->KompletanNazivBazePodataka);
	if (!$this->link)
	{
		$this->konekcijaDB = false;
	}
	else
	{
		$this->konekcijaDB = true;
		mysqli_set_charset($this->link, "utf8");
	}
}

public function disconnect()
{
	if ($this->link)
	{
		mysqli_close($this->link);
	}
}

}
?>
