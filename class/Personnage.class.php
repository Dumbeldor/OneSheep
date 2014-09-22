<?php
class Personnage
{
  protected $id;
  protected $PA;
  protected $heureStock;
  protected $nom;
  protected $argent;
  protected $village;
  protected $forcePerso;
  protected $defense;
  protected $fuite;
  protected $nomArme;
  protected $attaqueArme;
  protected $defenseArme;
  protected $nomArmure;
  protected $attaqueArmure;
  protected $defenseArmure;
  protected $vie;
  protected $magie;
  protected $niveau;
  protected $experience;
  protected $x;
  protected $y;
  protected $xVille;
  protected $yVille;
  protected $joueurVille;
  protected $tempsMission;
  protected $combat;
  protected $num;

  const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
  const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
  const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
  const SOIGNE_ADVERSE = 4;
  const PLUS_MAGIE = 5;
  const SOIGNE = 6;
  const REPOS_ADV = 7;
  const REPOS = 8;
  const TROP_MAGIE = 9;
  const TROP_VIE = 10;
  const TROP_TARD = 11;
  const CONTRER_SOI = 12;
  const CONTRER = 13;
  const FUIR_ADV = 14;
  const FUIR = 15;
  const PLUS_VIE = 16;
  const DEF_ADV = 17;
  const SEDEF = 18;
  const TOI = 19;
  const INACTIF = 20;
  const DEGATS_MAX = 21;

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


  public function equipe($nom, $attaque, $defense, $type)
  {
    if ($type == 1) // SI c'est une arme
    {
      $this->nomArme = $nom;
      $this->attaqueArme = $attaque;
      $this->defenseArme = $defense;
    }
    elseif ($type == 2) // SI c'est une armure
    {
      $this->nomArmure = $nom;
      $this->attaqueArmure = $attaque;
      $this->defenseArmure = $defense;
    }
  }

  public function enCombat()
  {
    if($this->combat == 0)
    {
      return false;
    }
    else {
      return true;
    }
  }

  public function perdreArgent($argent)
  {
    $argent = (int) $argent;
    if ($this->argent > 0)
    {
      $this->argent -= $argent;
    }
  }

  public function gagnerArgent($argent)
  {
    $argent = (int) $argent;
    if ($this->argent < 9999999999999)
    {
      $this->argent += $argent;
    }
  }

  public function gagnerXP($xp)
  {
    $xp = (int) $xp;
    if ($xp >= 0)
    {
      $this->experience += $xp;
      $this->setExperience($xp);
      $this->experience = $this->experience();
      echo "TEST";
      echo $this->experience;
    }
  }


  public function checkTempsMission()
  {
    $tempsM = (time() - $this->tempsMission);
    if ($tempsM >= 1800)
    {
      $this->setTempsMission();
      return true;
    }
    else
    {
      return false;
    }
  }

  /* 
    Ajout PA
  */
  public function actionPA()
  {
    $this->PA -= 1;
  }
  public function ajoutPA()
  {
    $heureE = (time() - $this->heureStock) / 60 / 60;
    $heureE = $heureE * 3;
    $this->PAajout($heureE);
    $this->heureStock = time();
  }
  public function PAajout($pa)
  {
    $paa = $this->PA;
    $paa += $pa;
    if ($paa > 30)
    {
      $this->PA = 30;
    }
    else
    {
      $this->PA = $paa;
    }
  }

  /*
      Bot Combat
  */

  public function botCombat(Personnage $perso)
  {
    $degats = $this->degats($perso);
    return $perso->recevoirDegats($degats);
  }
  

  public function frapper(Personnage $perso)
  {
    if ($perso->id() == $this->id)
    {
      return self::CEST_MOI;
    }
    $degats = $this->degats($perso);
    return $perso->recevoirDegats($degats);
  }
  public function recevoirDegats($degats)
  {
    $this->vie -= $degats;

    if ($this->vie <= 0) 
    {
      return self::PERSONNAGE_TUE;
    }
    else
    {
      return self::PERSONNAGE_FRAPPE;
    }
  }

  public function defendre()
  {

  }

    public function nomValide()
  {
    return !empty($this->nom);
  }

