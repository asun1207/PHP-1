<?php
session_start();
   include("./classes/StudentClass.php");
   $student = new Student(12,"John","something","test@mail.com");
   $student->set_fname("Sayaka");
   $student->display();
   $_SESSION["testVal"] = "This is user2 page.";
   ?>