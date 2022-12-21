<?php
	
	Class Clothe
	{
		public function showAll(){
			
			$clothes = file_get_contents('./assets/storage/clothes.json');
			return $clothes;
		}

		public function getAllPurchased(){
			
			$clothes = file_get_contents('./assets/storage/purchased.json');
			return $clothes;
		}

		public function findById($id){
			
			$jsonClothes = Clothe::showAll();
			$clothes = json_decode($jsonClothes);

			$clothePurchased = json_encode($clothes[$id]);

			return $clothePurchased;
		}

		public function addToList($id){
			$puchasedClothes = json_decode(file_get_contents('./assets/storage/purchased.json'));

			$add = true;
			foreach ($puchasedClothes as $item) {
				if ($id == $item->id) {
						$add = false;
				}
			}

			if($add){
				array_push($puchasedClothes, json_decode(Clothe::findById($id)));
				$jsonList = json_encode($puchasedClothes);
				file_put_contents('./assets/storage/purchased.json', $jsonList);
			}
		}

		public function removeAllPurchased(){
			file_put_contents('./assets/storage/purchased.json', '[]');
		}

	}

?>