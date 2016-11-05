

<?php
    
require_once("View.php"); 

class HomeView extends View
{

 public function __construct() {
	

 }
	


public function getHome($subsCount)
{

  include("views/home/home.phtml");
}

    
public function getNavbar()
{
    include_once("views/home/navbar.phtml");

}


    
}





?>