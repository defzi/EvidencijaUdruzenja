<?php

session_start();


// Provera da li je korisnik prijavljen

if (
    !isset($_SESSION["korisnik"])
    || !isset($_SESSION["status"])
)
{
    header('Location:index.php');
    exit();
}


// Uređivanje samo za administratora 

if ($_SESSION["status"] != "admin")
{
    header('Location:udruzenjaLista.php');
    exit();
}


$korisnik = $_SESSION["korisnik"];


// Provera ID-a udruženja

if (!isset($_POST['ID']) || !is_numeric($_POST['ID']))
{
    header('Location:udruzenjaLista.php');
    exit();
}

$stariId = (int)$_POST['ID'];


// Povezivanje sa bazom

require_once "klase/BaznaKonekcija.php";

$KonekcijaObject = new Konekcija(
    "klase/BaznaParametriKonekcije.xml"
);

$KonekcijaObject->connect();


// Učitavanje kategorija

require_once "klase/BaznaTabela.php";
require_once "klase/DBKategorija.php";

$KategorijaObject = new DBKategorija(
    $KonekcijaObject,
    "Kategorija"
);

$KategorijaObject->UcitajKolekcijuSvihKategorija();

$KolekcijaZapisa =
    $KategorijaObject->Kolekcija;

$UkupanBrojZapisa =
    $KategorijaObject->BrojZapisa;


// Učitavanje izabranog udruženja

require_once "klase/DBUdruzenja.php";

$UdruzenjaObject = new DBUdruzenja(
    $KonekcijaObject,
    'Udruzenja'
);

$UdruzenjaObject->UcitajUdruzenjePoId(
    $stariId
);

$KolekcijaZapisaUdruzenja =
    $UdruzenjaObject->Kolekcija;

$UkupanBrojZapisaUdruzenja =
    $UdruzenjaObject->BrojZapisa;


// Preuzimanje postojećih podataka

if ($UkupanBrojZapisaUdruzenja > 0)
{
    $row = 0;

    $StariId =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            0
        );

    $StariNaziv =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            1
        );

    $StaraAdresa =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            2
        );

    $StariGrad =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            3
        );

    $StariDatum =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            4
        );

    $StaraIDKategorije =
        $UdruzenjaObject
        ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
            $KolekcijaZapisaUdruzenja,
            $row,
            5
        );
}
else
{

	// Ako udruženje ne postoji sa prosleđenim ID-em, vraća korisnika u listu

    $KonekcijaObject->disconnect();

    header('Location:udruzenjaLista.php');
    exit();
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
include 'delovi/zaglavljewelcome.php';
?>


<tr style="padding:0px;">

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
            bgcolor="#003366"
        >

            <tr>

                <td style="width:1%;"></td>


                <td
                    style="width:15%; padding:0"
                    valign="top"
                >

                    <?php
                    include 'delovi/menilevoadmin.php';
                    ?>

                </td>


                <td style="width:1%;"></td>


                <td
                    style="width:80%; padding:0"
                    valign="top"
                >

                    <?php
                    include 'delovi/desnoudruzenjaIzmeniForm.php';
                    ?>

                </td>


                <td style="width:1%;"></td>

            </tr>

        </table>

    </td>

    <td style="width:10%;"></td>

</tr>


<?php
include 'delovi/footer.php';
?>


</table>

</body>

</html>