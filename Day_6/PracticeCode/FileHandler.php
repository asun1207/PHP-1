<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Headers: *");
   if($_SERVER["REQUEST_METHOD"]=="POST"){
      switch($_POST["req"]){
         case "open":
            $fileAdr = "./userData/". $_POST["dirname"]."/".$_POST["filename"];
               if(file_exists($fileAdr)){
                  $file = fopen($fileAdr,"r") or die("Unable to create the file.");
                  $content = fread($file,filesize($fileAdr));
                  fclose($file);
                  echo $content;
               }
            break;
         case "read":
            $dir = "./userData/".$_POST['dirname'];
            if(is_dir($dir)){
               $dirOutput = [];
               $userDirs = scandir($dir);
               foreach($userDirs as $uDir){
                  if(in_array($uDir,array(".","..")))
                     continue;
                  array_push($dirOutput,$uDir);
               }
               if(count($dirOutput)>=1)
                  echo(json_encode($dirOutput));
            }
            break;
         case "write":
            $dir = "./userData/".$_POST['dirname'];
            if(!is_dir($dir)){
               mkdir($dir);
            }
            if(isset($_POST["filename"]) && isset($_POST["content"])){
               $file = fopen($dir."/".$_POST["filename"].".txt","w") or die("Unable to create the file.");
               fwrite($file,$_POST["content"]);
               fclose($file);
               echo "File Saved!";
            }
            break;
         case "delete":
            $fileAdr = "./userData/".$_POST['dirname']."/".$_POST['filename'];
            if(file_exists($fileAdr)){
               if(unlink($fileAdr)){
                  echo "File Deleted";
               }else{
                  echo "Unable to delete the file.";
               }
            }else{
               echo "File not found";
            }
            break;
         }
      }
?>