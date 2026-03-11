<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-table me-1"></i>
		DataTable Example
	</div>
	<div class="card-body">
		<table id="datatablesSimple">
			<thead>
				<tr>
					<th>transaction id</th>
					<th>currency</th>
					<th>amount</th>
					<th>completion</th>
					<th>date</th>
					<th>items</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>transaction id</th>
					<th>currency</th>
					<th>amount</th>
					<th>completion</th>
					<th>date</th>
					<th>items</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
					include_once('..\config2.php');
					echo getAllTransactions();
				?>
			</tbody>
		</table>
	</div>
</div>
