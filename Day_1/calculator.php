<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        if(isset($_GET['num1']) && isset($_GET['num2']))
        echo "total is: " . $_GET['num1'] + $_GET['num2'];
    else
        echo "No number provided";
    }
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        if(isset($data->num1) && isset($data->num2))
        echo "total is: ". $data->num1 + $data->num2;
    else
        echo "No number provided";
    }
?>