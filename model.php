<?php
   class Model {
        private $manufacturerId = "";
        private $color = "";
        private $manufacturingYear = "";
        private $registrationNumber = "";
        private $note = "";
        private $pictureNames = "";
        private $modelName = "";
        
        function getManufacturerId(){
            return $this->manufacturerId;
        }
        function setManufacturerId($manufacturerId){
            $this->manufacturerId = $manufacturerId;
        }
        public function getColor(){
            return $this->color;
        }
        public function setColor($color){
            $this->color = $color;
        }
        public function getManufacturingYear(){
            return $this->manufacturingYear;
        }
        public function setManufacturingYear($manufacturingYear){
            $this->manufacturingYear = $manufacturingYear;
        }
        public function getRegistrationNumber(){
            return $this->registrationNumber;
        }
        public function setRegistrationNumber($registrationNumber){
            $this->registrationNumber = $registrationNumber;
        }
        public function getNote(){
            return $this->note;
        }
        public function setNote($note){
            $this->note = $note;
        }
        public function getPictureNames(){
            return $this->pictureNames;
        }
        public function setPictureNames($pictureNames){
            $this->pictureNames = $pictureNames;
        }
        public function getModelName(){
            return $this->modelName;
        }
        public function setModelName($modelName){
            $this->modelName = $modelName;
        }
   }
?>