<!-- Autor: Jovan Nikolic -->

<html>
	
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css.css"/>
		<script src = "<?php echo base_url();?>js/js.js"></script>
		<script src = "<?php echo base_url();?>js/dodavanje.js"></script>
	</head>
	
	<body>
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
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/predlaganjeurednik/index/<?php echo $id;?>"> Dodavanje novih pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/dodavanje/index/<?php echo $id;?>"> Dodavanje predlozenih pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/uredjivanje/index/<?php echo $id;?>"> Ure&#273;ivanje pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/forumurednik/index/<?php echo $id;?>"> Forum </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $id;?>"> Nalog </a>
			</div>
		</div>
		<div id = "sredina">
			<div id = "sredinalevo">
				Izaberite pitanje: <br><br>	
				<form>
					<select id="pitanja" name="pitanja" form="" size="10" onclick="selektovanje()">
						<?php
							for ($i = 1; $i <= $broj; $i++){
								echo '<option value="'.$i.'"';
								if ($i==1) echo 'selected';
								echo'>Pitanje '.$i.'</option>';
							}
						?>
					</select>
				</form>
			</div>
			<div id = "sredinadesno">
				Detalji o izabranom pitanju: <br><br>
				<form>
					Postavka:<br>
					<textarea id = "postavka" style = "display: inline" readonly> <?php echo $tekst; ?> </textarea><br><br>
					Odgovori:<br>
					<input id = "odgovor1" type = "text" value = "<?php echo $odg1; ?>" readonly/><br>
					<input id = "odgovor2" type = "text" value = "<?php echo $odg2; ?>" readonly/><br>
					<input id = "odgovor3" type = "text" value = "<?php echo $odg3; ?>" readonly/><br>
					<input id = "odgovor4" type = "text" value = "<?php echo $odg4; ?>" readonly/><br><br>
					Ta&#269;an odgovor:
					<select id = "tacanodgovor" name="tacan" disabled>
						<option value="1" <?php if ($tacan==1) echo 'selected'; ?> >1</option>
						<option value="2" <?php if ($tacan==2) echo 'selected'; ?> >2</option>
						<option value="3" <?php if ($tacan==3) echo 'selected'; ?> >3</option>
						<option value="4" <?php if ($tacan==4) echo 'selected'; ?> >4</option>
					</select>
					<br><br>
					<button type="button" onclick="odobri()">Odobri</button>
					<button type="button" onclick="odbaci()">Odbaci</button><br><br>
					<button id = "izmeni" type = "button" onclick = "izmenipitanje()" style = "display: inline">Izmeni</button>
					<button id = "sacuvaj" type = "button" onclick = "izmenii(); izmenipitanje()" style = "display: none">Sacuvaj</button>
					<button id = "otkazi" type = "button" onclick = "izmenipitanje()" style = "display: none">Otkazi</button>
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