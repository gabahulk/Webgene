<?php
	require_once ("webgene.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Webgene</title>
		<link rel="stylesheet" href="css/grid.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	</head>
	<?php 
		$gene = new Webgene('home',1);
		$dom = $gene->start(); 

		echo $dom;?>
  
</html>