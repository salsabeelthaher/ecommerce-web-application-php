<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-table me-1"></i>
		DataTable Example
	</div>
	<div class="card-body">
		<table id="datatablesSimple">
			<thead>
				<tr>
					<th>Category ID</th>
					<th>Category Name</th>
					<th></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Category ID</th>
					<th>Category Name</th>
					<th></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
					include_once('..\config2.php');
					echo getAllCategories();
				?>
			</tbody>
		</table>
	</div>
</div>
