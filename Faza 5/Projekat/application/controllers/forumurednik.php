<?php

//Autor: Jovan Nikolic

class ForumUrednik extends CI_Controller {
	
	public function index($id) {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$korisnik = new Entity\Korisnik();
		$korisnik = $em->find("Entity\Korisnik", $id);
		
		$qb = $em->createQueryBuilder();
		$qb->select('p')
            ->from('Entity\Post', 'p');
		$q = $qb->getQuery();
		$postovi = $q->getResult();
		
		/*$qb = $em->createQueryBuilder();
		$qb->select('k')
            ->from('Entity\Komentar', 'k');
		$q = $qb->getQuery();
		$komentari = $q->getResult();*/
		
		$podaci['korisnik'] = $korisnik;
		$podaci['postovi'] = $postovi;
		/*$podaci['komentari'] = $komentari;*/
		
		$this->load->view('forumurednik', $podaci);
		
	}
	
	public function dodajKomentar() {
		
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$komentar = new Entity\Komentar();
		$komentar->setTekst($_POST['tekst']);
		$date = date("Y-m-d H:i:s");
		$date = date_create($date);
		$komentar->setDatum_i_vreme($date);
		$komentar->setVidjen("Ne");
		
		$korisnik = new Entity\Korisnik();
		$korisnik = $em->find("Entity\Korisnik", $_POST['korisnikid']);
		
		$komentar->setKorisnik($korisnik);
		
		$post = new Entity\Post();
		$post = $em->find("Entity\Post", $_POST['postid']);
		
		if($post->getKomentari()->count() == 0) {
			echo "
			<hr color = '#FF9400'>
			Komentari
			<hr color = '#FF9400'>
			<br>
			";
		}
		
		$komentar->setPost($post);
		
		$em->persist($komentar);
		$em->flush();
	
		echo "
		<div class = 'postkomentar'>
			<div class = 'postkomentartekst'>".
				$komentar->getTekst()."
			</div>
			<div class = 'korisnik'>
				<i>".$komentar->getKorisnik()->getKorisnicko_ime()."</i>
			</div>
			<div class = 'datumivreme'>
			";
			$date = $komentar->getDatum_i_vreme();
			echo "<i>".$date->format('Y-m-d H:i:s')."</i>
			</div>
		</div>
		<hr color = '#FF9400'>
		<br>
		";
	}
	
	public function dodajPost() {
	
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$post = new Entity\Post();
		$post->setTekst($_POST['tekst']);
		$date = date("Y-m-d H:i:s");
		$date = date_create($date);
		$post->setDatum_i_vreme($date);
		
		$korisnik = new Entity\Korisnik();
		$korisnik = $em->find("Entity\Korisnik", $_POST['korisnikid']);
		
		$post->setKorisnik($korisnik);
		
		$em->persist($post);
		$em->flush();
	
		echo "
		<br>
		<div class = 'post'>
			<div class = 'posttekst'>".
				$post->getTekst()."
			</div>
			<!--<div class = 'postdetalji'>-->
				<div class = 'korisnik'>
					Autor:<i>".$post->getKorisnik()->getKorisnicko_ime()."</i>
				</div>
				<div class = 'datumivreme'>
					";		
					$date = $post->getDatum_i_vreme();
					echo "
					Datum i vreme:<i>".$date->format('Y-m-d H:i:s')."</i>
				</div>
			<!--</div>-->	
			<div class = 'postkomentari' id = 'postkomentari".$post->getid()."'>
			<br><br>
			</div>
			<textarea class = 'komentarpolje' id = 'komentarpolje".$post->getid()."' placeholder = 'Unesite komentar ovde'></textarea>
			<br><br>
			<button type = 'button' class = 'komentardugme' id = 'komentardugme".$post->getid()."' onclick = 'dodajKomentar(".$korisnik->getid().",".$post->getid().")'>Pisi komentar</button>
		</div>
		";	
	
	}
	
	public function upozoriPost() {
	
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$post = new Entity\Post();
		$post = $em->find("Entity\Post", $_POST['postid']);
		
		$upozorenje = new Entity\Upozorenje();
		$upozorenje->setPoruka($_POST['poruka']);
		$upozorenje->setTekst_posta($post->getTekst());
		$upozorenje->setDatum_i_vreme_posta($post->getDatum_i_vreme());
		$upozorenje->setKorisnik($post->getKorisnik());
		$upozorenje->setVidjeno("Ne");
		
		$em->persist($upozorenje);
		$em->remove($post);
		$em->flush();
		
		if($post->getKorisnik()->getUpozorenja()->count() >= 5) {
			$prijava = new Entity\Prijava();
			$prijava->setKorisnik($post->getKorisnik());
			$em->persist($prijava);
			$em->flush();
		}
		
		echo "Postlato je upozorenje i obrisan post";
		
	}
	
	public function upozoriKomentar() {
	
		$this->load->helper('url');
		$this->load->library('doctrine');
		
		$em = $this->doctrine->em;
		
		$komentar = new Entity\Komentar();
		$komentar = $em->find("Entity\Komentar", $_POST['komentarid']);
		
		$upozorenje = new Entity\Upozorenje();
		$upozorenje->setPoruka($_POST['poruka']);
		$upozorenje->setTekst_posta($komentar->getTekst());
		$upozorenje->setDatum_i_vreme_posta($komentar->getDatum_i_vreme());
		$upozorenje->setKorisnik($komentar->getKorisnik());
		$upozorenje->setVidjeno("Ne");
		
		$em->persist($upozorenje);
		$em->remove($komentar);
		$em->flush();
		
		if($komentar->getKorisnik()->getUpozorenja()->count() >= 5) {
			$prijava = new Entity\Prijava();
			$prijava->setKorisnik($komentar->getKorisnik());
			$em->persist($prijava);
			$em->flush();
		}
		
		echo "<div style = 'border: solid #FF9400; border-radius: 2.5vh;'>Postlato je upozorenje i obrisan komentar</div>";
		
	}
	
}