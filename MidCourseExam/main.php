<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    // User sent a GET REQUEST
    if($_SERVER["REQUEST_METHOD"]=="GET") {
        //verify fname, lname
        if(isset($_GET['fname']) && isset($_GET['lname'])){
            echo "Welcome ". $_GET['fname'] . " " . $_GET['lname'];
        }else{
            //if it is not presented
            echo "Keys are not valid.";
            http_response_code(400);
        }
    }
    // Response type is POST, and key is reqtype.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         switch ($_POST["reqtype"]) {
            // Request type "login"
            case "login":
                // open json file
            $file = fopen("./data/empMockData_PHPMid.json", "r") or die("unable to open user file");
            $data = fread($file, filesize("./data/empMockData_PHPMid.json"));
            fclose($file);
            // login
            $users = json_decode($data);
            session_start();
            foreach ($users as $user) {
                if ($user->email == $_POST["email"] && $user->pass == $_POST["pass"]) {
                    $userObj = new User(session_id(), $user->name, $user->address);
                    $_SESSION['user'] = $userObj;
                    $login = true;
                    $response = ["empid" => session_id(), "name" => $user->name];
                    echo json_encode($response);
                    break;
                }
            }
            // response code
            if ($login) {
                http_response_code(202);
            } else {
                http_response_code(400);
                echo "email/password wrong";
            }
            break;
            //Request type "info"
            case "info":
                session_start();
                if(isset($_SESSION['empid'])) {
                    $user = $_SESSION['empid'];
                    $userSalary = $user->set_finalSalary();
            
                    if (file_exists($selectedDrugsFile)) {
                        $selectedDrugsData = file_get_contents($selectedDrugsFile);
                        $userData = [
                            "name" => $user->getName(),
                            "address" => $user->getAddress(),
                            "selectedDrugs" => json_decode($selectedDrugsData, true)
                        ];
                        echo json_encode($userData);
                        http_response_code(200);
                    } else {
                        echo "No selected drugs found!";
                        http_response_code(404);
                    }
                } else {
                    echo "User session not found!";
                    http_response_code(400);
                }
                break;


        }
    }
?>