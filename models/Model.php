<?php

include("db.php");

class Model
{
    protected $db;
	
    public function __construct(){	
        
        	$this->db= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

	        if($this->db->connect_error) {
            echo $this->db->connect_error;
            exit;
            }
		        mysqli_set_charset($this->db,"utf8");

        }


      public function checkLogin ($userName , $password)
        {
            $password= md5("space".$password);

           $q = "SELECT `firstName`,`lastName`,`userName` FROM mangers where `userName`='$userName' and `password` = '$password'";
            $result = $this->db->query($q);

            $row = $result->fetch_array(MYSQLI_ASSOC);

            if (count($row))
            {
              $row['userType']="manger";
              return $row;
            }
           else
           { 

               $q = "SELECT `firstName`,`lastName`,`userName` FROM trainers where `userName`='$userName' and `password` = '$password'";
               $result = $this->db->query($q);

               $row = $result->fetch_array(MYSQLI_ASSOC);


                if (count($row))
                {
                   $row['userType']="trainer";
                  return $row;
                }
              else
              return FALSE;
          }
        }

        
	

	}
	




?>
