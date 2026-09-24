<?php

session_start();

if (!isset($_SESSION["korisnik"]))
{
    header('Location:index.php');
    exit();
}

$FilterZaStampu = isset($_POST['imeFilter'])
    ? trim($_POST['imeFilter'])
    : '';

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenjaV.php";
require_once "klase/ValidacijaUdruzenja.php";

$KonekcijaObject = new Konekcija(
    "klase/BaznaParametriKonekcije.xml"
);

$KonekcijaObject->connect();

$KolekcijaZapisaUdruzenja = array();
$UkupanBrojZapisaUdruzenja = 0;
$greskaFiltera = null;
$poljeFiltera = "Grad";

if ($KonekcijaObject->konekcijaDB)
{
    $UdruzenjaObject = new DBUdruzenja(
        $KonekcijaObject,
        'Udruzenja'
    );

    try
    {
        // Osnovna validacija filtera

        $greskaFiltera =
            ValidacijaUdruzenja::ProveriFilter(
                $FilterZaStampu
            );

        if ($greskaFiltera != null)
        {
            echo "Greška: " . htmlspecialchars(
                $greskaFiltera,
                ENT_QUOTES,
                'UTF-8'
            );

            $KonekcijaObject->disconnect();
            exit;
        }

        // Parametarska štampa prema gradu

        $UdruzenjaObject
            ->DajSvePodatkeOUdruzenjima(
                $FilterZaStampu,
                $poljeFiltera
            );

        $KolekcijaZapisaUdruzenja =
            $UdruzenjaObject->Kolekcija;

        $UkupanBrojZapisaUdruzenja =
            $UdruzenjaObject->BrojZapisa;
    }
    catch (Exception $e)
    {
        echo "Greška: " . htmlspecialchars(
            $e->getMessage(),
            ENT_QUOTES,
            'UTF-8'
        );

        $KonekcijaObject->disconnect();
        exit;
    }
}
else
{
    echo "Nije moguće uspostaviti konekciju sa bazom podataka.";
    exit;
}

?>