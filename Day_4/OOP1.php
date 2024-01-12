<?php
session_start();
    include("./classes/studentClass.php");
    $student = new Student(12, "John", "Something", "test@mail.com");
    $student->set_fname("Sayaka");
    $student->display();
?>