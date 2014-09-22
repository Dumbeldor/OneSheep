<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "include/session.php";

if ($perso->vivant())
{
	if (isset($_GET['frapper']))
	{
		if (!isset($perso))
		{
			$message = "Identifiez vous !";
		}
		else
		{
			if (!$manager->exists((int) $_GET['frapper']))
			{
				$message = "Le perso que vous voulez frappez n'existe pas !...";
			}
			else
			{
				$persoFrapper = $manager->get((int) $_GET['frapper']);

				if ($perso->vivant() && $persoFrapper->vivant())
				{
					//Script quand les joueurs sont encore vivant !!
					if (isset($_POST['choix']))
					{
						if ($_POST['choix'] == "attaquer")
						{
							$retour = $perso->frapper($persoFrapper);
							$bot = $persoFrapper->botCombat($perso);

							switch ($retour) {
								case Personnage::CEST_MOI :
								$message = "Pourquoi vous vous frappez ?!";
								break;
				
							case Personnage::PERSONNAGE_FRAPPE :
								$message = "Vous lui avez infligé " . $perso->degats($persoFrapper) . " de dégats !";
								$manager->update($perso);
								$manager->update($persoFrapper);
								break;
							case Personnage::PERSONNAGE_TUE :
								$message = "Vous avez gagné le combat ! </br>".'<a href="index.php">Retour</a>';
								$manager->update($perso);
								$manager->update($persoFrapper);
								break;
							}
							switch ($bot) {
								case Personnage::CEST_MOI :
								$message2 = "Pourquoi vous vous frappez ?!";
								break;
				
							case Personnage::PERSONNAGE_FRAPPE :
								$message2 = $persoFrapper->nom() . " vous a infligé " . $persoFrapper->degats($perso) . " de dégats !";
								$manager->update($perso);
								$manager->update($persoFrapper);
								break;
							case Personnage::PERSONNAGE_TUE :
								$message = "Il vous a tué ! </br>".'<a href="index.php">Retour</a>';
								$manager->update($perso);
								$manager->update($persoFrapper);
								break;
							}

						}
					}
				}
				if (!$perso->vivant()) 
				{
					$perso->actionPA();
					$manager->update($perso);
					$manager->update($persoFrapper);
					echo $message;
				}
				elseif(!$persoFrapper->vivant())
				{
					$perso->actionPA();
					$manager->update($perso);
					$manager->update($persoFrapper);
					echo $message;
				}
				else {
					?><h1>Combat !</h1> <?php
				echo '<fieldset>';
				echo $persoFrapper->combatInfo(), '</fieldset>';
				echo '</br></br>';
				if (isset($message))
				{
					echo $message;
					echo $message2;
				}
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
			</form> <?php
				}
			}
		}
	}
}