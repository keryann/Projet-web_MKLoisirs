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
		<li><a href="./../index.php" title="Accueil">Accueil</a> </li>
		<li><a href="./../php/jeux.php" title="Les jeux">Les jeux</a> </li>
		<li><a href="./../html/panier.html" title="Mon panier">Mon Panier</a> </li>
	</ul>
	</nav>
	<div>
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
			mysql_set_charset('utf8', $LienBase);
			// Recherche du Nombre de jeux à afficher
			$Requete="SELECT COUNT(Nom) AS nombre FROM FC_grp2_Jeux;";
			$Reponse=mysql_query($Requete);
			$N=mysql_fetch_array($Reponse, MYSQL_ASSOC);
			// Boucle pour l'affichage du code
			for($i=1;$i<=$N['nombre'];$i++) :
				$Requete="SELECT Nom FROM FC_grp2_Jeux WHERE ID=" .$i .";";
				$Reponse=mysql_query($Requete);
				$name=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				
				$Requete="SELECT Ages FROM FC_grp2_Jeux WHERE ID=" .$i .";";
				$Reponse=mysql_query($Requete);
				$age=mysql_fetch_array($Reponse, MYSQL_ASSOC);

				$Requete="SELECT TypeJeux FROM FC_grp2_Jeux WHERE ID=" .$i .";";
				$Reponse=mysql_query($Requete);
				$type=mysql_fetch_array($Reponse, MYSQL_ASSOC);

				$Requete="SELECT image FROM FC_grp2_Jeux WHERE ID=" .$i .";";
				$Reponse=mysql_query($Requete);
				$image=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				?>
				<br />
					<table>
						<tr>
							<td>
								<ul>
									<li>
										<?php
											echo $name['Nom'] ."\n";
										?>
				 					</li><br/>
				 					<li>
				 						<?php
				 							echo $age['Ages'] ."\n";
				 						?>
				 					</li><br/>
				 					<li>
				 						<?php
											echo $type['TypeJeux'] ."\n";
										?>
									</li><br/>
								</ul>
							</td>
							<td>
								<?php
									echo '<img src="./../image/' .$image['image'] .'" alt="' .$image['image'] .'" />';	
								?>
							</td>
						</tr>
					</table>
			<?php
				endfor;
			?>
	</div>

  </body>

</html>
