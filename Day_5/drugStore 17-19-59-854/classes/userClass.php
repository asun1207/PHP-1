<?php
    class User{
        public $uid;
        public $name;
        public $address;
        public $selectedDrugs = [];

        function __construct($uid, $name, $address) {
            $this->uid = $uid;
            $this->name = $name;
            $this->address = $address;
            $this->selectedDrugs = [];
        }
        public function addDrug($drug) {
            $this->selectedDrugs[] = $drug;
        }
        public function getSelectedDrugs() {
            return $this->selectedDrugs;
        }
        public function getUID() {
            return $this->uid;
        }
    
        public function getName() {
            return $this->name;
        }
    
        public function getAddress() {
            return $this->address;
        }

    }
?>