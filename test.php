<?php 
if ( $_POST ) {
	$parts = getBPValues($_POST['item_name']);
}

function getBPValues($value) {
		
	$base_sql = 'select t.typeID, t.typeName, m.quantity
				from invTypes t
					inner join invTypeMaterials m on m.materialTypeID = t.typeID
				where m.typeID = ?';
	$extra_sql = "select 
					t.typeName, r.quantity, r.damagePerJob, case when g.categoryID = 16 then 'Skill' else 'Material' end as Type
				from
					ramTypeRequirements r
					inner join invBlueprintTypes b on b.blueprintTypeID = r.typeID
					inner join invTypes t on r.requiredTypeID = t.typeID
					inner join invGroups g on g.groupID = t.groupID
				where 
					b.productTypeID = ?
					and r.activityID = 1";
	
	$user = 'gallica';
	$pass = 'recorder123';
	$dbh = new PDO('mysql:host=localhost;dbname=eve', $user, $pass);
	$stmt = $dbh->prepare($base_sql);
	$stmt->execute(array($value));
	$parts = $stmt->fetchAll();
	#print_r($parts);
	
	$stmt2 = $dbh->prepare($extra_sql);
	$stmt2->execute(array($value));
	while ( $row = $stmt2->fetch() ) {
		$parts[] = $row;
	}
	
	return $parts;
}

?>
<html>
	<head>
	</head>
	<body>
		<form id="search" action="test.php" method="post">
			<label>Item</label><input type="text" name="item_name" />
			<input type="hidden" name="item_id" value="" />
			<input type="submit" value="Get" />
			<div>
				<h3><?php echo $_POST['item_name']; ?></h3>
				<ul>
					<li>
						<label>Price Per Unit:</label>
						<span><?php echo $item_price; ?></span>
				</ul>
				<table>
					<thead>
						<tr>
							<th>Compenent</th>
							<th>Quantity</th>
							<th>Price per Unit</th>
							<th>Total Price</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ( $parts as $part ) { ?>
					
						<tr>
							<td><?php echo $part['typeName']; ?></td>
							<td><?php echo $part['quantity']; ?></td>
							<td>0</td>
							<td>0</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</form>
	</body>
</html>

