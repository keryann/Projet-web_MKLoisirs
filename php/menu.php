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

<div id='connecte'>
	<?php
		error_reporting(E_ALL ^ E_DEPRECATED); //Pour palier aux erreurs provoqués par l'utilisation de wamp
		/*$Req="SELECT * FROM FC_grp2_Users WHERE Mail='" .$_SESSION["mail"] ."';";
		$connexion=mysql_query($Req);
		$co=mysql_fetch_array($connexion, MYSQL_ASSOC);*/
		echo "Vous êtes connectés en tant que :<br/>" .$_SESSION['mail']; //.$co['Nom'] ." " .$co['Prenom'];
	 ?>
</div>
