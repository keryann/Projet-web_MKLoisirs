<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
</head>

<body>
	<?php include ("menu.php"); ?>

	<div id="gauche">
		<img src='./../image/dr_maboul.jpg', alt=""/>
	</div><!--

--><div id="droite">
		<?php
			error_reporting(E_ALL ^ E_DEPRECATED);
			//paramètres de connexion à la base de données
			$Base="jeux"; //"info201a";
			$Serveur="localhost";//"info.univ-lemans.fr";
			$Utilisateur="root";//"info201a_user";
			$MotDePasse="";//"com72";

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
			echo "<br/><table>";
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
				echo"	<tr>	<td>
							<ul>	<li>" .$name['Nom'] ."\n" ."</li><br/>
								<li>" .$age['Ages'] ."\n" ."</li><br/>
								<li>" .$type['TypeJeux'] ."\n" ."</li> <br/> </ul>
						</td>
						<td> <img src='./../image/" .$image['image'] ."' alt='" .$name['Nom'] ."' /> </td>
					</tr>";

			endfor;
			echo "</table>";
		?>
	</div>

</body>
