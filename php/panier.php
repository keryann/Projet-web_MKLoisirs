<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
</head>

  <body>
	<?php include ("./menu.php");
		echo "<div>";
				/* On vérifie qu'on est connecté */
				if(isset($_SESSION['mail']) && $retour) {
					mysql_set_charset('utf8', $LienBase);
					/*Requete SQL pour l'affichage de tout le panier*/
					$Requete="SELECT * FROM ((FC_grp2_Jeux NATURAL JOIN FC_grp2_JeuxLudotheque) NATURAL JOIN FC_grp2_Paniers)
										NATURAL JOIN FC_grp2_Users WHERE Mail='" .$_SESSION["mail"] ."' AND Valide=0;";
					$Reponse=mysql_query($Requete);
					$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
					if(!$res) {
						echo "<h2>Votre panier est vide </h2>";
					}
					else {
						echo "<br/><table>";
						// Boucle pour l'affichage du code
						while($res!=NULL) {
							$id=$res['ID'];
							// On affiche tout les jeux présents dans le panier
							echo"	<tr>	<td>
									<ul>	<li class='space'>" .$res['Jeux'] ."\n" ."</li>
										<li class='space'>" .$res['Ages'] ." ans et plus\n" ."</li>
										<li class='space'>" .$res['TypeJeux'] ."\n" ."</li>
										<li class='space'> Jeux d'" .$res['Lieu'] ."\n" ."</li>
										<li class='space'> Il y a " .$res['NbJeuxDispos'] ." jeux disponibles sur les " .$res['NbJeux']
										." jeux de la ludothèque. </li></ul>";
										/* On affiche un bouton pour supprimer l'élément du panier*/
										echo "<form method='post' action ='panier.php'>
											<input type='submit' value='Supprimer du panier' name='$id'/>
										</form>";
										/* Si l'utilisateur clique sur le bouton on enlève de la table panier */
										if(isset($_POST["$id"])){
											$Suppression="DELETE FROM FC_grp2_Paniers WHERE ID='" .$id ."' AND Mail= '" .$_SESSION['mail'] ."';";
											mysql_query($Suppression);
											header("Refresh:0");
										}

										echo "</td>
										<td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' /> </td>
										</tr>";
							$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
						}
						echo "</table><br />";
						/* On affiche un bouton en fin de panier permettant de vider le panier */
						echo "<form id='gauche' method='post' action ='panier.php'>
							<input type='submit' value='Vider le panier' name='vider'/>
						</form>";
						/* Si l'utilisateur clique sur le bouton vider le panier on supprime tout les éléments du panier
						correspondants à la personne connectée */
						if(isset($_POST["vider"])){
							$Suppression="DELETE FROM FC_grp2_Paniers WHERE Mail= '" .$_SESSION["mail"] ."';";
							mysql_query($Suppression);
							header("Refresh:0");
						}
						/* On met un bouton permettant de valider le panier qui renvoie vers une page qui permettra la validation */
						echo"<form id='droite' method='post' action ='validepanier.php'>
									<input type='submit' value='Valider panier' name='valider'/>
								</form>";
					}
				}
				else
					echo "<h2>Vous n'êtes pas connecté</h2>"
					?>
			</div>
  </body>
</html>
