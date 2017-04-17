

<?php
    
require_once("View.php"); 

class StudioView extends View
{

	 public function __construct() {
		

	 }
	


		public function getStudio($trainersList ,$catList ,$studioLessons)
		{
		  include("views/studio/studio.phtml");
		}

    
		public function getNavbar()
		{
		    include_once("views/studio/navbar.phtml");

		}

		public function printMsg($bool , $type)
		{


		  if ($bool)
		  {
		       switch ($type) {
		          case 'addStudio':
		            $msg="שיעור הסטודיו נוסף בהצלחה";
		            break;
		           case 'registerSubToStudio':
		            $msg = 'רישום המנוי לשיעור התבצע בהצלחה.';
		            break;


		          default:
		            # code...
		            break;
		          }

		    $alert="success";
		    $icon = "glyphicon glyphicon-ok";

	  		}
	 		 else{
			       switch ($type) {
			          case 'addStudio':
			             $msg="הוספת שיעור הסטודיו נכשלה. יש לנסות שנית.";
			            break;
			  
			          default:
			            # code...
			            break;
			  		  }

			      $alert="danger";
			      $icon="glyphicon glyphicon-exclamation-sign";

  				}


  			include_once("views/sharedViews/alertMsg.phtml");
  

		}
 


    
}





?>