<?php
session_start();
$korisnik=$_SESSION["korisnik"];
if (!isset($korisnik))
{
	header('Location:index.php');
}

$id=$_POST['StariId'];
$Naziv=$_POST['naziv'];
$Adresa=$_POST['adresa'];
$Grad=$_POST['grad'];
$Datum=$_POST['datumOsnivanja'];
$IDKategorije=$_POST['kategorija'];

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();
if ($KonekcijaObject->konekcijaDB)
{
	require "klase/DBUdruzenja.php";
	$UdruzenjaObject = new DBUdruzenja($KonekcijaObject, 'Udruzenja');
	$greska=$UdruzenjaObject->IzmeniUdruzenje($id, $Naziv, $Adresa, $Grad, $Datum, $IDKategorije);
}
else
{
	echo "Nije uspostavljena konekcija ka bazi podataka!";
}

$KonekcijaObject->disconnect();

header('Location:udruzenjaLista.php');
?>
