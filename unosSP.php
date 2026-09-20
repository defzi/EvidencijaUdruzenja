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

$korisnik = $_SESSION["korisnik"];

require "klase/BaznaKonekcija.php";

$KonekcijaObject = new Konekcija(
    "klase/BaznaParametriKonekcije.xml"
);

$KonekcijaObject->connect();

require "klase/BaznaTabela.php";
require "klase/DBKategorija.php";

$KategorijaObject = new DBKategorija(
    $KonekcijaObject,
    "Kategorija"
);

$KategorijaObject->UcitajKolekcijuSvihKategorija();

$KolekcijaZapisa =
$KategorijaObject->Kolekcija;

$UkupanBrojZapisa =
$KategorijaObject->BrojZapisa;

?>

<!DOCTYPE html>
<html lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Evidencija Udruženja</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body>

<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<?php include 'delovi/zaglavljewelcome.php';?>

<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle" style="width:80%; padding:0">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#003366">
<tr>
<td style="width:1%;"></td>
<td style="width:15%;padding:0" valign="top">
<?php include 'delovi/menilevoadmin.php';?>
</td>
<td style="width:1%;"></td>
<td style="width:80%;padding:0" valign="top">
<?php include 'delovi/desnounosSP.php';?>
</td>
<td style="width:1%;"></td>
</tr>
</table>
</td>
<td style="width:10%;"></td>
</tr>

<?php include 'delovi/footer.php';?>

</table>
</body>
</html>
