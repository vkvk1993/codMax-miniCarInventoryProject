<?php require_once "DatabaseModel.php";?>
<?php
    $databaseModel = new DatabaseModel();
    $manufacturer = new Manufacturer();
    $manufacturer->setManufacturerName($_POST['manufacturerName']);
    $databaseModel->insertManufacturer($manufacturer);
    $rouCount = new \stdClass();
    $rouCount->manufacturer = $databaseModel->getManufacturerRowsCount();
    $rouCount->model = $databaseModel->getModelRowsCount();
    echo json_encode($rouCount);
?>