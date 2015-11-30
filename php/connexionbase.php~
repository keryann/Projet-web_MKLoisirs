<?php
error_reporting(E_ALL ^ E_DEPRECATED); //Pour palier aux erreurs provoqués par l'utilisation de wamp
/*paramètres de connexion à la base de données*/
/*Connexion au PhpMyAdmin local*/
$Base="jeux";
$Serveur="localhost";
$Utilisateur="root";
$MotDePasse="";

//connexion au serveur où se trouve la base de données
$LienBase=mysql_connect($Serveur,$Utilisateur,$MotDePasse);

//sélection de la base de données au niveau du serveur
$retour=mysql_select_db($Base,$LienBase);

/*Connexion au PhpMyAdmin de la fac si on est pas en local*/
if(!$retour){
  //echo "Connexion à la base impossible";
  $Base="info201a";
  $Serveur="info.univ-lemans.fr";
  $Utilisateur="info201a_user";
  $MotDePasse="com72";

  //connexion au serveur où se trouve la base de données
  $LienBase=mysql_connect($Serveur,$Utilisateur,$MotDePasse);

  //sélection de la base de données au niveau du serveur
  $retour=mysql_select_db($Base,$LienBase);

  //affichage d’un message d’erreur si la connexion a été refusée
  if (!$retour){
    echo "Connexion à la base impossible";
  }
}
?>
