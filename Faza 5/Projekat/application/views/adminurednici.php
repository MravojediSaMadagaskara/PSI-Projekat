<!-- Autor: Jovan Nikolic -->

<html>
	
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css.css"/>
		<script src = "<?php echo base_url();?>js/js.js"></script>
		<script src = "<?php echo base_url();?>js/adminurednici.js"></script>
	</head>
	
	<body onload = "godine();">
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				&nbsp MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<?php echo $imeprez;?> <img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>slike/logout.png"/>
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $id;?>'" src = "<?php echo base_url();?>img/home.png"/>
			</div>
			<div id = "goredesno">
				<img id = "logokviza" src = "<?php echo base_url();?>slike/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div id = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/adminurednici/index/<?php echo $id;?>"> Uredjivanje urednika </a>
			</div>
			<div id = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/adminkorisnici/index/<?php echo $id;?>"> Uredjivanje korisnika </a>
			</div>
			<div id = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $id;?>"> Nalog </a>
			</div>
		</div>
		
		<?php
			if ($poruka!=''){
				$str= '<div id="obavestenje">'.
					$poruka
					.'<br><button type="button" onclick="skloniobavestenje()"> OK </button>
				</div>';
				echo $str;
			}
		?>
		
		<div id = "sredina">
			<div id = "sredinal1">
				Brisanje urednika
			</div>
			<div id = "sredinad1">
				Dodavanje urednika
			</div>
			<div id="sredinadole">
				<div id = "sredinal2">
					Izaberite urednika: <br><br>	
					<form>
						<select id="urednici" name="urednici" form="" size="10" onclick="selektovanje()">
							<?php
								for ($i = 1; $i <= $broj; $i++){
									echo '<option value="'.$i.'"';
									if ($i==1) echo 'selected';
									echo '>Urednik '.$i.'</option>';
								}
							?>
						</select>
					</form>
				</div>
				<div id = "sredinal3">
					Detalji o izabranom uredniku: <br><br>
					<form>
						Korisni&#269;ko ime:<br>
						<input type="text" name="korime" value="<?php echo $korime ?>" readonly> <br><br>
						E-mail:<br>
						<input type="text" name="email" value="<?php echo $email ?>" size="30" readonly><br><br>
						Ime i prezime:<br>
						<input type="text" name="imeprezime" value="<?php echo $ime_prezime ?>" readonly><br><br>
						Pol:<br>
						<input type="text" name="pol" value="<?php echo $pol ?>" size="1" readonly> <br><br>
						Godi&#353;te:<br>
						<input type="text" name="godiste" value="<?php echo $godiste ?>" size="4" readonly><br><br>
						<button type="button" onclick="obrisi()" id = "brisinalog" style = "width: 50%;">Obri&#353;i nalog</button>
					</form>
				</div>
			</div>
			<div id = "sredinad2">
				<form action="<?php echo site_url();?>/adminurednici/dodaj/<?php echo $id;?>" method="post">
				    Korisni&#269;ko ime:<br>
					<input type="text" name="korime2" id="korime2" value=""> <br><br>
					Lozinka:<br>
					<input type="text" name="lozinka2" id="lozinka2" value=""> <br><br>
					E-mail:<br>
					<input type="text" name="email2" id="email2" value="" size="30"><br><br>
					Ime i prezime:<br>
					<input type="text" name="imeprezime2" id="imeprezime2" value=""><br><br>
					Pol: <br>
					<input id = "muski" type= "radio" name = "pol2" value="Muski"/> Muski
					<input id = "zenski" type= "radio" name = "pol2" value="Zenski"/> Zenski
					<br><br>
					Godiste:<br>
					<select id = "godine" name="godiste2">
					</select>
					<br><br>
					<button type="submit" style = "width: 25%;">Dodaj nalog</button>
				</form>
			</div>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img src = "<?php echo base_url();?>slike/logo tima.png"/>
			</div>
			<div id = "doledesno">
				Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
	
</html>