<?php
function chargerClasse($classe)
{
  require 'class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
try {
    $db = new PDO('mysql:host=localhost;dbname=weblobsd_onesheep', 'weblobsd_oneshee', 'mZ[+D6H$@+;0');
	$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$manager = new PersonnageManager($db);
$inventaireManager = new InventaireManager($db);

session_start();

if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
{
  $perso = $_SESSION['perso'];
}
if (isset($_SESSION['inventaire']))
{
  $inventaire = $_SESSION['inventaire'];
}
if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['perso'] = $perso;
  $_SESSION['inventaire'] = $inventaire;
}
if (isset($_GET['deconnexion']))
{
	$manager->update($perso);
	$inventaireManager->update($inventaire);
  session_destroy();
  header('Location: .');
  exit();
}
 ?>