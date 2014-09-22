<?php include "include/session.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <?php

if ($perso->vivant())
{
if (isset($_GET['frapper']) && $perso->vivant())
{
	if (!isset($perso))
	{
		$message = "Merci de vous identifiez !";
	}
	else
	{
		if (!$manager->exists((int) $_GET['frapper']))
		{
			$message = "Le personnage que vous voulez frapper n'existe pas !";
		}
		else
		{
			$persoAFrapper = $manager->get((int) $_GET['frapper']);
			if (!$persoAFrapper->vivant())
			{

			}
			else
			{
			$retour = $perso->frapper($persoAFrapper);
			$bot = $persoAFrapper->botCombat($perso);
	if ($_POST['choix'] == "attaquer" && $persoAFrapper->vivant()) {
		switch ($retour) {
				case Personnage::CEST_MOI :
					$message = "Pourquoi vous vous frappez ?!";
					break;
				
				case Personnage::PERSONNAGE_FRAPPE :
					$message = "Vous lui avez infligé " . $perso->degats($persoAFrapper) . " de dégats !";
					$manager->update($perso);
					$manager->update($persoAFrapper);
					break;
				case Personnage::PERSONNAGE_TUE :
					$message = "Vous avez tuez l'autre perso ! </br>".'<a href="index.php">Retour</a>';
					$manager->update($perso);
					$manager->update($persoAFrapper);
					break;
			}		
				switch ($bot) {
				case Personnage::CEST_MOI :
					$message2 = "Pourquoi vous vous frappez ?!";
					break;
				
				case Personnage::PERSONNAGE_FRAPPE :
					$message2 = $persoAFrapper->nom() . " vous as infligé " . $persoAFrapper->degats($perso) . " de dégats !";
					$manager->update($perso);
					$manager->update($persoAFrapper);
					break;
				case Personnage::PERSONNAGE_TUE :
					$message2 = "Vous êtes mort !</br>".'<a href="index.php">Retour</a>';
					$manager->update($perso);
					$manager->update($persoAFrapper);
					break;
			}		
	}
}
		}
	}
}

			if (isset($message) && $perso->vivant() && $persoAFrapper->vivant())
			{
				echo $message, '</br>';
				echo $message2;
			}
			elseif (!$perso->vivant())
			{
				echo "Vous êtes mort !</br>".'<a href="index.php">Retour</a>';
			}
			elseif (!$persoAFrapper->vivant())
			{
				echo "Vous avez tuez l'autre perso ! </br>".'<a href="index.php">Retour</a>';
				echo $persoAFrapper->vivant();
			}
			else{}
			if ($perso->vivant() && $persoAFrapper->vivant())
			{
				?><h1>Combat !</h1> <?php
				echo '<fieldset>';
				echo $persoAFrapper->combatInfo(), '</fieldset>';
				echo '</br></br>';
				echo '</br></br>';
				echo '<fieldset>', $perso->combatInfo(), '</fieldset>';
				$_SESSION['combat'] = 1; //Sécurité !

				?> <form method="post" action="combat.php?frapper=<?php echo $_GET['frapper']; ?>">
   				<p>
       			<label for="choix">Que voulez vous faire ?</label><br />
       			<select name="choix" id="choix">
           			<option value="attaquer">Attaquer</option>
           			<option value="defendre">Défendre</option>
           			<option value="esquiver">Esquiver</option>
           			<option value="fuire">Fuire</option>
        			</select>
   			</p>
   			<input type="submit" value="Go" name="combat" />
			</form>
			<?php
			}
			else {}
			}
else { ?> <h1>Vous êtes mort !</h1> 
			<a href="index.php?revivre=1">Revivre</a><?php }