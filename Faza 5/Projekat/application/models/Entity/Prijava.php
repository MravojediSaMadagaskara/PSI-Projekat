<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="prijava")
 */
class Prijava {

    /**
	 * @Id
     * @OneToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = false, onDelete = "CASCADE")
     */
    protected $Korisnik;

	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setPrijava($this);
    }
	
	public function getKorisnik() {
        return $this->Korisnik;
    }
	
}
