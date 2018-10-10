<?php require_once "DatabaseModel.php";?>
<?php
    $databaseModel = new DatabaseModel();
    $rouCount = new \stdClass();
    $rouCount->manufacturer = $databaseModel->getManufacturerRowsCount();
    $rouCount->model = $databaseModel->getModelRowsCount();
    echo json_encode($rouCount);
?>