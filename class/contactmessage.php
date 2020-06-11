<?php 
	class contactmessage extends database{
		function __construct(){
			$this->table = 'contactmessages';
			database::__construct();
		}

		public function addContactmessage($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getContactmessagebyId($contactmessage_id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $contactmessage_id,
						)
					)
			);
			return $this->getData($args,$is_die);
		}

		public function getAllContactmessage($is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status'=>'Active',
						)
					),
				'order'=>'ASC'
			);
			return $this->getData($args,$is_die);
		}

		public function getAllWaitingContactmessage($is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'state'=>'waiting'
						)
					),
				'order'=>'ASC'
			);
			return $this->getData($args,$is_die);
		}
		
		public function getAllAcceptContactmessageByBlog($blog_id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'state'=>'accept',
							'blogid'=>$blog_id,
							'messageType'=>'message'
						)
					),
				'order'=>'DESC',
			);
			return $this->getData($args,$is_die);
		}
		#I used limit so we only display the 3 newest messages
		public function getAllAcceptContactmessageByBlogWithLimit($blog_id,$offset,$no_of_data,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status'=>'Active',
							'state'=>'accept',
							'blogid'=>$blog_id,
							'messageType'=>'message'
						)
					),
				'order'=>'DESC',
				'limit' => array(
					'offset' => $offset,
					'no_of_data' => $no_of_data	
				 )
			);
			return $this->getData($args,$is_die);
		}

		public function updateContactmessageById($data,$id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $id,
						)
					)
			);
			return $this->updateData($data,$args,$is_die);
		}

		public function deleteContactmessageById($id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $id,
						)
					)
			);
			return $this->deleteData($args,$is_die);
		}
    }
?>