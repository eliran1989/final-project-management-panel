<?php

require_once ("Model.php");
require_once ("Program.php");

class AppModel extends Model
{

	
public function __construct(){	
    parent::__construct();
}


public function checkUserValidation($tel , $pass)
{
    $pass = md5("space".$pass);
    $q= "SELECT `id`,`firstName`,`lastName`,`pass_change` FROM `subscriptions` WHERE `password`='$pass' and `phone`='$tel'"; 

	$result = $this->db->query($q);
     
    if ($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $row['user']=1;
       return $row;
    }
    
    $row['user']=0;
    return $row;


}


public function changePassFirstTime($id ,$pass)
{
    $pass = md5("space".$pass);
     $q= "UPDATE `subscriptions` SET `password`='$pass', `pass_change`='1' WHERE `id`='$id'"; 
     return $this->db->query($q);
}
	

public function getPrograms($subId){

    $q = "SELECT `program_id` FROM `training_programs` WHERE `sub_id` = '$subId'";

    $programs =array();
     
    $result = $this->db->query($q);

    while ($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $program = new Program();
        $program->getProgram($row['program_id'] , $this->db);
        $programs[] = $program;
    }

    return $programs;


}

}
	
?>
