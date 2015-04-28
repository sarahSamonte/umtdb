<html>
<head>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Service ID</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Cost</th>
				<th>Total KWH</th>
				<th>Generation Charge</th>
				<th>Transmission  Charge</th>
				<th>Distribution Charge</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ebills as $ebill): ?>				
				<?php echo "<tr>"?>				
				<?php echo "<td>" . $ebill['serviceID'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['startDate'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['endDate'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['totalCost'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['totalKwh'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['genCharge'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['transCharge'] . "</td>"; ?>
				<?php echo "<td>" . $ebill['distCharge'] . "</td>"; ?>
				<?php echo "</tr>"?>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>