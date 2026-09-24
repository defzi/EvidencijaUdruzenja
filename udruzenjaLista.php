<?php

session_start();


// Provera korisnika

if (!isset($_SESSION["korisnik"]))
{
    header('Location:index.php');
    exit();
}

$korisnik = $_SESSION["korisnik"];


// Uključivanje klasa

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenjaV.php";
require_once "klase/ValidacijaUdruzenja.php";


// Povezivanje s bazom

$KonekcijaObject = new Konekcija(
    'klase/BaznaParametriKonekcije.xml'
);

$KonekcijaObject->connect();


// Početne vrednosti

$filter = null;
$greskaFiltera = null;
$poljeFiltera = "Grad";


// Provera povezivanja

if ($KonekcijaObject->konekcijaDB)
{

    // Sadrži klasu DBUdruzenja koja radi s pogledom PodaciUdruzenja

    $UdruzenjaViewObject = new DBUdruzenja(
        $KonekcijaObject,
        "Udruzenja"
    );


 try
{
    // Pritisnuto je dugme za filtriranje

    if (isset($_GET['filtriraj']))
    {
        $filter = isset($_GET['filter'])
            ? trim($_GET['filter'])
            : '';

        // Osnovna validacija filtera

        $greskaFiltera =
            ValidacijaUdruzenja::ProveriFilter(
                $filter
            );


        // Ako filter nije ispravan, prikazuju se svi podaci

        if ($greskaFiltera != null)
        {
            $filter = null;

            $UdruzenjaViewObject
                ->DajSvePodatkeOUdruzenjima(
                    null,
                    $poljeFiltera
                );
        }
        else
        {
            $UdruzenjaViewObject
                ->DajSvePodatkeOUdruzenjima(
                    $filter,
                    $poljeFiltera
                );
        }
    }

    // Ako nema filtriranja, prikazuju se svi podaci

    else
    {
        $UdruzenjaViewObject
            ->DajSvePodatkeOUdruzenjima(
                null,
                $poljeFiltera
            );
    }
}
catch (Exception $e)
{
    $greskaFiltera =
        $e->getMessage();

    $UdruzenjaViewObject
        ->DajSvePodatkeOUdruzenjima(
            null,
            $poljeFiltera
            );
}
}
else
{
    $greskaFiltera =
        "Nije moguće uspostaviti konekciju sa bazom podataka.";
}


// Izvlačimo prikaz stranice iz HTML-a iz drugog fajla 

include 'delovi/udruzenjaListaPrikaz.php';

?>