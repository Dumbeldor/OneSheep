<?php

if (isset($_POST['creer']) && isset($_POST['nom']) && isset($_POST['village'])) // Si il veut créer son perso
{
	$perso = new Personnage(array(
		'PA' => 30,
		'heureStock' => time(),
		'nom' => $_POST['nom'],
		'argent' => 5,
		'village' => $_POST['village'],
		'forcePerso' => 4,
		'defense' => 2,
		'fuite' => 2,
		'nomArme' => "Baton en bois",
		'attaqueArme' => 2,
		'defenseArme' => 1,
		'nomArmure' => "Habit d'étudiant",
		'attaqueArmure' => 0,
		'defenseArmure' => 2,
  		'vie' => 100,
  		'magie' => 100,
  		'niveau' => 1,
  		'experience' => 0,
  		'x' => 0,
  		'y' => 0,
  		'xVille' => 1,
  		'yVille' => 1,
  		'joueurVille' => 1,
  		'tempsMission' => time()
		));
		$inventaire = new Inventaire(array(
		'itemId' => 1,
		'nom' => "Baton",
		'description' => "Un simple baton",
		'prix' => "5",
		'type' => "1",
		'attaque' => "5",
		'defense' => "2",
		'proprio' => $_POST['nom'],
		));
		$inventaire->setItemId(2);
		$inventaire->setNom("Armure en cuire");
		$inventaire->setDescription("Fait en peau de vache");
		$inventaire->setPrix(5);
		$inventaire->setType(2);
		$inventaire->setAttaque(1);
		$inventaire->setDefense(5);
		$inventaire->setProprio($_POST['nom']);
		$mapManager = new MapManager($db);
		$map = $mapManager->get($perso->x(), $perso->y());
		$_SESSION['map'] = $map;
	
	$_SESSION['perso'] = $perso;
	$_SESSION['inventaire'] = $inventaire;
	if (!$perso->nomValide())
	{
		$message = "Le nom est invalide !";
		unset($perso);
		
	}
	elseif($manager->exists($perso->nom()))
	{
		$message = "Le nom existe déjà";
		unset($perso);
		
	}
	else
	{
		$manager->add($perso);
		$inventaireManager->add($inventaire);

	}
}
elseif (isset($_POST['utiliser']) && isset($_POST['nom']))
{
	if ($manager->exists($_POST['nom'])) 
	{
		$perso = $manager->get($_POST['nom']);
		$_SESSION['perso'] = $perso;
		$inventaire = $inventaireManager->get($_POST['nom']);
		$_SESSION['inventaire'] = $inventaire;
		$mapManager = new MapManager($db);
		$map = $mapManager->get($perso->x(), $perso->y());
		$_SESSION['map'] = $map;
	}
	else
	{
		$message = "Ce personnage n'existe pas !";
	}
}