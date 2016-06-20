<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/gore.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/meni.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/dole.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/indexkorisnik.css"/>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/indexkorisnik.js"></script>
	</head>
	<body>
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				&nbsp MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<?php
					echo $korisnik->getIme_i_prezime();
				?>
				<img onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>img/logout.png"/>
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $korisnik->getid();?>'" src = "<?php echo base_url();?>img/home.png"/>
			</div>
			<div id = "goredesno">
				<img src = "<?php echo base_url();?>img/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/predlaganjeurednik/index/<?php echo $korisnik->getid();?>"> Dodavanje novih pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/dodavanje/index/<?php echo $korisnik->getid();?>"> Dodavanje predlozenih pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/uredjivanje/index/<?php echo $korisnik->getid();?>"> Ure&#273;ivanje pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/forumurednik/index/<?php echo $korisnik->getid();?>"> Forum </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $korisnik->getid();?>"> Nalog </a>
			</div>
		</div>
		<div id = "sredina">
			<br><br>
			Dobrodosli,
			<br>
			<?php echo $korisnik->getIme_i_prezime();?>
			<br><br>
			<div id = "obavestenja">
				<br>
				Obavestenja
				<br><br>
				<div id = "postovi">
					<?php
						$brkom = 0;
						foreach ($postovi as $post) {
							foreach($post->getKomentari() as $komentar) {
								if($komentar->getVidjen() == "Ne" ) {
									$brkom++;
									echo "
									<div class = 'komentar' id = 'komentar".$komentar->getid()."'>".
										$komentar->getKorisnik()->getKorisnicko_ime()
										;
										if($komentar->getKorisnik()->getPol() == "Muski") {
											echo "
											je komentarisao vas post
											";
										}
										else {
											echo "
											je komentarisala vas post
											";
										}
										echo "
										<br>
										<div class = 'porukapolje' id = 'porukapoljekomentar".$komentar->getid()."'>
											Post:<br>".
											$post->getTekst()."<br>
											Komentar:<br>".
											$komentar->getTekst()."
										</div>
										<button type = 'button' class = 'porukadugme' id = 'porukadugmekomentar".$komentar->getid()."' onclick = 'prikaziKomentar(".$komentar->getid().")'>Prikazi</button>	
									</div>
									
									";
								}	
							}
						}
						if($brkom == 0) {
							echo "Nemate novih komentara<br><br>";
						}
						else {
							echo "<br>";
						}
					?>
				</div>
				<div id = "upozorenja">
					<?php
						$brupo = 0;
						foreach($upozorenja as $upozorenje) {
							if($upozorenje->getVidjeno() == "Ne" ) {
								$brupo++;
								echo "
								<div class = 'upozorenje' id = 'upozorenje".$upozorenje->getid()."'>
									Urednik je postavio upozorenje na vas post
									<br>
									<div class = 'porukapolje' id = 'porukapoljeupozorenje".$upozorenje->getid()."'>
										Post:<br>".
										$upozorenje->getTekst_posta()."<br>
										Poruka:<br>".
										$upozorenje->getPoruka()."
									</div>
									<button type = 'button' class = 'porukadugme' id = 'porukadugmeupozorenje".$upozorenje->getid()."' onclick = 'prikaziUpozorenje(".$upozorenje->getid().")'>Prikazi</button>	
								</div>
								";
							}	
						}
						if($brupo == 0) {
							echo "Nemate novih upozorenja<br><br>";
						}
						else {
							echo "<br>";
						}
					?>
				</div>
				<br>
			</div>
			<br><br>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img src = "<?php echo base_url();?>/img/logo tima.png"/>
			</div>
			<div id = "doledesno">
			Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
</html>