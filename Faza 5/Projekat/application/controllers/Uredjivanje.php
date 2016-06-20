<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class Uredjivanje extends CI_Controller {
	
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
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		
		$data['id']=$id;
		if (count($pitanja)==0){
			$data['tekst']=$data['odg1']=$data['odg2']=$data['odg3']=$data['odg4']="";
			$data['tacan']=1;
		}
		else{
			$data['tekst']=$pitanja[0]->getTekst();
			$data['odg1']=$pitanja[0]->getOdgovor_1();
			$data['odg2']=$pitanja[0]->getOdgovor_2();
			$data['odg3']=$pitanja[0]->getOdgovor_3();
			$data['odg4']=$pitanja[0]->getOdgovor_4();
			$data['tacan']=$pitanja[0]->getTacan_odgovor();
			if ($pitanja[0]->getStatus_prijavljeno()=='Da')
				$data['prijavljeno']='Da';
			else
				$data['prijavljeno']='Ne';
		}
		
		$brojostalih=count($pitanja);
		$brojprijavljenih=0;
		foreach ($pitanja as $pitanjce){
			if ($pitanjce->getStatus_prijavljeno()=='Da'){
				$brojostalih--;
				$brojprijavljenih++;
			}
		}
		$data['brojostalih']=$brojostalih;
		$data['brojprijavljenih']=$brojprijavljenih;
		
		$this->load->view('uredjivanje', $data);
	}
	
	public function selektovanjeee(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$vrsta=$_POST['vrsta'];
		$broj=count($pitanja);
		$a=0;
		for ($i = 0; $i < $broj; $i++){
			if (($vrsta=='Prijavljena' && $pitanja[$i]->getStatus_prijavljeno()=='Da') || ($vrsta=='Ostala' && $pitanja[$i]->getStatus_prijavljeno()=='Ne')){
				if ($a==$index){
					$pitanje=$pitanja[$i];
					break;
				}
				$a++;
			}
		}
		$brojostalih=$broj;
		$brojprijavljenih=0;
		foreach ($pitanja as $pitanjce){
			if ($pitanjce->getStatus_prijavljeno()=='Da'){
				$brojostalih--;
				$brojprijavljenih++;
			}
		}
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					Prijavljena pitanja: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ostala pitanja:
					<br>
					<select id="prijavljenapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Prijavljena\')">';
							for ($i = 1; $i <= $brojprijavljenih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1 && $vrsta=='Prijavljena') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select id="ostalapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Ostala\')">';
							for ($i = 1; $i <= $brojostalih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1 && $vrsta=='Ostala') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
				</form>
			</div>
			<div id = "sredinadesno">
				Detalji o izabranom pitanju: <br><br>
				<form>
					Postavka:<br>
					<textarea id = "postavka" style = "display: inline" readonly>'.$pitanje->getTekst().' </textarea><br><br>
					Odgovori:<br>
					<input id = "odgovor1" type = "text" value = "'.$pitanje->getOdgovor_1().'" readonly/><br>
					<input id = "odgovor2" type = "text" value = "'.$pitanje->getOdgovor_2().'" readonly/><br>
					<input id = "odgovor3" type = "text" value = "'.$pitanje->getOdgovor_3().'" readonly/><br>
					<input id = "odgovor4" type = "text" value = "'.$pitanje->getOdgovor_4().'" readonly/><br><br>
					Ta&#269;an odgovor:
					<select id = "tacanodgovor" name="tacan" disabled>
						<option value="1"'; if ($pitanje->getTacan_odgovor()==1) $str .= 'selected'; $str .= ' >1</option>
						<option value="2"'; if ($pitanje->getTacan_odgovor()==2) $str .= 'selected'; $str .= ' >2</option>
						<option value="3"'; if ($pitanje->getTacan_odgovor()==3) $str .= 'selected'; $str .= ' >3</option>
						<option value="4"'; if ($pitanje->getTacan_odgovor()==4) $str .= 'selected'; $str .= ' >4</option>
					</select>
					<br><br>
					<button type="button" onclick="ostavi()"'; if ($vrsta=='Ostala') $str .= 'style="display:none"'; $str .= '>Ostavi</button>
					<button type="button" onclick="obrisi()">Obrisi</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
	
	public function ostavi(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		
		$broj=count($pitanja);
		$a=0;
		for ($i = 0; $i < $broj; $i++){
			if ($pitanja[$i]->getStatus_prijavljeno()=='Da'){
				if ($a==$index){
					$pitanje=$pitanja[$i];
					break;
				}
				$a++;
			}
		}
		
		$pitanje->setStatus_prijavljeno("Ne");
		$em->persist($pitanje);
		$em->flush();
		
		$pitanje=$pitanja[0];
		if ($pitanja[0]->getStatus_prijavljeno()=='Da')
			$vrsta='Prijavljena';
		else
			$vrsta='Ostala';
		
		$brojostalih=$broj;
		$brojprijavljenih=0;
		foreach ($pitanja as $pitanjce){
			if ($pitanjce->getStatus_prijavljeno()=='Da'){
				$brojostalih--;
				$brojprijavljenih++;
			}
		}
		
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					Prijavljena pitanja: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ostala pitanja:
					<br>
					<select id="prijavljenapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Prijavljena\')">';
							for ($i = 1; $i <= $brojprijavljenih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1 && $vrsta=='Prijavljena') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select id="ostalapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Ostala\')">';
							for ($i = 1; $i <= $brojostalih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1 && $vrsta=='Ostala') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
				</form>
			</div>
			<div id = "sredinadesno">
				Detalji o izabranom pitanju: <br><br>
				<form>
					Postavka:<br>
					<textarea id = "postavka" style = "display: inline" readonly>'.$pitanje->getTekst().' </textarea><br><br>
					Odgovori:<br>
					<input id = "odgovor1" type = "text" value = "'.$pitanje->getOdgovor_1().'" readonly/><br>
					<input id = "odgovor2" type = "text" value = "'.$pitanje->getOdgovor_2().'" readonly/><br>
					<input id = "odgovor3" type = "text" value = "'.$pitanje->getOdgovor_3().'" readonly/><br>
					<input id = "odgovor4" type = "text" value = "'.$pitanje->getOdgovor_4().'" readonly/><br><br>
					Ta&#269;an odgovor:
					<select id = "tacanodgovor" name="tacan" disabled>
						<option value="1"'; if ($pitanje->getTacan_odgovor()==1) $str .= 'selected'; $str .= ' >1</option>
						<option value="2"'; if ($pitanje->getTacan_odgovor()==2) $str .= 'selected'; $str .= ' >2</option>
						<option value="3"'; if ($pitanje->getTacan_odgovor()==3) $str .= 'selected'; $str .= ' >3</option>
						<option value="4"'; if ($pitanje->getTacan_odgovor()==4) $str .= 'selected'; $str .= ' >4</option>
					</select>
					<br><br>
					<button type="button" onclick="ostavi()"'; if ($vrsta=='Ostala') $str .= 'style="display:none"'; $str .= '>Ostavi</button>
					<button type="button" onclick="obrisi()">Obrisi</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
	
	
	public function obrisi(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$vrsta=$_POST['vrsta'];
		$broj=count($pitanja);
		$a=0;
		for ($i = 0; $i < $broj; $i++){
			if (($vrsta=='Prijavljena' && $pitanja[$i]->getStatus_prijavljeno()=='Da') || ($vrsta=='Ostala' && $pitanja[$i]->getStatus_prijavljeno()=='Ne')){
				if ($a==$index){
					$pitanje=$pitanja[$i];
					break;
				}
				$a++;
			}
		}
		$em->remove($pitanje);
		$em->flush();
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		$broj=count($pitanja);
		
		if ($broj==0){
			$tekst=$odg1=$odg2=$odg3=$odg4="";
			$tacan=1;
			$brojostalih=$broj;
			$brojprijavljenih=0;
		}
		else{
			$tekst=$pitanja[0]->getTekst();
			$odg1=$pitanja[0]->getOdgovor_1();
			$odg2=$pitanja[0]->getOdgovor_2();
			$odg3=$pitanja[0]->getOdgovor_3();
			$odg4=$pitanja[0]->getOdgovor_4();
			$tacan=$pitanja[0]->getTacan_odgovor();
			if ($pitanja[0]->getStatus_prijavljeno()=='Da')
				$vrsta='Prijavljena';
			else
				$vrsta='Ostala';
			$brojostalih=$broj;
			$brojprijavljenih=0;
			foreach ($pitanja as $pitanjce){
				if ($pitanjce->getStatus_prijavljeno()=='Da'){
					$brojostalih--;
					$brojprijavljenih++;
				}
			}
		}
		
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					Prijavljena pitanja: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ostala pitanja:
					<br>
					<select id="prijavljenapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Prijavljena\')">';
							for ($i = 1; $i <= $brojprijavljenih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1 && $vrsta=='Prijavljena') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select id="ostalapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Ostala\')">';
							for ($i = 1; $i <= $brojostalih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1 && $vrsta=='Ostala') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
				</form>
			</div>
			<div id = "sredinadesno">
				Detalji o izabranom pitanju: <br><br>
				<form>
					Postavka:<br>
					<textarea id = "postavka" style = "display: inline" readonly>'.$tekst.' </textarea><br><br>
					Odgovori:<br>
					<input id = "odgovor1" type = "text" value = "'.$odg1.'" readonly/><br>
					<input id = "odgovor2" type = "text" value = "'.$odg2.'" readonly/><br>
					<input id = "odgovor3" type = "text" value = "'.$odg3.'" readonly/><br>
					<input id = "odgovor4" type = "text" value = "'.$odg4.'" readonly/><br><br>
					Ta&#269;an odgovor:
					<select id = "tacanodgovor" name="tacan" disabled>
						<option value="1"'; if ($tacan==1) $str .= 'selected'; $str .= ' >1</option>
						<option value="2"'; if ($tacan==2) $str .= 'selected'; $str .= ' >2</option>
						<option value="3"'; if ($tacan==3) $str .= 'selected'; $str .= ' >3</option>
						<option value="4"'; if ($tacan==4) $str .= 'selected'; $str .= ' >4</option>
					</select>
					<br><br>
					<button type="button" onclick="ostavi()"'; if ($vrsta=='Ostala') $str .= 'style="display:none"'; $str .= '>Ostavi</button>
					<button type="button" onclick="obrisi()">Obrisi</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
	
	
	public function izmenii(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:da");
		$query->setParameters(array(
			'da' => 'Da',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$vrsta=$_POST['vrsta'];
		$broj=count($pitanja);
		$a=0;
		for ($i = 0; $i < $broj; $i++){
			if (($vrsta=='Prijavljena' && $pitanja[$i]->getStatus_prijavljeno()=='Da') || ($vrsta=='Ostala' && $pitanja[$i]->getStatus_prijavljeno()=='Ne')){
				if ($a==$index){
					$pitanje=$pitanja[$i];
					break;
				}
				$a++;
			}
		}
		
		$brojostalih=$broj;
		$brojprijavljenih=0;
		foreach ($pitanja as $pitanjce){
			if ($pitanjce->getStatus_prijavljeno()=='Da'){
				$brojostalih--;
				$brojprijavljenih++;
			}
		}
		
		$postavka=$_POST['postavka'];
		$odg1=$_POST['odg1'];
		$odg2=$_POST['odg2'];
		$odg3=$_POST['odg3'];
		$odg4=$_POST['odg4'];
		$tacan=$_POST['tacan'];
		
		if (!empty($postavka) && !empty($odg1) && !empty($odg2) && !empty($odg3) && !empty($odg4) && !empty($tacan)){
			$pitanje->setTekst($postavka);
			$pitanje->setOdgovor_1($odg1);
			$pitanje->setOdgovor_2($odg2);
			$pitanje->setOdgovor_3($odg3);
			$pitanje->setOdgovor_4($odg4);
			$pitanje->setTacan_odgovor($tacan);
			$em->persist($pitanje);
			$em->flush();
			$b=false;
		}
		else{
			$postavka=$pitanje->getTekst();
			$odg1=$pitanje->getOdgovor_1();
			$odg2=$pitanje->getOdgovor_2();
			$odg3=$pitanje->getOdgovor_3();
			$odg4=$pitanje->getOdgovor_4();
			$tacan=$pitanje->getTacan_odgovor();
			$b=true;
		}
		
		$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					Prijavljena pitanja: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ostala pitanja:
					<br>
					<select id="prijavljenapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Prijavljena\')">';
							for ($i = 1; $i <= $brojprijavljenih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1 && $vrsta=='Prijavljena') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select id="ostalapitanja" name="pitanja" form="" size="10" onclick="selektovanje(\'Ostala\')">';
							for ($i = 1; $i <= $brojostalih; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1 && $vrsta=='Ostala') $str .= 'selected';
								$str .= '>Pitanje '.$i.'</option>';
							}
					$str .= '</select>
				</form>
			</div>';
			if ($b){
				$str .= '<div id="obavestenje">
					Morate da popunite sva polja!
					<br><br><button type="button" onclick="skloniobavestenje()"> OK </button>
				</div>';
			}
			else{
				$str .= '<div id="obavestenje">
					Izmenjeno pitanje!
					<br><br><button type="button" onclick="skloniobavestenje()"> OK </button>
				</div>';
			}
			$str .= '<div id = "sredinadesno">
				Detalji o izabranom pitanju: <br><br>
				<form>
					Postavka:<br>
					<textarea id = "postavka" style = "display: inline" readonly>'.$postavka.' </textarea><br><br>
					Odgovori:<br>
					<input id = "odgovor1" type = "text" value = "'.$odg1.'" readonly/><br>
					<input id = "odgovor2" type = "text" value = "'.$odg2.'" readonly/><br>
					<input id = "odgovor3" type = "text" value = "'.$odg3.'" readonly/><br>
					<input id = "odgovor4" type = "text" value = "'.$odg4.'" readonly/><br><br>
					Ta&#269;an odgovor:
					<select id = "tacanodgovor" name="tacan" disabled>
						<option value="1"'; if ($tacan==1) $str .= 'selected'; $str .= ' >1</option>
						<option value="2"'; if ($tacan==2) $str .= 'selected'; $str .= ' >2</option>
						<option value="3"'; if ($tacan==3) $str .= 'selected'; $str .= ' >3</option>
						<option value="4"'; if ($tacan==4) $str .= 'selected'; $str .= ' >4</option>
					</select>
					<br><br>
					<button type="button" onclick="ostavi()"'; if ($vrsta=='Ostala') $str .= 'style="display:none"'; $str .= '>Ostavi</button>
					<button type="button" onclick="obrisi()">Obrisi</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
}