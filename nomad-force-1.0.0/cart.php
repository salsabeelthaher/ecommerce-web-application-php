<?php
session_start();
include('config2.php');
include('topbar.php');
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<br><br>
<div class="container">
    <h2 class="text-center mb-4">Your Shopping Cart</h2>

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="ebusines@mycompany.com">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="USD">

        <div class="card shadow-lg p-4">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>NO.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Item Total</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $counter = 0;
                $grandTotal = 0;

                foreach ($_SESSION as $k => $v) {
                    if (substr($k, 0, 5) == "prod_") {

                        $iid = substr($k, 5);
                        $counter++;

                        $q = "SELECT * FROM services WHERE id = $iid";
                        $results = mysqli_query($conn, $q);
                        $row = mysqli_fetch_assoc($results);

                        $itemTotal = $v * $row['price'];
                        $grandTotal += $itemTotal;
                ?>

                    <tr>
                        <td><?= $counter ?></td>

                        <td><?= $row['name'] ?></td>

                        <td><?= $row['price'] ?> USD</td>

                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">

                               
                                <a href="cart_action.php?action=minus&id=<?= $iid ?>" 
                                   class="btn btn-sm btn-danger">-</a>

                               
                                <span class="fw-bold px-2"><?= $v ?></span>

                                
                                <a href="cart_action.php?action=plus&id=<?= $iid ?>" 
                                   class="btn btn-sm btn-success">+</a>

                                
                                <a href="cart_action.php?action=delete&id=<?= $iid ?>" 
                                   class="btn btn-sm btn-secondary ms-2">🗑</a>

                            </div>
                        </td>

                        <td><?= $itemTotal ?> USD</td>
                    </tr>

                    
                    <input type="hidden" name="item_name_<?= $counter ?>" value="<?= $row['name'] ?>">
                    <input type="hidden" name="amount_<?= $counter ?>" value="<?= $row['price'] ?>">
                    <input type="hidden" name="quantity_<?= $counter ?>" value="<?= $v ?>">

                <?php }} ?>

                </tbody>

                <tfoot>
                    <tr class="table-secondary">
                        <th colspan="4" class="text-end">Grand Total:</th>
                        <th><?= $grandTotal ?> USD</th>
                    </tr>
                </tfoot>
            </table>
<div class="text-center">
    <button type="submit" class="btn btn-primary btn-lg mt-3">
        <img src="https://www.paypalobjects.com/digitalassets/c/website/logo/full-text/pp_fc_hl.svg" 
             width="70" 
             alt="PayPal Logo">
        Checkout with PayPal
    </button>
</div>


        </div>
    </form>
</div>

<?php include('footer.php'); ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
