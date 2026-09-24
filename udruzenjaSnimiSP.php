<?php

session_start();


// Provera korisnika

if (
    !isset($_SESSION["korisnik"])
    || !isset($_SESSION["status"])
)
{
    header('Location:index.php');
    exit();
}


// Samo administrator može da dodaje udruženja

if ($_SESSION["status"] != "admin")
{
    header('Location:udruzenjaLista.php');
    exit();
}


// Preuzimamo podatke iz forme

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


// Potrebne klase

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenjaSP.php";
require_once "klase/UdruzenjaLogika.php";
require_once "klase/ValidacijaUdruzenja.php";


// Konekcije sa bazom

$KonekcijaObject = new Konekcija(
    'klase/BaznaParametriKonekcije.xml'
);

$KonekcijaObject->connect();

$UtvrdjenaGreska = null;


if ($KonekcijaObject->konekcijaDB)
{
    // Data sloj koristi stored procedure

    $UdruzenjaObject = new DBUdruzenja(
        $KonekcijaObject,
        'Udruzenja'
    );

   try
{
    // Osnovna validacija korisničkog unosa

    $UtvrdjenaGreska =
        ValidacijaUdruzenja::ProveriPodatke(
            $Naziv,
            $Adresa,
            $Grad,
            $Datum,
            $IDKategorije
        );


    // Poslovna logika i poziv stored procedure izvršavaju se samo ako je osnovna validacija uspešna

    if ($UtvrdjenaGreska == null)
    {
        $UdruzenjaLogika = new UdruzenjaLogika(
            $UdruzenjaObject
        );

        $UtvrdjenaGreska =
            $UdruzenjaLogika->DodajUdruzenje(
                $Naziv,
                $Adresa,
                $Grad,
                $Datum,
                $IDKategorije
            );
    }
}
catch (Exception $e)
{
    $UtvrdjenaGreska =
        $e->getMessage();
}
}
else
{
    $UtvrdjenaGreska =
        "Nije moguće uspostaviti konekciju sa bazom podataka.";
}


$KonekcijaObject->disconnect();


if ($UtvrdjenaGreska != null)
{
    echo "Greška: " . htmlspecialchars(
        $UtvrdjenaGreska,
        ENT_QUOTES,
        'UTF-8'
    );
}
else
{
    header('Location:udruzenjaLista.php');
    exit();
}

?>