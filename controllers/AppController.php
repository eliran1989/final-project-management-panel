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


           public function registerToStudio(){

               if ($this->model->registerToStudio())
                  echo "true";
           }


           public function startTraining(){


              echo $this->model->startTraining($_POST['programId'] , $_POST['letter']);

           }


           public function endTraining(){

              echo $this->model->endTraining($_POST['trackId']);

           }




       public function getPrograms()
       {
         $programs = $this->model->getPrograms($_POST['id']);
         $this->view->printPrograms($programs);
       }

       public function activeStudios(){

          $this->view->echoJson($studios = $this->model->getStudios($_POST['id']));

       }


       public function updateDetails(){
            $this->model->updateDetails($_POST);
        }




    }
    
    
?>