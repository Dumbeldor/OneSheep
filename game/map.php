<?php
        if(isset($_POST['deplacement'])) {
                $deplacement = explode('|', $_POST['deplacement']); // On sépare les deux valeurs du déplacement. Ici On aura $deplacement['0'] qui contiendra la valeur du déplacement horizontalement et $deplacement ['1'] celles du déplacement vertical.
                
                $recup = mysql_query("SELECT x,y FROM personnages WHERE nom='$perso->nom()'") or die(mysql_error());

                $fetch = mysql_fetch_assoc($recup);
                
                $valX = $deplacement['0']; // On utilise des noms de variable plus clairs.
                $valY = $deplacement['1'];
                
                $newX = $valX + $fetch['posx']; // On calcule les hypothétiques nouvelles coordonnées
                $newY = $valY + $fetch['posy'];
                
                $verif = mysql_query("SELECT nom,x,y FROM personnages WHERE x='$newX' AND y='$newY'") or die(mysql_error()); // Recherche des personnages à la case où le joueur souhaite aller.
                                                
                                
                        if(mysql_num_rows($verif) >= 1) { // S'il y a déjà quelqu'un sur cette case.
                                $data = mysql_fetch_assoc($verif);
                                $message = '<p class="message">Tu ne peux pas te déplacer en '. $data['x'] .' | '. $data['y'] . "<br />\n";
                                $message .= 'Cette case est occupée par '. $data['nom']. "<br />\n";
                                $message .= 'Pour retourner au menu d\'action, clique <a href="play.php" title="Jouer mon personnage">ici</a></p>';
                        }
                                                
                        else {
                                $message = '<p class="message">Tu réussis à te déplacer en '. $newX .' | '. $newY ."<br />\n"; 
                                $message .= 'Pour retourner au menu d\'action, clique <a href="play.php" title="Jouer mon personnage">ici</a></p>';
                                mysql_query("UPDATE personnages SET x='$newX', y='$newY' WHERE nom='$perso->nom()") or die(mysql_error()); // Et maintenant seulement on met à jour !
                        }
                echo $message;
        }
        
        else  echo '<p class="message">Heu, t\'as du te tromper quelque part pour le déplacement, pour retourner au menu d\'action, clique <a href="play.php" title="Jouer mon personnage">ici</a></p>';

?>