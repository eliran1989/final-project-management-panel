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



		public function registerSubToStudio(){


			$subID = htmlspecialchars($_POST['id']);
			$studioID = htmlspecialchars($_POST['studio_id']);


			$q="INSERT INTO `subs_studios` VALUES ('$subID', '$studioID')";

			return $this->db->query($q);
			


		}



		public function getStudioList($catId){

			$q="SELECT * FROM `studio_lessons` WHERE `cat_id`='$catId'";

			$result = $this->db->query($q);


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$rows[]=$row;
			}

			return $rows;


		}



		public function getStudioBySub($subId){

			$q="SELECT `studioId` FROM `subs_studios` WHERE '$subId'=`subId`";

			$result = $this->db->query($q);

			$studioNames = array();

			while($studioId = $result->fetch_array(MYSQLI_ASSOC)){

				$q="SELECT `id` , `lesson_name`  FROM `studio_lessons` WHERE '$studioId[studioId]'=`id`";



				$res = $this->db->query($q);

				while($studio = $res->fetch_array(MYSQLI_ASSOC)){
					$studioNames[] = array('id' => $studio['id'] , 'lesson'=> $studio['lesson_name']);

				}

			}

			return $studioNames;

			




		}



		public function getLessonByStudioId ($studioId){

			$q="SELECT `day`,`time` FROM `lesson` WHERE `studio_id`='$studioId'";
			$result = $this->db->query($q);
			$lessonArr =array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$lessonArr[]= $arrayName = array('day' => $row['day'], 'time'=>$row['time']);

			}

			return $lessonArr;
 
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


		public function getRegsByStudio($id){

		$q="SELECT `id` ,`firstName` , `lastName` FROM subscriptions INNER JOIN subs_studios ON subscriptions.id = subs_studios.subId AND subs_studios.studioId = '$id'";

			$result = $this->db->query($q);

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$subs[] = $row;
			}

			return $subs;
			
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
