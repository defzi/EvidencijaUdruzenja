<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$korisnik=$_SESSION["korisnik"];
?>
<meta charset="UTF-8">
<table style="width:100%;" bgcolor="#003366">
<tr>
<td style="width:1%;"></td>
<td align="left" valign="middle" style="width:25%;">
<font face="Trebuchet MS" color="white" size="2px">Korisnik: <b><?php echo $korisnik; ?></b></font>
</td>
<td style="width:60%;"></td>
<td align="right">
<font face="Trebuchet MS" color="white" size="2px"><a href="index.php"><font color="white">Odjava</font></a></font>
</td>
<td style="width:1%;"></td>
</tr>
</table>
