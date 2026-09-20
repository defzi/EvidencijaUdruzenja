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

                // Prikaz greške filtera ili konekcije

                    if ($greskaFiltera != null)
                    {
                        echo
                            "<p style='color:red;'>" .
                            htmlspecialchars(
                                $greskaFiltera,
                                ENT_QUOTES,
                                'UTF-8'
                            ) .
                            "</p>";
                    }


                    // Prikaz liste udruženja. Prikazujemo je samo ako je objekat kreiran uspešno

                    if (isset($UdruzenjaViewObject))
                    {
                        include 'delovi/desnoudruzenjaLista.php';
                    }
                    else
                    {
                        echo
                            "<p style='color:red;'>" .
                            "Podaci trenutno nisu dostupni." .
                            "</p>";
                    }

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