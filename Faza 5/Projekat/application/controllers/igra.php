<?php

// Autor: Jovan Nikolic*

class Igra extends CI_Controller {

	public function index($id) {
	
		$this->load->helper('url');
		$this->load->library('doctrine');
	
		$em = $this->doctrine->em;
		
		$korisnik = new Entity\Korisnik();
		$korisnik = $em->find("Entity\Korisnik", $id);
		
		$rezultat = new Entity\Rezultat();
		$rezultat->setBroj_poena(0);
		$date = date("Y-m-d H:i:s");
		$date = date_create($date);
		$rezultat->setDatum_i_vreme($date);
		$rezultat->setKorisnik($korisnik);
		
		$pitanje = $this->izaberiPitanje();
		
		$pitanje->addToRezultat($rezultat);
		$rezultat->setTrenutno($pitanje->getTacan_odgovor());
		$em->persist($rezultat);
		$em->flush();
		
		$podaci['korisnik'] = $korisnik;
		$podaci['rezultat'] = $rezultat;
		$podaci['pitanje'] = $pitanje;
		
		$this->load->view('igra', $podaci);
	
	} 

	public function izaberiPitanje() {
	
		$this->load->library('doctrine');

        $em = $this->doctrine->em;
		
		$qb = $em->createQueryBuilder();
		$qb->select('p')
            ->from('Entity\Pitanje', 'p')
			->where('p.Status_aktivno = :sa')
			->setParameter('sa', 'Da');
		$q = $qb->getQuery();
		$result = $q->getResult();
		
		$max = count($result);
		$i = rand(0, $max-1);
		
		$pitanje = $result[$i];
		return $pitanje;
	
	}

	public function osveziPitanje() {

		$this->load->library('doctrine');

        $em = $this->doctrine->em;
		
		//$rezultat = $_POST['rezultat'];
		$rezultat = $this->doctrine->em->find("Entity\Rezultat", $_POST['rezultat']);
		
		$izabraniOdgovor = $_POST['izabraniOdgovor'];
		if($izabraniOdgovor == $rezultat->getTrenutno()) {
			$rezultat->setBroj_poena($rezultat->getBroj_poena() + 1);
			$em->persist($rezultat);
			$em->flush();
		}
		
		$redniBroj = $_POST['redniBroj'];
		if($redniBroj == 4) {
			if($rezultat->getBroj_poena() == 0) {
				echo "<br><br><br><br><br><div id = 'upozorenje'> Zao nam je, niste osvojili ni jedan poen. Vise srece drugi put! </div>";
			}
			elseif ($rezultat->getBroj_poena() == 1) {
				echo "<br><br><br><br><br><div id = 'upozorenje'> Cestitamo, osvojili se 1 poen! </div>";
			}
			else { 
				echo "<br><br><br><br><br><div id = 'upozorenje'> Cestitamo, osvojili se ".$rezultat->getBroj_poena()." poena! </div>";
			}
			return;
		}
	
		$qb = $em->createQueryBuilder();
		$qb->select('p')
            ->from('Entity\Pitanje', 'p')
			->where('p.Status_aktivno = :sa')
			->setParameter('sa', 'Da');
		$q = $qb->getQuery();
		$result = $q->getResult();
		$max = count($result);
	
		$prethodnaPitanja = array();
		for($i = 0; $i < $rezultat->getPitanja()->count(); $i++) {
			$prethodnaPitanja[] = $rezultat->getPitanja()[$i]->getid();
		}
		
		do {
			$i = rand(0, $max-1);
		}
		while (in_array($result[$i]->getid(), $prethodnaPitanja));

		$pitanje = $result[$i];
		
		$pitanje->addToRezultat($rezultat);
		$rezultat->setTrenutno($pitanje->getTacan_odgovor());
		$em->persist($rezultat);
		$em->flush();
	
		echo "
		<div id = 'pitanje'>".
			$pitanje->getTekst()."
		</div>
		<br>
		<div id = 'ponudjeniodgovori'>
			<input type = 'radio' name = 'ponudjeniodgovori' value = '1' id = 'ponudjeniodgovor1'>".
				$pitanje->getOdgovor_1()."<br><br>
			</input>
			<input type = 'radio' name = 'ponudjeniodgovori' value = '2' id = 'ponudjeniodgovor2'>".
				$pitanje->getOdgovor_2()."<br><br>
			</input>
			<input type = 'radio' name = 'ponudjeniodgovori' value = '3' id = 'ponudjeniodgovor3'>".
				$pitanje->getOdgovor_3()."<br><br>
			</input>
			<input type = 'radio' name = 'ponudjeniodgovori' value = '4' id = 'ponudjeniodgovor4'>".
				$pitanje->getOdgovor_4()."
			</input>
		</div>
		";

	}

}