<?php

   require_once ("Controller.php");

    class StudioController extends Controller
    {
        protected $title ="סטודיו";

        public function __construct($model , $view)
        {
         parent::__construct($model, $view);
        }
 

          
    public function initSection()
    {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->view->getStudio($this->getTrainersList(), $this->getCatList(), $this->getStudioLessons());


        
    }

    
    
        public function setSectionTemplate()
        {
            parent::setTemplate();
            parent::setSideBar();
            $this->view->getNavbar();
            $this->checkIfPost();
        }



        private function getTrainersList(){

         return $this->model->getTrainersList();

        }


        private function getCatList(){

         return $this->model->getCatList();

        }


        private function getStudioLessons(){

              return $this->model->getStudioLessons();
        }


        public function getStudioBySub(){

            $this->model->getStudioBySub($_POST['subId']);

        }



        private function checkIfPost(){
       #Check if http request is post and executed the model function  accordingly.

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
         $this->view->printMsg($this->model->{$_POST['postFunction']}(), $_POST['postFunction']);
        }

   }



    }
    
    
?>