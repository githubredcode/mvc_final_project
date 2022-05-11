<?php
    class Session{

        private $data;
        private $logged; // true - false
        
        public function __construct()
        {
            session_start();

            $this->logged = false;
            $this->data = [];

            // hay login?
            if( !empty($_SESSION['id']) && !empty($_SESSION['email'])){
                $this->logged = true;
                $this->data = $_SESSION;
            }
        }

        // Guardar info en SESSION
        public function save( $id, $email ){
            $_SESSION['id'] = $id;
            $_SESSION['email'] =  $email;
            $this->logged = true;
            $this->data = $_SESSION;
        }

        public function isLogged(){
            return $this->logged;
        }

        public function getData(){
            return $this->data;
        }
        public function getDataId(){
            return $this->data['id'];
        }
        public function getDataEmail(){
            return $this->data['email'];
        }

        public function destroy(){
            session_unset();
            setcookie( session_name(),"", -1 );
            session_destroy();
            $this->logged = false;
            $this->data = [];
        }

    }

?>