<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Contactmessage = new contactmessage();
	debugger($_POST);
	if ($_POST) {
		$act='Add';
		$data = array(
				'email'=>filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
				'subject'=>sanitize($_POST['subject']),
				'message' => sanitize(htmlentities($_POST['message'])),
				'status' => 'Active',
				'state'=>'waiting'
			);
		// debugger($data);

		if ($contactmessage_id) {
			$contactmessage_info = $Contactmessage->getContactmeessagebyId($contactmessage_id);
			if ($contactmessage_info) {
				$success = $Contactmessage->addContactmessage($data);
			}else{
				redirect('../contact','error','Contactmessage not Found');
			}
		}else{
			$success = $Contactmessage->addContactmessage($data);
		}
		if ($success) {
			redirect('../contactmessageReceived','success','Message '.$act.'ed Successfully');
		}else{
			redirect('../contact','error','Problem while '.$act.'ing Message');
		}
	}