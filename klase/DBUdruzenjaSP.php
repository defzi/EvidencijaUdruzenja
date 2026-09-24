<?php

class DBUdruzenja extends Tabela
{
    public $NazivUdruzenja;
    public $Adresa;
    public $Grad;
    public $DatumOsnivanja;
    public $IDKategorije;


    public function DodajNovoUdruzenje()
    {
        $GreskaPar1 = $this->IzvrsiAktivanSQLUpit(
            "SET @NazivUdruzenjaParametar='" .
            $this->NazivUdruzenja . "'"
        );

        $GreskaPar2 = $this->IzvrsiAktivanSQLUpit(
            "SET @AdresaParametar='" .
            $this->Adresa . "'"
        );

        $GreskaPar3 = $this->IzvrsiAktivanSQLUpit(
            "SET @GradParametar='" .
            $this->Grad . "'"
        );

        $GreskaPar4 = $this->IzvrsiAktivanSQLUpit(
            "SET @DatumOsnivanjaParametar='" .
            $this->DatumOsnivanja . "'"
        );

        $GreskaPar5 = $this->IzvrsiAktivanSQLUpit(
            "SET @IDKategorijeParametar=" .
            $this->IDKategorije
        );

        $GreskaCall = $this->IzvrsiAktivanSQLUpit(
            "CALL `DodajUdruzenje`(
                @NazivUdruzenjaParametar,
                @AdresaParametar,
                @GradParametar,
                @DatumOsnivanjaParametar,
                @IDKategorijeParametar
            );"
        );

        return
            $GreskaPar1 .
            $GreskaPar2 .
            $GreskaPar3 .
            $GreskaPar4 .
            $GreskaPar5 .
            $GreskaCall;
    }


    public function PostojiUdruzenjeSaNazivom(
        $Naziv,
        $IDZaIzuzimanje = null
    )
    {
        $Naziv = mysqli_real_escape_string(
            $this->veza,
            trim($Naziv)
        );

        $SQL =
            "SELECT COUNT(*) " .
            "FROM `" .
            $this->NazivBazePodataka .
            "`.`Udruzenja` " .
            "WHERE NazivUdruzenja='" .
            $Naziv .
            "'";


        // Kod izmene, trenutni zapis ne sme da bude pronađen kao duplikat samog sebe.
        if (
            $IDZaIzuzimanje !== null
            && is_numeric($IDZaIzuzimanje)
        )
        {
            $SQL .=
                " AND IDUdruzenja<>" .
                (int)$IDZaIzuzimanje;
        }


        $rezultat = mysqli_query(
            $this->veza,
            $SQL
        );

        if (!$rezultat)
        {
            return false;
        }

        $red = mysqli_fetch_row($rezultat);

        return ((int)$red[0] > 0);
    }


    public function PostojiKategorija($IDKategorije)
    {
        $IDKategorije = (int)$IDKategorije;

        $SQL =
            "SELECT COUNT(*) " .
            "FROM `" .
            $this->NazivBazePodataka .
            "`.`Kategorija` " .
            "WHERE IDKategorije=" .
            $IDKategorije;


        $rezultat = mysqli_query(
            $this->veza,
            $SQL
        );

        if (!$rezultat)
        {
            return false;
        }

        $red = mysqli_fetch_row($rezultat);

        return ((int)$red[0] > 0);
    }
}

?>