<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
  </head>

  <body>
	<?php include ("menu.php");?>
		<div> <?php
				$User;
				include("connexionbase.php");
				if($retour) {
					mysql_set_charset('utf8', $LienBase);
					/*Requete SQL en fonction de la recherche*/
					$Requete="SELECT * FROM (FC_grp2_Jeux NATURAL JOIN FC_grp2_Paniers) NATURAL JOIN FC_grp2_Users WHERE Mail='keryannbussereau@gmail.com';";
					$Reponse=mysql_query($Requete);
					if(!$Reponse) {
						echo "Le panier est vide";
					}
					else {
						echo "<br/><table>";
						// Boucle pour l'affichage du code
						$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
						while($res!=NULL) {
							echo"	<tr>	<td>
									<ul>	<li>" .$res['Jeux'] ."\n" ."</li><br/>
										<li>" .$res['Ages'] ."\n" ."</li><br/>
										<li>" .$res['TypeJeux'] ."\n" ."</li> <br/>
										<li> Jeux d'" .$res['Lieu'] ."\n" ."</li> <br/></ul>

										<input type='submit' value='supprimer du panier' name='videpanier'/>";
										if(isset($_POST["videpanier"])){

										}

										echo "</td>
										<td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' /> </td>
										</tr>";
							$res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
						}
						echo "</table>";
					}
				}?>
			</div>
  </body>
