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
require_once "klase/UdruzenjaLogika.php";


// Povezivanje s bazom

$KonekcijaObject = new Konekcija(
    'klase/BaznaParametriKonekcije.xml'
);

$KonekcijaObject->connect();


// Početne vrednosi

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

        // Kreiranje logike preko poslovne logike

        $UdruzenjaLogika = new UdruzenjaLogika(
            $UdruzenjaViewObject
        );


        // Kriterijum filtera iz XML fajla

        $poljeFiltera =
            $UdruzenjaLogika
                ->DajPoljeFiltera();


        // Pritisnuto je dugme za filtriranje

        if (isset($_GET['filtriraj']))
        {
            $filter = isset($_GET['filter'])
                ? trim($_GET['filter'])
                : '';

            // Provera filtera preko logike

            $greskaFiltera =
                $UdruzenjaLogika
                    ->ProveriFilter(
                        $filter
                    );


            // Ako nije ispravan filter, prikazujemo sve

            if ($greskaFiltera != null)
            {
                $filter = null;

                $UdruzenjaViewObject
                    ->DajSvePodatkeOUdruzenjima(
                        null,
                        $poljeFiltera
                    );
            }

            // U slučaju ako je filter ispravljen

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

        // Ako se poslovna pravila ne mogu učitati, pokušavamo da prikažemo sve podatke.

        $UdruzenjaViewObject
            ->DajSvePodatkeOUdruzenjima(
                null,
                "Grad"
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