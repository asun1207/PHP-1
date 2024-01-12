<?php
    include("./config.php");
    header("Access-Control-Allow-Origin: *");
    $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);

    if($conn->connect_error){
        echo ("DB Connection Error".$conn->connect_error);
    }else{
        // $insertQuery = "INSERT INTO students_tb (fname,lname,bdate,email,pass,address) VALUES ('Edmond','Baker','1998-11-12','test@mail.com','test','test address')"; //it should be string
        // if($conn->query($insertQuery)===TRUE){
        //     echo "1 Row added!";
        // }else{
        //     echo "Error: ".$conn->error;
        // }
        $file = fopen("./student_Mock_data.json", "r") or die("Unable to open the file");
        $data = fread($file,filesize("./student_Mock_data.json"));
        $data = json_decode($data);
        // print_r($data[0]->stid);
        $insertQuery = $conn->prepare("INSERT INTO students_tb VALUES (?,?,?,?,?,?,?)");
        $insertQuery->bind_param("issssss",$stid,$fname,$lname,$bdate,$email,$pass,$address);
        foreach ($data as $e){
            $stid = $e->stid;
            $fname = $e->fname;
            $lname = $e->lname;
            $bdate = $e->bdate;
            $email = $e->email;
            $pass = password_hash($e->pass, PASSWORD_BCRYPT, ["cost"=>10]);
            $address = $e->address;
            $insertQuery->execute();
        }
        $insertQuery->close();
        $conn->close();
    }
?>