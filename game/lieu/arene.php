<a href="?lieu=commerce">Commerce</a>
		<h1>Vous êtes à l'arène du village</h1>
			<fieldset>
      		<legend>Qui frapper ?</legend>
      		<p>
		<?php
		$persos = $manager->getList($perso->nom());

		if (empty($persos))
		{
  			echo 'Personne à frapper !';
		}

		else
		{
  			foreach ($persos as $unPerso)
  			{
    			echo '<a href="combat.php?frapper=', $unPerso->id(), '">', htmlspecialchars($unPerso->nom()), '</a> (Vie : ', $unPerso->vie(), ')<br />';
  			}
		}
		?>
      	</p>
    	</fieldset> 