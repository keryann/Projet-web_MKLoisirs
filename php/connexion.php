<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

		<title> Connexion MKLoisirs</title>
	</head>

	<body>
		<?php include ("./menu.php");
		/* Si on est déjà connecté on prévient l'utilisateur et on lui propose de se déconnecter */
		if(isset($_SESSION['mail'])):
			echo "<h2>Vous êtes déjà connecté </h2>";

			echo "<form id='deco' method='post' action='connexion.php'>
			<input type='submit' value='Déconnexion' name = 'Deconnexion' />
			<br />
			</form>";
			/* Si l'utilisateur clique sur déconnexion on met fin à la session et on actualise la page*/
			if(isset($_POST["Deconnexion"])){
				session_unset($_SESSION['mail']);
				header("Refresh:0");
			};
		/* Si jamais on est connecté :*/
		else:
		 ?>


		<h2> Connexion </h2>
		<form class="connexion" method="post" action="connexion.php">

			<!-- Formulaire de connexion -->
			Adresse électronique : <input type="email" name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			<input type="submit" value="Valider" name = "valider" />
			<a href="./inscription.php" > <br />
			<br />Pas encore inscrit ?  </a>
		<p>
		<?php
			/* Quand l'utilisateur valide  on fait les vérifications nécessaires : mail et mdp remplis */
			if(isset($_POST["valider"])) {

				if(!empty($_POST["mail"])&&!empty($_POST["password"])) {
					$mail = $_POST["mail"];
					$password = $_POST["password"];

					include("./connexionbase.php");
					if($retour) {

						/* On cherche le le mot de passe correspondant à l'adresse mail entrée */
						mysql_set_charset('utf8', $LienBase);
						$Requete="SELECT * FROM FC_grp2_Users WHERE Mail='" .$mail ."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);

						/*On compare le mot de passe avec celui entré*/
						if (strcmp($UsrBase['Password'], $password)==0){
									$_SESSION['mail'] = $mail;

									echo "Bonjour ".$UsrBase['Prenom']." ".$UsrBase['Nom']."<br /><br />";
						}
						/* Si le mot de passe ne correspond pas avec l'adresse mail */
						else {
							echo"L'adresse mail et le mot de passe ne correspondent pas <br />";
						}
					}
				}
				else echo "Toutes les cases du formulaire ne sont pas remplies <br/>";
			}
			/* Affichage du fait que nous utilisons des cookies*/
			echo "<img src='./../image/cookies.png' alt='cookies'/> <br />
						Pour vous permettre une expérience optimale nous utilisons des cookies</form>";
			endif;
		?>



	</body>
</html>
