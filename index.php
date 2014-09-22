<?php
include "include/session.php";
include "connection.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>OneSheep</title>
	<link href="design.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

	<header>
		<a href="index.php" title="Accueil du site"><img src="img/logo.png" width="617" height="200" alt="logo.png"></a>
	</header>
	<?php
if (isset($message)) // On a un message à afficher ?
{
  echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
} else {}
if (isset($perso)) {
	header('Location: game/index.php');
}
else
{
?>
	<div id="wrapper">
	<div id="connex">
	<h1>Connexion / Inscription à OneSheep</h1>
		<form action="" method="post">
		  <p>
			Nom de votre personnage :<br /><input type="text" name="nom" maxlength="50" class="inputConn"><br /><br />
			Nom de votre village :<br /><input type="text" name="village" maxlength="50" class="inputConn">
			<div id="connex_table">
				<div id="connex-left">
					<input type="submit" value="Créer ce personnage" name="creer" class="submit">
				</div>
				<div id="connex-right">
					<input type="submit" value="Utiliser ce personnage" name="utiliser" class="submit">
				</div>
			</div>
		  </p>
		</form>
	</div>
	</div>

<?php }
 ?>
</body>