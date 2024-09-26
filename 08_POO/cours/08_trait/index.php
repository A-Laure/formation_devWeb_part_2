<?php 

trait Identity
{

  public function getId()
  {
    return $this->id;
  }

}

class User 
{
  protected $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

}


class Admin extends User{

  use Identity;

  public function getRole()
  {
    return "Admin";
  }

}


$admin = new Admin(2);
echo "id : {$admin->getId()}";
echo "<br>";
echo "role : {$admin->getRole()}";