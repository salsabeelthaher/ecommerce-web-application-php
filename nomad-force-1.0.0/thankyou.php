<?php
session_start();
include_once('config2.php'); 
include('topbar.php');
include('navbar.php');

if(!isset($_GET['st'])){
    header("Location:index.php");
    exit;
}

$tx = $_GET['tx'] ?? '';
$st = $_GET['st'] ?? '';
$amt = $_GET['amt'] ?? 0;
$cc = $_GET['cc'] ?? 'USD';

$items = "";
$grandTotal = 0;

if(isset($_SESSION)){
    foreach($_SESSION as $k => $v){
        if(substr($k,0,5) == "prod_"){
            $iid = substr($k,5);
            $q = "SELECT * FROM services WHERE id = $iid";
            $res = mysqli_query($conn, $q);
            if($row = mysqli_fetch_assoc($res)){
                $items .= $row['name'] . ":" . $v . ",";
                $grandTotal += $row['price'] * $v;
            }
        }
    }
}

$q = "INSERT INTO transactions (transactionID, tCurrency, tAmount, tComplete, tItems)
      VALUES ('$tx','$cc','$amt','$st','$items')";
mysqli_query($conn, $q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<br><br>
<div class="container">
    <div class="card shadow-lg p-5 text-center">
        <h2 class="text-success">Payment Successful! 🎉</h2>
        <p class="mt-3"><strong>Transaction ID:</strong> <?= $tx ?></p>
        <p><strong>Amount Paid:</strong> <?= $amt . " " . $cc ?></p>

        <hr>
        <h4 class="mb-3">Order Summary</h4>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>NO.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $counter = 0;
            foreach($_SESSION as $k => $v){
                if(substr($k,0,5) == "prod_"){
                    $iid = substr($k,5);
                    $q = "SELECT * FROM services WHERE id = $iid";
                    $res = mysqli_query($conn, $q);
                    if($row = mysqli_fetch_assoc($res)){
                        $counter++;
                        $itemTotal = $v * $row['price'];
            ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?> USD</td>
                    <td><?= $v ?></td>
                    <td><?= $itemTotal ?> USD</td>
                </tr>
            <?php }}} ?>
            </tbody>

            <tfoot>
                <tr class="table-secondary">
                    <th colspan="4" class="text-end">Grand Total:</th>
                    <th><?= $grandTotal ?> USD</th>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4">
            <button class="btn btn-secondary" onclick="window.print()">Print Receipt</button>
            <a href="index.php?clearsession=1" class="btn btn-primary ms-2">Return Home</a>
        </div>
    </div>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
