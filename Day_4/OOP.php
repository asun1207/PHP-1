<?php
    class Student{
        public $id;
        protected $fname; // only accessable by the class and the child class
        private $lname; // only accessable by the class 
        public $email;
        function __construct($id, $fname, $lname, $email){
            $this->id = $id;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
        }
        function display(){
            foreach($this as $value){
                echo "$value<br/>";
            }
        }
        function get_fname(){
            return $this->fname;
        }
        function set_fname($newName){
            $this->fname = $newName;
        }
    }
    $student = new Student(12, "John", "Something", "test@mail.com");
    // $student->id = "15"; // id: 15
    // $student->fname = "Kosuke"; // fname: protected properties
    // $student->lname = "Kosuke"; // lname : private
    $student->set_fname("Sayaka");
    $student-> display();
?>