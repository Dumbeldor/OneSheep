<?php
include "include/session.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../design.css" type="text/css" media="all">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>OneSheep</title>
</head>
<body>
<header>
	<a href="index.php?lieu=academie" title="Accueil du site"><img src="img/logo.png" width="617" height="200" alt="logo.png"></a>
</header>
<div id="header"></div>
<div id="InnerWrap">
	<div id="wrap">
	<nav>
		<?php 
		echo '<a href="?deconnexion=1">Déconnexion</a><br />';
		include "include/menu.php";
		?>
	</nav>
	<section>
<?php
echo $perso->combat();
if (isset($perso)) // Si la session avec le perso est activé ! 
{
	var_dump($_SESSION['perso']);
	if ($perso->enVie())
	{
		if(!$perso->enCombat())
		{
			include "include/deplacement.php";
			include "include/localisation.php";
			include "include/action.php";
			$perso->ajoutPA();
			echo '<p>', $perso->info(), '</p>';
		}
		else {
			echo "<h2>Script anti triche...Vous avez quitté un combat en cours... vous êtes donc mort !";
			$perso->setVie(0);
			$perso->setCombat(0);
		}
	}
	else {
	}
}
if (isset($message)) // Si il y a un message à afficher !
{
	echo '<p>', $message, '</p>';
} else {}
?>
	</section>
	</div>
	<footer></footer>
</div>