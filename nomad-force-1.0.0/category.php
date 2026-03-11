<?php require_once('config.php'); ?>



<div class="list-group">
<?php
$results = query("select * from categories");
while($row=mysqli_fetch_array($results))
{
	$string ="<a href =\"#\" class=\"list-group-item\">$row[catName]</a>";
echo $string;
}
?>
</div>