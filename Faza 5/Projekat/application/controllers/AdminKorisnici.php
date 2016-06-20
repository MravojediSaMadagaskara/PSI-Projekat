<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class AdminKorisnici extends CI_Controller {
	
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
		$data['imeprez']=$korisnici[0]->getIme_i_prezime();
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$data['broj']=count($korisnici);
		
		$data['id']=$id;
		if (count($korisnici)==0){
			$data['korime']=$data['email']=$data['ime_prezime']=$data['pol']=$data['godiste']="";
			$data['upozorenja']=null;
		}
		else{
			$data['korime']=$korisnici[0]->getKorisnicko_ime();
			$data['email']=$korisnici[0]->getE_mail();
			$data['ime_prezime']=$korisnici[0]->getIme_i_prezime();
			$data['pol']=$korisnici[0]->getPol();
			$data['godiste']=$korisnici[0]->getGodiste();
			
			$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
			$query->setParameters(array(
				'kor' => $korisnici[0],
			));
			$upozorenja=$query->getResult();
			$data['upozorenja']=$upozorenja;
		}
		
		$this->load->view('adminkorisnici', $data);
	}
	
	public function selektovanjeee(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		$index=$_POST['index'];
		$korisnik=$korisnici[$index];
		
		$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$upozorenja=$query->getResult();
		
			$str = '<div id="sredina1">
					Izaberite korisnika: <br><br>
					<form>
						<select id="korisnici" name="korisnici" form="" size="10" onclick="selektovanje()">';
								for ($i = 1; $i <= $broj; $i++){
									$str .= '<option value="'.$i.'"';
									if ($i==$index+1) $str .= 'selected';
									$str .= '>Korisnik '.$i.'</option>';
								}
						$str .= '</select>
					</form>
				</div>
				<div id="sredina2">
					Detalji o izabranom korisniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="'.$korisnik->getKorisnicko_ime().'" readonly><br><br>
						E-mail:<br>
						<input type="text" name="email" value="'.$korisnik->getE_mail().'" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="'.$korisnik->getIme_i_prezime().'" readonly><br><br>
						Pol: <br>
						<input type="text" name="pol" value="'.$korisnik->getPol().'" size="1" readonly><br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="'.$korisnik->getGodiste().'" size="4" readonly><br><br>
					</form>
				</div>
				<div id="sredina3">
					<form>
						Prijavljeni komentari:<br><br>';
							for ($i = 1; $i <= count($upozorenja); $i++){
								$str .= '<input type="text" name="komentar'.$i.'" value="'.$upozorenja[$i-1]->getTekst_posta().'" readonly><br><br>';
							}
						$str .= '<button type="button" onclick="obrisi()" style = "width: 50%;"> Obri&#353;i nalog </button>
						<br><br>
						<button type="button" onclick="obrisiprijavu()" style = "width: 50%;">Obri&#353;i prijavu</button>
					</form>
				</div>';
			
			echo $str;
	}
	
	
	public function obrisi(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		$index=$_POST['index'];
		
		$korisnik=$korisnici[$index];
		$email=$korisnik->getE_mail();
		
		$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$upozorenja=$query->getResult();
		
		foreach ($upozorenja as $upozorenje){
			$em->remove($upozorenje);
		}
		
		$query=$em->createQuery("SELECT p FROM Entity\Prijava p WHERE p.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$prijava=$query->getResult();
		
		$em->remove($prijava[0]);
		
		$query=$em->createQuery("SELECT r FROM Entity\Rezultat r WHERE r.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$rezultati=$query->getResult();
		
		foreach ($rezultati as $rezultat){
			$em->remove($rezultat);
		}
		
		$query=$em->createQuery("SELECT p FROM Entity\Post p WHERE p.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$postovi=$query->getResult();
		
		foreach ($postovi as $post){
			$query=$em->createQuery("SELECT k FROM Entity\Komentar k WHERE k.Post=:pos");
			$query->setParameters(array(
				'pos' => $post,
			));
			$komentari=$query->getResult();
			
			foreach ($komentari as $komentar){
				$em->remove($komentar);
			}
			
			$em->remove($post);
		}
		
		$query=$em->createQuery("SELECT k FROM Entity\Komentar k WHERE k.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$komentari=$query->getResult();
		
		foreach ($komentari as $komentar){
			$em->remove($komentar);
		}
		
		$em->remove($korisnik);
		
		$em->flush();
		
		$obrisani=new Entity\Obrisani();
		$obrisani->setE_mail($email);
		$em->persist($obrisani);
		$em->flush();
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		if ($broj==0){
			$korime=$email=$imeprezime=$pol=$godiste="";
			$upozorenja=null;
		}
		else{
			$korime=$korisnici[0]->getKorisnicko_ime();
			$email=$korisnici[0]->getE_mail();
			$imeprezime=$korisnici[0]->getIme_i_prezime();
			$pol=$korisnici[0]->getPol();
			$godiste=$korisnici[0]->getGodiste();
			
			$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
			$query->setParameters(array(
				'kor' => $korisnici[0],
			));
			$upozorenja=$query->getResult();
		}
		
		
			$str = '<div id="sredina1">
					Izaberite korisnika: <br><br>
					<form>
						<select id="korisnici" name="korisnici" form="" size="10" onclick="selektovanje()">';
								for ($i = 1; $i <= $broj; $i++){
									$str .= '<option value="'.$i.'"';
									if ($i==1) $str .= 'selected';
									$str .= '>Korisnik '.$i.'</option>';
								}
						$str .= '</select>
					</form>
				</div>
				<div id="sredina2">
					Detalji o izabranom korisniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="'.$korime.'" readonly><br><br>
						E-mail:<br>
						<input type="text" name="email" value="'.$email.'" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="'.$imeprezime.'" readonly><br><br>
						Pol: <br>
						<input type="text" name="pol" value="'.$pol.'" size="1" readonly><br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="'.$godiste.'" size="4" readonly><br><br>
					</form>
				</div>
				<div id="sredina3">
					<form>
						Prijavljeni komentari:<br><br>';
							for ($i = 1; $i <= count($upozorenja); $i++){
								$str .= '<input type="text" name="komentar'.$i.'" value="'.$upozorenja[$i-1]->getTekst_posta().'" readonly><br><br>';
							}
						$str .= '<button type="button" onclick="obrisi()" style = "width: 50%;"> Obri&#353;i nalog </button>
						<br><br>
						<button type="button" onclick="obrisiprijavu()" style = "width: 50%;">Obri&#353;i prijavu</button>
					</form>
				</div>';
			
			echo $str;
	}
	
	public function obrisiprijavu(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		$index=$_POST['index'];
		
		$korisnik=$korisnici[$index];
		$email=$korisnik->getE_mail();
		
		$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$upozorenja=$query->getResult();
		
		$query=$em->createQuery("SELECT p FROM Entity\Prijava p WHERE p.Korisnik=:kor");
		$query->setParameters(array(
			'kor' => $korisnik,
		));
		$prijava=$query->getResult();
		
		foreach ($upozorenja as $upozorenje){
			$em->remove($upozorenje);
		}
		
		$em->remove($prijava[0]);
		$em->flush();
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k JOIN k.Prijava pr");
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		if ($broj==0){
			$korime=$email=$imeprezime=$pol=$godiste="";
			$upozorenja=null;
		}
		else{
			$korime=$korisnici[0]->getKorisnicko_ime();
			$email=$korisnici[0]->getE_mail();
			$imeprezime=$korisnici[0]->getIme_i_prezime();
			$pol=$korisnici[0]->getPol();
			$godiste=$korisnici[0]->getGodiste();
			
			$query=$em->createQuery("SELECT u FROM Entity\Upozorenje u WHERE u.Korisnik=:kor");
			$query->setParameters(array(
				'kor' => $korisnici[0],
			));
			$upozorenja=$query->getResult();
		}
		
		
			$str = '<div id="sredina1">
					Izaberite korisnika: <br><br>
					<form>
						<select id="korisnici" name="korisnici" form="" size="10" onclick="selektovanje()">';
								for ($i = 1; $i <= $broj; $i++){
									$str .= '<option value="'.$i.'"';
									if ($i==1) $str .= 'selected';
									$str .= '>Korisnik '.$i.'</option>';
								}
						$str .= '</select>
					</form>
				</div>
				<div id="sredina2">
					Detalji o izabranom korisniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="'.$korime.'" readonly><br><br>
						E-mail:<br>
						<input type="text" name="email" value="'.$email.'" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="'.$imeprezime.'" readonly><br><br>
						Pol: <br>
						<input type="text" name="pol" value="'.$pol.'" size="1" readonly><br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="'.$godiste.'" size="4" readonly><br><br>
					</form>
				</div>
				<div id="sredina3">
					<form>
						Prijavljeni komentari:<br><br>';
							for ($i = 1; $i <= count($upozorenja); $i++){
								$str .= '<input type="text" name="komentar'.$i.'" value="'.$upozorenja[$i-1]->getTekst_posta().'" readonly><br><br>';
							}
						$str .= '<button type="button" onclick="obrisi()" style = "width: 50%;"> Obri&#353;i nalog </button>
						<br><br>
						<button type="button" onclick="obrisiprijavu()" style = "width: 50%;">Obri&#353;i prijavu</button>
					</form>
				</div>';
			
			echo $str;
	}
	
}