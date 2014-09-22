<?php
class Map 
{
	protected 	$idcarte = array(),
				$x = array(),
				$y = array(),
				$idterrain = array(),
				$img = array();

	public function __construct(array $donnees)
 	{
    	$this->hydrate($donnees);
  	}

  	  // Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees)
	{
  		foreach ($donnees as $key => $value)
  		{
    		// On récupère le nom du setter correspondant à l'attribut.
    		$method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    		if (method_exists($this, $method))
    		{
      			// On appelle le setter.
      			$this->$method($value);
    		}
  		}
	}

	public function idcarte($id)
	{
		return $this->idcarte[$id];
	}
	public function NombreCarte()
	{
		return $this->x;
	}
	public function x($xs)
	{
		return $this->x[$xs];
	}
	public function y($ys)
	{
		return $this->y[$ys];
	}
	public function idterrain($id)
	{
		return $this->idterrain[$id];
	}
	public function img($imgs)
	{
		return $this->img[$imgs];
	}
	public function setIdcarte($idcarte)
	{
		$idcarte = (int) $idcarte;
		if ($idcarte >= 0)
		{
			array_push($this->idcarte, $idcarte);
		}
	}
	public function setX($x)
	{
		$x = (int) $x;
		if ($x >= 0)
		{
			array_push($this->x, $x);
		}
	}
	public function setY($y)
	{
		$y = (int) $y;
		if ($y >= 0)
		{
			array_push($this->y, $y);
		}
	}
	public function setIdterrain($id)
	{
		$id = (int) $id;
		if ($id >= 0)
		{
			array_push($this->idterrain, $id);
		}
	}
	public function setImg($img)
	{
		array_push($this->img, $img);
	}
}