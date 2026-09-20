<meta charset="UTF-8">

<table
    style="width:100%; padding:0"
    align="center"
    cellspacing="0"
    cellpadding="0"
    border="0"
    bgcolor="#D8E7F4"
>

<tr>

    <td style="width:5%;"></td>

    <td align="center">

        <font
            face="Trebuchet MS"
            color="darkblue"
            size="4px"
        >
            <b>PARAMETARSKA ŠTAMPA UDRUŽENJA</b>
        </font>

    </td>

    <td style="width:5%;"></td>

</tr>


<tr>

    <td style="width:5%;"></td>

    <td align="left">

        <br/>

        <?php

        if ($UkupanBrojZapisaUdruzenja == 0)
        {
            echo "NEMA UDRUŽENJA KOJA ODGOVARAJU ZADATOM KRITERIJUMU.";
        }
        else
        {
            echo
                "<font face=\"Trebuchet MS\" " .
                "color=\"darkblue\" size=\"3px\">" .
                "UKUPAN BROJ ZAPISA: " .
                $UkupanBrojZapisaUdruzenja .
                "</font>";

            echo "<br/><br/>";


            echo
                "<table " .
                "style=\"width:100%; padding:0\" " .
                "align=\"center\" " .
                "cellspacing=\"0\" " .
                "cellpadding=\"5\" " .
                "border=\"1\" " .
                "bgcolor=\"#D8E7F4\">";


            echo "<tr>";

            echo "<td><b>ID</b></td>";
            echo "<td><b>NAZIV</b></td>";
            echo "<td><b>ADRESA</b></td>";
            echo "<td><b>GRAD</b></td>";
            echo "<td><b>DATUM OSNIVANJA</b></td>";
            echo "<td><b>KATEGORIJA</b></td>";

            echo "</tr>";


            for (
                $RBZapisa = 0;
                $RBZapisa < $UkupanBrojZapisaUdruzenja;
                $RBZapisa++
            )
            {
                $ID =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        0
                    );

                $Naziv =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        1
                    );

                $Adresa =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        2
                    );

                $Grad =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        3
                    );

                $Datum =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        4
                    );

                $NazivKategorije =
                    $UdruzenjaObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $KolekcijaZapisaUdruzenja,
                        $RBZapisa,
                        5
                    );


                echo "<tr>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $ID,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $Naziv,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $Adresa,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $Grad,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $Datum,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

                echo
                    "<td>" .
                    htmlspecialchars(
                        $NazivKategorije,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</td>";

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