
<html>
	<head>
		<meta charset="UTF-8">
		<title> Connexion MKLoisirs</title>
	</head>
	
	<body>
	
		<?
		// on teste la déclaration de notre cookie
		//if (isset($_COOKIE['mail'])) :
		//	echo 'Bonjour '.$_COOKIE['mail'].' !';
		//else :
		?>
		
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
						
						
							$temps = 24*3600;
						
								setcookie ("mail", $mail, time() + $temps);
								
								echo $_COOKIE['mail'];

								// fonction nous permettant de faire des redirections


								// on effectue une redirection vers la page d'accueil
								/*if (headers_sent()){
											print('<meta http-equiv="refresh" content="0;URL=http://info.univ-lemans.fr/~spi2136/Projet-web_MKLoisirs/php/jeux.php">');
										}
								else {
											header("Location: $url");
										}
									
							}
							else {
								echo 'La variable du formulaire n'est pas déclarée.';
							}*/
						}
						
						
						
						
						else {
							echo"L'adresse mail et le mot de passe ne correspondent pas";
						}
					}
				}
				else echo "Toutes les cases du formulaire ne sont pas remplies <br/>";
			}
			
			
		//endif;
		?>
	</p>

		</form>	
	</body>
</html>