    public function info()
    {
      echo '<legend>', $this->nom, '</legend></br>';
      echo $this->PA, '/30 PA </br>';
      echo "Argent : ", $this->argent, '</br>';
      echo 'Vie : ', $this->vie, '/100</br>';
      echo 'Vous êtes niveau ', $this->niveau, '</br>';
      echo 'Vous avez ',$this->experience, '/100 d\'experience </br>';
      echo 'Village : ', $this->village, '</br>';
      echo $this->forcePerso, ' force </br>';
      echo $this->defense, ' défense </br>';
      echo $this->fuite, ' fuite </br>';
      echo 'Votre arme : ', $this->nomArme, '</br> Degats de l\'arme : ', $this->attaqueArme, ' défense de l\'arme : ', $this->defenseArme, '</br>';
      echo 'Votre armure : ', $this->nomArmure, '</br> Degats de l\'armure : ', $this->attaqueArmure, ' défense de l\'armure : ', $this->defenseArmure, '</br>';
    }

    public function combatInfo()
    {
      echo '<legend>', $this->nom, '</legend>', '</br>';
      echo 'village : ', $this->village, '</br>';
      echo 'niveau : ', $this->niveau, '</br>';
      echo 'vie : ', $this->vie, '</br>';
    }

    public function enVie()
    {
      if($this->vie <= 0)
      {
        echo "Vous êtes mort ! </br> Une équipe médical de votre village veulent vous réanimez acceptez vous ? </br> <a href=index.php?action=reanimer>Oui</a>";
        if(isset($_GET['action']))
        {
          echo "Après de longue heures l'équipe médical a réussis à vous sauver, par contre vous avez perdu votre expérience";
          $this->vie = 15;
          $this->experience = 0;
          $this->combat = 0;
        }
        return false;
      }
      else { return true; }
    }

    public function vivant()
    {
      if ($this->vie <= 0)
      {
        return false;
      }
      else
      {
        return true;
      }
    }

    /*
        Localisation du personnage
    */

    public function localisation()
    {
      if ($this->joueurVille == 1)
      {
        if ($this->x == 0 && $this->y == 0)
        {
          return "village";
        }
        else
        {
          return "villageInconnu";
        }
      }
      elseif ($this->joueurVille == 0)
      {
        return "dehors";
      }
      else
      {
        return "dehors";
      }
    }
    public function localisationVillage()
    {
      if ($this->joueurVille == 1)
      {
        if ($this->xVille == 0 && $this->yVille == 0)
        {
          return "dehors";
        }
        elseif ($this->xVille == 1 && $this->yVille == 1)
        {
          return "academie";
        }
        elseif ($this->xVille == 1 && $this->yVille == 2)
        {
          return "commerce";
        }
        elseif ($this->xVille == 2 && $this->yVille == 1)
        {
          return "arene";
        }
        elseif ($this->xVille == 2 && $this->yVille == 2)
        {
          return "qg";
        }
        elseif ($this->xVille == 3 && $this->yVille == 3)
        {
          return "entree";
        }
        else
        {
          return "inconue";
        }
      }
      else
      {
        return "dehors";
      }
    }

    public function degats(Personnage $perso)
    {
      return $degats = ($this->forcePerso + $this->attaqueArme + $this->attaqueArmure) - ($perso->defense() + $perso->defenseArmure() - 5);
    }
  	


  	public function setId($id)
  	{
    // On convertit l'argument en nombre entier.
    // Si c'en était déjà un, rien ne changera.
    // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
    $id = (int) $id;
    
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($id > 0)
    {
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->id = $id;
    }
  }

  public function setPA($PA)
  {
    $PA = (int) $PA;
    
    if ($PA >= 0 && $PA <= 30)
    {
      $this->PA = $PA;
    }
    elseif ($PA < 30)
    {
      $this->PA = 30;
    }
  }
  public function setHeureStock()
  {
    $this->heureStock = time();
  }
  
