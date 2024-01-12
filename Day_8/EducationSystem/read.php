<?php
include("./config.php");
$conn = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
if ($conn->connect_error){
    echo "Connection error: ".$conn->connect_error;
}else{
    // $email = "mkermit0@disqus.com";
    $selectQuery = "SELECT stid,fname,lname,bdate,email FROM students_tb WHERE fname LIKE 'B%'";
    // WHERE email='$email' // only that one will show up
    $data = $conn->query($selectQuery);
    $outData = [];
    if($data->num_rows > 0){
        while($row = $data->fetch_assoc()){
            array_push($outData,$row);
        }
        echo json_encode($outData);
    }
    $conn->close();
}
?>