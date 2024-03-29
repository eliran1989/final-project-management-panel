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

    public function registerToStudio(){

    
            $subID = htmlspecialchars($_POST['id']);
            $studioID = htmlspecialchars($_POST['studio_id']);

            $q="INSERT IGNORE INTO `subs_studios` SET `subId` = '$subID' ,`studioId` = '$studioID'";

            return $this->db->query($q);

        
    }

    public function getStudios($id){

        $q="SELECT studio_lessons.id , `lesson_name` , `firstName` ,`lastName` FROM  studio_lessons 
        INNER JOIN subs_studios ON 
        subs_studios.subId = '$id' AND
        studio_lessons.id=subs_studios.studioId
        INNER JOIN trainers ON 
        studio_lessons.trainer_id = trainers.id";


        $result = $this->db->query($q);

        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {

          $studios[] =  array('id'=>$row['id'] ,'name' => $row['lesson_name'], 'trainer'=>$row['firstName']." ".$row['lastName']);


          $lessons = $this->db->query("SELECT `day` ,`time` FROM lesson WHERE `studio_id`='$row[id]'");


           while($lesson = $lessons->fetch_array(MYSQLI_ASSOC)){


            $studios[count($studios)-1]["lessons"][] = $lesson;


           }



        }


        if (isset($studios)){
            return $studios;
        }else{
            return false;
        }



    }



           public function startTraining($programId ,$letter){

            date_default_timezone_set('Asia/Jerusalem');

            $startTime = date("Y-m-d H:i");

            $q="INSERT INTO `training_track` SET `program_id` = '$programId' ,`letter` = '$letter' , `start_time`='$startTime'";

             $result = $this->db->query($q);

             return $this->db->insert_id;


         }



            public function endTraining($trackId){

                date_default_timezone_set('Asia/Jerusalem');


                $endTime = date("Y-m-d H:i");

                $q ="UPDATE `training_track` SET `end_time`='$endTime' WHERE `id`='$trackId'";


                $result = $this->db->query($q);

                return $result;

            }



            public function updateDetails($details){

                $phone = (isset($details['phone'])) ? "`phone`='".$details['phone']."'" :"";
                $email = (isset($details['email'])) ? ",`email`='".$details['email']."'" :"";
                $address =  (isset($details['address'])) ? ",`address`='".$details['address']."'" :"";


                $q = "UPDATE `subscriptions` SET ".$phone.$email.$address." WHERE `id`='".$details['id']."'";

                $q = str_replace("SET ," , "SET ", $q);
               
                echo $result = $this->db->query($q);
                

            }


}

?>
