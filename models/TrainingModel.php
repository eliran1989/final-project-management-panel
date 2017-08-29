<?php

require_once ("Model.php");
require_once ("Program.php");

class TrainingModel extends Model
{

	
public function __construct(){	
    parent::__construct();
}

     /*   public function checkLogin ($userName , $password)
        {
            $password= md5("space".$password);

           $q = "SELECT `firstName`,`lastName`,`userName` FROM trainers where `userName`='$userName' and `password` = '$password'";
            $result = $this->db->query($q);

            $row = $result->fetch_array(MYSQLI_ASSOC);
           if (count($row))
           return $row;
           else
           return FALSE;
          
        }*/

        public function searchSubs($query)
        {
          $q = "SELECT `id` ,`firstName`,`lastName`,`dateStart`,`dateEnd` FROM `subscriptions` WHERE concat(`firstName`,' ',`lastName`)
              LIKE '%$query%' OR `id` LIKE '%$query%';";

        $subs =array();

        $result = $this->db->query($q);

        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $subs[]=$row;
        }


       return $subs;

        }


        public function getSubPrograms($subId){

        $q ="SELECT `program_id` ,`sub_id` , `type` ,`purpose`,`date_create`,`date_end`, `create_by` FROM training_programs WHERE `sub_id`='$subId'";
        
        $programs =array();
        $result = $this->db->query($q);

        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $programs[]=$row;
        }

        return $programs;


        }

        public function getExerciseList($muscleName){

          $q = "SELECT `name` ,`en_name` FROM `exercises` WHERE `muscle_name`='$muscleName'";
          $result = $this->db->query($q);

         $exercises =array();
         $i=0;

        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $exercises[$i]=$row;
            $i++;
        }

          return $exercises;
        }


        public function getMusclesList(){
          $q = "SELECT `name`  FROM `muscles`";
          $result = $this->db->query($q);

         $muscles =array();
         $i=0;

        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $muscles[$i]=$row;
            $i++;
        }

          return $muscles;


        }


        public function get_track_precent($program_id , $letter , $startDate){

              $today = date("d-m-Y");
              $startDateWeekCnt = round(floor( date('d',strtotime($startDate)) / 7)) ;
              $endDateWeekCnt = round(ceil( date('d',strtotime($today)) / 7)) ;
              $datediff = strtotime(date('Y-m',strtotime($today))."-01") - strtotime(date('Y-m',strtotime($startDate))."-01");
              $totalnoOfWeek = round(floor($datediff/(60*60*24)) / 7) + $endDateWeekCnt - $startDateWeekCnt ;

              $totalnoOfWeek = $totalnoOfWeek-($totalnoOfWeek%7);


              switch ($letter) {
                case 'AB':
                  $trainingsForWeek = 2;
                  break;
                case 'ABC':
                  $trainingsForWeek = 3;
                  break;
                case 'ABCD':
                  $trainingsForWeek = 4;
                  break;
                default:

                  break;
              }

              $trainingsSum = $totalnoOfWeek * $trainingsForWeek;

              $q = "SELECT `id` FROM `training_track` WHERE `program_id`='$program_id'";

              $result = $this->db->query($q);

              $totalTrainings = $result->num_rows;

              echo $totalnoOfWeek."</br>";


              if($totalTrainings==0){
                return 0;
              }else{
                
              }




        }


        public function addProgram(){

            if ($_POST['purpose']=="other")
              $_POST['purpose']=$_POST['other_purpose'];

          $program =new Program($_GET['id'],$_POST['trainingType'],$_POST['purpose'],$_POST['training_lenght'],$_POST['note'],$this->db);
            
            return $program->addProgram();

        }



        public function getProgram($programId){

           $program = new Program();


          $program->getProgram($programId , $this->db);

          return $program;
      
        }

        public function updateProgram(){

              if ($_POST['purpose']=="other")
              $_POST['purpose']=$_POST['other_purpose'];

          $program =new Program($_GET['subId'],$_POST['trainingType'],$_POST['purpose'],$_POST['training_lenght'],$_POST['note'],$this->db);
            return $program->update();

        }




	
}
	

	
	




?>
