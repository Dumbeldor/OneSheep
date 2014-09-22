<?php

$db = new PDO('mysql:host=localhost;dbname=weblobsd_onesheep', 'weblobsd_oneshee', 'mZ[+D6H$@+;0');

include "include/session.php";
                                                
$pseudo = $perso->nom();
                                                
$recup = $db->prepare("SELECT nom,x,y FROM personnages WHERE nom='$pseudo'");
 $recup->execute();
      while ($fetch = $recup->fetch())
      {
    
                                                
        $posx = $fetch['x'];
        $posy = $fetch['y'];
                                                
        $compteurX = $posx - 4;
        $compteurY = $posy + 4;

        $finX = $posx + 4;
        $finY = $posy - 4;
                                        
        $debutX = $posx - 4;

        while($compteurY >= $finY) {
                echo '<div class="ligneMap">', "\n";
       
                while($compteurX <= $finX) {
                    echo "test";
                        echo "\t\t\t\t\t\t\t", '<div class="caseMap">';
                        $test = $db->prepare("SELECT nom FROM personnages WHERE x='$compteurX' AND    y='$compteurY'") or die(mysql_error());
                        $test->execute();
                        while ($fetch = $test->fetch())
                        
                        echo '</div>', "\n";
                        $compteurX++;
                }
                                
        echo "\t\t\t\t\t\t", '</div>', "\n";
        $compteurX = $debutX; // <===============ICI
        $compteurY--;
        }
    }


