<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head> <!-- -->

		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="./../css/StyleSlide.css" media="all" />

		<title> Ludotheque du Mans MKLoisirs</title>
	</head>

	<body>
		<?php include ("./menu.php"); ?>

		<p id="presentation"> Bonjour, <br> MKloisirs vous propose de nombreux jeux de
		qualité que vous pouvez emprunter sur réservation. Nous vous proposons des jeux
		de société, des jeux vidéos, des jeux d'extérieurs et pleins d'autre choses. Nous sommes
		à votre disposition pour toutes les informations qui vous semblent nécessaires. </p><br />

		<p id="horaires"> <br /><b>Nos horaires :</b> <br />
		10h - 12h <br />
		14h - 18h</p>

			<h2> Les nouveaux jeux disponibles</h2>
		<!-- diapo -->
		<section id="slideshow">
			<div class="container"> <!-- Section réunissant le conteneur des images -->
				<div class="c_slider"></div>
				<div class="slider"> <!-- Partie glissante -->
					<!-- Selection des images de manière dynamique -->
					<?php
						if($retour) {
							mysql_set_charset('utf8', $LienBase);

							// Recherche du Nombre de jeux présent dans la base
							$Requete="SELECT * FROM fc_grp2_jeux ORDER BY ID DESC LIMIT 4;";
							$Reponse=mysql_query($Requete);
							$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);

							// Boucle pour l'affichage du code
							while($res!=NULL) {
								echo "<figure>

								<img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' width='640' height='310' />
								<figcaption>" .$res['Jeux'] ."</figcaption>

								</figure>";
								$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
							}
						}
					?>
				</div>
			</div>

			<span id="timeline"></span> <!-- Barre de défilement du temps -->
		</section>
	</body>
</html>
