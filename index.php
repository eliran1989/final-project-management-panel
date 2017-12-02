


<?php


            try
            {

            $ini = ini_set("soap.wsdl_cache_enabled","0");

                $client = new SoapClient("http://api.itnewsletter.co.il/webServices/WebServiceSMS.asmx?wsdl");

                print_r($client);



            
            }
            catch (Exception $e)  
            {
            echo $e->getMessage();
            }    
                die;


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');  




 session_start();

    $sections = array(
        'default' => array('model' => 'HomeModel', 'view' => 'HomeView', 'controller' => 'HomeController'),
        'subs' => array('model' => 'SubModel', 'view' => 'SubView', 'controller' => 'SubController'),
        'reports' => array('model' => 'ReportsModel', 'view' => 'ReportsView', 'controller' => 'ReportsController'),
        'training'=>array('model' => 'TrainingModel', 'view' => 'TrainingView', 'controller' => 'TrainingController'),
        'studio'=>array('model' => 'StudioModel', 'view' => 'StudioView', 'controller' => 'StudioController'),
        'app' => array('model' => 'AppModel', 'view' => 'AppView', 'controller' => 'AppController')

    );


             if (isset($_SESSION['trainer']) || isset($_COOKIE['trainer']))
             {
                $section="training";
             }
             else
             {
                           if (isset($_GET['section']) && isset($sections[$_GET['section']]))
                             {
                                 $section=  $_GET['section'] ;
                             }
                             else
                             {
                                    $section="default";
                             }
             }



    


    foreach($sections as $key => $components){
        if ($section == $key) {
            $model = $components['model'];
            $view = $components['view'];
            $controller = $components['controller'];
            break;
        }
    }


    include("controllers/".$controller.".php");
    include("models/".$model.".php");
    include("views/".$view.".php");
    

    if (isset($model)) {
        $m = new $model();
        $v = new $view();
        $c = new $controller($m,$v);
    }

    $c->{ (isset($_GET['action']) && method_exists($c, $_GET['action'])) ? $_GET['action'] :  'initSection'}();





?>



