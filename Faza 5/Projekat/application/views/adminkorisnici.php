<!-- Autor: Jovan Nikolic -->

<html>
	
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css.css"/>
		<script src = "<?php echo base_url();?>js/adminkorisnici.js"></script>
	</head>
	
	<body onload = "">
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				&nbsp MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<?php echo $imeprez;?> <img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>/slike/logout.png"/>
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
		<div id = "sredina">
			<div id = "sredina1">
				Izaberite korisnika: <br><br>	
				<form>
					<select id="korisnici" name="korisnici" form="" size="10" onclick="selektovanje()">
						<?php
							for ($i = 1; $i <= $broj; $i++){
								echo '<option value="'.$i.'"';
								if ($i==1) echo 'selected';
								echo'>Korisnik '.$i.'</option>';
							}
						?>
					</select>
				</form>
			</div>
			<div id = "sredina2">
				Detalji o izabranom korisniku: <br><br>
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
				</form>
			</div>
			<div id = "sredina3">
				<form>
					Prijavljeni komentari:<br><br>
					<?php 
						for ($i = 1; $i <= 5 && $i <= count($upozorenja); $i++){
							echo '<input type="text" name="komentar'.$i.'" value="'.$upozorenja[$i-1]->getTekst_posta().'" readonly><br><br>';
						}
					?>
					<button type="button" onclick="obrisi()" style = "width: 50%;">Obri&#353;i nalog</button>
					<br><br>
					<button type="button" onclick="obrisiprijavu()" style = "width: 50%;">Obri&#353;i prijavu</button>
				</form>
			</div>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img id = "logotima" src = "<?php echo base_url();?>slike/logo tima.png"/>
			</div>
			<div id = "doledesno">
				Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
	
</html>