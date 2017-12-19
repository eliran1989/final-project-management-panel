<?php

require_once ("Model.php");

class ReportsModel extends Model
{

	
public function __construct(){	
    parent::__construct();
}


public function allStudiosReport(){


$q = "SELECT subscriptions.id , subscriptions.firstName , subscriptions.lastName , studio_lessons.lesson_name FROM `subscriptions`INNER JOIN `subs_studios` ON subscriptions.id = subs_studios.subId INNER JOIN `studio_lessons` ON subs_studios.studioId = studio_lessons.id";

$result = $this->db->query($q);


	$studioArray = array();

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$lesson_name = $row['lesson_name'];
				unset($row['lesson_name']);
		    	$studioArray[$lesson_name][] =  $row;

	}



		return $studioArray;


}


public function getSubsByDateOfReg($start , $end)
{
   
	$q= "SELECT * FROM `subscriptions` WHERE `dateStart` BETWEEN '$start' AND '$end' ORDER BY `dateStart` DESC";
	$result = $this->db->query($q);
	$rows=array();

	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$row['dateStart']= date('d-m-y', strtotime($row['dateStart']));	
		$row['dateEnd']= date('d-m-y', strtotime($row['dateEnd']));	
		$rows[]=$row;
	}

	return $rows;

}

public function getSubsByDateOfEndSub($start , $end)
{
	$q= "SELECT * FROM `subscriptions` WHERE `dateEnd` BETWEEN '$start' AND '$end' ORDER BY `dateEnd` DESC";
	$result = $this->db->query($q);

	$rows=array();

	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$row['dateStart']= date('d-m-y', strtotime($row['dateStart']));	
		$row['dateEnd']= date('d-m-y', strtotime($row['dateEnd']));	
		$rows[]=$row;
	}

	return $rows;
}

public function agesBreakDown()
{
     
	$q= "SELECT `birthDate` ,`dateEnd` FROM `subscriptions`";
	$result = $this->db->query($q);


	$agesBreakDown = array();
	$agesBreakDown['14_20']=0;
	$agesBreakDown['21_30']=0;
	$agesBreakDown['31_40']=0;
	$agesBreakDown['41_50']=0;
	$agesBreakDown['50+']=0;

   
	while($row = $result->fetch_array(MYSQLI_ASSOC)){

		$row['active']= $this->checkActive(new DateTime($row['dateEnd']));
	 	 $age = floor((time() - strtotime($row['birthDate'])) / 31556926);

	 	 if ($row['active'])
	 	 {
	 	 	if ($age>=14 && $age<=20)
	 	 		$agesBreakDown['14_20']++;

	 	 	if ($age>=21 && $age<=30)
	 	 		$agesBreakDown['21_30']++;

	 	 	if ($age>=31 && $age<=40)
	 	 		$agesBreakDown['31_40']++;

	 	 	if ($age>=41 && $age<=50)
	 	 		$agesBreakDown['41_50']++;

	 	 	if ($age>50)
	 	 		$agesBreakDown['50+']++;
	 	 	}

	 	 

	}

 		return $agesBreakDown;
}



public function sexBreakDown()
{
     
	$q= "SELECT `sex` , `dateEnd` FROM `subscriptions`";
	$result = $this->db->query($q);


	$sexBreakDown = array();
	$sexBreakDown['man']=0;
	$sexBreakDown['woman']=0;

	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$row['active']= $this->checkActive(new DateTime($row['dateEnd']));

	  if($row['active'])
	  {
		if ($row['sex']=="ז")
			$sexBreakDown['man']++;
		if ($row['sex']=="נ")
			$sexBreakDown['woman']++;
	  }
	}

 		return $sexBreakDown;
}


    private function checkActive($dateEnd)
    {
        $today = new DateTime();

        if ($today>$dateEnd)
        return 0;
        else
        return 1;

    }



	
}