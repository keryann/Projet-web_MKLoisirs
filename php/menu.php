<h1> MKLoisirs </h1>

<nav> <!-- Pour le cas d'une navigation entre page html -->
	<div>
	<ul id='navigation'> <!-- Menu principal -->
		<li><a href='./index.php' title='Accueil'>Accueil</a> </li>
		<li><a href='./jeux.php?init=1' title='Les jeux'>Les jeux</a></li>
		<li><a href='./panier.php' title='Mon panier'>Mon Panier</a> </li>
		<li><a href='./connexion.php' title='connexion'>Connexion</a> </li>
	</ul>
	</div>
</nav>

<div>
	<?php
        include("./../php/connexionbase.php");
		error_reporting(E_ALL ^ E_DEPRECATED); //Pour palier aux erreurs provoqués par l'utilisation de wamp
        mysql_set_charset('utf8', $LienBase);
        $Requete="SELECT Nom,Prenom FROM FC_grp2_Users WHERE Mail='" .$_SESSION["mail"]."';";
        $Reponse=mysql_query($Requete);
        $UsrBase=mysql_fetch_array($Reponse, MYSQL_ASSOC);
        echo "Vous êtes connecté en tant que :<br />".$UsrBase['Prenom']." ".$UsrBase['Nom'];

	 ?>
</div>
