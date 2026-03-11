<?php
 

$conn = mysqli_connect('localhost', 'nomadforce', 'nmf2003','nomadforce');

function getAllItems(){
	global $conn;
	$items = "";
	$q = "SELECT * FROM services";
	$results = mysqli_query($conn, $q);
	while($row = mysqli_fetch_array($results)){
		extract($row);		
		$items .= <<<DELIMITER
<tr>
	<td>$id</td>
	<td>$name</td>
	<td>$price</td>
	<td>$itemQty</td>
	<td>$description</td>
	<td>$itemCategory</td>
</tr>
DELIMITER;
	}
	return $items;
}

function getAllCategories(){
	global $conn;
	$items = "";
	$q = "SELECT * FROM categories";
	$results = mysqli_query($conn, $q);
	while($row = mysqli_fetch_array($results)){
		extract($row);
		$items .= <<<DELIMITER
<tr>
	<td>$catid</td>
	<td>$catName</td>
	<td><button name='btn_$catid'>Delete</button></td>
</tr>
DELIMITER;
	}
	return $items;
}

function getAllTransactions(){
	global $conn;
	$items = "";
	$q = "SELECT * FROM transactions";
	$results = mysqli_query($conn, $q);
	while($row = mysqli_fetch_array($results)){
		extract($row);
		$i = explode("," , $tItems);
		$ii = "";
		foreach($i as $k => $v){
			if($v == "") continue;
			$v = explode(":", $v);
			$itemName = $v[0] ?? '';
			$itemQty  = $v[1] ?? 0;
			$ii .= $itemName . " Qty: " . $itemQty . "<br/>";
		}
		$items .= <<<DELIMITER
<tr>
	<td>$transactionID</td>
	<td>$tCurrency</td>
	<td>$tAmount</td>
	<td>$tComplete</td>
	<td>$date</td>
	<td>$ii</td>
</tr>
DELIMITER;
	}
	return $items;
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function logTask($activity){
    $date = date("Y-m-d H:i:s");
    $user = $_SESSION['user'] ?? 'Anonymous';

  
    $logFilePath = __DIR__ . "/admin/OurLog.log";

    file_put_contents(
        $logFilePath,
        "$date || $user || $activity" . PHP_EOL,
        FILE_APPEND
    );
}



if (!function_exists('getCategoryItems')) {
    function getCategoryItems($catid) {
        global $conn;
        $items = "";
        $q = "SELECT * FROM services WHERE itemCategory = $catid";
        $results = mysqli_query($conn, $q);
        if (!$results) return "<p style='color:red;'>Query error: " . mysqli_error($conn) . "</p>";
        if (mysqli_num_rows($results) == 0) return "<p>No services found for category ID: $catid</p>";

        while ($row = mysqli_fetch_assoc($results)) {
            $short = substr($row['description'], 0, 100) . "...";
            $items .= <<<DELIMETER
<div class="col-lg-6 col-12">
    <div class="portfolio-thumb mb-5" data-aos="fade-up">
        <a href="images/portfolio/{$row['image']}" class="image-popup">
            <img src="{$row['image']}" alt="">
        </a>
        <div class="d-flex flex-column justify-content-center text-start border-inner px-4 mt-3" style="background-color: #fff;">
            <h5 class="text-uppercase">
                <a href='item.php?id={$row['id']}'>
                    {$row['name']}
                </a>
            </h5>
            <span>{$short}</span>
        </div>
        <div class="portfolio-info">                     
            <h4 class="pull-right">&#36;{$row['price']}</h4>
        </div>
    </div> 
</div>
DELIMETER;
        }
        return $items;
    }
}

if (!function_exists('getMenuItems')) {
    function getMenuItems() {
        global $conn;
        $items = <<<DELIMITER
<ul class="nav nav-pills d-inline-flex justify-content-center bg-dark text-uppercase border-inner p-4 mb-5">
DELIMITER;

        $q = "SELECT * FROM categories";
        $results = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_assoc($results)) {
            $catName = $row['catName'];
            $catid = $row['catid'];
            $active = ($catid == 1) ? "active" : "";
            $items .= <<<DELIMITER
<li class="nav-item">
    <a class="nav-link text-white $active" data-bs-toggle="pill" href="#tab-$catid">$catName</a>
</li>
DELIMITER;
        }

        $items .= "</ul>";
        return $items;
    }
}

if (!function_exists('getItemContent')) {
    function getItemContent() {
        global $conn;
        $content = "<div class=\"tab-content\">";
        $q = "SELECT catid FROM categories";
        $results = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_array($results)) {
            $catid = $row[0];
            $content .= "<div id=\"tab-$catid\" class=\"tab-pane fade show p-0\"><div class=\"row g-3\">";
            $content .= getCategoryItems($catid);
            $content .= "</div></div>";	
        }

        $content .= "</div>";
        echo $content;
    }
}
