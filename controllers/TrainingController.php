<?php

   require_once ("Controller.php");

    class TrainingController extends Controller
    {
        protected $title ="תוכנית אימונים";
        public function __construct($model , $view)
        {
         parent::__construct($model, $view);
        }
 
 
        public function checkUser()
        {
             if (!isset($_SESSION['trainer']) && !isset($_COOKIE['trainer'])){
                $this->logOut();
                exit();
                }

        }

          
    public function initSection()
    {
        $this->checkUser();
        $this->setSectionTemplate();
        $this->view->getTrainingSection();
    }

    
    private function setSectionTemplate()
    {
        parent::setTemplate();
        $this->view->getSideBar((isset($_SESSION['trainer'])) ? $_SESSION['trainer'] : json_decode($_COOKIE['trainer'],true) );
    }

    public function search()
    {
        $this->checkUser();
        $this->setSectionTemplate();
        $this->view->navBar();
        $subs = $this->model->searchSubs($_GET['query']);

        if (count($subs)!=1)
        {
            $this->view->getSearch($subs);
        }
        else
        {
            $sub = $this->_getSub($subs);
            $programs = $this->model->getSubPrograms($sub['id']);

          
            for ($i=0; $i < count($programs) ; $i++) { 
              
                $programs[$i]['track_percent'] = $this->model->get_track_precent($programs[$i]['program_id'] , $programs[$i]['type'] , $programs[$i]['date_create']);

            }


            $this->view->getTrainingPrograms($sub , $programs);
        }

    }



    public function showSubPrograms(){

        if (isset($_POST['trainingType']))
        {
          $bool = $this->model->addProgram();
        }

       $this->checkUser();
       $this->setSectionTemplate();
       $this->view->navBar();
       $sub = $this->getSub();
       $programs = $this->model->getSubPrograms($sub['id']);

       
          

          for ($i=0; $i < count($programs) ; $i++) { 
            
              $programs[$i]['track_percent'] = $this->model->get_track_precent($programs[$i]['program_id'] , $programs[$i]['type'] , $programs[$i]['date_create']);

          }



       $this->view->getTrainingPrograms($sub ,$programs);

      if (isset($bool))
      {
         $this->view->addProgramMsg($bool);
      }
    }

    public function addProgramInterface(){
       $this->checkUser();
       $this->setSectionTemplate();
       $this->view->navBar();
       $this->view->addProgramInterface($this->getSub());

    }


    public function showProgram()
    {

        if (isset($_POST['trainingType']))
        {
           $bool = $this->model->updateProgram();
        }

       $this->checkUser();
       $this->setSectionTemplate();
       $this->view->navBar();
       $program = $this->model->getProgram($_GET['progId']);
       $tracking_details = $this->model->getTrakingDetails($_GET['progId']);

       $this->view->showProgram($program , $tracking_details);

      if (isset($bool))
      {
         $this->view->updateProgramMsg($bool);
      }

    }


    private function getSub(){
       $sub['id'] = $_GET['id'];
       $sub['firstName'] = $_GET['firstName'];
       $sub['lastName'] =$_GET['lastName'];
       return $sub;
    }

    private function _getSub($subs){
        $sub['id'] = $subs[0]['id'];
        $sub['firstName'] = $subs[0]['firstName'];
        $sub['lastName'] = $subs[0]['lastName'];
        return $sub;
    }

    public function getExercise(){

      $this->view->echoJson($this->model->getExerciseList($_GET['muscleName']));

    }

    public function getMuscles(){
        $this->view->echoJson($this->model->getMusclesList());
    }



    }
    
    
?>