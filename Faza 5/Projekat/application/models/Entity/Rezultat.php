<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="rezultat")
 */
class Rezultat {

    /**
     * @Id
     * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="integer", nullable=false, unique=false)
     */
    protected $Broj_poena;

    /**
     * @Column(type="datetime", nullable=false, unique=false)
     */
    protected $Datum_i_vreme;
	
	/**
     * @ManyToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = false, onDelete = "CASCADE")
     */
    protected $Korisnik;
	
	/**
     * @ManyToMany(targetEntity = "Pitanje", mappedBy="Rezultati")
     * @var pit[]
     */
    protected $Pitanja = null;
	
	/**
     * @Column(type="integer", nullable=false, unique=false)
     */
    protected $Trenutno;
	
	public function setTrenutno($Trenutno) {
		$this->Trenutno = $Trenutno;
		return $this;
	}
	
	public function getTrenutno() {
		return $this->Trenutno;
	}

    public function setBroj_poena($Broj_poena) {
        $this->Broj_poena = $Broj_poena;
        return $this;
    }
	
	public function setDatum_i_vreme($Datum_i_vreme) {
        $this->Datum_i_vreme = $Datum_i_vreme;
        return $this;
    }

	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setRezultat($this);
    }
	
	public function setPitanje($Pitanje) {
        $this->Pitanja[] = $Pitanje;
    }
	
	public function getid() {
        return $this->id;
    }
	
	public function getBroj_poena() {
        return $this->Broj_poena;
    }
	
	public function getDatum_i_vreme() {
        return $this->Datum_i_vreme;
    }
	
	public function getKorisnik() {
        return $this->Korisnik;
    }
	
	public function getPitanja() {
        return $this->Pitanja;
    }

}
