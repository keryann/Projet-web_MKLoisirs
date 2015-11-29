<?php session_start(); ?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

		<title>Inscription MKLoisirs</title>
	</head>
	<body>
		<?php include ("./menu.php"); ?>
		<h2> Inscriptions </h2>
		<form class="connexion" method="post" action="inscription.php">
			Nom : <input name="nom" size="25px"/> <br /> <br />
			Prénom : <input name="prenom" /><br /><br />
			Adresse électronique : <input type="email" name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			Confirmation du Mot de Passe : <input type="password" name="passwordconfirm" /><br /><br />
			<input type="submit" value="Valider" name = "valider" />
			<p>
		<?php

		if(isset($_POST["valider"])) {
			if(!empty($_POST["nom"])&&!empty($_POST["prenom"])&&!empty($_POST["mail"])&&!empty($_POST["password"])) {
				$nom = $_POST["nom"];
				$prenom = $_POST["prenom"];
				$mail = $_POST["mail"];
				$password = $_POST["password"];
				$passwordconfirm = $_POST["passwordconfirm"];

				if($password == $passwordconfirm){

					include("./connexionbase.php");

					if($retour) {

						mysql_set_charset('utf8', $LienBase);
						$Requete="SELECT Mail FROM FC_grp2_Users WHERE Mail='" .$mail."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);

						if (isset($_POST["valider"]) && $UsrBase["Mail"] != NULL){
							echo"Cette adresse mail a déjà été utilisé";
						}
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
		</p>
	</body>
</html>
