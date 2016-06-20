<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="pitanje")
 */
class Pitanje {

    /**
     * @Id
     * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Tekst;

    /**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Odgovor_1;
	
	/**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Odgovor_2;
	
	/**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Odgovor_3;
	
	/**
     * @Column(type="string", length=1000, nullable=false, unique=false)
     */
    protected $Odgovor_4;
    
	/**
     * @Column(type="integer", nullable=false, unique=false)
     */
    protected $Tacan_odgovor;
	
	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Status_aktivno;
	
	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Status_prijavljeno;
	
	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Vidjeno;
	
	/**
     * @ManyToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = true, onDelete = "SET NULL")
     */
    protected $Korisnik;
	
	/**
	 * @ManyToMany(targetEntity="Rezultat", inversedBy="Pitanja")
     */
    protected $Rezultati;

    public function setTekst($Tekst) {
        $this->Tekst = $Tekst;
        return $this;
    }
	
	public function setOdgovor_1($Odgovor_1) {
        $this->Odgovor_1 = $Odgovor_1;
        return $this;
    }
	
	public function setOdgovor_2($Odgovor_2) {
        $this->Odgovor_2 = $Odgovor_2;
        return $this;
    }
	
	public function setOdgovor_3($Odgovor_3) {
        $this->Odgovor_3 = $Odgovor_3;
        return $this;
    }
	
	public function setOdgovor_4($Odgovor_4) {
        $this->Odgovor_4 = $Odgovor_4;
        return $this;
    }
	
	public function setTacan_odgovor($Tacan_odgovor) {
        $this->Tacan_odgovor = $Tacan_odgovor;
        return $this;
    }
	
	public function setStatus_aktivno($Status_aktivno) {
        $this->Status_aktivno = $Status_aktivno;
        return $this;
    }
	
	public function setStatus_prijavljeno($Status_prijavljeno) {
        $this->Status_prijavljeno = $Status_prijavljeno;
        return $this;
    }
	
	public function setVidjeno($Vidjeno) {
        $this->Vidjeno = $Vidjeno;
        return $this;
    }
	
	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setPitanje($this);
    }
	
	public function addToRezultat($Rezultat) {
        $this->Rezultati[] = $Rezultat;
        $Rezultat->setPitanje($this);
    }
	
    public function getid() {
        return $this->id;
    }
	
	public function getTekst() {
        return $this->Tekst;
    }
	
	public function getOdgovor_1() {
        return $this->Odgovor_1;
    }
	
	public function getOdgovor_2() {
        return $this->Odgovor_2;
    }
	
	public function getOdgovor_3() {
        return $this->Odgovor_3;
    }
	
	public function getOdgovor_4() {
        return $this->Odgovor_4;
    }
	
	public function getTacan_odgovor() {
        return $this->Tacan_odgovor;
    }
	
	public function getStatus_aktivno() {
        return $this->Status_aktivno;
    }
	
	public function getStatus_prijavljeno() {
        return $this->Status_prijavljeno;
    }
	
	public function getVidjeno() {
		return $this->Vidjeno;
	}
	
	public function getKorisnik() {
        return $this->Korisnik;
    }
	
	public function getRezultati() {
        return $this->Rezultati;
    }

}
