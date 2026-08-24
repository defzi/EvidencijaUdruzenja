<?php
session_start();
$korisnik=$_SESSION["korisnik"];
if (!isset($korisnik))
{
	header('Location:index.php');
}

$Naziv=$_POST['naziv'];
$Adresa=$_POST['adresa'];
$Grad=$_POST['grad'];
$Datum=$_POST['datumOsnivanja'];
$IDKategorije=$_POST['kategorija'];

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();

$UtvrdjenaGreska=null;

if ($KonekcijaObject->konekcijaDB)
{
	require('klase/DBUdruzenjaSP.php');
	$UdruzenjaObject = new DBUdruzenja($KonekcijaObject, 'Udruzenja');
	$UdruzenjaObject->NazivUdruzenja=$Naziv;
	$UdruzenjaObject->Adresa=$Adresa;
	$UdruzenjaObject->Grad=$Grad;
	$UdruzenjaObject->DatumOsnivanja=$Datum;
	$UdruzenjaObject->IDKategorije=$IDKategorije;
	$UtvrdjenaGreska=$UdruzenjaObject->DodajNovoUdruzenje();
}

$KonekcijaObject->disconnect();

if ($UtvrdjenaGreska!=null) {
	echo "Greška: $UtvrdjenaGreska";
}
else
{
	header('Location:udruzenjaLista.php');
}
?>
