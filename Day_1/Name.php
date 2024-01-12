<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            if(isset($_GET['name']) && isset($_GET['family'])){
                echo "Welcome ". $_GET['name'] . " " . $_GET['family'];
            }else{
                echo "No name/family provided";
            }
        break;
        case "POST":
            $data = file_get_contents("php://input");
            $json = json_decode($data);
            if(isset($json->name) && isset($json->family)){
                $fileName = $json->name . $json->family;
                if(file_exists("./data/$fileName.txt")){
                    $file = fopen("./data/$fileName.txt","r");
                    $wishes = fread($file,filesize("./data/$fileName.txt"));
                    fclose($file);
                    echo "Your wishes are: $wishes";
                }else{
                    $file = fopen("./data/$fileName.txt","w") or die("Unable to create the file");
                    fwrite($file,$json->wishes);
                    fclose($file);
                    echo "Wishes sent....";
                }
            }else{
                echo "No name/family provided";
            }
            break;
        default:
            echo "BAD REQUEST";
    }
?>