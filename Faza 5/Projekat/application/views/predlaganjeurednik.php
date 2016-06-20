<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css.css"/>
		<script src = "<?php echo base_url();?>js/js.js"></script>
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
				<img src = "<?php echo base_url();?>slike/logo kviza.png"/>
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
			<form action="<?php echo site_url();?>/predlaganjeurednik/potvrdi/<?php echo $id;?>" method="post">
				<br><br>
				<textarea placeholder = "Unesite pitanje ovde" style = "display: inline" name="postavka"></textarea>
				<br><br>
				<input type = "text" placeholder = "Odgovor 1" name="odgovor1"></input>
				<br>
				<input type = "text" placeholder = "Odgovor 2" name="odgovor2"></input>
				<br>
				<input type = "text" placeholder = "Odgovor 3" name="odgovor3"></input>
				<br>
				<input type = "text" placeholder = "Odgovor 4" name="odgovor4"></input>
				<br><br>
				Tacan odgovor:
				<select name="tacan">
					<option value="">Izaberite</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<br><br>
				<button type = "submit">
					Potvrdi
				</button>
				<br><br>
				<button type = "button" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $id;?>'">
					Odustani
				</button>
			</form>
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