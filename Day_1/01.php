<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $names = ["David","Nacho","Sayaka","Joao","Jeferson","Yooni","Sun"];
        
    ?>
    <ul>
        <?php
            for($i = 0 ; $i < count($names) ; $i++){
                echo "<li> $names[$i] </li>";
            }
        ?>
    </ul>
    <ul>
        <?php
            foreach($names as $value){
                echo "<li> $value </li>";
            }
        ?>
    </ul>
    <ul>
        <?php
            $students = [12=>45,"Jeferson"=>20,"Kim"=>60,"Otoha"=>15.9];
             
            foreach($students as $key=>$student){
                echo "<li> $key $student </li>";
            }
        ?>
    </ul>
</body>
</html>