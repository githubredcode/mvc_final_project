<?php

class UserController
{

    public function __construct()
    {
    }
    public function show($id)
    {

        try {
            // ir a por el usuario 1
            // la peticion a la BDD lo haremos desde la clase user.class.php
            $user = User::getById($id);
            echo "<br><br>";
            require_once($_SERVER['DOCUMENT_ROOT'] . FOLDER . "/views/user/show.php");
        } catch (\Throwable $th) {

            echo "Error " . $th->getMessage();
        }
    }

    public function signup()
    {
        try {
         
      
           User::signup(); // metodo de validar los campos y crear usuario
            $user = User::login();
            header("Location: ".FOLDER."/");

        
        } catch (\Throwable $th) {
            echo "ERROR" . $th->getMessage();
            $error = $th->getMessage();

            // plantilla formulario de signup --> error donde corresponda
            require_once($_SERVER['DOCUMENT_ROOT'] . FOLDER . "/views/user/signup.php");

            //header
            // header("Location ".FOLDER." /signup)error=245");
        }
    }




    public function login(){
        try {
            
            $user = User::login(); // User Object()
            
        } catch (\Throwable $th) {
            
            print_r($th->getMessage());
        }
    }


    public function logout(){
        try {

            $user =  User::logout(); // User Object() 
            //echo "LOGPOUT";
         
      
        } catch (\Throwable $th) {
            
            echo "ERROR" . $th->getMessage();
        }
    }

}



