<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class Nalog extends CI_Controller {
	
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
		$korisnik=$query->getResult();
		
		$data['id']=$id;
		$data['korisnicko_ime']=$korisnik[0]->getKorisnicko_ime();
		$data['lozinka']=$korisnik[0]->getLozinka();
		$data['ime_prezime']=$korisnik[0]->getIme_i_prezime();
		$data['email']=$korisnik[0]->getE_mail();
		$data['pol']=$korisnik[0]->getPol();
		$data['godiste']=$korisnik[0]->getGodiste();
		
		$query=$em->createQuery("SELECT r FROM Entity\Rezultat r WHERE r.Korisnik=:user_id");
		$query->setParameters(array(
			'user_id' => $id,
		));
		$rezultati=$query->getResult();
		
		$odigrano=0;
		$ukupno=0;
		$prosecno=0;
		foreach ($rezultati as $rezultat) {
			$odigrano+=1;
			$ukupno+=$rezultat->getBroj_poena();
		}
		if ($odigrano!=0)
			$prosecno=$ukupno/ (float) $odigrano;
		
		$data['odigrano']=$odigrano;
		$data['ukupno']=$ukupno;
		$data['prosecno']=number_format($prosecno, 2, ',', ' ');
		
		$vrsta=$korisnik[0]->getVrsta();
		
		if ($this->glporuka==null)
			$data['poruka']='';
		else
			$data['poruka']=$this->glporuka;
		
		if ($vrsta=="Obican")
			$this->load->view('nalog', $data);
		else if ($vrsta=="Urednik")
			$this->load->view('nalogurednik', $data);
		else if ($vrsta=="Admin")
			$this->load->view('nalogadmin', $data);

	}
	
	
	public function izmeni($id){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('url');
		
		$poruka='';
		
		$ime=$this->input->post('username');
		$lozinka=$this->input->post('lozinka');
		$imeprezime=$this->input->post('ime_prezime');
		$email=$this->input->post('email');
		$pol=$this->input->post('pol');
		$godiste=$this->input->post('godiste');
	
		
		if ($ime==false){
			$poruka.='Niste uneli korisnicko ime!<br>';
		}
		if ($lozinka==false){
			$poruka.='Niste uneli lozinku!<br>';
		}
		if ($imeprezime==false){
			$poruka.='Niste uneli ime i prezime!<br>';
		}
		if ($email==false){
			$poruka.='Niste uneli email!<br>';
		}
		else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				$poruka.='Email je u pogresnom formatu!<br>';
		}
		if ($pol==false){
			$poruka.='Niste uneli pol!<br>';
		}
		if ($godiste==false){
			$poruka.='Niste uneli godiste!<br>';
		}
		
		if ($ime!=false && $lozinka!=false && $imeprezime!=false && $email!=false && $pol!=false && $godiste!=false && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
			$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE (k.Korisnicko_ime=:ki OR k.E_mail=:em) AND k.id!=:ajdi");
			$query->setParameters(array(
				'ki' => $ime,
				'em' => $email,
				'ajdi' => $id,
			));
			$korisnici=$query->getResult();
			
			if ($korisnici!=null){
				foreach ($korisnici as $korisnik){
					if ($korisnik->getKorisnicko_ime() == $ime)
						$poruka.='Korisnicko ime je zauzeto!<br>';
					if ($korisnik->getE_mail() == $email)
						$poruka.='E-mail je zauzet!<br>';
				}
			}
			else{
				$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.id=:user_id");
				$query->setParameters(array(
					'user_id' => $id,
				));
				$korisnici=$query->getResult();
				$korisnik=$korisnici[0];
				
				$korisnik->setKorisnicko_ime($ime);
				$korisnik->setLozinka($lozinka);
				$korisnik->setIme_i_prezime($imeprezime);
				$korisnik->setE_mail($email);
				$korisnik->setPol($pol);
				$korisnik->setGodiste($godiste);
				$em->persist($korisnik);
				$em->flush();
			}
		}
		
		$this->glporuka=$poruka;
		$this->index($id);
	}
}