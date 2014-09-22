<?php
class PersonnageManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Personnage $perso)
  {
    $q = $this->_db->prepare('INSERT INTO personnages SET PA = :PA, heureStock = :heureStock, nom = :nom, argent = :argent, village = :village, forcePerso = :forcePerso, defense = :defense, fuite = :fuite, nomArme = :nomArme, attaqueArme = :attaqueArme, defenseArme = :defenseArme, nomArmure = :nomArmure, attaqueArmure = :attaqueArmure, defenseArmure = :defenseArmure, vie = :vie, magie = :magie, niveau = :niveau, experience = :experience, x = :x, y = :y, xVille = :xVille, yVille = :yVille, joueurVille = :joueurVille, tempsMission = :tempsMission');

    $q->bindValue(':PA', $perso->PA(), PDO::PARAM_INT);
    $q->bindValue(':heureStock', time(), PDO::PARAM_INT);
    $q->bindValue(':nom', $perso->nom());
    $q->bindValue(':argent', $perso->argent(), PDO::PARAM_INT);
    $q->bindValue(':village', $perso->village());
    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':defense', $perso->defense(), PDO::PARAM_INT);
    $q->bindValue(':fuite', $perso->fuite(), PDO::PARAM_INT);
    $q->bindValue(':nomArme', $perso->nomArme());
    $q->bindValue(':attaqueArme', $perso->attaqueArme(), PDO::PARAM_INT);
    $q->bindValue(':defenseArme', $perso->defenseArme(), PDO::PARAM_INT);
    $q->bindValue(':nomArmure', $perso->nomArmure());
    $q->bindValue(':attaqueArmure', $perso->attaqueArmure(), PDO::PARAM_INT);
    $q->bindValue(':defenseArmure', $perso->defenseArmure(), PDO::PARAM_INT);
    $q->bindValue(':vie', $perso->vie(), PDO::PARAM_INT);
    $q->bindValue(':magie', $perso->magie(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
    $q->bindValue(':x', $perso->x(), PDO::PARAM_INT);
    $q->bindValue(':y', $perso->y(), PDO::PARAM_INT);
    $q->bindValue(':xVille', $perso->xVille(), PDO::PARAM_INT);
    $q->bindValue(':yVille', $perso->yVille(), PDO::PARAM_INT);
    $q->bindValue(':joueurVille', $perso->joueurVille(), PDO::PARAM_INT);
    $q->bindValue(':tempsMission', $perso->tempsMission(), PDO::PARAM_INT);

    $q->execute();
  }

  public function delete(Personnage $perso)
  {
    $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->id());
  }

   public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT id, PA, heureStock, nom, argent, village, forcePerso, defense, fuite, nomArme, attaqueArme, defenseArme, nomArmure, attaqueArmure, defenseArmure, vie, magie, niveau, experience, x, y, xVille, yVille, joueurVille, tempsMission FROM personnages WHERE id = '.$info);
      while ($donnees = $q->fetch())
      {
        return new Personnage(array(
          'id' => $donnees['id'],
          'PA' => $donnees['PA'],
          'heureStock' => $donnees['heureStock'],
          'nom' => $donnees['nom'],
          'argent' => $donnees['argent'],
          'village' => $donnees['village'],
          'forcePerso' => $donnees['forcePerso'],
          'defense' => $donnees['defense'],
          'fuite' => $donnees['fuite'],
          'nomArme' => $donnees['nomArme'],
          'attaqueArme' => $donnees['attaqueArme'],
          'defenseArme' => $donnees['defenseArme'],
          'nomArmure' => $donnees['nomArmure'],
          'attaqueArmure' => $donnees['attaqueArmure'],
          'defenseArmure' => $donnees['defenseArmure'],
          'vie' => $donnees['vie'],
          'magie' => $donnees['magie'],
          'niveau' => $donnees['niveau'],
          'experience' => $donnees['experience'],
          'x' => $donnees['x'],
          'y' => $donnees['y'],
          'xVille' => $donnees['xVille'],
          'yVille' => $donnees['yVille'],
          'joueurVille' => $donnees['joueurVille'],
          'tempsMission' => $donnees['tempsMission'],
      ));
      }
    }
    else
    {
      $q = $this->_db->prepare('SELECT PA, heureStock, id, nom, argent, village, forcePerso, defense, fuite, nomArme, attaqueArme, defenseArme, nomArmure, attaqueArmure, defenseArmure, vie, magie, niveau, experience, x, y, xVille, yVille, joueurVille, tempsMission FROM personnages WHERE nom = :nom');
      $q->execute(array(':nom' => $info));

      while ($donnees = $q->fetch())
      {
        return new Personnage(array(
          'PA' => $donnees['PA'],
          'heureStock' => $donnees['heureStock'],
          'id' => $donnees['id'],
          'nom' => $donnees['nom'],
          'argent' => $donnees['argent'],
          'village' => $donnees['village'],
          'forcePerso' => $donnees['forcePerso'],
          'defense' => $donnees['defense'],
          'fuite' => $donnees['fuite'],
          'nomArme' => $donnees['nomArme'],
          'attaqueArme' => $donnees['attaqueArme'],
          'defenseArme' => $donnees['defenseArme'],
          'nomArmure' => $donnees['nomArmure'],
          'attaqueArmure' => $donnees['attaqueArmure'],
          'defenseArmure' => $donnees['defenseArmure'],
          'vie' => $donnees['vie'],
          'magie' => $donnees['magie'],
          'niveau' => $donnees['niveau'],
          'experience' => $donnees['experience'],
          'x' => $donnees['x'],
          'y' => $donnees['y'],
          'xVille' => $donnees['xVille'],
          'yVille' => $donnees['yVille'],
          'joueurVille' => $donnees['joueurVille'],
          'tempsMission' => $donnees['tempsMission'],
      ));
      }
    }
  }

  public function getList($nom)
  {
    $persos = array();
    
    $q = $this->_db->prepare('SELECT id, nom, vie FROM personnages WHERE nom <> :nom ORDER BY nom');
    $q->execute(array(':nom' => $nom));
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }
    
    return $persos;
  }

  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
    $q->execute(array(':nom' => $info));
    
    return (bool) $q->fetchColumn();
  }

  public function update(Personnage $perso)
  {
    $id = $perso->id();
    if (isset($id))
    {
      
$q = $this->_db->prepare('UPDATE personnages SET PA = :PA, heureStock = :heureStock, nom = :nom, argent = :argent, village = :village, forcePerso = :forcePerso, defense = :defense, fuite = :fuite, nomArme = :nomArme, attaqueArme = :attaqueArme, defenseArme = :defenseArme, nomArmure = :nomArmure, attaqueArmure = :attaqueArmure, defenseArmure = :defenseArmure, vie = :vie, magie = :magie, niveau = :niveau, experience = :experience, x = :x, y = :y, xVille = :xVille, yVille = :yVille, joueurVille = :joueurVille, tempsMission = :tempsMission WHERE id = :id');

    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    $q->bindValue(':PA', $perso->PA(), PDO::PARAM_INT);
    $q->bindValue(':heureStock', time(), PDO::PARAM_INT);
    $q->bindValue(':nom', $perso->nom());
    $q->bindValue(':argent', $perso->argent(), PDO::PARAM_INT);
    $q->bindValue(':village', $perso->village());
    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':defense', $perso->defense(), PDO::PARAM_INT);
    $q->bindValue(':fuite', $perso->fuite(), PDO::PARAM_INT);
    $q->bindValue(':nomArme', $perso->nomArme());
    $q->bindValue(':attaqueArme', $perso->attaqueArme(), PDO::PARAM_INT);
    $q->bindValue(':defenseArme', $perso->defenseArme(), PDO::PARAM_INT);
    $q->bindValue(':nomArmure', $perso->nomArmure());
    $q->bindValue(':attaqueArmure', $perso->attaqueArmure(), PDO::PARAM_INT);
    $q->bindValue(':defenseArmure', $perso->defenseArmure(), PDO::PARAM_INT);
    $q->bindValue(':vie', $perso->vie(), PDO::PARAM_INT);
    $q->bindValue(':magie', $perso->magie(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
    $q->bindValue(':x', $perso->x(), PDO::PARAM_INT);
    $q->bindValue(':y', $perso->y(), PDO::PARAM_INT);
    $q->bindValue(':xVille', $perso->xVille(), PDO::PARAM_INT);
    $q->bindValue(':yVille', $perso->yVille(), PDO::PARAM_INT);
    $q->bindValue(':joueurVille', $perso->joueurVille(), PDO::PARAM_INT);
    $q->bindValue(':tempsMission', $perso->tempsMission(), PDO::PARAM_INT);

    $q->execute();
  }
    else
    {
      
      $q = $this->_db->prepare('UPDATE personnages SET PA = :PA, heureStock = :heureStock, nom = :nom, argent = :argent, village = :village, forcePerso = :forcePerso, defense = :defense, fuite = :fuite, nomArme = :nomArme, attaqueArme = :attaqueArme, defenseArme = :defenseArme, nomArmure = :nomArmure, attaqueArmure = :attaqueArmure, defenseArmure = :defenseArmure, vie = :vie, magie = :magie, niveau = :niveau, experience = :experience, x = :x, y = :y, xVille = :xVille, yVille = :yVille, joueurVille = :joueurVille, tempsMission = :tempsMission WHERE nom = :nom');

    $q->bindValue(':PA', $perso->PA(), PDO::PARAM_INT);
    $q->bindValue(':heureStock', time(), PDO::PARAM_INT);
    $q->bindValue(':nom', $perso->nom());
    $q->bindValue(':argent', $perso->argent(), PDO::PARAM_INT);
    $q->bindValue(':village', $perso->village());
    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':defense', $perso->defense(), PDO::PARAM_INT);
    $q->bindValue(':fuite', $perso->fuite(), PDO::PARAM_INT);
    $q->bindValue(':nomArme', $perso->nomArme());
    $q->bindValue(':attaqueArme', $perso->attaqueArme(), PDO::PARAM_INT);
    $q->bindValue(':defenseArme', $perso->defenseArme(), PDO::PARAM_INT);
    $q->bindValue(':nomArmure', $perso->nomArmure());
    $q->bindValue(':attaqueArmure', $perso->attaqueArmure(), PDO::PARAM_INT);
    $q->bindValue(':defenseArmure', $perso->defenseArmure(), PDO::PARAM_INT);
    $q->bindValue(':vie', $perso->vie(), PDO::PARAM_INT);
    $q->bindValue(':magie', $perso->magie(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
    $q->bindValue(':x', $perso->x(), PDO::PARAM_INT);
    $q->bindValue(':y', $perso->y(), PDO::PARAM_INT);
    $q->bindValue(':xVille', $perso->xVille(), PDO::PARAM_INT);
    $q->bindValue(':yVille', $perso->yVille(), PDO::PARAM_INT);
    $q->bindValue(':joueurVille', $perso->joueurVille(), PDO::PARAM_INT);
    $q->bindValue(':tempsMission', $perso->tempsMission(), PDO::PARAM_INT);

    $q->execute();
    }
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }

  
  public function carteJoueurEnvirons($x_max, $x_min, $y_max, $y_min)
  {
    $q = $this->_db->prepare('SELECT id, nom, x, y, niveau FROM personnages WHERE x BETWEEN :x_min AND :x_max AND y BETWEEN :y_min AND :y_max');
    $q->execute(array(':x_min' => $x_min, ':x_max' => $x_max, ':y_min' => $y_min, ':y_max' => $y_max));

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $joueur[$donnees['id']][$donnees['nom']][$donnees['x']][$donnees['y']][$donnees['niveau']] = array('id'=>$donnees['id'], 'nom'=>$donnees['nom'], 'x'=>$donnees['x'], 'y'=>$donnees['y'], 'niveau'=>$donnees['niveau']);
    }
    return $joueur;
  } 
}
?>