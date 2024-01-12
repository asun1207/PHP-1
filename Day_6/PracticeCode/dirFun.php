<?php
   // mkdir('./userData/testDir');
   // if(is_dir("./userData/testDir")){
   //    rmdir('./userData/testDir');
   // }else{
   //    echo "No";
   // }
   // if(file_exists("./userData/CarlottaMc.txt")){
   //    if(unlink("./userData/CarlottaMc.txt"))
   //       echo "file deteled";
   //    else
   //       echo "not able to delete the file.";
   // }
   $dirOutput = [];
   $dirs = scandir('./FrontEnd');
   foreach($dirs as $dir){
      if(in_array($dir,array(".","..")))
         continue;   
      array_push($dirOutput,$dir);
   }
   print_r(json_encode($dirOutput));
   // json_encode != JSON.parse
   // json_decode != JSON.stringify
?>