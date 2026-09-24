<?php

class UdruzenjaLogika
{
    private $UdruzenjaDB;

    private $NazivMoraBitiJedinstven;
    private $DozvoliBuduciDatumOsnivanja;
    private $KategorijaMoraPostojati;


    public function __construct(
        $UdruzenjaDB,
        $PutanjaParametara = null
    )
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


        $this->NazivMoraBitiJedinstven =
            strtoupper(
                trim(
                    (string)$xml
                        ->udruzenje
                        ->nazivMoraBitiJedinstven
                )
            );


        $this->DozvoliBuduciDatumOsnivanja =
            strtoupper(
                trim(
                    (string)$xml
                        ->udruzenje
                        ->dozvoliBuduciDatumOsnivanja
                )
            );


        $this->KategorijaMoraPostojati =
            strtoupper(
                trim(
                    (string)$xml
                        ->udruzenje
                        ->kategorijaMoraPostojati
                )
            );
    }


    private function ProveriPoslovnaPravila(
        $Naziv,
        $Datum,
        $IDKategorije,
        $IDUdruzenja = null
    )
    {
        // POSLOVNO PRAVILO 1: Naziv udruženja mora biti jedinstven.

        if (
            $this->NazivMoraBitiJedinstven == "DA"
            && $this->UdruzenjaDB
                ->PostojiUdruzenjeSaNazivom(
                    $Naziv,
                    $IDUdruzenja
                )
        )
        {
            return "Udruženje sa unetim nazivom već postoji.";
        }


        // POSLOVNO PRAVILO 2: Udruženje ne može biti osnovano u budućnosti.

        if (
            $this->DozvoliBuduciDatumOsnivanja == "NE"
            && $Datum > date("Y-m-d")
        )
        {
            return "Nije moguće evidentirati udruženje čiji je datum osnivanja u budućnosti.";
        }


        // POSLOVNO PRAVILO 3: Udruženje mora pripadati postojećoj kategoriji.

        if (
            $this->KategorijaMoraPostojati == "DA"
            && !$this->UdruzenjaDB
                ->PostojiKategorija(
                    $IDKategorije
                )
        )
        {
            return "Izabrana kategorija ne postoji u evidenciji.";
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
            $this->ProveriPoslovnaPravila(
                trim($Naziv),
                $Datum,
                (int)$IDKategorije
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
        if (
            !is_numeric($ID)
            || (int)$ID <= 0
        )
        {
            return "Neispravan ID udruženja.";
        }


        $greska =
            $this->ProveriPoslovnaPravila(
                trim($Naziv),
                $Datum,
                (int)$IDKategorije,
                (int)$ID
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
}

?>