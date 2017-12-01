<?php
	  
class Subscriber
{

  private $id;
  private $phone;
  private $firstName;
  private $lastName;
  private $birthDay;
  private $sex;
  private $email;
  private $address;
  private $subscribe;	
  private $password;
  private $dateStart;
  private $dateEnd;
	  
     public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

	function __construct2($id ,$subLength){
		$this->setId($id);
		$this->setSubscribe($subLength);
		$this->dateStart= new DateTime();
		$this->dateEnd = $this->calcDateEnd();
	}

  function __construct9($id , $phone ,$firsName, $lastName ,$birthDay,$sex,$subscribe ,$email ,$address)
  {
		 $this->setId($id);
		 $this->setPhone($phone);
		 $this->setFirstName($firsName);
		 $this->setLastName($lastName);
		 $this->setBirthDay($birthDay);
		 $this->setSex($sex);
		 $this->setSubscribe($subscribe);
		 $this->setEmail($email);
		 $this->setAddress($address);
		 $this->setPassword();
		 $this->dateStart=new DateTime();
		 $this->dateEnd = $this->calcDateEnd();
  		 $this->checkFields();
  }
  
  public function addNewSub($db){

     $id = htmlspecialchars($db->real_escape_string($this->getId()));
     $firstName = htmlspecialchars($db->real_escape_string($this->getFirstName()));
     $lastName = htmlspecialchars($db->real_escape_string($this->getLastName()));
     $phone = htmlspecialchars($db->real_escape_string($this->getPhone()));
     $email = htmlspecialchars($db->real_escape_string($this->getEmail()));
     $birtDate =$this->getBirthDay();
     $sex =$this->getSex();
     $address = $db->real_escape_string($this->getAddress());
     $password= $this->getPassword();
     $timeStart =$this->getDateStart();
     $timeEnd = $this->getDateEnd();

     $q = "INSERT INTO `subscriptions`(`id`, `firstName`, `lastName`, `birthDate`,`sex`,`phone`, `address`, `email`, `dateStart`, `dateEnd`,`password`) VALUES ('$id','$firstName','$lastName','$birtDate','$sex','$phone','$address','$email','$timeStart','$timeEnd','$password')";

    return $db->query($q);

  }


  public function registrationUpdate($db){
  	 $id =$this->getId();
  	 $timeStart =$this->getDateStart();
     $timeEnd = $this->getDateEnd();


     $q = "UPDATE `subscriptions` SET `dateStart`='$timeStart' , `dateEnd`='$timeEnd' WHERE `id`='$id'";
	 return $db->query($q);


  }
  
  
  public function checkFields()
{
	
  $errors = array();

    if($this->id==false){
   $errors[] = "תז לא נכונה"; 
   }
    if($this->phone==false){
   $errors[] = "מספר פאלפון לא נכון"; 
   }
      if($this->birthDay==false){
   $errors[] = "גיל לא נכון"; 
   }
   
         if($this->email==false){
   $errors[] = "אימייל שגוי"; 
   }


 if(count($errors) > 0) {
            foreach($errors as $error) {
                echo $error . "<br>";
            }
     
       exit;
 }
}
  
  
	  
	public function getId()
	{
	  return $this->id;
	}
  
	  public function setId($id)
	{
	    $this->id = is_numeric($id) ? $id: false ;
	}
  
   public function getPhone()
	{
	  return $this->phone;
	}
  
  
   public function setPhone($phone)
	{
	     $this->phone = is_numeric($phone) ? $phone: false ;
	}
  
   public function getFirstName()
	{
	  return $this->firstName;
	}
  
   public function setFirstName($firstName)
	{
	  $this->firstName=$firstName;
	}
  
   public function getLastName()
	{
  
	  return $this->lastName;
	}
  
	 public function setLastName($lastName)
	{
  
	 $this->lastName=$lastName;
	}
  
   public function getAddress()
	{
  
	  return $this->address;
	}
  
	 public function setAddress($address)
	{
  
	  $this->address=$address;
	}
   public function getBirthDay()
	{
  
	  return $this->birthDay->format('Y-m-d');
	}
  
	 public function setBirthDay($birthDay)
	{
	   $this->birthDay=new DateTime($birthDay);
	}

	public function setSex($sex)
	{
		$this->sex=$sex;
	}

	public function getSex()
	{
		return $this->sex;
	}
  
   public function getSubscribe()
	{
	return $this->subscribe;
	 
	}
  
	 public function setSubscribe($subscribe)
	{
		 $this->subscribe=$subscribe;
	
	}
  
   public function getEmail()
	{
		return $this->email;
	 
	}
  
	 public function setEmail($email)
	{
	$this->email=preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^" ,$email) ? $email: false;
	
	}
	
	  public function getPassword()
	  {
	  return $this->password;
	  }
  
	  public function setPassword()
	  {
	   $randomPassword =$this->randomPassword();
	   echo $randomPassword;
	   $this->sendSms($randomPassword);
	   $this->password = md5("space". $randomPassword);
	  }

  
 	 	public function getDateStart(){
	 	 return $this->dateStart->format('Y-m-d');
  	 	}
		
		 public function getDateEnd(){
	 	 return $this->dateEnd->format('Y-m-d');
  	 	}
  
	  public function calcDateEnd()
	  {
		 $this->dateEnd = new DateTime();
		 return $this->dateEnd->add(new DateInterval('P'.$this->subscribe.'M'));
	  }
	  
	  
	
	 private function randomPassword() {
	  $alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
	  $pass = array(); //remember to declare $pass as an array
	  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	  for ($i = 0; $i < 8; $i++) {
		  $n = rand(0, $alphaLength);
		  $pass[] = $alphabet[$n];
	  }
	  return implode($pass); //turn the array into a string
	  }


	  public function sendSms($password)
	  {


	  		$un = "elirana1989@gmail.com";
			$pw = "kQM9c9";
			$accid = 1625;
			$sysPW = "itnewslettrSMS";
			$t = date("Y-m-d H:i:s");

			try
			{
				$ini = ini_set("soap.wsdl_cache_enabled","0");

				$client = new SoapClient("http://api.itnewsletter.co.il/webServices/WebServiceSMS.asmx?wsdl");

				$params = array();
				$params["un"] = $un;
				$params["pw"] = $pw;
				$params["accid"] = $accid;
				$params["sysPW"] = $sysPW;
				$params["t"] = $t;

				$params["txtUserCellular"] = "SpaceGym";
				$params["destination"] = $this->getPhone();
				$params["txtSMSmessage"] = $password;
				$params["dteToDeliver"] = "";

				$result = $client->sendSMSrecipients($params)->sendSMSrecipientsResult;
		
			}

			catch (Exception $e)  
			{
			echo $e;
			}


	  }
	  
  
	  
  }
  
  
  
  
  
  
  
  
  
  ?>