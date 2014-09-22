<?php 
class Inventaire
{
	protected $id = array(),
			  $itemId = array(),
			  $proprio = array(),
			  $nom = array(),
			  $description = array(),
			  $prix = array(),
			  $type = array(),
			  $attaque = array(),
			  $defense = array();

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



	public function id()
  	{
  		for ($numero = 0; $numero < count($this->id); $numero++)
  		{
  			return $this->id[$numero]; 	
  		}
  	}
  	public function itemId()
  	{
      if (isset($this->itemId[0]))
      {
  		  for ($numero = 0; $numero < count($this->itemId); $numero++)
  		  {
  			 return $this->itemId[$numero]; 	
        }
  	 }
    }
    public function itemIds($id)
    {
      return $this->itemId[$id];
    }
  	public function proprio()
  	{
  		for ($numero = 0; $numero < count($this->proprio); $numero++)
  		{  			
  			return $this->proprio[$numero]; 						
  		}
  	}
    public function proprios($id)
    {
      if (isset($this->proprio[$id])) 
      {
        return $this->proprio[$id];
      }
    }
  
  	public function nom()
  	{
  		for ($numero = 0; $numero < count($this->nom); $numero++)
  		{
  			return $this->nom[$numero]; 						
  		} 		
  	}
  	public function description()
  	{
  		for ($numero = 0; $numero < count($this->description); $numero++)
  		{
  			return $this->description[$numero]; 						
  		}
  	}
  	public function prix()
  	{
  		for ($numero = 0; $numero < count($this->prix); $numero++)
  		{
  			return $this->prix[$numero]; 						
  		}
  	}
  	public function type()
  	{
  		for ($numero = 0; $numero < count($this->type); $numero++)
  		{
  			return $this->type[$numero]; 						
  		}
  	}
  	public function attaque()
  	{
  		for ($numero = 0; $numero < count($this->attaque); $numero++)
  		{
  			return $this->attaque[$numero]; 						
  		}
  	}
  	public function defense()
  	{
  		for ($numero = 0; $numero < count($this->defense); $numero++)
  		{
  			return $this->defense[$numero]; 
  		}
  	}
  	

	public function setId($id)
	{
		$id = (int) $id;
		if ($id >= 0)
		{
			array_push($this->id, $id);
		}
	}
	public function setItemId($itemId)
	{
		$itemId = (int) $itemId;
		if ($itemId >= 0)
		{
			array_push($this->itemId, $itemId);
		}
	}
	public function setProprio($proprio)
	{
		if (is_string($proprio))
		{
			array_push($this->proprio, $proprio);
		}
	}
	public function setNom($nom)
	{
		if (is_string($nom))
		{
			array_push($this->nom, $nom);
		}
	}
	public function setDescription($description)
	{
		if (is_string($description))
		{
			array_push($this->description, $description);
		}
	}
	public function setPrix($prix)
	{
		$prix = (int) $prix;
		if ($prix >= 0)
		{
			array_push($this->prix, $prix);
		}
	}
	public function setType($type)
	{
		$type = (int) $type;
		if ($type >= 0)
		{
			array_push($this->type, $type);
		}
	}
	public function setAttaque($attaque)
	{
		$attaque = (int) $attaque;
		if ($attaque >= 0)
		{
			array_push($this->attaque, $attaque);
		}
	}
	public function setDefense($defense)
	{
		$defense = (int) $defense;
		if ($defense >= 0)
		{
			array_push($this->defense, $defense);
		}
	}
  public function tableau()
  {
    return count($this->nom);
  }



	 public function afficherInventaire()
  	{
      if (count($this->itemId) > 0)
      {
         if (isset($this->itemId[0]))
      {
        
  		for ($numero = 0; $numero < count($this->nom); $numero++)
		{
			   echo "Objet : ".$this->nom[$numero] . '<br />';
      
			echo "Description : ".$this->description[$numero]. '</br>';
			if ($this->type[$numero] == 1)
			{
				echo "Type d'objet : Arme </br>";
				echo "attaque : ".$this->attaque[$numero].'</br>';
				echo "defense : ".$this->defense[$numero].'</br>'; 
			}
			elseif ($this->type[$numero] == 2)
			{
				echo "Type d'objet : Armure </br>";
				echo "attaque : ".$this->attaque[$numero].'</br>';
				echo "defense : ".$this->defense[$numero].'</br>'; 
			}	
			?><a href="?vendre=<?php echo $this->id[$numero];?>">Vendre</a>
      <a href="?equiper=<?php echo $this->id[$numero];?>">Equiper</a> <?php	
			echo $this->id[$numero];
      echo "</br></br>";
		}
    }
  }
  	}

