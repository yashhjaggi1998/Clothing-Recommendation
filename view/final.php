<?php
	require_once('./inc/functions.php');
	require_once('./controller/clotheController.php');

	$functions = new Functions();
	$clotheController = new clotheController();

	if(!isset($_GET['clothe_id']))
		exit();
	
	$clothePurchased = json_decode($clotheController->getclothe($_GET['clothe_id']));

	$clotheController->buy($clothePurchased->id);

	$top3 = $functions->getRecommendation($clothePurchased);	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Purchase</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="view/style.css">
	</head>
	<body>
		<h1 class="title">Purchase Made</h1>
		<a href="?p=home" class="aButtons">Main Menu</a>
		<a href="?p=cart" class="aButtons">View Cart</a>	

		<div id="final" class="container">
			<div class="clothe-card">
				<img src="<?=$clothePurchased->image ?>" alt="<?= $clothePurchased->name ?>" />
				<h5><?= $clothePurchased->name ?></h5>

				<div class="purchased-info">
					<p>Gender - <?= $clothePurchased->gender ?></p>
					<p>Material - <?= $clothePurchased->material ?></p>
					<p>Color - <?= $clothePurchased->color ?></p>
				</div>
			</div>

			<p style="color:orange; font-style: italic;"><strong style="color:orange;"><?= $clothePurchased->name ?></strong> added to cart.</p>				
		</div>

		<?php echo ($top3)? "<h2 class='title'>Recommended Items</h2>": '' ?>

		<div id="recommendation">
			<?php
			if ($top3) {

				foreach ($top3 as $clotheRecommended) {
			?>
				<div class="clothe-card">
					<img src="<?=$clotheRecommended->image ?>" alt="<?= $clotheRecommended->name ?>" />
					<h5><?= $clotheRecommended->name ?></h5>

					<div class="info">
						<p>Gender - <?= $clotheRecommended->gender ?></p>
						<p>Material - <?= $clotheRecommended->material ?></p>
						<p>Color - <?= $clotheRecommended->color ?></p>
					</div>
					
					<?php
						if($functions->alreadyPurchased($clotheRecommended->id))
							echo "<p class='purchased'>Added To Cart!!</p>";
						else
							echo "<a href='?p=final&clothe_id=".$clotheRecommended->id."'>Purchase</a>";
					?>

				</div>
			<?php
				}
			}else{
				?>
				<h2 style="color: #000;">Few parts available for recommendation</h2>
				<?php
			}
			?>
		</div>

		<footer>
		</footer>
	</body>
</html>