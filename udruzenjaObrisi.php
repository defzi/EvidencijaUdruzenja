<?php
session_start();
$korisnik=$_SESSION["korisnik"];
if (!isset($korisnik))
{
	header('Location:index.php');
}

$IdZaBrisanje=$_POST['ID'];

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";
$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();
if ($KonekcijaObject->konekcijaDB)
{
	require "klase/DBUdruzenja.php";
	$UdruzenjaObject = new DBUdruzenja($KonekcijaObject, 'Udruzenja');
	$greska=$UdruzenjaObject->ObrisiUdruzenje($IdZaBrisanje);
}

$KonekcijaObject->disconnect();

header('Location:udruzenjaLista.php');
?>
