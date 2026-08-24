<meta charset="UTF-8">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#D8E7F4">
<tr>
<td style="width:5%;"></td>
<td align="center">
<b><font face="Trebuchet MS" color="black" size="3px">IZMENA PODATAKA O UDRUŽENJU</font></b><br/><br/>

<table style="width:60%;" bgcolor="#D8E7F4" align="center" cellspacing="4" cellpadding="4" border="0">
<form name="FormaZaIzmenuUdruzenja" action="udruzenjaIzmeni.php" METHOD="POST">

<input type="hidden" name="StariId" value="<?php echo $StariId; ?>">

<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Naziv udruženja&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="naziv" type="text" size="40" value="<?php echo $StariNaziv; ?>"/></td>
</tr>

<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Adresa&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="adresa" type="text" size="40" value="<?php echo $StaraAdresa; ?>"/></td>
</tr>

<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Grad&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="grad" type="text" size="40" value="<?php echo $StariGrad; ?>"/></td>
</tr>

<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Datum osnivanja&nbsp;&nbsp;</font></b></td>
<td align="left"><input name="datumOsnivanja" type="date" value="<?php echo $StariDatum; ?>"/></td>
</tr>

<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Kategorija&nbsp;&nbsp;</font></b></td>
<td align="left">
<select name="kategorija" required>
	<option value="">izaberite...</option>
	<?php
	if ($UkupanBrojZapisa>0)
	{
		for ($brojacKategorija = 0; $brojacKategorija < $UkupanBrojZapisa; $brojacKategorija++)
			{
				$IDKategorije=$KategorijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacKategorija, 0);
				$nazivKategorije=$KategorijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacKategorija, 1);
				$selected = ($IDKategorije == $StaraIDKategorije) ? "selected" : "";
				echo "<option value=\"$IDKategorije\" $selected>$nazivKategorije</option>";
			}
	}
	?>
</select>
</td>
</tr>

<tr>
<td></td>
<td align="left"><input TYPE="submit" name="snimiButton" value="SAČUVAJ IZMENU"/></td>
</tr>
</form>
</table>

</td>
<td style="width:5%;"></td>
</tr>
</table>
