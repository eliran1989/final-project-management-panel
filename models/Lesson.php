<?php



class Lesson
{

	private $day;
	private $time; 
	private $studioId;



	    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

       		 if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        	}
    	}


   public function __construct2($day , $time ){

			$this->setDay($day);
			$this->setTime($time);
 		
	}	

	public function __construct3($day , $time ,$studioId){

			$this->setDay($day);
			$this->setTime($time);
			$this->setStudioId($studioId);

 		
	}



	public function setDay($day)
	{
		$this->day=$day;
	}


	public function setTime($time)
	{
		$this->time=$time;

	}

   public function setStudioId($studioId)
	{
		$this->studioId=$studioId;

	}

	public function getDay()
	{

		return $this->day;

	}

	public function getTime(){
		return $this->time;
		//return substr($this->time,0 ,-3);

	}

		function getStudioId(){

		return $this->studioId;

	}

	
}
	

	
	




?>