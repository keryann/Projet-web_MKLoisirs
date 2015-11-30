<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

		<title>Inscription MKLoisirs</title>
	</head>
	<body>
		<?php include ("./menu.php"); ?>
		<h2> Inscriptions </h2>
		<!-- Formulaire d'inscription -->
		<form class="connexion" method="post" action="inscription.php">
			Nom : <input name="nom" /> <br /> <br />
			Prénom : <input name="prenom" /><br /><br />
			Adresse électronique : <input type="email" name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			Confirmation du Mot de Passe : <input type="password" name="passwordconfirm" /><br /><br />
			<input type="submit" value="Valider" name = "valider" /><br /><br />
		<?php

		if(isset($_POST["valider"])) {
			/* On met ce qu'on a tapé dans des variables */
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$mail = $_POST["mail"];
			$password = $_POST["password"];
			$passwordconfirm = $_POST["passwordconfirm"];
			/* On vérifie que toutes les cases sont remplies */
			if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($password) && !empty($passwordconfirm)) {
				/* On vérifie que le mot de passe et la confirmation du mot de passe sont identiques */
				if($password == $passwordconfirm){

					if($retour) {
						/* On cherche le mail dans la BdD*/
						mysql_set_charset('utf8', $LienBase);
						$Requete="SELECT Mail FROM FC_grp2_Users WHERE Mail='" .$mail."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);

						/* Si on a un retour on prévient que l'email est déjà utilisé */
						if ($UsrBase){
							echo"Cette adresse mail a déjà été utilisé";
						}
						/* Si non on inscrit l'utilisateur dans la BdD*/
						else{
							echo "Bienvenue ".$prenom." ".$nom. " !<br/>" ;

							$sql="INSERT INTO FC_grp2_Users VALUES('".$nom."','".$prenom."','".$mail."','".$password."');";
							mysql_query($sql);
						}
					}
				}
				else echo "La confirmation du mot de passe ne correspond pas au mot de passe";
			}
			else echo "Toutes les cases du formulaire ne sont pas remplies";
		}
		?>
	</form>
	</body>
</html>
