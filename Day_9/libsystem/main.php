<?php
   include("./phpConfig.php");
   header("Access-Control-Allow-Origin: *");
   // echo($_SERVER["REQUEST_URI"]);
   // echo($_SERVER["PATH_INFO"]);
   if($_SERVER["REQUEST_METHOD"]=="POST"){
      $dbcon = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
      if($dbcon->connect_error){
         die("Connection Error: ".$dbcon->connect_error);
      }else{
      $path = $_SERVER["PATH_INFO"];
      switch($path){
         case "/reg":
               $insertCmd = $dbcon->prepare("INSERT INTO customers_tb (fname,lname,email,pass,addr) VALUES (?,?,?,?,?)");
               $pass = password_hash($_POST["pass"],PASSWORD_BCRYPT,["cost"=>10]);
               $insertCmd->bind_param("sssss", $_POST["fname"], $_POST["lname"], $_POST["email"], $pass, $_POST["addr"]);
               $insertCmd->execute();
               echo "Registeration success";
               $insertCmd->close();
               $dbcon->close();
            break;
         case "/login":
            $logCmd = "SELECT * FROM customers_tb WHERE email='".$_POST["email"]."'";
            $result = $dbcon->query($logCmd);
            if($result->num_rows > 0){
               $user = $result->fetch_assoc();
               if(password_verify($_POST["pass"],$user["pass"])){
                  session_start();
                  $_SESSION["user"] = $user;
                  $response = ["sid"=>session_id()];
                  echo json_encode($response);
               }else{
                  http_response_code(400);
                  echo ("Invalid Email/Password");   
               }
            }else{
               http_response_code(400);
               echo ("Invalid Email/Password");
            }
            $dbcon->close();
            break;
         case "/read":
            session_id($_POST["sid"]);
            session_start();
            if(isset($_SESSION["user"])){
               echo json_encode($_SESSION["user"]);
            }else{
               http_response_code(400);
               echo("Login required");
            }
         break;
            }
      }
   }
?>