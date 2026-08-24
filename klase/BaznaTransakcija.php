<?php
class Transakcija{

public $veza;

public function __construct($konekcijaObj)
{
	$this->veza = $konekcijaObj->link;
}

public function startTransakciju()
{
	mysqli_begin_transaction($this->veza);
}

public function commit()
{
	mysqli_commit($this->veza);
}

public function rollback()
{
	mysqli_rollback($this->veza);
}

}
?>
