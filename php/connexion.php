<?php session_start(); ?>

	<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

		<title> Connexion MKLoisirs</title>
	</head>

	<body>
		<?php include ("./menu.php");
		if(isset($_SESSION['mail'])):
			echo "<h2>Vous êtes deja connecté <h2>";

			echo "<form method='post' action='connexion.php'>
			<input type='submit' value='Déconnexion' name = 'Deconnexion' />
			<br />
			</form>";

			if(isset($_POST["Deconnexion"])){
				session_unset($_SESSION['mail']);
				header("Refresh:0");
			};

		else:
		 ?>


		<h2> Connexion </h2>
		<form class="connexion" method="post" action="connexion.php">

			<!--A quel heure voulez vous venir chercher votre jeux ? (horaires d'ouverture 10h-12h et 14h-18h) : <input name="heur" /><br /><br />-->
			Adresse électronique : <input type="email" name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			<input type="submit" value="Valider" name = "valider" />
			<a href="./inscription.php" > <br />
			<br />pas encore inscrit ?  </a>
		<p>
		<?php

			if(isset($_POST["valider"])) {

				if(!empty($_POST["mail"])&&!empty($_POST["password"])) {
					$mail = $_POST["mail"];
					$password = $_POST["password"];

					include("./../php/connexionbase.php");
					if($retour) {

						mysql_set_charset('utf8', $LienBase);
						$Requete="SELECT Mail FROM FC_grp2_Users WHERE Password='" .$password ."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);


						if (isset($_POST["valider"]) && $UsrBase['Mail']==$mail){
									$_SESSION["mail"] = $mail;

									mysql_set_charset('utf8', $LienBase);
									$Requete="SELECT Nom,Prenom FROM FC_grp2_Users WHERE Mail='" .$_SESSION["mail"]."';";
									$Reponse=mysql_query($Requete);
									$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);

									echo "Bonjour ".$UsrBase['Prenom']." ".$UsrBase['Nom']."<br>";
									header("Refresh:2");
						}
						else {
							echo"L'adresse mail et le mot de passe ne correspondent pas";
						}
					}
				}
				else echo "Toutes les cases du formulaire ne sont pas remplies <br/>";
			}


			echo "</p> <img src='./../image/cookies.png' /> </form>";
			endif;
		?>


	</body>
</html>
