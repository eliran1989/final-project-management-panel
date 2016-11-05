

<?php
    
require_once("View.php"); 

class TrainingView extends View
{

 	public function __construct() {
	

 	}
	


	public function getSideBar($user)
	{
		 include("training/sideBar.phtml");
	}
	
	public function getTrainingSection(){
 		include("training/training.phtml");	
	}

	public function getTrainingPrograms($sub ,$programs)
	{
       include("training/sub-training-program.phtml");
	}

    public function getSearch($subs)	
    {

    	if (count($subs)==0)
			echo "<div class='col-md-10'><h3><small>לא נמצאו תוצאות עבור: ". $_GET['query']."</small></h3></div>";
		else
 		  include("training/search.phtml");
	}

	public function addProgramInterFace($sub){
     include("training/add-program.phtml");
	}

	public function navBar(){
    	include("training/navbar.phtml");
	}


	public function addProgramMsg($bool)
	{
      echo $bool;
  	 if ($bool)
     {
    	$alert="success";
    	$msg="התוכנית נוספה בהצלחה.";
    	$icon = "glyphicon glyphicon-ok";
  	 }
  	 else
  	 {
    	$alert="danger";
    	$msg="אירעה שגיעה יש לנסות מאוחר יותר.";
    	$icon="glyphicon glyphicon-exclamation-sign";
  	 }

       include_once("views/sharedViews/alertMsg.phtml");
	}


  public function updateProgramMsg($bool)
  {
      echo $bool;
     if ($bool)
     {
      $alert="success";
      $msg="תוכנית האימון עודכנה בהצלחה";
      $icon = "glyphicon glyphicon-ok";
     }
     else
     {
      $alert="danger";
      $msg="אירעה שגיעה יש לנסות מאוחר יותר.";
      $icon="glyphicon glyphicon-exclamation-sign";
     }

       include_once("views/sharedViews/alertMsg.phtml");
  }


  	public function showProgram($program){

  		$A =$program->getTrainings()->getA();
  		$B =$program->getTrainings()->getB();

  		$C =$program->getTrainings()->getC();

  		 $D =$program->getTrainings()->getD();


  		   switch ($program->getProgramLength()) {
  				case '2':
      				$programLength = "חודשיים";
   			    break;
  				case '3':
      				$programLength = "שלושה חודשים";
    			break;

  				case '6':
      				$programLength = "חצי שנה";
    			break;
  				case '12':
      				$programLength = "שנה";
    			break;
			}

  		 $note = $program->getNote();
  		 $dateCreate = $program->getDateCreate();
  		 $createBy = $program->getCreateBy();
  		 $purpose = $program->getPurpose();
  		 $type = $program->getType();
  		 $Length = $program->getProgramLength();

       

		include("views/training/program.phtml");
    include("views/training/editProgram.phtml");
  	}

    
}





?>