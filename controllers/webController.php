<?php

    class WebController
    {
        
        public function __construct( )
        {   
            
        }

        public function index(){

          global $currentUser;
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/web/home.php"); 
          echo "Hola Mundo";

        }

        public function services(){

          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/web/services.php"); 

        }

        public function signup(){
          global $currentUser;
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/signup.php"); 

        }

        public function login(){
          global $currentUser;
          if($currentUser){
          //die ("Voy ha mandar al usuario a /");
          header("Location:".FOLDER."/");

          }

          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/login.php");

        }
    }

?>