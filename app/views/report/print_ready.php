
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style type="text/css">
		table{
			border-collapse: collapse;
		}

		table td {
			padding: 10px;
		}

		  @media print {
	         #print,#cancel{
	         	display: none;
	         }
	      }
	</style>
</head>
<body>

	<div style="width: 700px; margin:0px auto">
		<div style="text-align: center;">
			<h4>Borrowing Report</h4>
			<p>as of <?php echo date('Y-m-d H:i:s')?> report By <?php echo whoIs('firstname') . ' '.whoIs('lastname')?> </p>

			<div style="text-align:center; margin-top: 15px;">
				<a href="<?php echo _route('report:index')?>" id="cancel">Cancel</a> | 
				<a href="#" onclick="print()" id="print">Print</a>
			</div>
		</div>

		<table border="1px" width="100%">
			<tr>
				<td style="width:30%"><strong>Most Borrowed Product</strong></td>
				<td><?php echo $summarizedData['topBorrowedItem']['item']->name?></td>
				<td><?php echo $summarizedData['topBorrowedItem']['total']?></td>
			</tr>

			<tr>
				<td style="width:30%"><strong>Least Borrowed Product</strong></td>
				<td><?php echo $summarizedData['leastBorrowedItem']['item']->name?></td>
				<td><?php echo $summarizedData['leastBorrowedItem']['total']?></td>
			</tr>

			<tr>
				<td style="width:30%"><strong>Top Course Borrower</strong></td>
				<td><?php echo $summarizedData['topCourseBorrower']['course']->course . "(".$summarizedData['topCourseBorrower']['course']->course_abbr.")"?></td>
				<td><?php echo $summarizedData['topCourseBorrower']['total']?></td>
			</tr>

			<tr>
				<td style="width:30%"><strong>Top Year level Borrower</strong></td>
				<td><?php echo $summarizedData['topYearLevelBorrower']['year']?></td>
				<td><?php echo $summarizedData['topYearLevelBorrower']['total']?></td>
			</tr>


			<tr>
				<td colspan="3"><strong>Top 10 most Borrowed Items</strong></td>
			</tr>

			<?php foreach($summarizedData['topTenBorrowedItems'] as $key => $row) :?>
				<?php 
					$item = $row['item'];
					$total = $row['total'];
				?>
				<tr>
					<td><?php echo "#".++$key?></td>
					<td><?php echo $item->name?></td>
					<td><?php echo $total?></td>
				</tr>
			<?php endforeach?>


			<tr>
				<td colspan="3"><strong>Top 10 most Borrowed Categories</strong></td>
			</tr>

			<?php foreach($summarizedData['topTenMostBorrowedItemCategories'] as $key => $row) :?>
				<?php 
					$category = $row['category'];
					$total = $row['total'];
				?>
				<tr>
					<td><?php echo "#".++$key?></td>
					<td><?php echo $category->name?></td>
					<td><?php echo $total?></td>
				</tr>
			<?php endforeach?>
		</table>
	</div>
</body>
</html>