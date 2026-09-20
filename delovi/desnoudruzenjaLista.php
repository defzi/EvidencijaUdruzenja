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

    <td>

        <font
            face="Trebuchet MS"
            color="darkblue"
            size="4px"
        >
            <b>SPISAK UDRUŽENJA</b>
        </font>

        <br/>


        <!-- PRETRAGA -->

        <form action="" method="GET">

            <?php

            $nazivFiltera = isset($poljeFiltera)
                ? $poljeFiltera
                : "Grad";

            echo htmlspecialchars(
                $nazivFiltera,
                ENT_QUOTES,
                'UTF-8'
            );

            ?>:

            <input
                type="text"
                name="filter"
                value="<?php
                    echo isset($filter)
                        ? htmlspecialchars(
                            $filter,
                            ENT_QUOTES,
                            'UTF-8'
                        )
                        : '';
                ?>"
            />

            <input
                type="submit"
                name="filtriraj"
                value="FILTRIRAJ"
            />

            <input
                type="submit"
                name="svi"
                value="SVI"
            />

        </form>

    </td>

    <td style="width:5%;"></td>

</tr>


<tr>

    <td style="width:5%;"></td>

    <td align="left">

        <br/>

        <?php

        // Proverava se da li je korisnik administrator

        $jeAdministrator = (
            isset($_SESSION["status"])
            && $_SESSION["status"] == "admin"
        );


        // Ako nema zapisa

        if ($UdruzenjaViewObject->BrojZapisa == 0)
        {
            echo "NEMA ZAPISA U TABELI!";
        }

        // Ako postoje zapisi

        else
        {
            echo
                "<font face=\"Trebuchet MS\" " .
                "color=\"darkblue\" size=\"3px\">" .
                "UKUPAN BROJ ZAPISA: " .
                $UdruzenjaViewObject->BrojZapisa .
                "</font>";


            echo
                "<table " .
                "style=\"width:100%; padding:0\" " .
                "align=\"center\" " .
                "cellspacing=\"0\" " .
                "cellpadding=\"0\" " .
                "border=\"1\" " .
                "bgcolor=\"#D8E7F4\">";


            // Zaglavlje

            echo "<tr>";


            echo
                "<td style=\"width:8%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "ID" .
                "</font>" .
                "</b>" .
                "</td>";


            echo
                "<td style=\"width:18%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "NAZIV" .
                "</font>" .
                "</b>" .
                "</td>";


            echo
                "<td style=\"width:18%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "ADRESA" .
                "</font>" .
                "</b>" .
                "</td>";


            echo
                "<td style=\"width:14%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "GRAD" .
                "</font>" .
                "</b>" .
                "</td>";


            echo
                "<td style=\"width:14%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "DATUM OSNIVANJA" .
                "</font>" .
                "</b>" .
                "</td>";


            echo
                "<td style=\"width:14%;\">" .
                "<b>" .
                "<font face=\"Trebuchet MS\" size=\"3px\">" .
                "KATEGORIJA" .
                "</font>" .
                "</b>" .
                "</td>";


            // Kolone izmene i brisanja se samo prikazuju administratoru

            if ($jeAdministrator)
            {
                echo
                    "<td>" .
                    "<b>" .
                    "<font face=\"Trebuchet MS\" size=\"3px\">" .
                    "IZMENA" .
                    "</font>" .
                    "</b>" .
                    "</td>";


                echo
                    "<td>" .
                    "<b>" .
                    "<font face=\"Trebuchet MS\" size=\"3px\">" .
                    "BRISANJE" .
                    "</font>" .
                    "</b>" .
                    "</td>";
            }


            echo "</tr>";


        // Prikaz zapisa

            for (
                $RBZapisa = 0;
                $RBZapisa < $UdruzenjaViewObject->BrojZapisa;
                $RBZapisa++
            )
            {

            // Učitavanje podataka

                $ID =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        0
                    );


                $Naziv =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        1
                    );


                $Adresa =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        2
                    );


                $Grad =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        3
                    );


                $Datum =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        4
                    );


                $NazivKategorije =
                    $UdruzenjaViewObject
                    ->DajVrednostPoRednomBrojuZapisaPoRBPolja(
                        $UdruzenjaViewObject->Kolekcija,
                        $RBZapisa,
                        5
                    );

                // Novi red tabele

                echo "<tr>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $ID,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $Naziv,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $Adresa,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $Grad,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $Datum,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


                echo
                    "<td>" .
                    "<font face=\"Trebuchet MS\" size=\"2px\">" .
                    htmlspecialchars(
                        $NazivKategorije,
                        ENT_QUOTES,
                        'UTF-8'
                    ) .
                    "</font>" .
                    "</td>";


            // Ako je korisnik, ima mogućnost brisanja i izmene udruženja

                if ($jeAdministrator)
                {

                // Izmena

                    echo "<td>";

                    echo
                        "<form " .
                        "action=\"udruzenjaIzmeniForm.php\" " .
                        "method=\"POST\">";


                    echo
                        "<input " .
                        "type=\"hidden\" " .
                        "name=\"ID\" " .
                        "value=\"" .
                        htmlspecialchars(
                            $ID,
                            ENT_QUOTES,
                            'UTF-8'
                        ) .
                        "\">";


                    echo
                        "<input " .
                        "type=\"submit\" " .
                        "name=\"izmeniUpis\" " .
                        "value=\"IZMENI\" />";


                    echo "</form>";

                    echo "</td>";

            // Brisanje

                    echo "<td>";

                    echo
                        "<form " .
                        "action=\"udruzenjaObrisi.php\" " .
                        "method=\"POST\">";


                    echo
                        "<input " .
                        "type=\"hidden\" " .
                        "name=\"ID\" " .
                        "value=\"" .
                        htmlspecialchars(
                            $ID,
                            ENT_QUOTES,
                            'UTF-8'
                        ) .
                        "\">";


                    echo
                        "<input " .
                        "type=\"submit\" " .
                        "name=\"obrisiUpis\" " .
                        "value=\"OBRIŠI\" " .
                        "onclick=\"return confirm(" .
                        "'Da li ste sigurni da želite da obrišete zapis?'" .
                        ")\"/>";


                    echo "</form>";

                    echo "</td>";
                }


                echo "</tr>";
            }


            echo "</table>";
        }

    // Zatvaranje konekcije

        $KonekcijaObject->disconnect();

        ?>

    </td>

    <td style="width:5%;"></td>

</tr>

</table>