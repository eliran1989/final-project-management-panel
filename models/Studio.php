<?php

require_once ("Lesson.php");

class Studio
{

	private $name;
	private $trainerId;
	private $lessons;
	private $studioId;
	private $catId;



	    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    	}


		public function __construct4($name , $trainerId, $catId ,$lessons){	

			$this->setName($name);
			$this->setTrainerId($trainerId);
			$this->setCatId($catId);
			$this->setLessons($lessons);
		}


		public function __construct5($name , $trainerId, $catId ,$studioId ,$lessons){	

			$this->setName($name);
			$this->setTrainerId($trainerId);
			$this->setCatId($catId);
			$this->setLessons($lessons);
			$this->setStudioId($studioId);
		}


	function setName($name){

		$this->name=$name;

	}

	function setTrainerId($trainerId){

		$this->trainerId=$trainerId;


	}

    function setCatId($catId){

		$this->catId=$catId;


	}
	function setLessons($lessons){

		$this->lessons=$lessons;
	}

  function setStudioId($studioId){

		$this->studioId=$studioId;
	}


	function getTrainerId(){

		return $this->trainerId;

	}
	function getCatId(){

		return $this->catId;

	}


	function getName(){

		return $this->name;

	}

	function getLessons(){

		return $this->lessons;

	}

	function getStudioId(){

		return $this->studioId;

	}


	function addNewStudio($db)
	{
		$trainerId= htmlspecialchars($db->real_escape_string($this->getTrainerId()));
		$catId=htmlspecialchars($db->real_escape_string($this->getCatId()));
		$name=htmlspecialchars($db->real_escape_string($this->getName()));

		$q="INSERT INTO `studio_lessons` (`trainer_id`,`cat_id`,`lesson_name`) VALUES ('$trainerId','$catId','$name')";


		if (!$db->query($q))
		{
			return FALSE;
		}



		 $studioId= $db->query("select LAST_INSERT_ID()")->fetch_array()[0];

	     $lessons = $this->getLessons();
        
		 	for ($i=0 ;$i<count($lessons);$i++){
		 		$day = $lessons[$i]->getDay();
				$time = $lessons[$i]->getTime();
		 		
               if (!$db->query("INSERT INTO `lesson` (`studio_id`,`day`,`time`) VALUES ('$studioId','$day','$time')"))
               	return FALSE;
			}

			return TRUE;




	}
	
}
	

	
	




?>
