<?php

require_once ("Model.php");
require_once ("Subscriber.php");
class SubModel extends Model
{

	
public function __construct(){	
    parent::__construct();
}

  public function subsCount(){

    $result = $this->db->query("SELECT COUNT(*) AS count FROM subscriptions");
    $row = $result->fetch_assoc();
    return $row['count'];

  }

    public function getLastRegisters()
    {

    $q ="SELECT `id`,`firstName`,`lastName` ,`dateStart` FROM `subscriptions` ORDER BY `number` DESC LIMIT 5";
  
   if ($result = $this->db->query($q)) {
    $j=0;
    $lastRows=array();
    while ($row = $result->fetch_row()) {

        for ($i=0;$i<count($row);$i++)
        {
            if ($i==0)
            $lastRows[$j]['id']=$row[$i];

            if ($i==1)
            $lastRows[$j]['name']=$row[$i]." ".$row[$i+1];

            if ($i==3)
            $lastRows[$j]['subDate']=date('d-m-y', strtotime($row[$i]));
        }
        $j++;
    }
    }

    return $lastRows;
    }

    public function addNewSub()
    {

    $q = "SELECT `id` FROM subscriptions WHERE `id`='$_POST[id]'";
    $result = $this->db->query($q);

    if ($result->fetch_row()==0)
    {
     $subscriber = new Subscriber($_POST['id'],$_POST['tel'],$_POST['firstName'],$_POST['lastName'],$_POST['birthDate'],$_POST['sex'],$_POST['subscribe'],$_POST["email"],$_POST['address']);

       return $subscriber->addNewSub($this->db);
    }

    return 0;
     
    }



    public function subDetails($id)
    {
     $q="SELECT `id` ,`firstName`,`lastName`,`birthDate`,`phone`,`address`,`email`,`dateStart`,`dateEnd` FROM `subscriptions` WHERE `ID`='$id'";
        $result = $this->db->query($q);
        $details = $result->fetch_array(MYSQLI_ASSOC);
        $details['birthDate'] = date("d-m-Y", strtotime($details['birthDate']));
        $details['active'] = $this->checkActive(new DateTime($details['dateEnd']));

        return $details;
    } 



    public function searchSubs($query)
    {
        
        
    $q = "SELECT `id` ,`firstName`,`lastName`,`dateStart`,`dateEnd` FROM `subscriptions` WHERE concat(`firstName`,' ',`lastName`)
    LIKE '%$query%' OR `id` LIKE '%$query%';";



        $result = $this->db->query($q);
         $subs=array();
      
         $i=0;
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $subs[$i]=$row;
            $subs[$i]['active']= $this->checkActive(new DateTime($row['dateEnd']));
          $i++;
        }




       return $subs;

    }

    private function checkActive($dateEnd)
    {
        $today = new DateTime();

        if ($today>$dateEnd)
        return 0;
        else
        return 1;

    }






    public function updateDetails($details)
    {

        $firstName =htmlspecialchars($this->db->real_escape_string($_POST['firstName']));
        $lastName =htmlspecialchars($this->db->real_escape_string($_POST['lastName']));
        $birthDate= htmlspecialchars($this->db->real_escape_string($_POST['birthDate']));
        $address = htmlspecialchars($this->db->real_escape_string($_POST['address']));
        $email = htmlspecialchars($this->db->real_escape_string($_POST['email']));
        $phone = htmlspecialchars($this->db->real_escape_string($_POST['phone']));



            $q = "UPDATE `subscriptions` SET `firstName`='$firstName' , `lastName`='$lastName', `birthDate`='$birthDate',`address`='$address' ,`email`='$email' ,`phone`='$phone' WHERE `id`='$details[id]'";

            return $this->db->query($q);


    }

    public function registrationUpdate(){
        
        $subscriber = new Subscriber($_POST['id'] ,$_POST['subLength']);
        return $subscriber->registrationUpdate($this->db);


    }



	
}
	

	
	




?>
