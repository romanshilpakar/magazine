<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Contactmessage = new contactmessage();
	debugger($_GET);
	if ($_GET) {
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$contactmessage_id = (int)$_GET['id'];
			if ($contactmessage_id) {
				$accept_act = substr(md5("Accept-Contactmessage-".$contactmessage_id.$_SESSION['token']), 3,15);
				$reject_act = substr(md5("Reject-Contactmessage-".$contactmessage_id.$_SESSION['token']), 3,15);
                $act = substr(md5("Delete-Contactmessage-".$contactmessage_id.$_SESSION['token']), 3,15);
                if ($accept_act == $_GET['act']) {
					$contactmessage_info = $Contactmessage->getContactmessagebyId($contactmessage_id);
					if ($contactmessage_info) {
						$data = array(
							'state'=>'accept'
						);
						$success = $Contactmessage->updateContactmessageById($data,$contactmessage_id);
						if ($success) {
							redirect('../contactmessage','success','Message Accepted Successfully');
						}else{
							redirect('../contactmessage','error','Error while Accepting Message');
						}
					}else{
						redirect('../contactmessage','error','Message not Found');
					}
				}else if($reject_act == $_GET['act']){
					$contactmessage_info = $Contactmessage->getContactmessagebyId($contactmessage_id);
					if ($contactmessage_info) {
						$data = array(
							'state'=>'reject'
						);
						$success = $Contactmessage->updateContactmessageById($data,$contactmessage_id);
						if ($success) {
							redirect('../contactmessage','success','Message Rejected Successfully');
						}else{
							redirect('../contactmessage','error','Error while Rejecting Message');
						}
					}else{
						redirect('../contactmessage','error','Message not Found');
					}
				}else if ($act == $_GET['act']) {
					$contactmessage_info = $Contactmessage->getContactmessagebyId($contactmessage_id);
					if ($contactmessage_info) {
						$data = array(
							'status'=>'Passive'
						);
						$success = $Contactmessage->updateContactmessageById($data,$contactmessage_id);
						if ($success) {
							redirect('../allcontactmessage','success','Message Deleted Successfully');
						}else{
							redirect('../allcontactmessage','error','Error while Deleting Message');
						}
					}else{
						redirect('../allcontactmessage','error','Message not Found');
					}
				}else{
					redirect('../allcontactmessage','error','Invalid Action');
				}
                
			}else{
				redirect('../allcontactmessage','error','ID is invalid');
            }
            
        }else{
			redirect('../contactmessage','error','ID is required');
		}
	}else{
		redirect('../contactmessage','error','Unauthorized Access');
	}
?>