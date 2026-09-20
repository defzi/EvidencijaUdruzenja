<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$korisnik = isset($_SESSION["korisnik"])
    ? $_SESSION["korisnik"]
    : '';

?>

<meta charset="UTF-8">

<table
    style="width:100%;"
    bgcolor="#003366"
>

<tr>

    <td style="width:1%;"></td>

    <td
        align="left"
        valign="middle"
        style="width:25%;"
    >

        <font
            face="Trebuchet MS"
            color="white"
            size="2px"
        >

            <?php

            if ($korisnik != '')
            {
                echo "Korisnik: <b>"
                    . htmlspecialchars(
                        $korisnik,
                        ENT_QUOTES,
                        'UTF-8'
                    )
                    . "</b>";
            }

            ?>

        </font>

    </td>

    <td style="width:60%;"></td>

    <td align="right">

        <?php

        if ($korisnik != '')
        {
            echo
            '<font face="Trebuchet MS" color="white" size="2px">
            <a href="index.php">
            <font color="white">Odjava</font>
            </a>
            </font>';
        }

        ?>

    </td>

    <td style="width:1%;"></td>

</tr>

</table>