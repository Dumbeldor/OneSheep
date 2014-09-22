<?php
if (isset($_GET['lieu']))
{
	if ($_GET['lieu'] == "commerce")
	{
		$perso->setXVille(1);
		$perso->setYVille(2);
	}
	elseif ($_GET['lieu'] == "arene")
	{
		$perso->setXVille(2);
		$perso->setYVille(1);
	}
	elseif ($_GET['lieu'] == "academie")
	{
		$perso->setXVille(1);
		$perso->setYVille(1);
	}
	elseif ($_GET['lieu'] == "qg")
	{
		$perso->setXVille(2);
		$perso->setYVille(2);
	}
	elseif ($_GET['lieu'] == "entree")
	{
		$perso->setXVille(3);
		$perso->setYVille(3);
	}
}
else{}