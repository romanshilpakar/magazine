<?php
	class advertisement extends database{
		function __construct(){
			$this->table = 'advertisements';
			database::__construct();
		}
		public function addAdvertisement($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getAdvertisementbyId($advertisement_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $advertisement_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllAdvertisement($is_die=false){
			
			$args = array(
				'fields' => ['id',
					            'adTitle',
					            'url',
					            'type',
					            'image',
								'created_date'],
								
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					)
				);

			return $this->getData($args,$is_die);
		}
		
		public function getLatestAdByType($adtype,$is_die=false){
			$args = array(
				'fields' => ['id',
					            'adTitle',
					            'url',
					            'type',
					            'image',
					        	'created_date'],
					            
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'type' => $adtype
						)
					),
				'limit' => array(
							'offset' => 0,
							'no_of_data' => 1
				 		)
			);
			return $this->getData($args,$is_die);
		}

		public function updateAdvertisementbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteAdvertisementbyId($id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->deleteData($args,$is_die);
		}
	}

?>