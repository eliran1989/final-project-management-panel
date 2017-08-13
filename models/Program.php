  <?php

require_once ("Trainings.php");

  class Program
  {

  	private $programId;
  	private $subId;
  	private $type;
  	private $purpose;
  	private $dateCreate ;
  	private $dateEnd; 
  	private $programLength;
  	private $note;
    private $createBy;
    private $db;
    private $trainings;


    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct0() {


    }



    public function __construct6($subId ,$type ,$purpose,$programLength,$note,$db) {

      $this->setSubId($subId);
      $this->setType($type);
      $this->setPurpose($purpose);
      $this->setProgramLength($programLength);
      $this->setDateCreate(new DateTime());
      $this->setDateEndClac(new DateTime(),$programLength);
      $this->setNote($note);
      $createBy = (isset($_SESSION['trainer'])) ? $_SESSION['trainer'] : json_decode($_COOKIE['trainer'],true);
      $this->setCreateBy($createBy['firstName']." ".$createBy['lastName']);
      $this->setDb($db);


    }


    public function setProgramId($programId){

      $this->programId=$programId;

    }

     public function getProgramId(){

        return $this->programId;
    	
    }


     public function setSubId($subId){

     	$this->subId =$subId;

    }

     public function getSubId(){

     	return $this->subId;
    	
    }


     public function setType($type){

     	$this->type=$type;

    }

     public function getType(){

     	return $this->type;
    	
    }


     public function setPurpose($purpose){

     	$this->purpose=$purpose;


    }

     public function getPurpose(){

     	return $this->purpose;
    	
    }    


     public function setDateCreate($dateNow){
     		$this->dateCreate =$dateNow;

    }

     public function getDateCreate(){
     	return $this->dateCreate;
    }  

    public function setDateEndClac($dateNow , $programLength){
     $dateNow->add(new DateInterval("P".$programLength."M"));
     $this->dateEnd = $dateNow;
    }

    public function setDateEnd($date){
      $this->dateEnd = $date;
    }

     public function getDateEnd(){
     	return $this->dateEnd;
    }    

     public function setProgramLength($programLength){

     		$this->programLength=$programLength;

    }

     public function getProgramLength(){
     	return $this->programLength;
    	
    }  

    public function setNote($note){

    	$this->note=$note;

    }

     public function getNote(){

     	return $this->note;
    	
    }


    public function setCreateBy($createBy){
 		$this->createBy =$createBy;

    }

     public function getCreateBy(){

     	return $this->createBy;
    	
    }     


    public function setDb($db)
    {
    	$this->db =$db;
    }   

    public function getDb()
    {
    	return $this->db;

    }

    public function setTrainings($trainings){

      $this->trainings =$trainings;

    }

    public function getTrainings(){

      return $this->trainings;
    }



    public function addProgram(){

	        $dateCreate = $this->getDateCreate()->format("Y-m-d");
	        $dateEnd = $this->getDateEnd()->format("Y-m-d");


    	$q = "INSERT INTO `training_programs`(`sub_id`, `type` ,`purpose`,`date_create`,`date_end`,`program_length`,`note`, `create_by`) VALUES ('$this->subId', '$this->type','$this->purpose','$dateCreate', '$dateEnd','$this->programLength','$this->note','$this->createBy')";

    		

    	$result = $this->db->query($q);

      if (!$result)
        return $result;

        $this->setProgramId($this->db->query("select LAST_INSERT_ID()")->fetch_array()[0]);

          return $this->addTrainings();
    }


  public function update()
  {
          $this->setProgramId($_GET['progId']);

        $q= "SELECT date_create FROM training_programs WHERE `program_id`= '$this->programId'";
        $result = $this->db->query($q);
        $row = $result->fetch_array(MYSQLI_ASSOC);



          $dateCreate = $row['date_create'];
          $this->setDateEndClac(new DateTime($dateCreate) , $this->programLength);
          $dateEnd = $this->getDateEnd()->format("Y-m-d");


      $q = "UPDATE `training_programs` SET `type`='$this->type' ,`purpose`='$this->purpose',`date_end`='$dateEnd',`program_length`='$this->programLength',`note`='$this->note', `create_by`='$this->createBy' WHERE `program_id`= '$this->programId'";

        

      $result = $this->db->query($q);

    if (!$result)
        return $result;

    $q =  "DELETE FROM `training_letter` WHERE `program_id`='$this->programId'";
    $result = $this->db->query($q);

    if (!$result)
        return $result;

    return $this->addTrainings();
  } 



  public function addTrainings(){

              $A =$this->mappingProgram('/^A_/');
              $B =$this->mappingProgram('/^B_/');


            switch ($this->getType()) {
              case 'ABC':
                $C =$this->mappingProgram('/^C_/');
                $this->setTrainings(new Trainings($A ,$B ,$C));
                break;
              case 'ABCD':
                $C =$this->mappingProgram('/^C_/');
                $D =$this->mappingProgram('/^D_/');
                $this->setTrainings(new Trainings($A ,$B ,$C,$D));
                break;

                default:
                $this->setTrainings(new Trainings($A ,$B));
                break;
            }



            foreach ($this->trainings->getA() as $key => $value) {
              $q ="INSERT INTO `training_letter` (`program_id`,`letter`,`muscle`,`exercise`,`sets`,`repeats`) VALUES ('$this->programId','A','$value[muscle]','$value[exercise]','$value[sets]','$value[repeat]')"; 
                 $result = $this->db->query($q);
             }

             foreach ($this->trainings->getB() as $key => $value) {
              $q ="INSERT INTO `training_letter` (`program_id`,`letter`,`muscle`,`exercise`,`sets`,`repeats`) VALUES ('$this->programId','B','$value[muscle]','$value[exercise]','$value[sets]','$value[repeat]')"; 
              $result = $this->db->query($q);
             }

             if (null !== $this->trainings->getC())
                foreach ($this->trainings->getC() as $key => $value) {
                  $q ="INSERT INTO `training_letter` (`program_id`,`letter`,`muscle`,`exercise`,`sets`,`repeats`) VALUES ('$this->programId','C','$value[muscle]','$value[exercise]','$value[sets]','$value[repeat]')"; 
                  $result = $this->db->query($q);
                }

              if (null !== $this->trainings->getD())
                foreach ($this->trainings->getD() as $key => $value) {
                  $q ="INSERT INTO `training_letter` (`program_id`,`letter`,`muscle`,`exercise`,`sets`,`repeats`) VALUES ('$this->programId', 'D','$value[muscle]','$value[exercise]','$value[sets]','$value[repeat]')"; 
                  $result = $this->db->query($q);
                }   


           return $result;
  
  }


  public function getProgram($programId ,$db)
  {
            $this->setDb($db);

            $q  =  "SELECT `sub_id` ,`type`,`purpose`,`date_create` ,`date_end`,`program_length`,`note`,`create_by` FROM `training_programs` WHERE `program_id`='$programId'";

            $result = $this->db->query($q);

            while ($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $this->setSubId($row['sub_id']);
                $this->setType($row['type']);
                $this->setPurpose($row['purpose']);
                $this->setDateCreate(new DateTime($row['date_create']));
                $this->setDateEnd(new DateTime($row['date_end']));
                $this->setProgramLength($row['program_length']);
                $this->setNote($row['note']);
                $this->setCreateBy($row['create_by']);


            }


            $this->trainings = new trainings();

            $q  =  "SELECT `letter` ,`muscle` ,`exercise`,`sets`,`repeats` FROM `training_letter` WHERE `program_id`='$programId' ORDER BY `id` ASC";

            $result = $this->db->query($q);

            while ($row = $result->fetch_array(MYSQLI_ASSOC))
            {
              switch ($row['letter']) {
                case 'A':
                  $this->trainings->setAarray($row);
                  break;
                case 'B':
                   $this->trainings->setBarray($row);
                  break;
                case 'C':
                  $this->trainings->setCarray($row);
                  break;
              case 'D':
                 $this->trainings->setDarray($row);
                  break;
              }


            }


  }


   private function mappingProgram($pattren)
   {
            $program=array();  

            foreach ($_POST as $key => $value) {
             if (preg_match($pattren, $key))
              $program[]=$value;
            }


             $programMap = array();

              $k=0;
              $j=0;

              for ($i=0 ; $i<count($program); $i++)
              {

              switch ($j) {
                case 0:
                 $programMap[$k]["muscle"]= $program[$i];
                  break;
                case 1:
                  $programMap[$k]["exercise"]= $program[$i];
                  break;
                case 2:
                  $programMap[$k]["sets"]= $program[$i];
                  break;
                case 3:
                  $programMap[$k]["repeat"]= $program[$i];
                  break;
              }

                $j++;

                if(($i+1)%4==0)
                {
                  $j=0; 
                  $k++;
                }
              }

              return $programMap;
   }


  

}





 ?>