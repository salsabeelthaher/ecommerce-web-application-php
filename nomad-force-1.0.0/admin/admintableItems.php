<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-table me-1"></i>
		DataTable Example
	</div>
	<div class="card-body">
		<table id="datatablesSimple">
			<thead>
				<tr>
					<th>Item ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Description</th>
					<th>Category</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Item ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Description</th>
					<th>Category</th>
				</tr>
			</tfoot>
			<tbody>
<?php
	include_once('..\config2.php');
    echo getAllItems();
?>
			</tbody>
		</table>
	</div>
</div>
