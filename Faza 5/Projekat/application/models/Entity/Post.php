<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="post")
 */
class Post {

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
     * @Column(type="datetime", nullable=false, unique=false)
     */
    protected $Datum_i_vreme;
    
	/**
     * @ManyToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = true, onDelete = "SET NULL")
     */
    protected $Korisnik;
	
    /**
     * @OneToMany(targetEntity = "Komentar", mappedBy = "Post")
     */
    protected $Komentari;

	public function setTekst($Tekst) {
        $this->Tekst = $Tekst;
        return $this;
    }
	
	public function setDatum_i_vreme($Datum_i_vreme) {
        $this->Datum_i_vreme = $Datum_i_vreme;
        return $this;
    }
	
	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setPost($this);
    }
	
	public function setKomentar($Komentar) {
        $this->Komentari[] = $Komentar;
    }
	
    public function getid() {
        return $this->id;
    }
	
	public function getTekst() {
        return $this->Tekst;
    }
	
	public function getDatum_i_vreme() {
        return $this->Datum_i_vreme;
    }
	
	public function getKorisnik() {
        return $this->Korisnik;
    }

	public function getKomentari() {
        return $this->Komentari;
    }
   
}
