<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: *");
include "./classes/userClass.php";

function startSession() {
   if (session_status() === PHP_SESSION_NONE) {
       session_start();
   }
}

$login = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   startSession();
    switch ($_POST["req"]) {
        case "login":
            $file = fopen("./data/user_tb.json", "r") or die("unable to open user file");
            $data = fread($file, filesize("./data/user_tb.json"));
            fclose($file);
            $users = json_decode($data);
            foreach ($users as $user) {
                if ($user->email == $_POST["email"] && $user->pass == $_POST["pass"]) {
                    $userObj = new User(session_id(), $user->name, $user->address);
                    $_SESSION['user'] = $userObj;
                    $login = true;
                    $response = ["uid" => session_id(), "name" => $user->name];
                    echo json_encode($response);
                    break;
                }
            }
            if ($login) {
                http_response_code(200);
            } else {
                http_response_code(401);
            }
            break;
        case "store":
            $file = fopen("./data/drug_tb.json", "r");
            $data = fread($file, filesize("./data/drug_tb.json"));
            fclose($file);
            echo $data;
            break;
         case "storeSelectedDrugs":
               if (isset($_SESSION['user']) && isset($_POST['selectedDrugs'])) {
                   $user = $_SESSION['user'];
                   $selectedDrugs = json_decode($_POST['selectedDrugs'], true);
                   // 사용자 폴더 생성 또는 확인
                   $userFolderPath = "./userData/" . $user->uid;
                   if (!file_exists($userFolderPath)) {
                       mkdir($userFolderPath, 0777, true);
                   };
                   // 선택한 약물을 파일로 저장
                   $selectedDrugsFile = $userFolderPath . "/selected_drugs.json";
                   file_put_contents($selectedDrugsFile, json_encode($selectedDrugs));
              
                   echo "Selected drugs stored for the user.";
                   http_response_code(200);
               } else {
                   echo "Error: User or selected drugs data is missing.";
                   http_response_code(400);
               }
               break;
         case "loadSelectedDrugs":
            $user = $_SESSION['user'];
            $userFolder = "./userData/" . $user->uid;
            $selectedDrugsFile = $userFolder . "/selected_drugs.json";
            if (file_exists($selectedDrugsFile)) {
                $selectedDrugsData = file_get_contents($selectedDrugsFile);
                echo $selectedDrugsData;
            } else {
                echo "No selected drugs found!";
            }
            break;
            case "buy":
               if (isset($_SESSION['user']) && isset($_POST['selectedDrugs'])) {
                  $user = $_SESSION['user'];
                  $userFolder = "./userData/" . $user->getUID();
                  
                  // Create a folder for the user if it doesn't exist
                  if (!file_exists($userFolder)) {
                      mkdir($userFolder, 0777, true);
                  }
              
                  $selectedDrugsFile = $userFolder . "/selected_drugs.json";
                  $selectedDrugs = $_POST['selectedDrugs'];
                  
                  // Store the selected drugs in a JSON file
                  file_put_contents($selectedDrugsFile, $selectedDrugs);
              
                  echo json_encode("Selected drugs stored for the user.");
                  http_response_code(200);
              } else {
                  echo json_encode("Error: User or selected drugs data is missing.");
                  http_response_code(400);
              }
               break;
               case "showInfo":
                  if (isset($_SESSION['user'])) {
                      $user = $_SESSION['user'];
                      $userFolder = "./userData/" . $user->getUID();
                      $selectedDrugsFile = $userFolder . "/selected_drugs.json";
              
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
} else {
    http_response_code(400);
}
?>