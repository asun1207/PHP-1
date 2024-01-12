<?php
class Employee{
    public $empid;
    public $fname;
    public $lname;
    public $email;
    public $depname;
    public $baseSalary;
    public $child;
    public $empYear;

    function __construct($empid, $fname, $lname, $email, $depname, $baseSalary, $child, $empYear){
        $this->empid = $empid;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->depname = $depname;
        $this->baseSalary = $baseSalary;
        $this->child = $child;
        $this->empYear = $empYear;

    }
    function display(){
        foreach($this as $value){
            echo "$value<br/>";
        }
    }
    function get_fname(){
        return $this->fname;
    }
    function set_finalSalary($newSalary){
        $this->baseSalary = $newSalary;
    }
}
    $employee = new employee($empid, $fname, $lname, $email, $depname, $finalSalary, $child, $empYear);
    $employee->set_finalSalary($newSalary);
    $employee-> display();

?>