<?php
// 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: *");
switch($_POST["req"]){
   case "sid":
      session_start();
      $data = ['sid'=>session_id()];
      $_SESSION["testVal"] = $_POST["name"];
      echo json_encode($data);
   break;
   case "load":
      session_id($_POST["sid"]);
      session_start();
      echo $_SESSION["testVal"];
   break;

}


?>