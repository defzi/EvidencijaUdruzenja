<?php

session_start();

if (!isset($_SESSION["korisnik"]))
{
    header('Location:index.php');
    exit();
}

$korisnik = $_SESSION["korisnik"];	

require "klase/BaznaKonekcija.php";
require "klase/BaznaTabela.php";

$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
$KonekcijaObject->connect();
if ($KonekcijaObject->konekcijaDB)
{
	require "klase/DBUdruzenjaV.php";
	$UdruzenjaViewObject = new DBUdruzenja($KonekcijaObject,"Udruzenja");
	if (isset($_GET['filtriraj']))
	{
		$filter=$_GET['filter'];
		$UdruzenjaViewObject->DajSvePodatkeOUdruzenjima($filter);
	}
	else
	{
		$filter=null;
		$UdruzenjaViewObject->DajSvePodatkeOUdruzenjima($filter);
	}
}
else
{
	echo "Neuspešna konekcija!";
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
<?php include 'delovi/desnostampa.php';?>
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
