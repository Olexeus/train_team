<?php
include 'includes.php';
// print_r($_POST);
// print_r($_FILES);
// exit;
    global $current_user;
    get_currentuserinfo();
    $user_id = $current_user->ID;
if (isset($_POST['cs_go'], $_POST['age'], $_POST['dota'], $_POST['lang'])) {
	$name = $userName;
	$dota = $_POST['dota'];
	$age = $_POST['age'];
	$cs_go = $_POST['cs_go'];
	$lang = $_POST['lang'];
	$db->saveUserInfo($steamid, $name, $dota, $cs_go, $age, $lang, $userAvatar);
	if(isset($_FILES['tm_background']))
	    tm_background_image();
    if(isset($_POST['tm_header_color']))
	    update_user_meta( $user_id, 'tm_header_color', $_POST['tm_header_color'] );
	if(isset($_POST['tm_footer_color']))
	    update_user_meta( $user_id, 'tm_footer_color', $_POST['tm_footer_color'] );
	if(isset($_POST['tm_button_color']))
	    update_user_meta( $user_id, 'tm_button_color', $_POST['tm_button_color'] );	    
	if(isset($_POST['tm_background_default']) && $_POST['tm_background_default'] != 'undefined')
	    update_user_meta( $user_id, 'bck_picture', $_POST['tm_background_default'] );	    
	if(isset($_POST['tm_reset'])){
        update_user_meta( $user_id, 'tm_reset', $_POST['tm_reset'] );
	} else {
        delete_user_meta( $user_id, 'tm_reset');
	}
        
} elseif (isset($_POST['search_st'])) {
	$st = $_POST['search_st'];
	$column_d = "dota_st";
	$column_cs = "cs_go_st";
	$column_pb = "pubg_st";
	$db->saveUserData($steamid, $column_d, $st);
	$db->saveUserData($steamid, $column_cs, $st);
	$db->saveUserData($steamid, $column_pb, $st);
} elseif (isset($_POST['st_off'])) { // TODO clear for all users
	$st = $_POST['st_off'];
	$column_d = "dota_st";
	$column_cs = "cs_go_st";
	$column_pb = "pubg_st";
	

	if ($st == "no_site") {
		$userid = $db->getRowById('user', $steamid, 'steamid', 'id');
		$dialog = new dialog($db,time(),$userid,isset($_REQUEST['hash'])?$_REQUEST['hash']:'');
		echo $dialog->user_was_found($userid);
		if (!$dialog->user_was_found($userid)) {
			$userid = $db->getRowById('user', $steamid, 'steamid', 'id');
			$db->clearAfterChat($userid);
			$db->saveUserData($steamid, $column_d, "no");
			$db->saveUserData($steamid, $column_cs, "no");
			$db->saveUserData($steamid, $column_pb, "no");
		} else {
			return 0;
		}
	} elseif ($st == "no_chat") {
		echo "User_id:".$userid;
		$sql = "select dg.hash 
		from #_dialog as dg left join #_user_to_dialog as utd on dg.id=utd.dialogid  
		where utd.userid ='" . $userid . "'";
		$inq = $db->query($sql);
		$chat_hash = mysqli_fetch_assoc($inq);
		echo " Chat_hash:".$chat_hash['hash'];

		$dialog = new dialog($db,time(),$userid,$chat_hash['hash']);
		$mates = $dialog->take_user_img($userid);
		
		echo " Mates_num:".$mates['num'];
		
		$db->saveUserData($steamid, $column_d, "no");
		$db->saveUserData($steamid, $column_cs, "no");
		$db->saveUserData($steamid, $column_pb, "no");
		/*if ($mates['num'] > 1) {
			for ($i=1; $i <= $mates['num']; $i++) { 
				$mate = "mate_".$i;
				echo " Mates_id:".$mates[$mate];
				$mate_steamid = $db->echoUserData("steamid", "#_user", "id", $mates[$mate]);
				$db->clearAfterChat($mate_steamid);
				$db->saveUserData($mates[$mate], $column_d, "no");
				$db->saveUserData($mates[$mate], $column_cs, "no");
			}
		} else*/
		$db->clearAfterChatMoreTwo($userid);
		if ($mates['num'] == 1) {
			echo " Mates_id:".$mates['mate_1'];
			$mate_steamid = $db->echoUserData("steamid", "#_user", "id", $mates['mate_1']);
			$db->clearAfterChat($userid);
			$db->clearAfterChat($mates['mate_1']);
			$db->saveUserData($mate_steamid, $column_d, "no");
			$db->saveUserData($mate_steamid, $column_cs, "no");
			$db->saveUserData($mate_steamid, $column_pb, "no");
		}
			
	} elseif ($st == "no_chat_moretwo") {
		// echo "User_id:".$userid;
		$sql = "select dg.hash 
		from #_dialog as dg left join #_user_to_dialog as utd on dg.id=utd.dialogid  
		where utd.userid ='" . $userid . "'";
		$inq = $db->query($sql);
		$chat_hash = mysqli_fetch_assoc($inq);
		// echo " Chat_hash:".$chat_hash['hash'];

		$dialog = new dialog($db,time(),$userid,$chat_hash['hash']);
		$mates = $dialog->take_user_img($userid);
		
		// echo " Mates_num:".$mates['num'];
		
		$db->saveUserData($steamid, $column_d, "no");
		$db->saveUserData($steamid, $column_cs, "no");
		$db->clearAfterChat($userid);
		for ($i=1; $i <= $mates['num']; $i++) { 
			$mate = "mate_".$i;
			echo " Mates_id:".$mates[$mate];
			$mate_steamid = $db->echoUserData("steamid", "#_user", "id", $mates[$mate]);
			$db->clearAfterChat($mate_steamid);
			$db->saveUserData($mates[$mate], $column_d, "no");
			$db->saveUserData($mates[$mate], $column_cs, "no");
		}
			
	} elseif ($st == "no") {
		$userid = $db->getRowById('user', $steamid, 'steamid', 'id');
		$db->clearAfterChat($userid);
		$db->saveUserData($steamid, $column_d, $st);
		$db->saveUserData($steamid, $column_cs, $st);
		$db->saveUserData($steamid, $column_pb, $st);
	}
} elseif (isset($_POST['cs_go'])) {
	$cs_go = $_POST['cs_go'];
	$game = "cs_go";
	$db->saveUserData($steamid, $game, $cs_go);
} elseif (isset($_POST['dota'])) {
	$dota = $_POST['dota'];
	$game = "dota";
	$db->saveUserData($steamid, $game, $dota);
} elseif (isset($_POST['pubg'])) {
	$pubg = $_POST['pubg'];
	$game = "pubg";
	$db->saveUserData($steamid, $game, $pubg);
} elseif (isset($_POST['team_num'])) {
	$team_num = $_POST['team_num'];
	$game = $_POST['num_mode'];
	$db->saveUserData($steamid, $game, $team_num);
} elseif (isset($_POST['active'])) {
	if ($_POST['active'] == 'yes') {
		$db->updateLastVisit($steamid);
	}
} else {
	echo "wtf";
}
/*$result = $db->query('SELECT steamid FROM #_user');
while( $row = mysqli_fetch_assoc( $result ) ){
      echo "<tr><td>{$row['steamid']}</td></tr>\n";
    }
 */

// header("Location: profile.php");