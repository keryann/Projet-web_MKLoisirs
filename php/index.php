<head> <!-- -->

		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="./../css/StyleSlide.css" media="all" />

		<title> Ludotheque du Mans MKLoisirs</title>
	</head>

	<body>
		<?php include ("./menu.php"); ?>

		<p classe="text"> Bonjour, <br> NMKloisirs vous propose de nombreux jeux de
		qualité que vous pouvez emprunter et/ou acheter sur réservation.  <p>

		<!-- diapo -->
		<section id="slideshow">
			<div class="container"> <!-- Section réunissant le conteneur des images -->
				<div class="c_slider"></div>
				<div class="slider"> <!-- Partie glissante -->
					<!-- Selection des images de manière dynamique -->
					<?php include("connexionbase.php");
						if($retour) {
							mysql_set_charset('utf8', $LienBase);

							// Recherche du Nombre de jeux à afficher
							$Requete="SELECT COUNT(Nom) AS nombre FROM FC_grp2_Jeux;";
							$Reponse=mysql_query($Requete);
							$N=mysql_fetch_array($Reponse, MYSQL_ASSOC);

							// Boucle pour l'affichage du code
							for($i=$N['nombre'];$i>=$N['nombre']-4;$i--) {
								$Requete="SELECT Nom FROM FC_grp2_Jeux WHERE ID=" .$i .";";
								$Reponse=mysql_query($Requete);
								$name=mysql_fetch_array($Reponse, MYSQL_ASSOC);

								$Requete="SELECT image FROM FC_grp2_Jeux WHERE ID=" .$i .";";
								$Reponse=mysql_query($Requete);
								$image=mysql_fetch_array($Reponse, MYSQL_ASSOC);

								echo "<figure>";

								echo "<img src='./../image/" .$image['image'] ."'alt='" .$name['Nom'] ."' width='640' height='310' />";
								echo "<figcaption>" .$name['Nom'] ."</figcaption>";

								echo "</figure>";
							}
						}
					?>
				</div>
			</div>

			<span id="timeline"></span> <!-- Barre de défilement du temps -->
		</section>
	</body>
