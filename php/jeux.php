<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Ludotheque du Mans MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");	?>
<!-- Partie formulaire pour la recherche de jeux -->
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

			Disponible uniquement : <br />
			<input type="radio" name="dispo" value=">0" /> Oui<br/>
			<input type="radio" name="dispo" value=">=0" checked="checked" /> Non<br/>

			<input type="submit" value="Valider" name="valider"/>
		</form>
	</div>

	<!-- Affichage des jeux -->
	<div id="games">
		<?php
			if($retour) {
				mysql_set_charset('utf8', $LienBase);
				/* Récupération de la recherche age*/
				$t_age=array();
				$cond_age="0";
				$sep=",";
				/* Si on arrive sur la page a partir du menu on a init à 1 donc on affiche tout les jeux */
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

				/* Récupération de la recherche disponiblité*/
				if (isset($_GET["init"]) || strcmp($_POST["dispo"],"oui") == 1) {
					$cond_dispo='NbJeuxDispos>=0';
				}
				else {
					$cond_dispo='NbJeuxDispos>0';
				}

				/*Requete SQL en fonction de la recherche*/
				$Requete="SELECT * FROM FC_grp2_Jeux NATURAL JOIN FC_grp2_JeuxLudotheque WHERE Ages IN($cond_age) AND Lieu IN($cond_lieu) AND " .$cond_dispo .";";
				$Reponse=mysql_query($Requete);
				echo "<br/><table>";
				// Boucle pour l'affichage du code
				$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
				while($res!=NULL) {
					$id=$res['ID'];
					$dispo=$res['NbJeuxDispos'];
					echo"	<tr>	<td>
								<ul>	<li class='space'>" .$res['Jeux'] ."\n" ."</li>
									<li class='space'>" .$res['Ages'] ." ans et plus\n" ."</li>
									<li class='space'>" .$res['TypeJeux'] ."\n" ."</li>
									<li class='space'> Jeux d'" .$res['Lieu'] ."\n" ."</li>
									<li class='space'> Il y a " .$dispo ." jeux disponibles sur les " .$res['NbJeux']
									." jeux de la ludothèque. </li> </ul>";
									/* On propose un bouton ajouter au panier */
									echo "<form method='post' action='jeux.php?init=1'>
										<input type='submit' value='Ajouter au panier' name='$id'/>
									</form>";

									/* Traitement du bouton ajouter au panier*/
									if(isset($_POST["$id"])){
										/* On vérifie que l'utilisateur est connecté */
										if(!isset($_SESSION['mail'])) {
											echo "Vous devez être connecté pour commander un jeu";
										}
										else {
											/* On regarde le nombre d'articles dnas le panier */
											$compte="SELECT COUNT(*) AS nbre FROM FC_grp2_Paniers WHERE Mail ='" .$_SESSION['mail'] ."';";
											$rep=mysql_query($compte);
											$nbre=mysql_fetch_array($rep, MYSQL_ASSOC);

											/*On regarde les ID présent dans le panier pour savoir si ils sont déjà dans le panier*/
											$present="SELECT ID FROM FC_grp2_Paniers WHERE ID = '" .$id ."' AND Valide=0;";
											$pres=mysql_query($present);
											$pre=mysql_fetch_array($pres, MYSQL_ASSOC);

											/*On vérifie si on a une commande en cours*/
											$commande="SELECT COUNT(*) AS nbre FROM FC_grp2_Paniers WHERE Mail ='" .$_SESSION['mail'] ."' AND Valide=1;";
											$comm=mysql_query($commande);
											$co=mysql_fetch_array($comm, MYSQL_ASSOC);

											if($nbre['nbre']>=3) {
												echo "Vous avez atteint la limite du nombre de jeux pouvants êtres commandés <br />";
											}
											elseif($pre) {
												echo "Ce jeu est déjà présent dans votre panier";
											}
											elseif($dispo == 0) {
												echo "Ce jeu n'est pas disponible";
											}
											elseif($co['nbre']>0){
												echo "Vous avez déjà une commande en cours";
											}
											else {
												$Insertion= "INSERT INTO FC_grp2_Paniers (ID,Mail,Creneau)
																		VALUES ('".$id."','".$_SESSION['mail']."','0');";
												mysql_query($Insertion);
												echo "L'article a bien été ajouté au panier";
											}
										}
									}
									/* Image relative au jeu */
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
</html>
