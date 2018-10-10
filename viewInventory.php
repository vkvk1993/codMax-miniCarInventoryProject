<!DOCTYPE html>
<?php require_once "DatabaseModel.php";?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Car Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Add Manufacturer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addModel.html">Add Model</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="viewInventory.php">View Inventory</a>
            </li>
        </ul>

    </nav>
    <div class="jumbotron">
        <h1>View Inventory</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Manufacturer</th>
                            <th scope="col">Model</th>
                            <th scope="col">Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $databaseModel = new DatabaseModel();
                            $result = $databaseModel->getInventoryDisplayResult();
                            while ($row = mysqli_fetch_array($result)) {?>
                            <tr id="<?=$row['manufacturerId']?>" onClick="displayInventoryModal(this.id,'manufactorurModel');" 
                            data-toggle="modal" data-target="#manufactorurModel" >
                                <th scope="row"><?=$i?></th>
                                <td><?=$row['manufacturerName']?></td>
                                <td><?=$row['modelName']?></td>
                                <td><?=$row['modelCount']?></td>
                            </tr>
                            <?php 
                            $i++;
                        }
                        ?>
                        
                        </tbody>
                    </table>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="modal" id="manufactorurModel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Model Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="overflow:auto;">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Color</th>
                        <th>Manufacturing Year</th>
                        <th>Note</th>
                        <th>Picture Names</th>
                        <th>Registration Number</th>
                        <th>Model Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="modelModalBody">
                    </tbody>
                </table>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <hr>
        <footer>
            <p>contact khandekarv44@gmail.com</p>
        </footer>
    </div>
</body>

</html>