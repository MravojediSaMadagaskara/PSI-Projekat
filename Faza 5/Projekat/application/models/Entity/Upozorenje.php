<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="upozorenje")
 */
class Upozorenje {

    /**
     * @Id
     * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Poruka;
	
	 /**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Tekst_posta;

    /**
     * @Column(type="datetime", nullable=false, unique=false)
     */
    protected $Datum_i_vreme_posta;
 
 	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Vidjeno;

	/**
     * @ManyToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = false, onDelete = "CASCADE")
     */
    protected $Korisnik;
	
    public function setPoruka($Poruka) {
        $this->Poruka = $Poruka;
        return $this;
    }
	
	public function setTekst_posta($Tekst_posta) {
        $this->Tekst_posta = $Tekst_posta;
        return $this;
    }
	
	public function setDatum_i_vreme_posta($Datum_i_vreme_posta) {
        $this->Datum_i_vreme_posta = $Datum_i_vreme_posta;
        return $this;
    }

	public function setVidjeno($Vidjeno) {
        $this->Vidjeno = $Vidjeno;
        return $this;
    }
	
	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setUpozorenje($this);
    }
	
    public function getid() {
        return $this->id;
    }
	
	public function getPoruka() {
        return $this->Poruka;
    }
	
	public function getTekst_posta() {
        return $this->Tekst_posta;
    }
	
	public function getDatum_i_vreme_posta() {
        return $this->Datum_i_vreme_posta;
    }

	public function getVidjeno() {
		return $this->Vidjeno;
	}

	public function getKorisnik() {
        return $this->Korisnik;
    }

}
