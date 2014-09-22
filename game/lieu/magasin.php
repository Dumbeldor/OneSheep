
<?php

	$inventaires = $inventaireManager->dansMagasin($perso);


	if (isset($_GET['choix']))
	{
		if ($_GET['choix'] == "arme")
		{
			?> <h1>Vous êtes dans le magasin d'arme</h1>
			<p>Voilà toute la list des armes disponible dans ce village<p> <?php

			$inventaires->afficherMagasin($_GET['choix']);
			
		}
		elseif ($_GET['choix'] == "armure")
		{
			?> <h1>Vous êtes dans le magasin d'armure</h1>
			<p>Voilà toute la list des armures disponible dans ce village<p> <?php

			$inventaires->afficherMagasin($_GET['choix']);
		}
		elseif ($_GET['choix'] == "potion")
		{
			?> <h1>Vous êtes dans le magasin de potion</h1>
			<p>Voilà toute la list des potion disponible dans ce village<p> <?php

			$inventaires->afficherMagasin($_GET['choix']);
		}
		else
		{
		}
	}

	else
	{
		?> <h1>Vous êtes au commerce</h1> 
		<p>Ici vous pouvez acheter du stuff, des potions, etc...</p>
		<p>Bon shopping !</p>
		<a href="?choix=arme">Magasin d'arme</a>
		<a href="?choix=armure">Magasin d'armure</a>
		<a href="?choix=potion">potion</a> <?php
	}

	if(isset($_GET['achat']))
	{
		if (is_numeric($_GET['achat'])) 
		{
			 $inventaires->achat($_GET['achat'], $perso, $inventaireManager, $inventaire);
		}
	}
}