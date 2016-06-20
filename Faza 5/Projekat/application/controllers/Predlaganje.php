<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class Predlaganje extends CI_Controller {
	
	protected $glporuka;
	
	public function index($id) {
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.id=:user_id");
		$query->setParameters(array(
			'user_id' => $id,
		));
		$korisnici=$query->getResult();
		
		if ($this->glporuka==null)
			$data['poruka']='';
		else
			$data['poruka']=$this->glporuka;
		
		$data['id']=$id;
		$data['imeprez']=$korisnici[0]->getIme_i_prezime();
		$this->load->view('predlaganje', $data);
	}
	
	public function potvrdi($id){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$poruka='';
		
		if ($this->input->post('postavka')!=false && $this->input->post('odgovor1')!=false && $this->input->post('odgovor2')!=false && $this->input->post('odgovor3')!=false && $this->input->post('odgovor4')!=false && $this->input->post('tacan')!=false) {
			$postavka=$this->input->post('postavka');
			$odgovor1=$this->input->post('odgovor1');
			$odgovor2=$this->input->post('odgovor2');
			$odgovor3=$this->input->post('odgovor3');
			$odgovor4=$this->input->post('odgovor4');
			$tacan=$this->input->post('tacan');
			
			$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.id=:user_id");
			$query->setParameters(array(
				'user_id' => $id,
			));
			$korisnici=$query->getResult();
			
			$pitanje = new Entity\Pitanje();
			$pitanje->setTekst($postavka);
			$pitanje->setOdgovor_1($odgovor1);
			$pitanje->setOdgovor_2($odgovor2);
			$pitanje->setOdgovor_3($odgovor3);
			$pitanje->setOdgovor_4($odgovor4);
			$pitanje->setTacan_odgovor($tacan);
			$pitanje->setStatus_aktivno("Ne");
			$pitanje->setStatus_prijavljeno("Ne");
			$pitanje->setVidjeno("Ne");
			$pitanje->setKorisnik($korisnici[0]);
			$em->persist($pitanje);
			$em->flush();
			$poruka='Pitanje je dodato!<br>';
		}
		else{
			if ($this->input->post('postavka')==false){
				$poruka.='Niste uneli tekst pitanja!<br>';
			}
			if ($this->input->post('odgovor1')==false){
				$poruka.='Niste uneli odgovor 1!<br>';
			}
			if ($this->input->post('odgovor2')==false){
				$poruka.='Niste uneli odgovor 2!<br>';
			}
			if ($this->input->post('odgovor3')==false){
				$poruka.='Niste uneli odgovor 3!<br>';
			}
			if ($this->input->post('odgovor4')==false){
				$poruka.='Niste uneli odgovor 4!<br>';
			}
			if ($this->input->post('tacan')==false){
				$poruka.='Niste uneli tacan odgovor!<br>';
			}
		}
		
		$this->glporuka=$poruka;
		$this->index($id);
	}
}