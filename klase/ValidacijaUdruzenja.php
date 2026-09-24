<?php

class ValidacijaUdruzenja
{
    private static function DuzinaTeksta($tekst)
    {
        if (function_exists('mb_strlen'))
        {
            return mb_strlen($tekst, 'UTF-8');
        }

        return strlen($tekst);
    }


    public static function ProveriPodatke(
        $Naziv,
        $Adresa,
        $Grad,
        $Datum,
        $IDKategorije
    )
    {
        $Naziv = trim($Naziv);
        $Adresa = trim($Adresa);
        $Grad = trim($Grad);


        // Osnovna provera naziva

        if ($Naziv == "")
        {
            return "Naziv udruženja je obavezan.";
        }

        if (self::DuzinaTeksta($Naziv) > 60)
        {
            return "Naziv udruženja može imati najviše 60 karaktera.";
        }


        // Osnovna provera adrese

        if ($Adresa == "")
        {
            return "Adresa je obavezna.";
        }

        if (self::DuzinaTeksta($Adresa) > 60)
        {
            return "Adresa može imati najviše 60 karaktera.";
        }


        // Osnovna provera grada

        if ($Grad == "")
        {
            return "Grad je obavezan.";
        }

        if (self::DuzinaTeksta($Grad) > 30)
        {
            return "Grad može imati najviše 30 karaktera.";
        }

        if (!preg_match('/^[\p{L}\s\-]+$/u', $Grad))
        {
            return "Grad može sadržati samo slova, razmake i crticu.";
        }


        // Osnovna provera datuma

        if ($Datum == "")
        {
            return "Datum osnivanja je obavezan.";
        }

        $datumObjekat = DateTime::createFromFormat(
            'Y-m-d',
            $Datum
        );

        if (
            !$datumObjekat
            || $datumObjekat->format('Y-m-d') != $Datum
        )
        {
            return "Datum osnivanja nije ispravan.";
        }


        // Osnovna provera kategorije

        if (
            !is_numeric($IDKategorije)
            || (int)$IDKategorije <= 0
        )
        {
            return "Kategorija mora biti izabrana.";
        }


        return null;
    }


    public static function ProveriFilter($Filter)
    {
        $Filter = trim($Filter);

        if ($Filter == "")
        {
            return null;
        }

        if (self::DuzinaTeksta($Filter) < 2)
        {
            return "Filter mora imati najmanje 2 karaktera.";
        }

        return null;
    }
}

?>