<div id="carte"> <?php

       for ($numero = 0; $numero < count($map->NombreCarte()); $numero++)
       {
           ?><img src="./img/<?php echo $map->img($numero); ?>.png"></img><?php

        }

?> </div>