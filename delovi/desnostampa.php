<meta charset="UTF-8">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#D8E7F4">
<tr>
<td style="width:5%;"></td>
<td align="center" valign="middle">
<font face="Trebuchet MS" color="darkblue" size="5px"><b>SPISAK UDRUŽENJA</b></font>
</td>
<td style="width:5%;"></td>
</tr>

<tr>
<td style="width:5%;"></td>
<td align="left">
<br/>
<?php
if ($UdruzenjaViewObject->BrojZapisa==0)
	{
		echo "NEMA ZAPISA U TABELI!";
	}
else
	{
	echo "UKUPAN BROJ ZAPISA: ".$UdruzenjaViewObject->BrojZapisa;
		echo "<table style=\"width:100%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\" bgcolor=\"#D8E7F4\">";
		echo "<tr>";
		echo "<td><b>ID</b></td><td><b>NAZIV</b></td><td><b>ADRESA</b></td><td><b>GRAD</b></td><td><b>DATUM OSNIVANJA</b></td><td><b>KATEGORIJA</b></td>";
		echo "</tr>";

		for ($RBZapisa = 0; $RBZapisa < $UdruzenjaViewObject->BrojZapisa; $RBZapisa++)
		{
		$ID=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 0);
		$Naziv=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 1);
		$Adresa=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 2);
		$Grad=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 3);
		$Datum=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 4);
		$NazivKategorije=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 5);

		echo "<tr><td>$ID</td><td>$Naziv</td><td>$Adresa</td><td>$Grad</td><td>$Datum</td><td>$NazivKategorije</td></tr>";
		}
		echo "</table>";
	}
$KonekcijaObject->disconnect();
?>
</td>
<td style="width:5%;"></td>
</tr>
</table>
