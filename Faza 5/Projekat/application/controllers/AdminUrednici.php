<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class AdminUrednici extends CI_Controller {
	
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
		$data['imeprez']=$korisnici[0]->getIme_i_prezime();
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Vrsta=:vrsta");
		$query->setParameters(array(
			'vrsta' => "Urednik",
		));
		$korisnici = $query->getResult();
		$data['broj']=count($korisnici);
		
		$data['id']=$id;
		if (count($korisnici)==0){
			$data['korime']=$data['email']=$data['ime_prezime']=$data['pol']=$data['godiste']="";
		}
		else{
			$data['korime']=$korisnici[0]->getKorisnicko_ime();
			$data['email']=$korisnici[0]->getE_mail();
			$data['ime_prezime']=$korisnici[0]->getIme_i_prezime();
			$data['pol']=$korisnici[0]->getPol();
			$data['godiste']=$korisnici[0]->getGodiste();
		}
		
		if ($this->glporuka==null)
			$data['poruka']='';
		else
			$data['poruka']=$this->glporuka;
		
		$this->load->view('adminurednici', $data);
	}
	
	public function selektovanjeee(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Vrsta=:vrsta");
		$query->setParameters(array(
			'vrsta' => "Urednik",
		));
		$korisnici = $query->getResult();
		
		$index=$_POST['index'];
		$broj=count($korisnici);
		$urednik=$korisnici[$index];
		
			$str = '<div id = "sredinal2">
					Izaberite urednika: <br><br>	
					<form>
						<select id="urednici" name="urednici" form="" size="10" onclick="selektovanje()">';
								for ($i = 1; $i <= $broj; $i++){
									$str.= '<option value="'.$i.'"';
									if ($i==$index+1) $str.= 'selected';
									$str.= '>Urednik '.$i.'</option>';
								}
						$str.= '</select>
					</form>
				</div>
				<div id = "sredinal3">
					Detalji o izabranom uredniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="'. $urednik->getKorisnicko_ime() .'" readonly> <br><br>
						E-mail:<br>
						<input type="text" name="email" value="'. $urednik->getE_mail()  .'" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="'. $urednik->getIme_i_prezime()  .'" readonly><br><br>
						Pol:<br>
						<input type="text" name="pol" value="'. $urednik->getPol()  .'" size="1" readonly> <br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="'. $urednik->getGodiste()  .'" size="4" readonly><br><br>
						<button type="button" onclick="obrisi()" id = "brisinalog" style = "width: 50%;">Obri&#353;i nalog</button>
					</form>
				</div>';
			
			echo $str;
	}
	
	
	public function obrisi(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Vrsta=:vrsta");
		$query->setParameters(array(
			'vrsta' => "Urednik",
		));
		$korisnici = $query->getResult();
		
		$index=$_POST['index'];
		$broj=count($korisnici);
		$urednik=$korisnici[$index];
		
		$em->remove($urednik);
		$em->flush();
		
		$query = $em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Vrsta=:vrsta");
		$query->setParameters(array(
			'vrsta' => "Urednik",
		));
		$korisnici = $query->getResult();
		$broj=count($korisnici);
		
		if ($broj==0){
			$korime=$email=$ime_prezime=$pol=$godiste="";
		}
		else{
			$korime=$korisnici[0]->getKorisnicko_ime();
			$email=$korisnici[0]->getE_mail();
			$ime_prezime=$korisnici[0]->getIme_i_prezime();
			$pol=$korisnici[0]->getPol();
			$godiste=$korisnici[0]->getGodiste();
		}
		
		
			$str = '<div id = "sredinal2">
					Izaberite urednika: <br><br>	
					<form>
						<select id="urednici" name="urednici" form="" size="10" onclick="selektovanje()">';
								for ($i = 1; $i <= $broj; $i++){
									$str.= '<option value="'.$i.'"';
									if ($i==1) $str.= 'selected';
									$str.= '>Urednik '.$i.'</option>';
								}
						$str.= '</select>
					</form>
				</div>
				<div id = "sredinal3">
					Detalji o izabranom uredniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="'. $korime .'" readonly> <br><br>
						E-mail:<br>
						<input type="text" name="email" value="'. $email  .'" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="'. $ime_prezime .'" readonly><br><br>
						Pol:<br>
						<input type="text" name="pol" value="'. $pol  .'" size="1" readonly> <br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="'. $godiste  .'" size="4" readonly><br><br>
						<button type="button" onclick="obrisi()" id = "brisinalog" style = "width: 50%;">Obri&#353;i nalog</button>
					</form>
				</div>';
			
			echo $str;
	}
	
	
	public function dodaj($id){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$korime=$this->input->post('korime2');
		$lozinka=$this->input->post('lozinka2');
		$email=$this->input->post('email2');
		$imeprezime=$this->input->post('imeprezime2');
		$pol=$this->input->post('pol2');
		$godine=$this->input->post('godiste2');
		
		$poruka='';
		
		
		if ($korime==false){
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
		if ($godine==false){
			$poruka.='Niste uneli godiste!<br>';
		}
		
		if ($korime!=false && $lozinka!=false && $imeprezime!=false && $email!=false && $pol!=false && $godine!=false) {
			
			$query=$em->createQuery("SELECT k FROM Entity\Korisnik k WHERE k.Korisnicko_ime=:ki OR k.E_mail=:em");
			$query->setParameters(array(
				'ki' => $korime,
				'em' => $email,
			));
			$korisnici=$query->getResult();
			
			if ($korisnici!=null){
				foreach ($korisnici as $korisnik){
					if ($korisnik->getKorisnicko_ime() == $korime)
						$poruka.='Korisnicko ime je zauzeto!<br>';
					if ($korisnik->getE_mail() == $email)
						$poruka.='E-mail je zauzet!<br>';
				}
			}
			else{
				$urednik = new Entity\Korisnik();
				$urednik->setKorisnicko_ime($korime);
				$urednik->setLozinka($lozinka);
				$urednik->setE_mail($email);
				$urednik->setIme_i_prezime($imeprezime);
				$urednik->setPol($pol);
				$urednik->setGodiste($godine);
				$urednik->setVrsta("Urednik");
				$em->persist($urednik);
				$em->flush();
			}
		}
		
		$this->glporuka=$poruka;
		$this->index($id);
	}
}