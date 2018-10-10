<?php
   class Manufacturer {
        private $manufacturerName = "";
        function getManufacturerName(){
            return $this->manufacturerName;
        }
        function setManufacturerName($manufacturerName){
            $this->manufacturerName = $manufacturerName;
        }
   }
?>