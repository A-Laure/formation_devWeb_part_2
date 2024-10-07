<?php 

class SupplierModel extends CoreModel{


 private $_req;

# Invoquée quand l'objet est détruit ou que un script se termine, elle libère des ressources
 public function __destruct()
 {
   if(!empty($this->_req))
   {
     $this->_req->closeCursor();
   }
 }


# CREATE, le $request = le $_POST
public function create($request)
{

//  if (!empty($_POST['spplName']) && !empty($_POST['lastname']) && !empty($_POST['email'])  && !empty($_POST['pwd']) && !empty($_POST['roleSelect'])) {
//    $firstName = $_POST['firstname'];
//    $lastName = $_POST['lastname'];
//    $email = $_POST['email'];
//    $pwd = $_POST['pwd'];
//    $roleId = $_POST['roleSelect'];
   // $dateTime = date_timestamp_get();
// Manque un morceau pour récup du rôle que l'on verra ds exo
  try
  {
    $query = "INSERT
    sppl_Id, sppl_name, sppl_contact, sppl_phoneContact, sppl_orderMail
    
    
     INTO supplier () VALUES (:id, :firstName, :lastName,:email, :pwd, :lastMove, :roleId)";

    if(($this->_req = $this->getDb()->prepare($query)) !== false) 
    {
      if(( 
       $this->_req->bindValue(':id', $request['id'])
        && 
       $this->_req->bindValue(':firstName', $request['firstName'])
       &&
       $this->_req->bindValue(':lastName', $request['lastName'])
       &&
       $this->_req->bindValue(':email', $request['email'])
       &&
       $this->_req->bindValue(':pwd', $request['pwd'])
       &&
       $this->_req->bindValue(':lastMove', $request['lastMove'])
       &&
       $this->_req->bindValue(':roleSelect', $request['roleSelect'])  
       ))
      {
        if($this->_req->execute())
        {
         // lastInsertId : Retourne l'identifiant de la dernière ligne insérée, on peut du coup l'utiliser pour afficher un message, 'le user intel a bien été créé' ou autre utilisation
          $res = $this->getDb()->lastInsertId();
          return $res;
        }
      }
    }
  }
  catch(PDOException $e)
  {
    die($e->getMessage());
  }
}
}






}