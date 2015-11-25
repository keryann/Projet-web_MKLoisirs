
<html>
	<head>
		<meta charset="UTF-8">
		<title> Connexion MKLoisirs</title>
	</head>
	
	<body>
		<h1> Connexion </h1>
		<form method="post" action="exo3.php">

			A quel heure voulez vous venir chercher votre jeux ? (horaires d'ouverture 10h-12h et 14h-18h) : <input name="heur" /><br /><br />
			Adresse électronique : <input type="email" name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			<input type="submit" value="Valider" name = "valider" />
			<a href="./../ressources/exo1.html" title="exo1.html"> <br /> 
			<br />pas encore inscrit ?  </a>
		<p>
		<?php
			if(isset($_POST["valider"])) {
				if(!empty($_POST["mail"])&&!empty($_POST["password"])&&!empty($_POST["heur"])) {
					$mail = $_POST["mail"];
					$password = $_POST["password"];
					$heure =  $_POST["heur"];
					
					if( ($heure<10 && $heure>12) || ($heure>18 && $heure<14))
						echo "veuillez entrer un horaire correspondant à nos horaires d'ouverture <br/>";
						
					include("./../php/connexionbase.php");

					if($retour) {
						
						mysql_set_charset('utf8', $LienBase);			
						$Requete="SELECT Mail FROM FC_grp2_Users WHERE Password='" .$password ."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);

				
						if (isset($_POST["valider"]) && $UsrBase['Mail']==$mail){
							$Requete=" INSERT INTO FC_grp2_Panier (Client,Creneau) VALUES (".$mail.",".$heur.");";				
						}
						else {
							echo"L'adresse mail et le mot de passe ne correspondent pas";
						}
					}
				}
				else echo "Toutes les cases du formulaire ne sont pas remplies <br/>";
			}
			
			
			
		?>
	</p>

		</form>	
	</body>
</html>

