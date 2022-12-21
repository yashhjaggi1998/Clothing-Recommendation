<?php
	
	if(!isset($_GET['p'])){
		return require_once('./view/home.php');
	}
	
	switch ($_GET['p']) {
		case 'home':
		
			require_once('./view/home.php');
			break;

		case 'final':
			
			require_once('./view/final.php');
			break;
		
		case 'cart':
			
			require_once('./view/cart.php');
			break;
		default:
	
			require_once('./view/home.php');
			break;
	}

?>