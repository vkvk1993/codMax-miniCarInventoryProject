<?php require_once "DatabaseModel.php";?>
<?php
    $type=$_GET['type'];
    $databaseModel = new DatabaseModel();
    if($type=="getManufacturersList"){
        getManufacturersList();
    } else{
        addModel();
    }
    function getManufacturersList(){
        $message = new \stdClass();
        $message->result=$GLOBALS['databaseModel']->getManufacturersList();
        echo json_encode($message);
    }
    function addModel(){
        $color = $_POST['color'];
        $year = $_POST['year'];
        $note = $_POST['note'];
        $rnum = $_POST['number'];
        $modelName = $_POST['modelName'];
        $manufacturerId = $_POST['manufacturerId'];
        $message = new \stdClass();
        $model = new Model();
        $model->setColor($color);
        $model->setManufacturerId($manufacturerId);
        $model->setManufacturingYear($year);
        $model->setRegistrationNumber($rnum);
        $model->setNote($note);
        $model->setModelName($modelName);
        $message->result=$GLOBALS['databaseModel']->insertModel($model);
        echo json_encode($message);
    }
?>