<?php
    header('Access-Control-Allow-Origin: *');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        switch($_SERVER["PATH_INFO"]){
            case "/load":
                $addr = "./data/".$_POST["filename"].".json";
                $file = fopen($addr,"r");
                $data = fread($file,filesize($addr));
                fclose($file);
                echo $data;
                break;
            case "/record":
                $addr = "./userData/".$_POST["uid"];
                if(!is_dir($addr)){
                    mkdir($addr);
                }
                $file = fopen($addr."/timeSheet.json","w");
                fwrite($file,$_POST["data"]);
                fclose($file);
                echo("Timesheet Saved!");
                break;
            case "/time":
                $addr = "./userData/".$_POST["uid"]."/timeSheet.json";
                $file = fopen($addr,"r");
                $data = fread($file,filesize($addr));
                fclose($file);
                echo $data;
                break;
            default:
                http_response_code(400);
                echo("bad request");        
        }
    }else{
        http_response_code(400);
        echo("bad request");
    }
?>