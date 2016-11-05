

<?php
    
require_once("View.php"); 

class View
{

 public function __construct() {
	

 }
	

 public function getSideBar($user)
 {
     include("sharedViews/sideBar.phtml");
 }

 public function getLogin()
 {
     include ("sharedViews/login.phtml");
 }

  public function loginFailed()
 {
    $alert="danger";
    $msg="שם משתמש ו\או סיסמא שגויים";
    $icon="glyphicon glyphicon-exclamation-sign";
     
     include ("views/sharedViews/login.phtml");
     include("views/sharedViews/alertMsg.phtml");
 }

public function getTemplate($title)
{
    include ("sharedViews/template.phtml");
}

public function echoJson($rows)
{
print json_encode($rows);
}
    
}





?>