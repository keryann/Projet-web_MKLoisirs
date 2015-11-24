<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
</head>

<body>
	<?php include ("menu.php"); ?>

<!-- Partie recherche de jeux -->
	<div id="gauche">
		<form method="post" action ="jeux.php">
			<br /><br /><h3>Recherche :</h3><br />
			Age : <br/>
			<input type="checkbox" name="age" value="quatre" checked="checked"/> 4 ans et plus<br />
			<input type="checkbox" name="age" value="huit" checked="checked"/> 8 ans et plus<br/>
			<input type="checkbox" name="age" value="douze" checked="checked"/> 12 ans et plus<br/><br/>

			Lieu : <br/>
			<input type="checkbox" name="lieu" value="interieur" checked="checked" /> Intérieur<br/>
			<input type="checkbox" name="lieu" value="exterieur" checked="checked" /> Extérieur<br/><br />

			<input type="submit" value="Valider" name="valider"/>
		</form>
	</div>

	<!-- Affichage des jeux -->
	<div id="droite">
		<?php include("connexionbase.php");
			if($retour) {
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

					$Requete="SELECT Lieu FROM FC_grp2_Jeux WHERE ID=" .$i .";";
					$Reponse=mysql_query($Requete);
					$lieu=mysql_fetch_array($Reponse, MYSQL_ASSOC);

					echo"	<tr>	<td>
								<ul>	<li>" .$name['Nom'] ."\n" ."</li><br/>
									<li>" .$age['Ages'] ."\n" ."</li><br/>
									<li>" .$type['TypeJeux'] ."\n" ."</li> <br/>
									<li> Jeux d'" .$lieu['Lieu'] ."\n" ."</li> <br/> </ul>
									</td>
									<td> <img src='./../image/" .$image['image'] ."' alt='" .$name['Nom'] ."' /> </td>
					</tr>";

				endfor;
				echo "</table>";
		}
		?>
	</div>

</body>
