<?php
   header("Access-Control-Allow-Origin: *");
   if($_SERVER["REQUEST_METHOD"]=="POST"){
      $path = $_SERVER["PATH_INFO"];
      switch($path){
         case "/read":
            $addr = "./data/".$_POST["filename"].".json";
            $file = fopen($addr,"r") or die("Not able to open the file");
            $data = fread($file,filesize($addr));
            fclose($file);
            echo $data;
         break;
         case "/record":
            $userID = $_POST["uid"];
            if(!is_dir("./userData/$userID")){
               mkdir("./userData/$userID");
            }
            $file = fopen("./userData/$userID/shoppinglist.json","w") or die("Can not open the file");
            fwrite($file,$_POST["data"]);
            fclose($file);
            echo "shopping list saved.";
         break;
      }
   }else{
      http_response_code(400);
      echo ("Bad request");
   }

?>