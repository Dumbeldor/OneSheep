<?php
/*
	Si le joueur est dans une ville
*/
if ($perso->joueurVille() == 1)
{
	if ($perso->localisationVillage() == "arene")
	{ 
		include "./lieu/arene.php";	
	}
		/*
		Commerce
		*/
	elseif ($perso->localisationVillage() == "commerce")
	{
		include "./lieu/commerce.php";		
	}

	/*
	Academie
	*/

	elseif ($perso->localisationVillage() == "academie")
	{
		include "./lieu/academie.php";
	}

	/*
	QG
	*/

	elseif ($perso->localisationVillage() == "qg")
	{
		include "./lieu/qg.php";
	}

	/*
	Entrée du village
	*/
	elseif ($perso->localisationVillage() == "entree")
	{
		include "./lieu/entree.php";
	}


}
else if ($perso->joueurVille() == 0) // dehors
{
	include "./lieu/map.php";
}

else
{
		echo "Vous êtes dans un endroit inconnue !";
}