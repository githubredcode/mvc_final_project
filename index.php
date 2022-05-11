<?php


const FOLDER ="/mvc_final_project";

// echo $_SERVER['DOCUMENT_ROOT'].FOLDER."/config/ini.php";
require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/config/ini.php");


$currentUser =  User::isLogged(); // true / false --> user object
// $currentUser =  User::logout(); // true / false --> user object
// print_r($_SESSION);
echo"<pre>";
print_r($currentUser);
echo"</pre>";
echo "<br>";
echo "<br>";

// conexion A bbdd
 $connect_obj = new DBConnection();
 $connection = $connect_obj->getConnection();

  $rc = new RouterController();
 // print_r($_SERVER);
  print_r($rc);// --> object controller
  echo "<br>";
  echo "<br>";
  echo "<br>";
  $rc->manageUris();
    

?>