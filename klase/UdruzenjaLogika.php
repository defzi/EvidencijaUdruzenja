<?php

class UdruzenjaLogika
{
    private $UdruzenjaDB;

    private $NazivMinDuzina;
    private $NazivMaxDuzina;

    private $AdresaMinDuzina;
    private $AdresaMaxDuzina;

    private $GradMinDuzina;
    private $GradMaxDuzina;

    private $DozvoliBuduciDatum;

    private $PoljeFiltera;
    private $MinimalnaDuzinaFiltera;


    public function __construct($UdruzenjaDB, $PutanjaParametara = null)
    {
        $this->UdruzenjaDB = $UdruzenjaDB;

        if ($PutanjaParametara == null)
        {
            $PutanjaParametara =
                __DIR__ . '/PoslovnaPravila.xml';
        }

        $xml = simplexml_load_file(
            $PutanjaParametara
        );

        if ($xml === false)
        {
            throw new Exception(
                "Nije moguće učitati fajl sa poslovnim pravilima."
            );
        }


        // Naziv udruženja

        $this->NazivMinDuzina =
            (int)$xml->udruzenje->nazivMinDuzina;

        $this->NazivMaxDuzina =
            (int)$xml->udruzenje->nazivMaxDuzina;



        $this->AdresaMinDuzina =
            (int)$xml->udruzenje->adresaMinDuzina;

        $this->AdresaMaxDuzina =
            (int)$xml->udruzenje->adresaMaxDuzina;



        $this->GradMinDuzina =
            (int)$xml->udruzenje->gradMinDuzina;

        $this->GradMaxDuzina =
            (int)$xml->udruzenje->gradMaxDuzina;



        $this->DozvoliBuduciDatum =
            strtoupper(
                trim(
                    (string)$xml
                        ->udruzenje
                        ->dozvoliBuduciDatum
                )
            );


        // Parametar pretrage

        $this->PoljeFiltera =
            trim(
                (string)$xml
                    ->pretraga
                    ->poljeFiltera
            );

        $this->MinimalnaDuzinaFiltera =
            (int)$xml
                ->pretraga
                ->minimalnaDuzinaFiltera;
    }


    public function ProveriPodatke(
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


        // Proveravanje naziva

        if (empty($Naziv))
        {
            return "Naziv udruženja je obavezan.";
        }

        if (
            strlen($Naziv)
            < $this->NazivMinDuzina
        )
        {
            return "Naziv udruženja mora imati najmanje "
                . $this->NazivMinDuzina
                . " karaktera.";
        }

        if (
            strlen($Naziv)
            > $this->NazivMaxDuzina
        )
        {
            return "Naziv udruženja može imati najviše "
                . $this->NazivMaxDuzina
                . " karaktera.";
        }


        // Proveravanje adrese

        if (empty($Adresa))
        {
            return "Adresa je obavezna.";
        }

        if (
            strlen($Adresa)
            < $this->AdresaMinDuzina
        )
        {
            return "Adresa mora imati najmanje "
                . $this->AdresaMinDuzina
                . " karaktera.";
        }

        if (
            strlen($Adresa)
            > $this->AdresaMaxDuzina
        )
        {
            return "Adresa može imati najviše "
                . $this->AdresaMaxDuzina
                . " karaktera.";
        }


        // Proveravanje grada

        if (empty($Grad))
        {
            return "Grad je obavezan.";
        }

        if (!preg_match('/^[\p{L}\s\-]+$/u', $Grad))
        {
            return "Grad može sadržati samo slova.";
        }

        if (
            strlen($Grad)
            < $this->GradMinDuzina
        )
        {
            return "Grad mora imati najmanje "
                . $this->GradMinDuzina
                . " karaktera.";
        }

        if (
            strlen($Grad)
            > $this->GradMaxDuzina
        )
        {
            return "Grad može imati najviše "
                . $this->GradMaxDuzina
                . " karaktera.";
        }


        // Proveravanje datuma

        if (empty($Datum))
        {
            return "Datum osnivanja je obavezan.";
        }

        if (
            $this->DozvoliBuduciDatum == "NE"
            && $Datum > date("Y-m-d")
        )
        {
            return "Datum osnivanja ne može biti u budućnosti.";
        }


        // Proveravanje kategorije

        if (
            empty($IDKategorije)
            || !is_numeric($IDKategorije)
            || (int)$IDKategorije <= 0
        )
        {
            return "Kategorija mora biti izabrana.";
        }


        return null;
    }


    public function DodajUdruzenje(
        $Naziv,
        $Adresa,
        $Grad,
        $Datum,
        $IDKategorije
    )
    {
        $greska =
            $this->ProveriPodatke(
                $Naziv,
                $Adresa,
                $Grad,
                $Datum,
                $IDKategorije
            );

        if ($greska != null)
        {
            return $greska;
        }


        $this->UdruzenjaDB->NazivUdruzenja =
            trim($Naziv);

        $this->UdruzenjaDB->Adresa =
            trim($Adresa);

        $this->UdruzenjaDB->Grad =
            trim($Grad);

        $this->UdruzenjaDB->DatumOsnivanja =
            $Datum;

        $this->UdruzenjaDB->IDKategorije =
            (int)$IDKategorije;


        return $this
            ->UdruzenjaDB
            ->DodajNovoUdruzenje();
    }


    public function IzmeniUdruzenje(
        $ID,
        $Naziv,
        $Adresa,
        $Grad,
        $Datum,
        $IDKategorije
    )
    {
        // Provera identifikacije

        if (
            !is_numeric($ID)
            || (int)$ID <= 0
        )
        {
            return "Neispravan ID udruženja.";
        }


        // Provera ostalih podataka

        $greska =
            $this->ProveriPodatke(
                $Naziv,
                $Adresa,
                $Grad,
                $Datum,
                $IDKategorije
            );

        if ($greska != null)
        {
            return $greska;
        }


        return $this
            ->UdruzenjaDB
            ->IzmeniUdruzenje(
            (int)$ID,
            trim($Naziv),
            trim($Adresa),
            trim($Grad),
            $Datum,
            (int)$IDKategorije
            );
    }


    // Provera kriterijuma pretrage

    public function ProveriFilter($Filter)
    {
        $Filter = trim($Filter);


        // Prazan filter je dozvoljen, u tom slučaju prikazuju se svi podaci


        if ($Filter == "")
        {
            return null;
        }

        if (
            strlen($Filter)
            < $this->MinimalnaDuzinaFiltera
        )
        {
            return "Filter mora imati najmanje "
                . $this->MinimalnaDuzinaFiltera
                . " karaktera.";
        }

        return null;
    }


    // Vraćanje kriterijuma pretrage

    public function DajPoljeFiltera()
    {
        return $this->PoljeFiltera;
    }
}

?>