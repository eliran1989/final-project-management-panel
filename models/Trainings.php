  <?php

  class Trainings
  {

  	private $A;
  	private $B;
  	private $C;
  	private $D;


    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }


    public function __construct0() {


    }


    public function __construct2($A,$B) {
        $this->setA($A);
        $this->setB($B);

    }


    public function __construct3($A,$B,$C) {
        $this->setA($A);
        $this->setB($B);
        $this->setC($C);
    }



    public function __construct4($A,$B,$C,$D) {
        $this->setA($A);
        $this->setB($B);
        $this->setC($C);
        $this->setD($D);
    }


    public function getA()
    {
      return $this->A;
    }

    public function setA($A)
    {
      $this->A=$A;
    }

    public function setAarray($A)
    {
      $this->A[]=$A;

    }

    public function getB()
    {
      return $this->B;
    }

    public function setB($B)
    {
      $this->B=$B;
    }

    public function setBarray($B)
    {
        $this->B[]=$B;
      
    }


    public function getC()
    {
      return $this->C;
    }

    public function setC($C)
    {
      $this->C=$C;
    }

    public function setCarray($C)
    {
        $this->C[]=$C;
      
    }



    public function getD()
    {
      return $this->D;
    }

    public function setD($D)
    {
      $this->D=$D;
    }

    public function setDarray($D)
    {
        $this->D[]=$D;
      
    }





  }