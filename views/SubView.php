<?php
    
require_once("View.php"); 

class SubView extends View
{

 public function __construct() {
	

 }


public function getSub($lastReg)
{
	include("views/subs/subs.phtml");
}
	

public function printJson($row){


echo json_encode($row ,JSON_UNESCAPED_UNICODE);


}

public function printMsg($bool , $type)
{


  if ($bool)
  {
       switch ($type) {
          case 'updateDetails':
            $msg="פרטי המנוי עודכנו בהצלחה";
            break;

          case 'registrationUpdate':
            $msg="חידוש המנוי הצליח";
            break;

          case 'addNewSub':
            $msg="הרישום התבצע בהצלחה";
            break;


          default:
            # code...
            break;
          }

    $alert="success";
    $icon = "glyphicon glyphicon-ok";

  }
  else
  {
       switch ($type) {
          case 'updateDetails':
             $msg="עידכון פרטי המנוי נכשל. יש לנסות שנית";
            break;

          case 'registrationUpdate':
            $msg="חידוש המנוי לא הצליח יש לנסות שנית";
            break;

          case 'addNewSub':
            $msg="המנוי כבר מופיע במערכת.<br>הרישום נכשל.";
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
 

    
public function getNavbar()
{
    include_once("views/subs/navbar.phtml");

}

public function getSearch($subs)
{
if (count($subs)==0)
echo "<div class='col-md-10'><h3><small>לא נמצאו תוצאות עבור: ". $_GET['query']."</small></h3></div>";
else
include("views/subs/search.phtml");

}


}





?>