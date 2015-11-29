<!DOCTYPE html>
<html>
<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");
	/* On demande à l'utilisateur l'horaire auquel il souhaite venier chercher sa commande */
	echo"<form class='connexion' method='post' action ='validepanier.php'>
				Entrez l'horaire auquel vous souhaitez venir chercher votre/vos jeux : <input name='horaire'>
				<input type='submit' value='valider' name='valide'/>
				<p id='horaires'> <br /><b>Nos horaires :</b> <br />
				10h - 12h <br />
				14h - 18h</p>";

	if(isset($_POST["valide"])) {
		$horaire=$_POST["horaire"];
		/* On vérifie que l'horaire entré correspond aux horaires de la ludothèque */
		if($horaire>=10 && $horaire<12 || $horaire>=14 && $horaire<18) {
			/* Lorsque l'horaire est valide on passe le bouléen précisant que la commande est validée à 1 */
			echo "<br />Votre commande a bien été prise en compte";
			$Ajout="UPDATE FC_grp2_Paniers SET Valide=1, Creneau =$horaire WHERE Mail= '" .$_SESSION["mail"] ."';";
			mysql_query($Ajout);
			/* Ensuite on décrémente le nombre de jeux présents dans la bibliothèque */
			$Decremente="UPDATE FC_grp2_JeuxLudotheque SET NbJeuxDispos=NbJeuxDispos-1 WHERE
								ID IN (SELECT ID FROM FC_grp2_Paniers WHERE Mail= '" .$_SESSION["mail"] ."');";
			mysql_query($Decremente);
		}
		else {
			echo "<br />L'horaire que vous avez entré est invalide";
		}
	}
?>
	</form>
</body>
</html>
