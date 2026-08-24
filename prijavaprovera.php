<?php
session_start();
$loginUserName=$_POST['korisnickoIme'];
$loginPassword=$_POST['sifra'];

require 'klase/BaznaKonekcija.php';
require 'klase/BaznaTabela.php';
require 'klase/DBKorisnik.php';

$objKonekcija = new Konekcija('klase/BaznaParametriKonekcije.xml');
$objKonekcija->connect();
if ($objKonekcija->konekcijaDB)
{
	$objKorisnik = new DBKorisnik($objKonekcija, 'Korisnik');
	$postojiKorisnik=$objKorisnik->DaLiPostojiKorisnik($loginUserName,$loginPassword);
	if ($postojiKorisnik=="DA")
	{
		$_SESSION["korisnik"] = $objKorisnik->DajImePrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
		$_SESSION["status"] = $objKorisnik->DajStatusPrijavljenogKorisnika($loginUserName,$loginPassword);
		header('Location:Welcome.php');
	}
	else
	{
		header('Location:prijava.php');
	}
}
else
{
	echo "Neuspeh konekcije na bazu podataka!";
}
?>
