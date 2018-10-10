<?php require_once("manufacturer.php"); ?>
<?php require_once("model.php"); ?>
<?php
   class DatabaseModel {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "minicarinventorysystem";
        private $conn = null;
        
        function __construct(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            } 
            //echo "Connected successfully";
        }

        function __destruct(){
            mysqli_close($this->conn); 
            //echo "Disconnected successfully";
        }

        function insertManufacturer($manufacturer){
            $sql = "INSERT INTO manufacturer(name) VALUES ('".$manufacturer->getManufacturerName()."')";
            if ($this->conn->query($sql) !== TRUE) {
                 echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
        function insertModel($model){
            $sql = "INSERT INTO model(manufacturerId,color,manufacturingYear,note,picturesNames,registrationNumber,modelName) VALUES 
                (".$model->getManufacturerId().",'".$model->getColor()."','".$model->getManufacturingYear()."',
                    '".$model->getNote()."','pic1.jpg','".$model->getRegistrationNumber()."','".$model->getModelName()."')";
            if ($this->conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        function getManufacturerRowsCount(){
            $sql = "SELECT * FROM manufacturer";
            if ($result = $this->conn->query($sql)) {
               return mysqli_num_rows($result);
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
                return 0;
            }
        }
        function getModelRowsCount(){
            $sql = "SELECT * FROM model";
            if ($result = $this->conn->query($sql)) {
               return mysqli_num_rows($result);
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
                return 0;
            }
        }

        function getManufacturersList(){
            $manufacturersList ;
            $sql = "SELECT * FROM manufacturer";
            if ($result = $this->conn->query($sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    $manufacturersList[] = array('id' => $row['id'], 'name' => $row['name']);
                }
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
                $manufacturersList="";
            }
            return json_encode($manufacturersList);
        }

        function getInventoryDisplayResult(){
            $sql = "SELECT manufacturer.id as manufacturerId, manufacturer.name AS manufacturerName, model.modelName, COUNT(model.id) AS modelCount FROM manufacturer 
                INNER JOIN model ON manufacturer.id = model.manufacturerId GROUP BY modelName";
            if ($result = $this->conn->query($sql)) {
                return $result;
            } else {
                return ;
            }
        }

        function getModelDetails($manufacturerId){
            $manufacturersList ;
            $sql = "SELECT manufacturer.id AS manufacturerId, model.id AS modelID, model.color, model.manufacturingYear, 
                model.note, model.picturesNames, model.registrationNumber, model.modelName FROM `manufacturer` 
                INNER JOIN `model` ON manufacturer.id = model.manufacturerId WHERE manufacturer.id=".$manufacturerId;
            if ($result = $this->conn->query($sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    $manufacturersList[] = array('manufacturerId' => $row['manufacturerId'],
                                                 'modelID' => $row['modelID'],
                                                 'color' => $row['color'],
                                                 'manufacturingYear' => $row['manufacturingYear'],
                                                 'note' => $row['note'],
                                                 'picturesNames' => $row['picturesNames'],
                                                 'registrationNumber' => $row['registrationNumber'],
                                                 'modelName' => $row['modelName']);
                }
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
                $manufacturersList="";
            }
            return json_encode($manufacturersList);
        }

        function deleteModel($modelId){
            $sql = "DELETE FROM model WHERE id=".$modelId;
            if ($this->conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
        
   }
?>