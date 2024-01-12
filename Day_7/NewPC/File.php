<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Headers: *");
   if($_SERVER["REQUEST_METHOD"]=="POST"){
      $userData = fopen("./data/stList.json","r") or die("Unable to open the file.");
      $user = json_decode(fread($userData,filesize("./data/stList.json")));
      fclose($userData);
     if(isset($_POST["email"]) && isset($_POST["pass"])){
      foreach($user as $uObj){
         if($uObj->email == $_POST["email"] && $uObj->pass == $_POST["pass"]){
            echo(json_encode($uObj));
            break;
         }
      }
     }else{
      $inputData = file_get_contents("php://input");
      $inputData = json_decode($inputData);
      foreach($user as $uObj){
         if($uObj->email == $inputData->email && $uObj->pass == $inputData->pass){
            echo(json_encode($uObj));
            break;
         }
      }
     }
   }
   
?>