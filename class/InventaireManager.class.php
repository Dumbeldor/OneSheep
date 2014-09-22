<?php
class InventaireManager
{
  private $_db; // Instance de PDO
  public $nom = array();

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Inventaire $inventaire)
  {
    for ($i=0; $i <= count($inventaire->itemId()); $i++) { 
           
      $q = $this->_db->prepare('INSERT INTO inventaire SET itemId = :itemId, proprio = :proprio');

      $q->bindValue(':itemId', $inventaire->itemIds($i));
      $q->bindValue(':proprio', $inventaire->proprios($i));

      $q->execute();
    }
  }

  public function addMagasin(Inventaire $inventaire, $id)
  {
    $q = $this->_db->prepare('INSERT INTO inventaire SET itemId = :itemId, proprio = :proprio');

    $q->bindValue(':itemId', $id);
    $q->bindValue(':proprio', $inventaire->proprio());

    $q->execute();
  }

  public function delete(Inventaire $inventaire, $id)
  {
    $this->_db->exec('DELETE FROM inventaire WHERE id = '.$id);
  }
   public function deleteInventaire($id)
  {
    $this->_db->exec('DELETE FROM inventaire WHERE id = '.$id);
  }

   public function get($info)
  {

    $inventaires = new Inventaire(array(
      ));
    if (is_int($info))
    {
      $q = $this->_db->prepare("SELECT * FROM inventaire WHERE id = :id ");
      $q->execute(array(':id' => $info));
      while ($donnees = $q->fetch())
     {
       $inventaires->setId($donnees['id']);
        $inventaires->setItemId($donnees['itemId']);
        $inventaires->setProprio($donnees['proprio']);
        $q1 = $this->_db->prepare("SELECT * FROM item WHERE itemId = :itemId");
        $q1->execute(array(':itemId' => $donnees['itemId']));
        while ($donnee = $q1->fetch())
        {
          $inventaires->setNom($donnee['nom']);
          $inventaires->setDescription($donnee['description']);
          $inventaires->setPrix($donnee['prix']);
          $inventaires->setType($donnee['type']);
          $inventaires->setAttaque($donnee['attaque']);
          $inventaires->setDefense($donnee['defense']);
        }
      }
      return $inventaires;
    }
    else
    {
      $q = $this->_db->prepare("SELECT * FROM inventaire WHERE proprio = :proprio ");
      $q->execute(array(':proprio' => $info));
      while ($donnees = $q->fetch())
     {
       $inventaires->setId($donnees['id']);
        $inventaires->setItemId($donnees['itemId']);
        $inventaires->setProprio($donnees['proprio']);
        $q1 = $this->_db->prepare("SELECT * FROM item WHERE itemId = :itemId");
        $q1->execute(array(':itemId' => $donnees['itemId']));
        while ($donnee = $q1->fetch())
        {
          $inventaires->setNom($donnee['nom']);
          $inventaires->setDescription($donnee['description']);
          $inventaires->setPrix($donnee['prix']);
          $inventaires->setType($donnee['type']);
          $inventaires->setAttaque($donnee['attaque']);
          $inventaires->setDefense($donnee['defense']);
        }
      }
      return $inventaires;
    }
  }

  public function getList($nom)
  {
    $persos = array();
    
    $q = $this->_db->prepare('SELECT * FROM inventaire WHERE proprio <> :proprio ORDER BY proprio');
    $q->execute(array(':proprio' => $nom));
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $inventaires[] = new Inventaire($donnees);
    }
    
    return $inventaires;
  }

  public function exists($info)
  {
    if (is_int($info)) 
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM inventaire WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
    $q->execute(array(':nom' => $info));
    
    return (bool) $q->fetchColumn();
  }

  public function update(Inventaire $inventaire)
  {
    $q = $this->_db->prepare('UPDATE inventaire SET id = :id, itemId = :itemId, proprio = :proprio WHERE id = :id');

    $q->bindValue(':id', $inventaire->id(), PDO::PARAM_INT);
    $q->bindValue(':itemId', $inventaire->itemId(), PDO::PARAM_INT);
    $q->bindValue(':proprio', $inventaire->proprio());

    $q->execute();
  }

  public function dansInventaire(Inventaire $inventaire)
  {

    $inventairess = new Inventaire(array(
          'id' => '',
          'itemId' => '',
          'proprio' => '',
          'nom' => '',
          'description' => '',
          'prix' => '',
          'type' => '',
          'attaque' => '',
          'defense' => '',
      ));

    $q = $this->_db->prepare("SELECT * FROM inventaire WHERE proprio = :proprio ");
    $q->execute(array(':proprio' => $inventaire->proprio()));
    while ($donnees = $q->fetch())
    {
      $itemId = $donnees['itemId'];
      $q1 = $this->_db->prepare("SELECT nom, description, prix, type, attaque, defense FROM item WHERE itemId = :itemId");
      $q1->execute(array('itemId' => $itemId));
      while ($donnee = $q1->fetch()) 
      {
       $inventairess->setId($donnees['id']);
       $inventairess->setItemId($donnees['itemId']);
       $inventairess->setProprio($donnees['proprio']);
       $inventairess->setNom($donnee['nom']);
       $inventairess->setDescription($donnee['description']);
       $inventairess->setPrix($donnee['prix']);
       $inventairess->setType($donnee['type']);
       $inventairess->setAttaque($donnee['attaque']);
       $inventairess->setDefense($donnee['defense']);
      }
    }
    return $inventairess;
  }

  public function dansMagasin(Personnage $perso)
  {
    $inventairess = new Inventaire(array(
      ));
    $q = $this->_db->query("SELECT itemId, nom, description, prix, type, attaque, defense FROM item WHERE villageX = '".$perso->x()."' AND villageY = '".$perso->y()."'");
      while($donnees = $q->fetch())
      {
        $inventairess->setId($donnees['id']);
       $inventairess->setItemId($donnees['itemId']);
       $inventairess->setNom($donnees['nom']);
       $inventairess->setDescription($donnees['description']);
       $inventairess->setPrix($donnees['prix']);
       $inventairess->setType($donnees['type']);
       $inventairess->setAttaque($donnees['attaque']);
       $inventairess->setDefense($donnees['defense']);
      }
      return $inventairess;
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
?>