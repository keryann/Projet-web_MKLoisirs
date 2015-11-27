<?php session_start(); ?>

<head> <!-- -->

	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./../css/style.css" media="all" />

	<title> Panier MKLoisirs</title>
</head>

<body>
	<?php include ("./menu.php");?>

<?php
if(isset($_POST["valider"])){
  $Ajout="UPDATE FC_grp2_Paniers SET Valide=1 WHERE Mail= '" .$_SESSION["mail"] ."';";
  mysql_query($Ajout);
  header("Refresh:0");
}
?>

</body>
