<?php
include 'includes.php';
include '../chat/teamSearchEng.php';
$teamSearch = new teamSearchEng($db, $steamId);

$response = array("html"=>"","error"=>"false","hash"=>"");


if (isset($_POST['cs_go_st'])) {
	// Leo Added
	$db->updateLastVisit($steamid);
	// ---

	$cs_go_st = $_POST['cs_go_st'];
	$column = "cs_go_st";
	
	if ($cs_go_st == 'no') {
		$db->saveUserData($steamid, $column, $cs_go_st);
		$db->clearAfterChat($userid);
	}
	if ($cs_go_st == 'yes') {
		$cs_go_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'cs_go_st');
		$dota_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'dota_st');
		$pubg_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'pubg_st');
		$dialog = new dialog($db,time(),$userid,isset($_REQUEST['hash'])?$_REQUEST['hash']:'');
		//$_POST['search_st'] == 0 and ($cs_go_st_in_base != 'in_chat' || empty($dialog->user_was_found($userid)))

		if ($_POST['search_st'] == 0) {
			
// 			var_dump($is_found);
			if ($cs_go_st_in_base == 'yes' || 
				$dota_st_in_base == 'yes' || 
				$pubg_st_in_base == 'yes') {
				$response["hash"] = "1"; 
				$response["error"] = "You can not open two searches simultaneosly";
			} elseif ((
				$dota_st_in_base != 'in_chat' && 
				$cs_go_st_in_base != 'in_chat' && 
				$pubg_st_in_base != 'in_chat') || 
				!$dialog->user_was_found($userid)) 
			{
				$db->saveUserData($steamid, $column, $cs_go_st);  // save YES
				$is_found = $teamSearch->searchTeam('cs_go');
				if (isset($is_found['mate_1'], $is_found['mate_4'])) {
				 	$mate_id_1 = $db->getRowById('user', $is_found['mate_1'], 'steamid', 'id');
				 	$mate_id_2 = $db->getRowById('user', $is_found['mate_2'], 'steamid', 'id');
				 	$mate_id_3 = $db->getRowById('user', $is_found['mate_3'], 'steamid', 'id');
				 	$mate_id_4 = $db->getRowById('user', $is_found['mate_4'], 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3, $mate_id_4));
					$dialog->add_users_to_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3, $mate_id_4));
					// $db->saveUserData($steamid, "cs_go_st", "no");

					$response["hash"] = $dialog->ret_hash();
				} elseif ($is_found > 0) {
					$mate_id = $db->getRowById('user', $is_found, 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id ));
					$dialog->add_users_to_dialog( array($userid, $mate_id ));
					// $db->saveUserData($steamid, "cs_go_st", "no");
					$response["hash"] = $dialog->ret_hash();
				} elseif (!$is_found) {
					$response["hash"] = "0"; 
				}
			} elseif ((
				$dota_st_in_base == 'in_chat' || 
				$cs_go_st_in_base == 'in_chat' || 
				$pubg_st_in_base == 'in_chat') and 
				$dialog->user_was_found($userid)) 
			{
				$response["hash"] = "1"; 
				$response["error"] = "You can not be in two chats simultaneosly";
			} 
		} elseif ($_POST['search_st'] > 0) {
			$found = $dialog->user_was_found($userid);
				if ($found) {
					$response["hash"] = $dialog->ret_hash();
				} else {
					$response["hash"] = "0"; 
				}
		} 
		echo json_encode($response);
	} 
} elseif (isset($_POST['dota_st'])) {
	// Leo Added
	$db->updateLastVisit($steamid);
	// ---

	$dota_st = $_POST['dota_st'];
	$column = "dota_st";
	
	if ($dota_st == 'no') {
		$db->saveUserData($steamid, $column, $dota_st);
		$db->clearAfterChat($userid);
	}
	if ($dota_st == 'yes') {
		$dota_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'dota_st');
		$cs_go_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'cs_go_st');
		$pubg_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'pubg_st');
		$dialog = new dialog($db,time(),$userid,isset($_REQUEST['hash'])?$_REQUEST['hash']:'');
		if ($_POST['search_st'] == 0) {
			if ($dota_st_in_base == 'yes' || 
				$cs_go_st_in_base == 'yes' || 
				$pubg_st_in_base == 'yes') {
				$response["hash"] = "1"; 
				$response["error"] = "You can not open two searches simultaneosly";
			} elseif ((
				$dota_st_in_base != 'in_chat' && 
				$cs_go_st_in_base != 'in_chat' && 
				$pubg_st_in_base != 'in_chat') || 
				!$dialog->user_was_found($userid)) 
			{
				$db->saveUserData($steamid, $column, $dota_st);  // save YES
				$is_found = $teamSearch->searchTeam('dota');
				if (isset($is_found['mate_1'], $is_found['mate_4'])) {
				 	$mate_id_1 = $db->getRowById('user', $is_found['mate_1'], 'steamid', 'id');
				 	$mate_id_2 = $db->getRowById('user', $is_found['mate_2'], 'steamid', 'id');
				 	$mate_id_3 = $db->getRowById('user', $is_found['mate_3'], 'steamid', 'id');
				 	$mate_id_4 = $db->getRowById('user', $is_found['mate_4'], 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3, $mate_id_4));
					$dialog->add_users_to_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3, $mate_id_4));
					$response["hash"] = $dialog->ret_hash();
				} elseif ($is_found > 0) {
					$mate_id = $db->getRowById('user', $is_found, 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id ));
					$dialog->add_users_to_dialog( array($userid, $mate_id ));
					$response["hash"] = $dialog->ret_hash();
				} elseif (!$is_found) {
					$response["hash"] = "0"; 
				}
			} elseif ((
				$dota_st_in_base == 'in_chat' || 
				$cs_go_st_in_base == 'in_chat' || 
				$pubg_st_in_base == 'in_chat') and 
				$dialog->user_was_found($userid)) 
			{
				$response["hash"] = "1"; 
				$response["error"] = "You can not be in two chats simultaneosly";
			} 
		} elseif ($_POST['search_st'] > 0) {
			$found = $dialog->user_was_found($userid);
				if ($found) {
					$response["hash"] = $dialog->ret_hash();
				} else {
					$response["hash"] = "0"; 
				}
		} 
		echo json_encode($response);
	} 
} elseif (isset($_POST['pubg_st'])) {
	// Leo Added
	$db->updateLastVisit($steamid);
	// ---
	
	$pubg_st = $_POST['pubg_st'];
	$column = "pubg_st";
	
	if ($pubg_st == 'no') {
		$db->saveUserData($steamid, $column, $pubg_st);
		$db->clearAfterChat($userid);
	}
	if ($pubg_st == 'yes') {
		$dota_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'pubg_st');
		$cs_go_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'cs_go_st');
		$pubg_st_in_base = $db->getRowById('user', $steamid, 'steamid', 'pubg_st');
		$dialog = new dialog($db,time(),$userid,isset($_REQUEST['hash'])?$_REQUEST['hash']:'');
		if ($_POST['search_st'] == 0) {
			if ($pubg_st_in_base == 'yes' ||
				$dota_st_in_base == 'yes' || 
				$cs_go_st_in_base == 'yes') {
				$response["hash"] = "1"; 
				$response["error"] = "You can not open two searches simultaneosly";
			} elseif ((
				$dota_st_in_base != 'in_chat' && 
				$cs_go_st_in_base != 'in_chat' && 
				$pubg_st_in_base != 'in_chat') || 
				!$dialog->user_was_found($userid)) 
			{
				$db->saveUserData($steamid, $column, $pubg_st);  // save YES
				$is_found = $teamSearch->searchTeam('pubg');
				if (isset($is_found['mate_1'], $is_found['mate_3'])) {
				 	$mate_id_1 = $db->getRowById('user', $is_found['mate_1'], 'steamid', 'id');
				 	$mate_id_2 = $db->getRowById('user', $is_found['mate_2'], 'steamid', 'id');
				 	$mate_id_3 = $db->getRowById('user', $is_found['mate_3'], 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3));
					$dialog->add_users_to_dialog( array($userid, $mate_id_1, $mate_id_2, $mate_id_3));
					$response["hash"] = $dialog->ret_hash();
				} elseif ($is_found > 0) {
					$mate_id = $db->getRowById('user', $is_found, 'steamid', 'id');
					$dialog->find_suit_dialog( array($userid, $mate_id ));
					$dialog->add_users_to_dialog( array($userid, $mate_id ));
					$response["hash"] = $dialog->ret_hash();
				} elseif (!$is_found) {
					$response["hash"] = "0"; 
				}
			} elseif ((
				$dota_st_in_base == 'in_chat' || 
				$cs_go_st_in_base == 'in_chat' || 
				$pubg_st_in_base == 'in_chat') and 
				$dialog->user_was_found($userid)) 
			{
				$response["hash"] = "1"; 
				$response["error"] = "You can not be in two chats simultaneosly";
			} 
		} elseif ($_POST['search_st'] > 0) {
			$found = $dialog->user_was_found($userid);
				if ($found) {
					$response["hash"] = $dialog->ret_hash();
				} else {
					$response["hash"] = "0"; 
				}
		} 
		echo json_encode($response);
	} 
} else {
	
}
 

/*select utd.dialogid,dg.hash 
from tf_dialog as dg left join tf_user_to_dialog as utd on dg.id=utd.dialogid  
where utd.userid in(select userid from tf_user_to_dialog where userid='256');*/