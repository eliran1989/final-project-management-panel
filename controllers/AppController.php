<?php



    class AppController 
    {
        protected $model;
        protected $view;


        public function __construct($model , $view)
        {
         $this->model=$model;
         $this->view=$view;
        }
 

     public function initSection()
    {

    }


        public function userValidation()
        {
           $this->view->echoJson($this->model->checkUserValidation($_POST['tel'] , $_POST['pass']));
        } 

       public function changePassword()
       {
           if (isset($_POST['oldPass']))
           {

           }
           else{
             $this->view->echoBool($this->model->changePassFirstTime($_POST['id'],$_POST['newPass']));
           }
       }



       public function getPrograms()
       {
         $programs = $this->model->getPrograms($_POST['id']);
         $this->view->printPrograms($programs);
       }

       public function activeStudios(){

          $studios = $this->model->getStudios($_GET['subId']);

       }



    }
    
    
?>