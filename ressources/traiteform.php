
<html>
	<head>
		<meta charset="UTF-8">
		<title>Inscription MKLoisirs</title>
	</head>
	<body>
		<h1> Inscriptions </h1>
		<form method="post" action="traiteform.php">
			Nom : <input name="nom" size="25px"/> <br /> <br />
			Prénom : <input name="prenom" /><br /><br />
			Adresse électronique : <input name="mail" /><br /><br />
			Mot de passe : <input type="password" name="password" /><br /><br />
			Confirmation du Mot de Passe : <input type="password" name="passwordconfirm" /><br /><br />
			<input type="submit" value="Valider" name = "valider" />
			</form>
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
				
					include("./../php/connexionbase.php");

					if($retour) {
						
						mysql_set_charset('utf8', $LienBase);			
						$Requete="SELECT Mail FROM FC_grp2_Users WHERE Mail='" .$mail."';";
						$Reponse=mysql_query($Requete);
						$UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);
						
						if (isset($_POST["valider"]) && $UsrBase["Mail"] != NULL){
							echo"cette adresse mail à deja été utilisé";
						}
						else{
							echo "Bienvenu ".$prenom." ".$nom. " !<br/>" ;
							
							$Requete="INSERT INTO FC_grp2_Users (Nom,Prenom,Mail,Password) VALUES('".$nom."','".$prenom."','".$mail."','".$password."');";
							echo $Requete;
						}
						
					}

					
				}
				
				else echo "La confirmation du mot de passe ne correspond pas au mot de passe";
			}
			
			else echo "Toutes les cases du formulaire ne sont pas remplies";
		}	
		?>	
		</p>
	</body>
</html>
