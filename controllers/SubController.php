<?php

   require_once ("Controller.php");

    class SubController extends Controller
    {
        protected $title ="מנויים";
        public function __construct($model , $view)
        {
         parent::__construct($model, $view);
        }
 
   
          
    public function initSection()
    {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->checkIfPost(); 
        $lastReg = $this->model->getLastRegisters();
        $this->view->getSub($lastReg);
    }



    public function showSubDetails()
    {
        $this->view->printJson($this->model->subDetails($_POST['id']));
    }


   public function search()
   {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->checkIfPost();
        $this->view->getSearch($this->model->searchSubs($_GET['query']));



   }
    
  
   private function setSectionTemplate()
   {
        parent::setTemplate();
        parent::setSideBar();
        $this->view->getNavbar();
   }



   private function checkIfPost(){
       #Check if http request is post and executed the model function  accordingly.

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
          $this->view->printMsg($this->model->{$_POST['postFunction']}($_POST) , $_POST['postFunction']);
        }

   }



}
    
    
?>