<?php

session_start();


// Proverava da li je korisnik prijavljen

if (
    !isset($_SESSION["korisnik"])
    || !isset($_SESSION["status"])
)
{
    header('Location:index.php');
    exit();
}


// Adminstrator ima mogućnost izmene

if ($_SESSION["status"] != "admin")
{
    header('Location:udruzenjaLista.php');
    exit();
}


// Preuzimanje podataka iz baze

$id = isset($_POST['StariId'])
    ? $_POST['StariId']
    : '';

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


// Uključivanje potrebnih baza

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenja.php";
require_once "klase/UdruzenjaLogika.php";


// Konekcija sa bazom

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

        // Validiranje i izmena podataka u bazi
        $UtvrdjenaGreska =
            $UdruzenjaLogika->IzmeniUdruzenje(
                $id,
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


// Provera rezultata

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