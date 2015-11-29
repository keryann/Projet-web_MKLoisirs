<?php session_start(); ?>

<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");
	echo"<form class='connexion' method='post' action ='validepanier.php'>
				Entrez l'horaire auquel vous souhaitez venir chercher votre/vos jeux : <input name='horaire'>
				<input type='submit' value='valider' name='valide'/>";

	if(isset($_POST["valide"])) {
		$horaire=$_POST["horaire"];
		if($horaire>=10 && $horaire<12 || $horaire>=14 && $horaire<18) {
			echo "<br />Votre commande a bien été prise en compte";
			$Ajout="UPDATE FC_grp2_Paniers SET Valide=1, Creneau =$horaire WHERE Mail= '" .$_SESSION["mail"] ."';";
			mysql_query($Ajout);
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
