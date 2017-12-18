<?php

   require_once ("Controller.php");

    class ReportsController extends Controller
    {
        protected $title ="דוחות";
        public function __construct($model , $view)
        {
         parent::__construct($model, $view);
        }
 

          
    public function initSection()
    {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->view->getMain();
    }

    
    
    public function setSectionTemplate()
    {
        parent::setTemplate();
        parent::setSideBar();
        $this->view->getNavbar();

    }


    public function showReport()
    {
        parent::checkUser();
       $this->setSectionTemplate();
       
       switch ($_GET['num']) {
            case 1:  // Subscriptions by date of registration
            $this->view->showReport(1);
            break;
            case 2:  // Subscriptions by date of end sub
            $this->view->showReport(2);
            break;
            case 3:  // age breakdown
            $this->view->showReport(3);
            break;
            case 4:  // sex breakdown
            $this->view->showReport(4);
            break;
            case 5:  // studio report
            $this->view->showReport(5);
            break;
            case 6:  // studio lesson report
            $this->view->showReport(6);
            break;


        default:
     
    }
    }

    public function reportsSubsMain()
    {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->view->reportsSubsMain();
    }

    public function reportsStudiosMain()
    {
        parent::checkUser();
        $this->setSectionTemplate();
        $this->view->reportsStudioMain();
    }



    public function subsByDateOfReg()
    {
       $rows = $this->model->getSubsByDateOfReg($_GET['startDate'],$_GET['endDate']);
       $this->view->echoJson($rows);

    }

    public function subsByDateOfEndSub()
    {
       $rows = $this->model->getSubsByDateOfEndSub($_GET['startDate'],$_GET['endDate']);
       $this->view->echoJson($rows);

    }

    public function agesBreakDown()
    {

        $this->view->echoJson($this->model->agesBreakDown());

    }


    public function sexBreakDown()
    {

        $this->view->echoJson($this->model->sexBreakDown());

    }


    }
    
    
?>