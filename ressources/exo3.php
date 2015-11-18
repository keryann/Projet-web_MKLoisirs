<head>
    <title> Hello </title>
</head>
<body>
<p>
<?php
	if(isset($_POST["valider"])) {
		if(!empty($_POST["mail"])&&!empty($_POST["password"])) {
			$mail = $_POST["mail"];
			$password = $_POST["password"];
			echo "Connexion réussie";
		}
		else echo "Toutes les cases du formulaire ne sont pas remplies";
	}
?>
</p>
</body>
