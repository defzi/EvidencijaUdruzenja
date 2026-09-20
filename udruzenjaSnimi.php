<?php

session_start();

if (
    !isset($_SESSION["korisnik"])
    || !isset($_SESSION["status"])
)
{
    header('Location:index.php');
    exit();
}

if ($_SESSION["status"] != "admin")
{
    header('Location:udruzenjaLista.php');
    exit();
}


// Provera prijavljenog korisnika

if (!isset($_SESSION["korisnik"]))
{
    header('Location:index.php');
    exit();
}


// Preuzimamo podatke s formi

$Naziv = isset($_POST['naziv'])
    ? $_POST['naziv']
    : '';

$Adresa = isset($_POST['adresa'])
    ? $_POST['adresa']
    : '';

$Grad = isset($_POST['grad'])
    ? $_POST['grad']
    : '';

$Datum = isset($_POST['datumOsnivanja'])
    ? $_POST['datumOsnivanja']
    : '';

$IDKategorije = isset($_POST['kategorija'])
    ? $_POST['kategorija']
    : '';


// Potrebne klase se prikljucuju ovde

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenja.php";
require_once "klase/UdruzenjaLogika.php";


// Bazna konekcija

$KonekcijaObject = new Konekcija(
    'klase/BaznaParametriKonekcije.xml'
);

$KonekcijaObject->connect();

$UtvrdjenaGreska = null;


// Provera konekcije

if ($KonekcijaObject->konekcijaDB)
{
    // data sloj
    $UdruzenjaObject = new DBUdruzenja(
        $KonekcijaObject,
        'Udruzenja'
    );


    try
    {
        // Poslovna logika
        $UdruzenjaLogika = new UdruzenjaLogika(
            $UdruzenjaObject
        );


        // Validiranje unosa u bazu
        $UtvrdjenaGreska =
            $UdruzenjaLogika->DodajUdruzenje(
                $Naziv,
                $Adresa,
                $Grad,
                $Datum,
                $IDKategorije
            );
    }
    catch (Exception $e)
    {
        $UtvrdjenaGreska = $e->getMessage();
    }
}
else
{
    $UtvrdjenaGreska =
        "Nije moguće uspostaviti konekciju sa bazom podataka.";
}


// Zatvaranje konekcije

$KonekcijaObject->disconnect();


// Proveravanje rezultata

if ($UtvrdjenaGreska != null)
{
    echo "Greška: " . $UtvrdjenaGreska;
}
else
{
    header('Location:udruzenjaLista.php');
    exit();
}

?>