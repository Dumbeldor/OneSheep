<?php
if (isset($_GET['action']))
{
	if($_GET['action'] == "sortir")
	{
		$perso->setJoueurVille(0);
	}
	else if($_GET['action'] == "passer_examen")
	{
		$xps = rand(3, 7);
		$message = 'Vous avez gagné '.$xps.' xp grâce à l\'examen !';
		$xp = $perso->experience() + $xps;
		$perso->setExperience($xp);
	}
}