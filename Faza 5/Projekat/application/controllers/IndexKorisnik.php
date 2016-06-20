<?php

//Autor: Jovan Nikolic

class IndexKorisnik extends CI_Controller {
	
	public function index($id) {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$korisnik = new Entity\Korisnik();
		$korisnik = $em->find("Entity\Korisnik", $id);
		
		$vrsta=$korisnik->getVrsta();
		
		if ($vrsta=="Admin"){
			$podaci['korisnik'] = $korisnik;
			$this->load->view('indexadmin', $podaci);
		}
		else{
		
			$qb = $em->createQueryBuilder();
			$qb->select('post')
				->from('Entity\Post', 'post')
				->where('post.Korisnik = :korisnik')
				->setParameter('korisnik', $korisnik);
			$q = $qb->getQuery();
			$postovi = $q->getResult();
			
			$qb->select('upozorenje')
				->from('Entity\Upozorenje', 'upozorenje')
				->where('upozorenje.Korisnik = :korisnik')
				->setParameter('korisnik', $korisnik);
			$q = $qb->getQuery();
			$upozorenja = $q->getResult();
			
			if ($vrsta=="Obican"){
				$qb->select('pitanje')
					->from('Entity\Pitanje', 'pitanje')
					->where('pitanje.Korisnik = :korisnik and pitanje.Status_aktivno =:status')
					->setParameter('korisnik', $korisnik)
					->setParameter('status', "Da");
				$q = $qb->getQuery();
				$pitanja = $q->getResult();
			}
			
			$podaci['korisnik'] = $korisnik;
			$podaci['postovi'] = $postovi;
			$podaci['upozorenja'] = $upozorenja;
			if ($vrsta=="Obican")
				$podaci['pitanja'] = $pitanja;
				
			if ($vrsta=="Obican")
				$this->load->view('indexkorisnik', $podaci);
			else if ($vrsta=="Urednik")
				$this->load->view('indexurednik', $podaci);
		}
		
	}
	
	public function Komentar() {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$komentar = new Entity\Komentar();
		$komentar = $em->find("Entity\Komentar", $_POST['id']);
		$komentar->setVidjen("Da");
		
		$em->persist($komentar);
		$em->flush();
		
		echo "Obavestenje obrisano";
	
	}
	
	public function Upozorenje() {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$upozorenje = new Entity\Upozorenje();
		$upozorenje = $em->find("Entity\Upozorenje", $_POST['id']);
		$upozorenje->setVidjeno("Da");
		
		$em->persist($upozorenje);
		$em->flush();
	
		echo "Obavestenje obrisano";
		
	}
	
	public function Pitanje() {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$pitanje = new Entity\Pitanje();
		$pitanje = $em->find("Entity\Pitanje", $_POST['id']);
		$pitanje->setVidjeno("Da");
		
		$em->persist($pitanje);
		$em->flush();
	
		echo "Obavestenje obrisano";
		
	}
	
	
	public function stari(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('url');
		
		$email=$this->input->post('email_stari');
		$lozinka=$this->input->post('lozinka_stari');
		$id=0;
		
		if ($email==false && $lozinka==false){
			$poruka="Niste uneli e-mail i lozinku!<br>";
		}
		else if ($email==false && $lozinka!=false){
			$poruka="Niste uneli e-mail!<br>";
		}
		else if ($email!=false && $lozinka==false){
			$poruka="Niste uneli lozinku!<br>";
		}
		else{
			
			$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.E_mail=:ki");
			$query->setParameters(array(
				'ki' => $email,
			));
			$korisnik=$query->getResult();
			
			if ($korisnik!=null){
				if ($korisnik[0]->getLozinka() != $lozinka)
					$poruka="Pogresna lozinka!<br>";
				else{
					$poruka='';
					$id=$korisnik[0]->getid();
				}
			}
			else{
				$query=$em->createQuery("SELECT o FROM Entity\Obrisani o WHERE o.E_mail=:ki");
				$query->setParameters(array(
					'ki' => $email,
				));
				$obrisani=$query->getResult();
				
				if ($obrisani!=null)
					$poruka="Vas nalog je obrisan zbog neprimerenog ponasanja!<br>";
				else
					$poruka="Ne postoji korisnik sa tim email-om!<br>";
			}
		}
		
		if ($poruka == '')
			$this->index($id);
		else
			$this->indexSajt($poruka);
	}
	
	public function indexSajt($poruka) {
		$this->load->helper('form');
		$this->load->helper('url');
		
		$data['poruka']=$poruka;
		$this->load->view('indexSajt', $data);
	}
	
	public function novi(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('url');
		
		$poruka='';
		
		$ime=$this->input->post('username_novi');
		$lozinka=$this->input->post('lozinka_novi');
		$imeprezime=$this->input->post('ime_prezime');
		$email=$this->input->post('email');
		$pol=$this->input->post('pol');
		$godiste=$this->input->post('godiste');
		$id=0;
		
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
			$query=$em->createQuery("SELECT o FROM Entity\Obrisani o WHERE o.E_mail=:ki");
			$query->setParameters(array(
				'ki' => $email,
			));
			$obrisani=$query->getResult();
				
			if ($obrisani!=null){
				$poruka='Nije moguce kreirati novi nalog sa ovom e-mail adresom!<br>';
				$b=false;
			}
			else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$poruka.='Email je u pogresnom formatu!<br>';
				$b=false;
			}
			else
				$b=true;
		}
		if ($pol==false){
			$poruka.='Niste uneli pol!<br>';
		}
		if ($godiste==false){
			$poruka.='Niste uneli godiste!<br>';
		}
		
		if ($ime!=false && $lozinka!=false && $imeprezime!=false && $email!=false && $pol!=false && $godiste!=false && $b) {
			
			$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Korisnicko_ime=:ki OR k.E_mail=:em");
			$query->setParameters(array(
				'ki' => $ime,
				'em' => $email,
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
				$korisnik = new Entity\Korisnik();
				$korisnik->setKorisnicko_ime($ime);
				$korisnik->setLozinka($lozinka);
				$korisnik->setIme_i_prezime($imeprezime);
				$korisnik->setE_mail($email);
				$korisnik->setPol($pol);
				$korisnik->setGodiste($godiste);
				$korisnik->setVrsta("Obican");
				$em->persist($korisnik);
				$em->flush();
				
				$id=$korisnik->getid();
			}
		}
		
		if ($poruka == '')
			$this->index($id);
		else{
			if (strpos($poruka, 'Nije moguce kreirati novi nalog sa ovom e-mail adresom!<br>') !== false) 
				$poruka='Nije moguce kreirati novi nalog sa ovom e-mail adresom!<br>';
			
			$this->indexSajt($poruka);
		}
	}

}