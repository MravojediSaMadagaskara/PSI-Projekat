<?php

// Autor: Jovan Nikolic

namespace Entity;

/**
 * @Entity
 * @Table(name="obrisani")
 */
class Obrisani {

    /**
     * @Id
     * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

	/**
     * @Column(type="string", length=50, nullable=false, unique=true)
     */
    protected $E_mail;

	public function setE_mail($E_mail) {
        $this->E_mail = $E_mail;
        return $this;
    }

    public function getid() {
        return $this->id;
    }

	public function getE_mail() {
        return $this->E_mail;
    }
	
}
