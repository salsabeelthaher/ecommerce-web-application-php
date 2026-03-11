	<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('config2.php');
include('topbar.php');
include('navbar.php');
?>

<body>
   
<?php

if(isset($_SESSION)){

	echo "<br/><center><table border='1' width='50%'>";
	?>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="business" value="ebusines@mycompany.com">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="currency_code" value="USD">

<?php
	echo "<tr><th>#</th><th>Name</th><th>Price</th><th>Qunatity</th><th>Item Total</th></tr>";
	$counter = 0;
	$grandTotal = 0;
	foreach($_SESSION as $k => $v){
		
		if(substr($k,0,5) == "prod_"){
	
			$iid = substr($k,5);
			$counter++;
			
			global $conn;
			$q = "select * from services where id = " . $iid ;
			$results = mysqli_query($conn, $q);
			$row = mysqli_fetch_assoc($results);
			extract($row);
			
			$itemTotal = $v * $price;
			$grandTotal += $itemTotal;
			echo "<tr>";
			echo "<td>$counter</td>";
			echo "<td>$name</td>";
			echo "<td>$price</td>";
			echo "<td>$v</td>";
			echo "<td>$itemTotal</td>";
			echo "</tr>";
			
			echo "<input type=\"hidden\" name=\"item_name_$counter\" value=\"$name\">";
			
			echo "<input type=\"hidden\" name=\"item_number_$counter\" value=\"$counter\">";
			
			echo "<input type=\"hidden\" name=\"amount_$counter\" value=\"$price\">" ;
			
			echo "<input type=\"hidden\" name=\"quantity_$counter\" value=\"$v\">";

			
		}
	}
	echo "<tr><td colspan='4'>Grand Total</td><td>$grandTotal</td></tr>";
	
	?>
		<input type="image" name="submit" src="img/pp.png" width="10%" height="10%" alt="PayPal - The safer, easier way to pay online">
	</form>

<?php
	
	echo "</table></center>";
}

?>


   
     <?php 
	 include('footer.php');
	 ?>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>


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


echo "<center><h3>Your payment was successful! Thank you!</h3>";
echo "<p>Transaction ID: $tx</p>";
echo "<p>Total Amount: $amt $cc</p></center>";


if(isset($_SESSION)){
    echo "<br/><center><table border='1' width='50%'>";
    echo "<tr><th>#</th><th>Name</th><th>Price</th><th>Quantity</th><th>Item Total</th></tr>";
    $counter = 0;
    foreach($_SESSION as $k => $v){
        if(substr($k,0,5) == "prod_"){
            $iid = substr($k,5);
            $q = "SELECT * FROM services WHERE id = $iid";
            $res = mysqli_query($conn, $q);
            if($row = mysqli_fetch_assoc($res)){
                $counter++;
                $itemTotal = $v * $row['price'];
                echo "<tr>";
                echo "<td>$counter</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>$v</td>";
                echo "<td>$itemTotal</td>";
                echo "</tr>";
            }
        }
    }
    echo "<tr><td colspan='4'>Grand Total</td><td>$grandTotal</td></tr>";
    echo "</table>";


    echo "<button class='bi bi-printer' onclick='window.print()'>Print</button>";
    echo "<a href='index.php?clearsession=1'><button class='bi bi-house'>Home</button></a></center>";
}

session_destroy();

include('footer.php');
?>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<script src="js/scrollspy.min.js"></script>
<script src="js/custom.js"></script>
