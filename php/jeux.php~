<!DOCTYPE html>
<html>

  <head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
  </head>

  <body>
	<h1> MKLoisirs </h1>
	<nav> <!-- Pour le cas d'une navigation entre page html -->
	<ul id="navigation"> <!-- Menu principal -->
		<li><a href="./../index.html" title="Accueil">Accueil</a> </li>
		<li><a href="./../php/jeux.php" title="Les jeux">Les jeux</a> </li>
		<li><a href="./../html/panier.html" title="Mon panier">Mon Panier</a> </li>
	</ul>
	</nav>
	<div>
		<?php
			//paramètres de connexion à la base de données
			$Base="FC_grp2_Jeux";
			$Serveur="http://info.univ-lemans.fr/phpMyAdmin/";
			$Utilisateur="info201a_User";
			$MotDePasse="com72";
			echo $Base ."<br/>";
			echo $Serveur ."<br/>";
			echo $Utilisateur ."<br/>";
			echo $MotDePasse ."<br/>";

			//connexion au serveur où se trouve la base de données
			$LienBase=mysql_connect($Serveur,$Utilisateur,$MotDePasse);
			echo $LienBase ."<br/>"

			//sélection de la base de données au niveau du serveur
			$retour=mysql_select_db($Base,$LienBase);

			//affichage d’un message d’erreur si la connexion a été refusée
			if(!$retour){
				echo "Connexion à la base impossible";
			}
		?>
	</div>

  </body>

</html>
