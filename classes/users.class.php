<?php
require_once "../config/constant.php";
class users extends Dbh {
    private $id;
    private $name;
    private $email;
    private $role;
    private $password;

    public function __construct() {
    }

    public function get_user_by_name($name){
        $user=[];
      $sql = "SELECT * FROM users WHERE name=? ";
      $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
      if(!$st->execute(array($name))){
          $st=null;
      }else{
          $st=$st->fetch(PDO::FETCH_ASSOC);
            $user["role"]=$this->role=$st["role"];
            $user["email"]=$this->email=$st["email"];
            $user["password"]=$this->password=$st["password"];
            $user["name"]=$this->name=$st["name"];
            $user['id']=$this->id=$st['id'];

      }
return $user;
}
 
  


}











?>