<?php

	require_once('./model/clothe.php');

	$clothes = new Clothe();
	$allCartClothes = json_decode($clothes->getAllPurchased());
	$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="view/style.css">
	<title>Cart</title>
</head>
<body>

	<h1 class="title">Zykaa Cart</h1>
	<a href="?p=home" class="aButtons">Main Menu</a>
		<div id="clothes" class="container">
			<?php
				for ($i = 0; $i < count($allCartClothes); $i++) { 
					$total = $total + $allCartClothes[$i]->price;
			?>
			<div class="clothe-card">
				<img src="<?= $allCartClothes[$i]->image ?>" alt="<?= $allCartClothes[$i]->name ?>" />
				<?php
					echo "<h5>".$allCartClothes[$i]->name.": $".$allCartClothes[$i]->price."</h5>";
				?>
						
				<div class="info">
					<p>Gender - <?= $allCartClothes[$i]->gender ?></p>
					<p>Material - <?= $allCartClothes[$i]->material ?></p>
					<p>Color - <?= $allCartClothes[$i]->color ?></p>
				</div>
			</div>
					
			<?php
				}
			?>
		</div>
	<?php
		echo "<h3>Checkout Total: ".$total."</h3>";
	?>

</body>
</html>