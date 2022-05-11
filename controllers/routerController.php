<?php

/**
 * Controlador Principal que se encarga de manejar las rutas
 */
class RouterController
{
    private $method;
    private $uri;

    public function __construct()
    {
        $this->method   =   $_SERVER['REQUEST_METHOD'];
        $this->uri  = str_replace(FOLDER, "",   $_SERVER['REQUEST_URI']); // --> /mvc_final_project/
    }

    public function manageUris()
    {

        $webController = new WebController();
        $userController = new userController();

        if ($this->method == "GET" && ($this->uri ==  "/" || $this->uri == "/home")) {

            $webController->index();
        }

        if ($this->method == "GET" && $this->uri == "/services") {

            $webController->services();
        }

        if ($this->method == "GET" && $this->uri == "/signup") {

            echo "Estamos en SIGNUP";
            $webController->signup();
        }

        if ($this->method == "POST" && $this->uri == "/signup") {

            // Registro usuario
            echo "REGISTRO USUARIO en SIGNUP";
            $userController->signup();
        }

        if ($this->method == "GET" && $this->uri == "/login") {
            $webController->login();
        }
        // LOGIN USER
        if ($this->method == "POST" && $this->uri == "/login") {
            // LOGIN de usuario    
            $userController->login();
        }


        // LOGOUT USER
        if ($this->method == "GET" && $this->uri == "/logout") {
            $webController->login();
        }

        if ($this->method == "POST" && $this->uri == "/logout") {
            // logout de usuario   
            echo "Entamos en logout"; 
          // header("Location ".FOLDER." /signup");
         //   header("Location: index.php");
            $userController->logout();
        }



        // user / :id
        if ($this->method == "GET" && preg_match("/^\/user\/[0-9]+$/i", $this->uri)) {

            $id = str_ireplace("/user/", "", $this->uri);
            //  echo $this->uri;
            $userController->show($id);
        }
    }
}
