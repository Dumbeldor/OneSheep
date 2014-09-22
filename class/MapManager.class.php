<?php
class MapManager
{
	private $_db; // Instance de PDO
  	public $nom = array();

  	public function __construct($db)
  	{
    	$this->setDb($db);
  	}
  	public function setDb(PDO $db)
  	{
   	 	$this->_db = $db;
  	}

  	public function get($x, $y)
  	{
  		$xMin = $x - 5;
    	$xMax = $x + 5;
    	$yMin = $y - 5;
    	$yMax = $y + 5;
    	if ($xMin <= 0)
    	{
      		$xMin = 0;
    	}
    	if ($yMin <= 0)
    	{
      		$yMin = 0;
    	}
    	$q = $this->_db->prepare('SELECT * FROM carte WHERE x BETWEEN :xMin AND :xMax AND y BETWEEN :yMin AND :yMax');
    	$q->execute(array(':xMin' => $xMin, ':xMax' => $xMax, ':yMin' => $yMin, ':yMax' => $yMax));
    	
    	$map = new Map(array());
    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$map->setIdcarte($donnees['idcarte']);
      		$map->setX($donnees['x']);
      		$map->setY($donnees['y']);
      		$map->setIdterrain($donnees['idterrain']);
          $map->setImg($donnees['img']);
    	}
    	return $map;
  	}

  	public function terrain($x, $y)
  	{
    	$xMin = $x - 5;
    	$xMax = $x + 5;
    	$yMin = $y - 5;
    	$yMax = $y + 5;
    	if ($xMin <= 0)
    	{
      		$xMin = 0;
    	}
    	if ($yMin <= 0)
    	{
      		$yMin = 0;
    	}
    	$q = $this->_db->prepare('SELECT * FROM carte WHERE x BETWEEN :xMin AND :xMax AND y BETWEEN :yMin AND :yMax');
    	$q->execute(array(':xMin' => $xMin, ':xMax' => $xMax, ':yMin' => $yMin, ':yMax' => $yMax));
    
    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		echo "X : ";
      		echo $donnees['x'];
      		echo " Y : "; echo $donnees['y']; echo " Terrain "; echo $donnees['idterrain']; echo "</br>";
    	}
    
  	}
}