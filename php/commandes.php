<?php session_start(); ?>

<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Commandes MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");
  echo "<div>";
      if(isset($_SESSION['mail']) && $retour) {
        mysql_set_charset('utf8', $LienBase);
        /*Requete SQL pour l'affichage de tout le panier*/
        $Requete="SELECT * FROM ((FC_grp2_Jeux NATURAL JOIN FC_grp2_JeuxLudotheque) NATURAL JOIN FC_grp2_Paniers)
                  NATURAL JOIN FC_grp2_Users WHERE Mail='" .$_SESSION["mail"] ."' AND Valide=1;";
        $Reponse=mysql_query($Requete);
        $res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
        if(!$res) {
          echo "<h2>Vous n'avez pas de commande d'effectuée </h2>";
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
                  ." jeux de la ludothèque. </li><br /></ul>";

                  echo "</td>
                  <td> <img src='./../image/" .$res['image'] ."' alt='" .$res['Jeux'] ."' /> </td>
                  </tr>";
            $res=mysql_fetch_array($Reponse, MYSQL_ASSOC);
          }
          echo "</table><br />";
          $Requete="SELECT DISTINCT Creneau FROM FC_grp2_Paniers WHERE Mail='" .$_SESSION["mail"] ."';";
          $Reponse=mysql_query($Requete);
          $Horaire=mysql_fetch_array($Reponse, MYSQL_ASSOC);
          echo "L'Horaire que vous avez choisis pour votre commande est : " .$Horaire['Creneau'] ."h";

          echo "<form method='post' action ='commandes.php'>
            <input type='submit' value='Annuler la commande' name='cancel'/>
          </form>";

          if(isset($_POST["cancel"])){
            $Incremente="UPDATE FC_grp2_JeuxLudotheque SET NbJeuxDispos=NbJeuxDispos+1 WHERE
      								ID IN (SELECT ID FROM FC_grp2_Paniers WHERE Mail= '" .$_SESSION["mail"] ."' AND Valide=1);";
      			mysql_query($Incremente);
            $Suppression="DELETE FROM FC_grp2_Paniers WHERE Mail= '" .$_SESSION["mail"] ."' AND Valide=1;";
            mysql_query($Suppression);
            echo "Votre commande à bien été annulée";
            header("Refresh:2");
          }
        }
      }
      else
        echo "<h2>Vous n'êtes pas connecté</h2>";
        ?>
    </div>
</body>
