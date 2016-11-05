<?php

   require_once ("Controller.php");
   require_once ("models/SubModel.php");

    class HomeController extends Controller
    {
        protected $title ="בית";
        public function __construct($model , $view)
        {
         parent::__construct($model, $view);
        }
 

          
    public function initSection()
    {
        parent::checkUser();
        $subModel= new SubModel();
        $subsCount = $subModel->subsCount();
        $this->setSectionTemplate();
        $this->view->getHome($subsCount);
    }

    
    
    public function setSectionTemplate()
    {
        parent::setTemplate();
        parent::setSideBar();
        $this->view->getNavbar();
    }


    }
    
    
?>