  public function setNom($nom)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($nom))
    {
      $this->nom = $nom;
    }
  }

  public function setArgent($argent)
  {
    $argent = (int) $argent;
    
    if ($argent > 1 && $argent <= 99999999999)
    {
      $this->argent = $argent;
    }
  }

  public function setVillage($village)
  {
    if (is_string($village))
    {
      $this->village = $village;
    }
  }

  public function setForcePerso($forcePerso)
  {
    $forcePerso = (int) $forcePerso;
    
    if ($forcePerso >= 1 && $forcePerso <= 100)
    {
      $this->forcePerso = $forcePerso;
    }
  }

    public function setDefense($defense)
  {
    $defense = (int) $defense;
    
    if ($defense >= 0 && $defense <= 10000)
    {
      $this->defense = $defense;
    }
  }

  public function setFuite($fuite)
  {
    $fuite = (int) $fuite;

    if ($fuite >= 0 && $fuite <= 10000)
    {
      $this->fuite = $fuite;
    }
  }

  public function setNomArme($nomArme)
  {
    if (is_string($nomArme))
    {
      $this->nomArme = $nomArme;
    }
  }
  public function setAttaqueArme($attaqueArme)
  {
    $attaqueArme = (int) $attaqueArme;
    if ($attaqueArme >= 0 && $attaqueArme <= 4000)
    {
      $this->attaqueArme = $attaqueArme;
    }
  }
  public function setDefenseArme($defenseArme)
  {
    $defenseArme = (int) $defenseArme;
    if ($defenseArme >= 0 && $defenseArme <= 4000)
    {
      $this->defenseArme = $defenseArme;
    }
  }

  public function setNomArmure($nomArmure)
  {
    if (is_string($nomArmure))
    {
      $this->nomArmure = $nomArmure;
    }
  }
  public function setAttaqueArmure($attaqueArmure)
  {
    $attaqueArmure = (int) $attaqueArmure;
    if ($attaqueArmure >= 0 && $attaqueArmure <= 4000)
    {
      $this->attaqueArmure = $attaqueArmure;
    }
  }
  public function setDefenseArmure($defenseArmure)
  {
    $defenseArmure = (int) $defenseArmure;
    if ($defenseArmure >= 0 && $defenseArmure <= 4000)
    {
      $this->defenseArmure = $defenseArmure;
    }
  }
  
  public function setVie($vie)
  {
    $vie = (int) $vie;
    
    if ($vie <= 100)
    {
      $this->vie = $vie;
    }
  }

  public function setMagie($magie)
  {
    $magie = (int) $magie;
    
    if ($magie <= 500)
    {
      $this->magie = $magie;
    }
  }

  public function setNiveau($niveau)
  {
    $niveau = (int) $niveau;
    
    if ($niveau >= 1 && $niveau <= 100)
    {
      $this->niveau = $niveau;
    }
  }
  
  public function setExperience($experience)
  {
    $experience = (int) $experience;
    
    if ($experience >= 0 && $experience <= 100)
    {
      $this->experience = $experience;
    }
  }
  public function setX($x)
  {
    $x = (int) $x;

    if ($x >= 0 && $x <= 100)
    {
      $this->x = $x;
    }
  }
  public function setY($y)
  {
    $y = (int) $y;

    if ($y >= 0 && $y <= 100)
    {
      $this->y = $y;
    }
  }
    public function setYVille($yVille)
  {
    $yVille = (int) $yVille;

    if ($yVille >= 0 && $yVille <= 100)
    {
      $this->yVille = $yVille;
    }
  }
    public function setXVille($xVille)
  {
    $xVille = (int) $xVille;

    if ($xVille >= 0 && $xVille <= 100)
    {
      $this->xVille = $xVille;
    }
  }
  public function setJoueurVille($joueurVille)
  {
    $joueurVille = (int) $joueurVille;

    if ($joueurVille == 0 || $joueurVille == 1)
    {
      $this->joueurVille = $joueurVille;
    }
  }
  public function setTempsMission()
  {
    $this->tempsMission = time();
  }
  public function setCombat($combat)
  {
    $combat = (int) $combat;

    if ($combat == 0 || $combat == 1)
    {
      $this->combat = $combat;
    }
  }

  public function id()
    {
      return $this->id;
    }
    public function PA()
    {
      return $this->PA;
    }
    public function heureStock()
    {
      return $this->heureStock;
    }
    public function nom()
    {
      return $this->nom;
    }
    public function argent()
    {
      return $this->argent;
    }
    public function village()
    {
      return $this->village;
    }
    public function forcePerso()
    {
      return $this->forcePerso;
    }  
    public function defense()
    {
      return $this->defense;
    }
    public function fuite()
    {
      return $this->fuite;
    }
    public function nomArme()
    {
      return $this->nomArme;
    }
    public function attaqueArme()
    {
      return $this->attaqueArme;
    }
    public function defenseArme()
    {
      return $this->defenseArme;
    }
    public function nomArmure()
    {
      return $this->nomArmure;
    }
    public function attaqueArmure()
    {
      return $this->attaqueArmure;
    }
    public function defenseArmure()
    {
      return $this->defenseArmure;
    }
    public function vie()
    {
      return $this->vie;
    }
    public function magie()
    {
      return $this->magie;
    }
    public function niveau()
    {
      return $this->niveau;
    }
    public function experience()
    {
      return $this->experience;
    }
    public function x()
    {
      return $this->x;
    }
    public function y()
    {
      return $this->y;
    }
    public function xVille()
    {
      return $this->xVille;
    }
    public function yVille()
    {
      return $this->yVille;
    }
    public function joueurVille()
    {
      return $this->joueurVille;
    }
    public function tempsMission()
    {
      return $this->tempsMission;
    }
    public function combat()
    {
      return $this->combat;
    }
}
