<head>
    <title> Hello </title>
</head>
<body>
<p>
<?php
	if(isset($_POST["valider"])) {
		if(!empty($_POST["nom"])&&!empty($_POST["prenom"])&&!empty($_POST["mail"])&&!empty($_POST["password"])) {
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$mail = $_POST["mail"];
			$password = $_POST["password"];

			echo "Bonjour ".$prenom." ".$nom. " !<br/>" ;
		}
		else echo "Toutes les cases du formulaire ne sont pas remplies";
	}
?>
</p>
</body>
