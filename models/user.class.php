<?php

class User extends DBConnection
{
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $created_at;

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    function __get($name)
    {
        return $this->$name;
    }

    // Obtiene un usuario de la BBDD y devuelve un user object
    public static function getBYID($id)
    {
        //  1. conectar BBDD
        global $connection;
        echo "<br><br><br>";

        //  2. SQL query
        $query = "SELECT * FROM user WHERE id = $id";
        echo $query;
        //  3. ejecutar query
        $execq =  $connection->query($query);
        echo "<br><br>";

        //  4. recojer usuario
        if ($connection->error) {
            throw new Exception("Error al obtener un usuario");
            return true;
            $connection->error;
        }

        if ($execq->num_rows != 1) {
            return true;
            //throw new Exception("No se encuentra al usuario");
        }
        //  5. devolver un user pbject
        $user_bd = $execq->fetch_assoc();

        $user = new User($user_bd);


        return $user;
    }

    public static function signup()
    {
        // 1. Validar campos
        // correo y password esta ok?
        if (!self::validateFields()) {
            throw new Exception("Campos no válidos");
        }

        // 2. Conexión
        global $connection;

        $email = $_POST['email'];

        $query_email = "SELECT id FROM user WHERE email = '$email'";
        $exec_q_email = $connection->query($query_email);

        if ($connection->error) {
            throw new Exception("Error al obtener usuario por email: " . $connection->error);
        }
        if ($exec_q_email->num_rows != 0) {
            throw new Exception("Este usuario ya está registrado");
        }

        // 5. Errores...
        // 6. query (Insert)
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //die(    $password );

        $query_insert = "INSERT INTO `user`(`email`, `password`) VALUES ('$email', '$password')";

        // 7. ejecutar query
        $connection->query($query_insert);

        // 8. Errores...
        if ($connection->error) {
            throw new Exception("Error al crear usuario: " . $connection->error);
        }

        // usuario registrado

    }

    public static function login()
    {

            // Validación de campos
            if( !self::validateFields() ){
                throw new Exception("Campos no válidos");
            }

            // preguntar si existe un usuario por email
            global $connection;
            $email = $_POST['email'];

            $query_email = "SELECT * FROM user WHERE email = '$email'";
            $exec_q_email = $connection->query( $query_email );
           // print_r($exec_q_email);

            if( $connection->error ){
                throw new Exception( "Error al obtener usuario por email: ". $connection->error );
            }
            if ($exec_q_email->num_rows != 1 ){
                throw new Exception( "El usuario no está registrado");
            }

            $user_bbdd = $exec_q_email->fetch_assoc();
            // print_r($user_bbdd);
            $password = $_POST['password'];
           
            if ( !password_verify( $password, $user_bbdd['password'] )){
                throw new Exception( "La contraseña es incorrecta");
            }

            // Hemos hecho LOGIN!
            $user = new User( $user_bbdd );
            print_r($user);

            $user->create_session();

            return $user;

       
    }

    private function create_session(){
        // 2 
        $_SESSION['id'] = $this->id;
        $_SESSION['email'] = $this->email;

    }

    public static function isLogged(){
            session_start();

            if(isset( $_SESSION['id']) ){
                
                $user = new User( $_SESSION );
                return $user;
            }
            return false;
    }


    /* Logout */

    public static function logout(){
        global  $currentUser;
       if(isset($currentuser)){
           setcookie( session_name(), time()-1 );
           //setcookie('PHPSESSID', " " , time()-1 );
           unset( $_SESSION );
           session_destroy();
        }
        return false;
    }




    private static function validateFields(){
            if( 
                !isset($_POST['email']) ||
                !isset($_POST['password']) ||
                empty($_POST['email']) ||
                empty($_POST['password']) 
            ){
                throw new Exception("Campos obligatorios: email y password");
            }
    
            if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){
                return false;
            }

            if( strlen($_POST['password'])<6 ){
                return false;
            }

            return true;
            
        } 






}
