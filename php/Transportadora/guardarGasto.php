<?php 
	include '../db.php';
	$Description = $_GET["Description"];
	$amount = (float)$_GET["amount"];
	$sql ="INSERT INTO trgastos(gasDescription,gasMonto) values('".$Description."',".$amount.")";
	$stmt = $db->prepare($sql);
    $stmt->execute();                            
	/*if (mysqli_query($db,$sql)) {
	$db->close();
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($db);
	    $db->close();
		}
	*/
 ?>