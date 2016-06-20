<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="komentar")
 */
class Komentar {

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
     * @Column(type="string", length=10, nullable=false, unique=false)
     */
    protected $Vidjen;
    
	/**
     * @ManyToOne(targetEntity = "Korisnik")
	 * @JoinColumn(name="korisnik_id", referencedColumnName="id", nullable = true, onDelete = "SET NULL")
     */
    protected $Korisnik;
	
	/**
     * @ManyToOne(targetEntity = "Post", inversedBy = "Komentari")
	 * @JoinColumn(name="post_id", referencedColumnName="id", nullable = false, onDelete = "CASCADE")
     */
    protected $Post;
	
    public function setTekst($Tekst) {
        $this->Tekst = $Tekst;
        return $this;
    }
	
	public function setDatum_i_vreme($Datum_i_vreme) {
        $this->Datum_i_vreme = $Datum_i_vreme;
        return $this;
    }
	
	public function setVidjen($Vidjen) {
        $this->Vidjen = $Vidjen;
        return $this;
    }
	
	public function setKorisnik($Korisnik) {
        $this->Korisnik = $Korisnik;
        $Korisnik->setKomentar($this);
    }
	
	public function setPost($Post) {
        $this->Post = $Post;
        $Post->setKomentar($this);
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
	
	public function getVidjen() {
		return $this->Vidjen;
	}

	public function getKorisnik() {
        return $this->Korisnik;
    }

	public function getPost() {
        return $this->Post;
    }

}
