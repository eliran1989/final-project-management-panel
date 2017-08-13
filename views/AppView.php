

<?php
    
require_once("View.php"); 

class AppView extends View
{

 public function __construct() {
	

 }

public function echoBool($bool)
{
if ($bool)
	echo "true";
else
	echo "false";
}



public function printPrograms($programs)
{
	$arr = array();

	for ($i=0 ; $i<count($programs) ;$i++)
	{
		$arr[$i]['program_id'] = $programs[$i]->getProgramId();
		$arr[$i]['type'] = $programs[$i]->getType();
		$arr[$i]['purpose'] = $programs[$i]->getPurpose();
		$arr[$i]['dateCreate'] = $programs[$i]->getDateCreate()->format("d-m-y");
		$arr[$i]['dateEnd'] = $programs[$i]->getDateEnd()->format("d-m-y");
		$arr[$i]['createBy'] = $programs[$i]->getCreateBy();
		$arr[$i]['note'] = $programs[$i]->getNote();

        switch ($programs[$i]->getProgramLength()) {
        	case 2:
        	$arr[$i]['length'] = "חודשיים";
        		break;
       		case 3:
        	$arr[$i]['length'] = "שלושה חודשים";
        		break;
        	case 6:
        	$arr[$i]['length'] = "חצי שנה";
        		break;
        	case 12:
        	$arr[$i]['length'] = "שנה";
        		break;
        }

		$arr[$i]['A']= $programs[$i]->getTrainings()->getA();
		$arr[$i]['B']= $programs[$i]->getTrainings()->getB();

		if ($programs[$i]->getTrainings()->getC()!=NULL)
			$arr[$i]['C']= $programs[$i]->getTrainings()->getC();
		
		if ($programs[$i]->getTrainings()->getD()!=NULL)
			$arr[$i]['D']= $programs[$i]->getTrainings()->getD();
	}

	$this->echoJson($arr);
}

    
}





?>