<?php
    // $file = fopen("./data/test.json","w") or die("Unable to open/create the file!");
    // fwrite($file,"I Don't know too");

    // fclose($file);

    $file = fopen("./data/test.txt","r") or die("Unable to open the file");

    echo fread($file,filesize('./data/test.txt'));

    fclose($file);
?>