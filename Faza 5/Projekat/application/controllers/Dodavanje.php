<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class Dodavanje extends CI_Controller {
	
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
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		
		$data['id']=$id;
		$data['broj']=count($pitanja);
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
		}
		$this->load->view('dodavanje', $data);
	}
	
	public function selektovanjeee(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$pitanje=$pitanja[$index];
		$broj=count($pitanja);
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					<select id="pitanja" name="pitanja" form="" size="10" onclick="selektovanje()">';
							for ($i = 1; $i <= $broj; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1) $str .= 'selected';
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
					<button type="button" onclick="odobri()">Odobri</button>
					<button type="button" onclick="odbaci()">Odbaci</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
	
	public function odobri(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$pitanje=$pitanja[$index];
		
		$pitanje->setStatus_aktivno("Da");
		$em->persist($pitanje);
		$em->flush();
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		$broj=count($pitanja);
		
		if ($broj==0){
			$tekst=$odg1=$odg2=$odg3=$odg4="";
			$tacan=1;
		}
		else{
			$tekst=$pitanja[0]->getTekst();
			$odg1=$pitanja[0]->getOdgovor_1();
			$odg2=$pitanja[0]->getOdgovor_2();
			$odg3=$pitanja[0]->getOdgovor_3();
			$odg4=$pitanja[0]->getOdgovor_4();
			$tacan=$pitanja[0]->getTacan_odgovor();
		}
		
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					<select id="pitanja" name="pitanja" form="" size="10" onclick="selektovanje()">';
							for ($i = 1; $i <= $broj; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1) $str .= 'selected';
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
					<button type="button" onclick="odobri()">Odobri</button>
					<button type="button" onclick="odbaci()">Odbaci</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
	
	
	public function odbaci(){
		$this->load->library('doctrine');
		$em = $this->doctrine->em;
		$this->load->helper('form');
		$this->load->helper('url');
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$pitanje=$pitanja[$index];
		
		$em->remove($pitanje);
		$em->flush();
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		$broj=count($pitanja);
		
		if ($broj==0){
			$tekst=$odg1=$odg2=$odg3=$odg4="";
			$tacan=1;
		}
		else{
			$tekst=$pitanja[0]->getTekst();
			$odg1=$pitanja[0]->getOdgovor_1();
			$odg2=$pitanja[0]->getOdgovor_2();
			$odg3=$pitanja[0]->getOdgovor_3();
			$odg4=$pitanja[0]->getOdgovor_4();
			$tacan=$pitanja[0]->getTacan_odgovor();
		}
		
		
			$str = '<div id = "sredinalevo">
				Izaberite pitanje: <br><br>
				<form>
					<select id="pitanja" name="pitanja" form="" size="10" onclick="selektovanje()">';
							for ($i = 1; $i <= $broj; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==1) $str .= 'selected';
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
					<button type="button" onclick="odobri()">Odobri</button>
					<button type="button" onclick="odbaci()">Odbaci</button><br><br>
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
		
		$query=$em->createQuery("SELECT p FROM Entity\Pitanje p WHERE p.Status_aktivno=:ne");
		$query->setParameters(array(
			'ne' => 'Ne',
		));
		$pitanja=$query->getResult();
		
		$index=$_POST['index'];
		$pitanje=$pitanja[$index];
		$broj=count($pitanja);
		
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
					<select id="pitanja" name="pitanja" form="" size="10" onclick="selektovanje()">';
							for ($i = 1; $i <= $broj; $i++){
								$str .= '<option value="'.$i.'"';
								if ($i==$index+1) $str .= 'selected';
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
					<button type="button" onclick="odobri()">Odobri</button>
					<button type="button" onclick="odbaci()">Odbaci</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
				</form>
			</div>';
			
			echo $str;
	}
}