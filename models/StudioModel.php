<?php

require_once ("Model.php");
require_once ("Lesson.php");
require_once ("Studio.php");

class StudioModel extends Model
{

	
		public function __construct(){	
		    parent::__construct();
		}

		public function getTrainersList(){

			$q="SELECT `id` ,`firstName`, `lastName` FROM `trainers`";

			$result = $this->db->query($q);


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$rows[]=$row;
			}

			return $rows;
		}


		public function getCatList(){

			$q="SELECT * FROM `studio_cat`";

			$result = $this->db->query($q);


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$rows[]=$row;
			}

			return $rows;
		}


		public function getStudioLessons(){


			$q="SELECT * FROM `studio_lessons`";

			$result = $this->db->query($q);
			$studioArr =array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
					
				$name = $row['lesson_name'];
				$trainerId =$row['trainer_id'];
				$catId =$row['cat_id'];

				$q="SELECT `day`,`time` FROM `lesson` WHERE `studio_id`='$row[id]'";
				$lessonResult = $this->db->query($q);

			
				while ( $rowLesson = $lessonResult->fetch_array(MYSQLI_ASSOC)) {
					$lessons[]= new Lesson($rowLesson['day'] , $rowLesson['time'],$row['id']);
				}
				
				

				$studioArr[]= new Studio($name , $trainerId, $catId, $row['id'] ,$lessons);

			}


			return $studioArr;




		}



		public function addStudio(){
          //order lessons day and time
			$days =array();
			$times = array();

			foreach ($_POST as $key => $value) {
					if(preg_match("/^day/", $key))
						$days[$key]=$value;
				}

			  foreach ($_POST as $timeKey => $timeValue) {

					if(preg_match("/^time/", $timeKey))
					{

						foreach ($days as $daysKey => $daysValue) {

							if (preg_match("/".$daysKey."$/", $timeKey)){
								$tempLessons[substr($daysKey , 3)] = new Lesson($daysValue ,$timeValue);
								
							}

						}

					}
			  }		


			  for ($i=0 ; $i<8 ; $i++)
			  {
			  	if(isset($tempLessons[$i]))
			  	{
			  		$lessons[] = $tempLessons[$i];
			  	}

			  }

			  //finsih to order 

			  	$studio = new Studio($_POST['name'] ,$_POST['trainer'] ,$_POST['catId'] ,$lessons);
			  	return $studio->addNewStudio($this->db);

		}

}

?>
