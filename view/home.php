<?php
	
	//import file if not already imported
	require_once('./inc/functions.php');
	require_once('./controller/clotheController.php');

	//object initializations
	$functions = new Functions();
	$clotheController = new clotheController(); 

	//convert json data to php object & shuffle clothes data
	$clothes = json_decode($clotheController->getAll());
	shuffle($clothes);


	if(isset($_GET['clothe_id']))
	{
		$id = $_GET['clothe_id'];
		$clotheController->buy($id);
	}

	if (isset($_GET['clearCart'])) 
		$clotheController->destroy();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Zykaa Clothes</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="view/style.css">
	</head>
	<body>
		<h1 class="title">Zykaa Clothes</h1>
		<a href="?clearCart" class="aButtons">Clear Cart</a>
		<a href="?p=cart" class="aButtons">View Cart</a>
		<div id="clothes" class="container">

			<?php
				for ($i = 0; $i < count($clothes); $i++) 
				{ 
			?>

				<div class="clothe-card">
					<img src="<?= $clothes[$i]->image ?>" alt="<?= $clothes[$i]->name ?>" />
					
					<?php
					echo "<h5>".$clothes[$i]->name.": $".$clothes[$i]->price."</h5>";
				
					if($functions->alreadyPurchased($clothes[$i]->id))
						echo "<p class='purchased'>Added To Cart!</p>";
					else
						echo "<a href='?p=final&clothe_id=".$clothes[$i]->id."'>Purchase</a>";
				?>
							
					<div class="info">
						<p>Gender - <?= $clothes[$i]->gender ?></p>
						<p>Material - <?= $clothes[$i]->material ?></p>
						<p>Color - <?= $clothes[$i]->color ?></p>
					</div>
				</div>
					

			<?php
				}
			?>
		</div>

		<footer>
		</footer>
	</body>
</html>