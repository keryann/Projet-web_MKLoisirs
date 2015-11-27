<?php session_start(); ?>

<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
</head>

  <body>
	<?php include ("./menu.php");?>
		<div> <?php
				$User;
				include("connexionbase.php");
				if($retour) {
					mysql_set_charset('utf8', $LienBase);
					/*Requete SQL en fonction de la recherche*/
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
									<ul>	<li>" .$res['Jeux'] ."\n" ."</li><br/>
										<li>" .$res['Ages'] ." ans et plus\n" ."</li><br />
										<li>" .$res['TypeJeux'] ."\n" ."</li> <br />
										<li> Jeux d'" .$res['Lieu'] ."\n" ."</li> <br />
										<li> Il y a " .$res['NbJeuxDispos'] ." jeux disponibles sur les " .$res['NbJeux']
										." jeux de la ludothèque. </li><br /></ul>
										<form method='post' action ='panier.php'>
											<input type='submit' value='supprimer du panier' name='$id'/>
										</form>";
										if(isset($_POST["$id"])){
											$Suppression="DELETE * FROM FC_grp2_Paniers WHERE ID='" .$id ."' AND Mail= '" .$_SESSION["mail"] ."';";
											mysql_query($Suppression);
											header("Refresh:0");
										}

										echo "</td>
										<td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' /> </td>
										</tr>";
							$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
						}
						echo "</table><br />

						<form method='post' action ='panier.php'>
							<input type='submit' value='Vider le panier' name='vider'/>
						</form>";

						if(isset($_POST["vider"])){
							$Suppression="DELETE FROM FC_grp2_Paniers WHERE Mail= '" .$_SESSION["mail"] ."';";
							mysql_query($Suppression);
							header("Refresh:0");
						}
						echo"<form method='post' action ='panier.php'>
							<input type='submit' value='valider panier' name='valider'/>
						</form>";

						if(isset($_POST["valider"])){
							$Ajout="UPDATE FC_grp2_Paniers SET Valide=1 WHERE Mail= '" .$_SESSION["mail"] ."';";
							mysql_query($Ajout);
							header("Refresh:0");
						}
					}
				}?>
			</div>
  </body>
