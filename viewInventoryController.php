<?php require_once "DatabaseModel.php";?>
<?php
    $type=$_GET['type'];
    $databaseModel = new DatabaseModel();
    if($type=="getModelDetails"){
        getModelDetails();
    } else {
        deleteModel();
    }
    function getModelDetails(){
        $manufacturerId = $_GET['manufacturerId'];
        $message = new \stdClass();
        $message->result=$GLOBALS['databaseModel']->getModelDetails($manufacturerId);
        echo json_encode($message);
    }

    function deleteModel(){
        $modelId = $_GET['modelId'];
        $message = new \stdClass();
        $message->result=$GLOBALS['databaseModel']->deleteModel($modelId);
    }
?>