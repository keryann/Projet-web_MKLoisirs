<!-- http://www.lephpfacile.com/cours/17-les-cookies  .$_COOKIE['pseudo'].-->
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
</head>

<body>
	<?php include ("menu.php");	?>

<!-- Partie recherche de jeux -->
	<div id="search">
		<form method="post" action ="jeux.php">
			<br /><br /><h3>Recherche :</h3><br />
			Age : <br/>

			<input type='checkbox' name='age[]' value='4' checked /> 4 ans et plus<br />
			<input type='checkbox' name='age[]' value='8' checked /> 8 ans et plus<br/>
			<input type='checkbox' name='age[]' value='12' checked /> 12 ans et plus<br/><br/>

			Lieu : <br/>
			<input type="checkbox" name="lieu[]" value="interieur" checked="checked" /> Intérieur<br/>
			<input type="checkbox" name="lieu[]" value="exterieur" checked="checked" /> Extérieur<br/><br />

			<input type="submit" value="Valider" name="valider"/>
		</form>
	</div>

	<!-- Affichage des jeux -->
	<div id="games">
		<?php include("connexionbase.php");
			if($retour) {
				mysql_set_charset('utf8', $LienBase);
				/* Récupération de la recherche age*/
				$t_age=array();
				$cond_age="0";
				$sep=",";

				if (isset($_GET["init"])) {
					$cond_age="4,8,12";
				}

				if (isset($_POST["age"])) {
					  $t_age=$_POST["age"];
						foreach($t_age as $v) {
							$cond_age=$cond_age .$sep .$v;
						}
				}

				/* Récupération de la recherche lieu*/
				$t_lieu=array();
				$cond_lieu="'other'";
				$sep=",";

				if (isset($_GET["init"])) {
					$cond_lieu="'interieur', 'exterieur'";
				}

				if (isset($_POST["lieu"])) {
					  $t_lieu=$_POST["lieu"];
						foreach($t_lieu as $v) {
							$cond_lieu=$cond_lieu .$sep ."'".$v ."'";
						}
				}


				/*Requete SQL en fonction de la recherche*/
				$Requete="SELECT * FROM FC_grp2_Jeux WHERE Ages IN($cond_age) AND Lieu IN($cond_lieu);";
				$Reponse=mysql_query($Requete);
				echo "<br/><table>";
				// Boucle pour l'affichage du code
				$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				while($res!=NULL) {
					echo"	<tr>	<td>
								<ul>	<li>" .$res['Nom'] ."\n" ."</li><br/>
									<li>" .$res['Ages'] ."\n" ."</li><br/>
									<li>" .$res['TypeJeux'] ."\n" ."</li> <br/>
									<li> Jeux d'" .$res['Lieu'] ."\n" ."</li> <br/></ul>

									<input type='submit' value='ajouter au panier' name='panier'/>";
									if(isset($_POST["panier"])){
										//$Requete="INSERT IN"
										
									}

									echo "</td>
									<td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Nom'] ."' /> </td>
					</tr>";
					$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				}
				echo "</table>";
		}
		?>
	</div>

</body>
