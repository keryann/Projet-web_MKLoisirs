<?php session_start(); ?>

<!-- http://www.lephpfacile.com/cours/17-les-cookies  .$_COOKIE['pseudo'].-->
<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");	?>

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
				$Requete="SELECT * FROM FC_grp2_Jeux NATURAL JOIN FC_grp2_JeuxLudotheque WHERE Ages IN($cond_age) AND Lieu IN($cond_lieu);";
				$Reponse=mysql_query($Requete);
				echo "<br/><table>";
				// Boucle pour l'affichage du code
				$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				while($res!=NULL) {
					$id=$res['ID'];
					echo"	<tr>	<td>
								<ul>	<li>" .$res['Jeux'] ."\n" ."</li><br/>
									<li>" .$res['Ages'] ." ans et plus\n" ."</li><br/>
									<li>" .$res['TypeJeux'] ."\n" ."</li> <br/>
									<li> Jeux d'" .$res['Lieu'] ."\n" ."</li> <br/>
									<li> Il y a " .$res['NbJeuxDispos'] ." jeux disponibles sur les " .$res['NbJeux']
									." jeux de la ludothèque. </li><br /></ul>

									<form method='post' action='jeux.php?init=1'>
										<input type='submit' value='ajouter au panier' name='$id'/>
									</form>";

									if(isset($_POST["$id"])){
										$compte="SELECT COUNT(*) AS nbre FROM FC_grp2_Paniers WHERE Mail ='" .$_SESSION['mail'] ."';";
										$rep=mysql_query($compte);
										$nbre=mysql_fetch_array($rep, MYSQL_ASSOC);

										$present="SELECT ID FROM FC_grp2_Paniers WHERE ID = '" .$id ."';";
										$pres=mysql_query($present);
										$pre=mysql_fetch_array($pres, MYSQL_ASSOC);

										if($nbre['nbre']>=3) {
											echo "Vous avez atteint la limite du nombre de jeux pouvants êtres commandés <br />";
										}
										elseif ($pre) {
											echo "Ce jeu est déjà présent dans votre panier";
										}
										else {
											$Insertion= "INSERT INTO FC_grp2_Paniers (ID,Mail,Creneau)
																	VALUES ('".$id."','".$_SESSION['mail']."','0');";
											mysql_query($Insertion);
										}
									}

									echo "</td>
									<td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' /> </td>
									</tr>";
					$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				}
				echo "</table>";
		}
		?>
	</div>

</body>
