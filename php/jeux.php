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
		<table>
		<?php
			//paramètres de connexion à la base de données
			$Base="info201a";
			$Serveur="info.univ-lemans.fr";
			$Utilisateur="info201a_user";
			$MotDePasse="com72";

			//connexion au serveur où se trouve la base de données
			$LienBase=mysql_connect($Serveur,$Utilisateur,$MotDePasse);

			//sélection de la base de données au niveau du serveur
			$retour=mysql_select_db($Base,$LienBase);

			//affichage d’un message d’erreur si la connexion a été refusée
			if(!$retour){
				echo "Connexion à la base impossible";
			}
			$Nom=mysql_query(SELECT `Nom` FROM FC_grp2_Jeux WHERE Nom='Dr maboul';);
			echo $Nom;
		?>
		</table>
	</div>

  </body>

</html>
