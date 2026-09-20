<?php

session_start();


// Provera prijave korisnika

if (
    !isset($_SESSION["korisnik"])
    || !isset($_SESSION["status"])
)
{
    header('Location:index.php');
    exit();
}


// Administrator ima mogućnost brisanja

if ($_SESSION["status"] != "admin")
{
    header('Location:udruzenjaLista.php');
    exit();
}


// Provera ID-a za brisanje

if (
    !isset($_POST['ID'])
    || !is_numeric($_POST['ID'])
)
{
    header('Location:udruzenjaLista.php');
    exit();
}

$IdZaBrisanje = (int)$_POST['ID'];


// Uključivanje baza

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenja.php";


// Konekcija sa bazom

$KonekcijaObject = new Konekcija(
    'klase/BaznaParametriKonekcije.xml'
);

$KonekcijaObject->connect();

$UtvrdjenaGreska = null;


// Provera konekcije

if ($KonekcijaObject->konekcijaDB)
{
    $UdruzenjaObject = new DBUdruzenja(
        $KonekcijaObject,
        'Udruzenja'
    );

    $UtvrdjenaGreska =
        $UdruzenjaObject->ObrisiUdruzenje(
            $IdZaBrisanje
        );
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