  public function afficherMagasin($choix)
  {
    if ($choix == "arme")
    {
    for ($numero = 1; $numero < count($this->nom); $numero++)
    {
      if ($this->type[$numero] == 1)
      {
         echo "Objet : ".$this->nom[$numero] . '<br />';
        echo "Description : ".$this->description[$numero]. '</br>';
        echo "Type d'objet : Arme </br>";
        echo "attaque : ".$this->attaque[$numero].'</br>';
        echo "defense : ".$this->defense[$numero].'</br>'; 
        ?><a href="?achat=<?php echo $this->itemId[$numero]?>">Achat</a><?php
      }
        
      echo "</br></br>";
    }
  }
  elseif ($choix == "armure")
  {
    for ($numero = 1; $numero < count($this->nom); $numero++)
    {
    if ($this->type[$numero] == 2)
      {
        echo "Objet : ".$this->nom[$numero] . '<br />';
        echo "Description : ".$this->description[$numero]. '</br>';
        echo "Type d'objet : Armure </br>";
        echo "attaque : ".$this->attaque[$numero].'</br>';
        echo "defense : ".$this->defense[$numero].'</br>'; 
        ?><a href="?achat=<?php echo $this->itemId[$numero]?>">Achat</a><?php  
      echo "</br></br>";
      } 
    }

  }
  elseif ($choix == "potion")
  {
    for ($numero = 1; $numero < count($this->nom); $numero++)
    {
    if ($this->type[$numero] == 3)
      {
        echo "Objet : ".$this->nom[$numero] . '<br />';
        echo "Description : ".$this->description[$numero]. '</br>';
        echo "Type d'objet : Potion </br>";
        ?><a href="?achat=<?php echo $this->itemId[$numero]?>">Achat</a><?php  
      echo "</br></br>";
        
      } 
    }

  }
  }
  	public function vente($id, Personnage $perso, InventaireManager $inventaireManager)
  	{
  		if (isset($id))
  		{
  			if (is_numeric($id))
  			{
           if (isset($this->id[0]))
            {
  				  for ($numero = 0; $numero < count($this->nom); $numero++)
  				  {
  					 if ($this->id[$numero] == $id)
  					 {
  						  echo "vente de ".$this->nom[$numero];
                $perso->gagnerArgent($this->prix[$numero]);
  						  $this->delete($this->id[$numero], $inventaireManager);
                unset($this->id[$numero]);
                unset($this->nom[$numero]);
                unset($this->itemId[$numero]);
                unset($this->proprio[$numero]);
                unset($this->description[$numero]);
                unset($this->prix[$numero]);
                unset($this->type[$numero]);
                unset($this->attaque[$numero]);
                unset($this->defense[$numero]);  						
  					 }
            }
  				}
  			}
  		}
  	}

  	public function delete($id, InventaireManager $inventaireManager)
  	{
  			$inventaireManager->deleteInventaire($id);
  	}

   public function equiper($id, Personnage $perso, InventaireManager $inventaireManager)
   {
      if (isset($id))
      {
        if (is_numeric($id))
        {
          for ($numero=0; $numero < count($this->id); $numero++) 
          { 
            if ($this->id[$numero] == $id)
            {
              if ($this->type[$numero] == 1 OR $this->type[$numero] == 2) // 1 = ARME 2 = ARMURE
              {
                echo "Vous vous êtes équipé de ".$this->nom[$numero];
                $perso->equipe($this->nom[$numero], $this->attaque[$numero], $this->defense[$numero], $this->type[$numero]);
                $message = "Vous vous êtes bien équipé de ".$this->nom[$numero];              
              }
            }
          }
        }
      }
      return $message = "Impossible d'équiper cette objet";
   }

   public function achat($id, $perso, $inventaireManager, $inventaire)
   {
      if(isset($id))
      {
        if (is_numeric($id))
        {
            $argents = $perso->argent() - $this->prix[$id];
            if ($argents >= 0)
            {
              $prix = $perso->argent() - $this->prix[$id];
              if ($perso->argent() > 0)
              {
              echo "Vous avez acheté ".$this->nom[$id];
              $perso->perdreArgent($this->prix[$id]);
              $inventaire->setItemId($this->itemId[$id]);
              $inventaire->setNom($this->nom[$id]);
              $inventaire->setDescription($this->description[$id]);
              $inventaire->setPrix($this->prix[$id]);
              $inventaire->setType($this->type[$id]);
              $inventaire->setAttaque($this->attaque[$id]);
              $inventaire->setDefense($this->defense[$id]);
              $inventaireManager->addMagasin($this, $id);
            }
            }
            else
            {
              $message = "Vous avez trop peu d'argent pour acheter l'objet";
            }
        
      }
   }
 }
	
}