<?php


    class Controller
    {

        protected $model;
        protected $view;

        public function __construct($model , $view)
        {
         $this->view=$view;
         $this->model=$model;
         date_default_timezone_set("Israel");


        
        }


    public function setTemplate()
    {
        $this->view->getTemplate($this->title);
    }


        public function setSideBar()
        {
        $this->view->getSideBar((isset($_SESSION['user'])) ? $_SESSION['user'] : json_decode($_COOKIE['user'],true) );
            
        }
 
        public function checkUser()
        {
                 if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])){
                 $this->logOut();
                 exit();
                 }

        }


      public function login ()
       {
         if (isset($_POST['userName']) && isset($_POST['password']))
         {
               if ($user = $this->model->checkLogin($_POST['userName'] , $_POST['password']))
               {

                    if (isset($_POST['check'])){
                            if ($user['userType']=="trainer"){
                                setcookie('trainer', json_encode($user), time()+(86400 * 30)); 
                                header("Location:index.php?section=training"); 
                            }
                            else{
                             setcookie('user', json_encode($user), time()+(86400 * 30));  
                              header("Refresh:0");
                            }
                     }
                     else
                         if ($user['userType']=="trainer")
                         {
                          $_SESSION['trainer'] = $user;
                           header("Location:index.php?section=training");
                           exit();
                         }
                         else{
                         $_SESSION['user'] = $user;
                         $this->initSection();
                         }   
                     }
                 else
                 {
                     $this->view->getTemplate("התחברות");
                     $this->view->loginFailed();
                 }
            }
        else
        $this->initSection();
        }


        

        public function logOut()
        {
            
            if (isset($_COOKIE['user']) || isset($_COOKIE['trainer']))
            {
                if (isset($_COOKIE['user'])){
                 setcookie("user", '', time() - 3600);
                }

                if (isset($_COOKIE['trainer'])){
                 setcookie("trainer", "", time() - 3600); 
                }
                

            }
            else
            {
                session_unset(); 
                session_destroy(); 
            }
              $this->view->getTemplate("התחברות");
              $this->view->getLogin();
        }



    }


    
    
?>