<?php
session_start();

if(empty($_POST['imeFilter'])) {
    echo "Morate uneti deo za filtriranje!";
    exit;
}

$FilterZaStampu = $_POST['imeFilter'];

require "klase/BaznaKonekcija.php";
$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
$KonekcijaObject->connect();

require "klase/BaznaTabela.php";
require "klase/DBUdruzenjaV.php";
$UdruzenjaObject = new DBUdruzenja($KonekcijaObject, 'Udruzenja');
$UdruzenjaObject->DajSvePodatkeOUdruzenjima($FilterZaStampu);
$KolekcijaZapisaUdruzenja= $UdruzenjaObject->Kolekcija;
$UkupanBrojZapisaUdruzenja = $UdruzenjaObject->BrojZapisa;

$ID = $Naziv = $Adresa = $Grad = $Datum = $NazivKategorije = "";

if ($UkupanBrojZapisaUdruzenja>0)
{
	$row=0;
	$ID=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 0);
	$Naziv=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 1);
	$Adresa=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 2);
	$Grad=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 3);
	$Datum=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 4);
	$NazivKategorije=$UdruzenjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUdruzenja, $row, 5);
}
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

<?php include 'delovi/zaglavljestampa.php';?>

<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle" style="width:80%; padding:0">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
<tr>
<td style="width:1%;"></td>
<td style="width:80%;padding:0" valign="top">
<?php include 'delovi/desnostampaoudruzenjima.php';?>
</td>
<td style="width:1%;"></td>
</tr>
</table>
</td>
<td style="width:10%;"></td>
</tr>

<?php include 'delovi/footerstampa.php';?>

</table>
</body>
</html>
