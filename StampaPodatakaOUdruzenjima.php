<?php

session_start();

if (!isset($_SESSION["korisnik"]))
{
    header('Location:index.php');
    exit();
}

$FilterZaStampu = trim($_POST['imeFilter']);

require_once "klase/BaznaKonekcija.php";
require_once "klase/BaznaTabela.php";
require_once "klase/DBUdruzenjaV.php";
require_once "klase/UdruzenjaLogika.php";

$KonekcijaObject = new Konekcija(
    "klase/BaznaParametriKonekcije.xml"
);

$KonekcijaObject->connect();

$KolekcijaZapisaUdruzenja = array();
$UkupanBrojZapisaUdruzenja = 0;

if ($KonekcijaObject->konekcijaDB)
{
    $UdruzenjaObject = new DBUdruzenja(
        $KonekcijaObject,
        'Udruzenja'
    );

    try
    {
        $UdruzenjaLogika = new UdruzenjaLogika(
            $UdruzenjaObject
        );

        $greskaFiltera =
            $UdruzenjaLogika->ProveriFilter(
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

        $poljeFiltera =
            $UdruzenjaLogika->DajPoljeFiltera();

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

<!DOCTYPE html>

<html lang="sr-RS">

<head>

    <meta charset="UTF-8">

    <title>Evidencija Udruženja</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style.css"
        media="screen"
    >

</head>

<body>

<table
    class="no-spacing"
    style="width:100%; padding:0"
    align="center"
    cellspacing="0"
    cellpadding="0"
    border="0"
>

<?php
include 'delovi/zaglavljestampa.php';
?>

<tr>

    <td style="width:10%;"></td>

    <td
        align="center"
        valign="middle"
        style="width:80%; padding:0"
    >

        <table
            style="width:100%; padding:0"
            align="center"
            cellspacing="0"
            cellpadding="0"
            border="0"
            bgcolor="#FFFFFF"
        >

            <tr>

                <td style="width:1%;"></td>

                <td
                    style="width:80%; padding:0"
                    valign="top"
                >

                    <?php
                    include 'delovi/desnostampaoudruzenjima.php';
                    ?>

                </td>

                <td style="width:1%;"></td>

            </tr>

        </table>

    </td>

    <td style="width:10%;"></td>

</tr>

<?php
include 'delovi/footerstampa.php';
?>

</table>

</body>

</html>