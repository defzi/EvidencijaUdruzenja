<?php

class DBUdruzenja extends Tabela
{

    // Rad sa pogledom PodaciUdruzenja. Učitava sva udruženja ili po kriterijumu filtriranja.


    public function DajSvePodatkeOUdruzenjima(
        $filterParametar = null,
        $poljeFiltera = "Grad"
    )
    {
        // Dozvoljena polja za filtriranje.

        $dozvoljenaPolja = array(
            "Grad",
            "NazivUdruzenja",
            "NazivKategorije"
        );


        // Ako kriterijum iz XML-a nije dozvoljen, koristi se 'Grad' kao kriterijum
        if (!in_array($poljeFiltera, $dozvoljenaPolja))
        {
            $poljeFiltera = "Grad";
        }

            // Ako je filter unet, izvršava se 'Select'
        if (
            isset($filterParametar)
            && $filterParametar !== null
            && trim($filterParametar) !== ""
        )
        {
            $filterParametar = trim($filterParametar);

            $upit =
                "SELECT * FROM `" .
                $this->NazivBazePodataka .
                "`.`PodaciUdruzenja` " .
                "WHERE `" .
                $poljeFiltera .
                "`='" .
                $filterParametar .
                "'";
        }

            // Ako filter nije zadat, prikazuju se svi podaci.
        else
        {
            $upit =
                "SELECT * FROM `" .
                $this->NazivBazePodataka .
                "`.`PodaciUdruzenja`";
        }


        /*
            Učitavanje rezultata preko bazne klase Tabela.
        */
        $this->UcitajSvePoUpitu($upit);
    }
}

?>