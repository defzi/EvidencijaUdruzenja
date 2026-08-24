<meta charset="UTF-8">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#D8E7F4">

<tr>
<td style="width:5%;"></td>
<td>
<font face="Trebuchet MS" color="darkblue" size="4px"><b>SPISAK UDRUŽENJA</b></font><br/>
<form action="" method="GET">
Grad: <input type="text" name="filter" />
<input type="submit" name="filtriraj" value="FILTRIRAJ" />
<input type="submit" name="svi" value="SVI" />
</form>
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
	echo "<font face=\"Trebuchet MS\" color=\"darkblue\" size=\"3px\">UKUPAN BROJ ZAPISA: ".$UdruzenjaViewObject->BrojZapisa."</font>";
		echo "<table style=\"width:100%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\" bgcolor=\"#D8E7F4\">";
		echo "<tr>";
		echo "<td style=\"width:8%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">ID</font></b></td>";
		echo "<td style=\"width:18%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">NAZIV</font></b></td>";
		echo "<td style=\"width:18%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">ADRESA</font></b></td>";
		echo "<td style=\"width:14%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">GRAD</font></b></td>";
		echo "<td style=\"width:14%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">DATUM OSNIVANJA</font></b></td>";
		echo "<td style=\"width:14%;\"><b><font face=\"Trebuchet MS\" size=\"3px\">KATEGORIJA</font></b></td>";
		echo "<td><b><font face=\"Trebuchet MS\" size=\"3px\">IZMENA</font></b></td>";
		echo "<td><b><font face=\"Trebuchet MS\" size=\"3px\">BRISANJE</font></b></td>";
		echo "</tr>";

		for ($RBZapisa = 0; $RBZapisa < $UdruzenjaViewObject->BrojZapisa; $RBZapisa++)
		{
		$ID=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 0);
		$Naziv=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 1);
		$Adresa=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 2);
		$Grad=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 3);
		$Datum=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 4);
		$NazivKategorije=$UdruzenjaViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($UdruzenjaViewObject->Kolekcija, $RBZapisa, 5);

		echo "<tr>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$ID</font></td>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$Naziv</font></td>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$Adresa</font></td>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$Grad</font></td>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$Datum</font></td>";
		echo "<td><font face=\"Trebuchet MS\" size=\"2px\">$NazivKategorije</font></td>";
		echo "<td>";
		echo "<form ACTION=\"udruzenjaIzmeniForm.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">";
		echo "<input TYPE=\"submit\" name=\"izmeniUpis\" value=\"IZMENI\" />";
		echo "</form>";
		echo "</td>";
		echo "<td>";
		echo "<form ACTION=\"udruzenjaObrisi.php\" METHOD=\"POST\">";
		echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">";
		echo "<input TYPE=\"submit\" name=\"obrisiUpis\" value=\"OBRIŠI\" onclick=\"return confirm('Da li ste sigurni da želite da obrišete zapis?')\"/>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
		}
		echo "</table>";
	}
$KonekcijaObject->disconnect();
?>
</td>
<td style="width:5%;"></td>
</tr>
</table>
