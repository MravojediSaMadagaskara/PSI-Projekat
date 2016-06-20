<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="korisnik")
 */
class Korisnik {

    /**
     * @Id
     * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=25, nullable=false, unique=true)
     */
    protected $Korisnicko_ime;

    /**
     * @Column(type="string", length=25, nullable=false, unique=false)
     */
    protected $Lozinka;
    
    /**
     * @Column(type="string", length=50, nullable=false, unique=false)
     */
    protected $Ime_i_prezime;

	/**
     * @Column(type="string", length=50, nullable=false, unique=true)
     */
    protected $E_mail;
	
	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Pol;
	
	/**
     * @Column(type="integer", nullable=false, unique=false)
     */
    protected $Godiste;
	
	/**
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Vrsta;
	
    /**
     * @OneToMany(targetEntity = "Rezultat", mappedBy = "Korisnik")
     */
    protected $Rezultati;
	
	/**
     * @OneToMany(targetEntity = "Post", mappedBy = "Korisnik")
     */
    protected $Postovi;
	
	/**
     * @OneToMany(targetEntity = "Komentar", mappedBy = "Korisnik")
     */
    protected $Komentari;
	
	/**
     * @OneToOne(targetEntity = "Prijava", mappedBy = "Korisnik")
     */
    protected $Prijava;
	
	/**
     * @OneToMany(targetEntity = "Upozorenje", mappedBy = "Korisnik")
     */
    protected $Upozorenja;
	
	/**
     * @OneToMany(targetEntity = "Pitanje", mappedBy = "Korisnik")
     */
    protected $Pitanja;

    public function setKorisnicko_ime($Korisnicko_ime) {
        $this->Korisnicko_ime = $Korisnicko_ime;
        return $this;
    }

    public function setLozinka($Lozinka) {
        $this->Lozinka = $Lozinka;
        return $this;
    }
	
	public function setIme_i_prezime($Ime_i_prezime) {
        $this->Ime_i_prezime = $Ime_i_prezime;
        return $this;
    }
	
	public function setE_mail($E_mail) {
        $this->E_mail = $E_mail;
        return $this;
    }
	
	public function setPol($Pol) {
        $this->Pol = $Pol;
        return $this;
    }
	
	public function setGodiste($Godiste) {
        $this->Godiste = $Godiste;
        return $this;
    }
	
	public function setVrsta($Vrsta) {
        $this->Vrsta = $Vrsta;
        return $this;
    }
	
	public function setRezultat($Rezultat) {
        $this->Rezultati[] = $Rezultat;
    }
	
	public function setPost($Post) {
        $this->Postovi[] = $Post;
    }
	
	public function setKomentar($Komentar) {
        $this->Komentari[] = $Komentar;
    }
	
	public function setPrijava($Prijava) {
        $this->Prijava[] = $Prijava;
    }
	
	public function setUpozorenje($Upozorenje) {
        $this->Upozorenja[] = $Upozorenje;
    }
	
	public function setPitanje($Pitanje) {
        $this->Pitanja[] = $Pitanje;
    }
	
    public function getid() {
        return $this->id;
    }
	
	public function getKorisnicko_ime() {
        return $this->Korisnicko_ime;
    }

    public function getLozinka() {
        return $this->Lozinka;
    }
	
	public function getIme_i_prezime() {
        return $this->Ime_i_prezime;
    }
	
	public function getE_mail() {
        return $this->E_mail;
    }
	
	public function getPol() {
        return $this->Pol;
    }
	
	public function getGodiste() {
        return $this->Godiste;
    }
	
	public function getVrsta() {
        return $this->Vrsta;
    }
	
	public function getRezultati() {
        return $this->Rezultati;
    }
	
	public function getPostovi() {
        return $this->Postovi;
    }
	
	public function getKomentari() {
        return $this->Komentari;
    }
	
	public function getPrijava() {
        return $this->Prijava;
    }
	
	public function getUpozorenja() {
        return $this->Upozorenja;
    }
	
	public function getPitanja() {
        return $this->Pitanja;
    }
    
}
