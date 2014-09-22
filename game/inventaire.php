<?php
include "include/session.php";
?>
<html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>OneSheep</title>
</head>
<body>
<?php
if (isset($message)) // Si il y a un message à afficher !
{
	echo '<p>', $message, '</p>';
} else {}

if (isset($perso)) // Si la session avec le perso est activé ! 
{
	$perso->ajoutPA();
	echo '<p>', $perso->info(), '</p>';
	echo '<p><a href="?deconnexion=1">Déconnexion</a></p>';

	?><h1>Inventaire !</h1></br><?php


	$inventaire->afficherInventaire();

	if (isset($message)) 
	{
		?><h1><?php echo $message;?></h1><?php
	}

	if (isset($_GET['vendre'])) 
  	{
  		if (is_numeric($_GET['vendre']))
  		{
  			$inventaire->vente($_GET['vendre'], $perso, $inventaireManager);
  			$manager->update($perso);
  		}
  		else {}
  	}

  	if (isset($_GET['equiper']))
  	{
  		if (is_numeric($_GET['equiper']))
  		{
  			$inventaire->equiper($_GET['equiper'], $perso, $inventaireManager);
  			$manager->update($perso);
  		}
  	}

}