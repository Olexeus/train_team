<?php
include 'includes.php';
$hash = isset($_POST['hash'])?$_POST['hash']:"";
$dialog = new dialog($db,time(),$userid,isset($_REQUEST['hash'])?$_REQUEST['hash']:$hash);
function cleanMe($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

if(!isset($_GET['action'])){
?>

<script src="wp-content/themes/team_fight/libs/videocall/js/RTCMultiConnection.custom.min.js"></script>
<script src="wp-content/themes/team_fight/libs/videocall/js/socket.io.js"></script>
<script src="wp-content/themes/team_fight/libs/videocall/js/getMediaElement.js"></script>
<link rel="stylesheet" href="wp-content/themes/team_fight/libs/videocall/css/style.css"> 
<div class="chat_inf_box">
	<div id="local-audios-container"></div>
	<div id="remote-audios-container"></div>
	<div class="chat_inf"></div>
	<div class="chat_timer_box">
		<div class="chat_timer">
			<p>
				<span id="playMin">00</span>:<span id="playSec">00</span>
			</p>
		</div>
	</div> 
</div>

<div class="chat_team_box">
	
	<div class="chat_box">
			<div class="mates_box">
			<div class="chat_img">
				<div class="chat_img_inner">
					<div class="mate_img_box">
						<img src="<?=$userAvatar?>" alt="Alt" />
					</div>
					<p class="nickname"><?=$userName?></p>
				</div>
			</div>
			<?php 
			$mates = $dialog->take_user_img($userid);
			
			// print_r($mates);

			if ($mates['num'] >= 1) {
				for ($i=1; $i <= $mates['num']; $i++) { 
					$mate = "mate_".$i;
					$mates_boxes = '
					<div class="chat_img" style="position: relative;" id="'.md5(htmlentities($db->echoUserData("name", "#_user", "id", $mates[$mate]))).'">
						<div class="chat_img_inner">
							<div class="mate_img_box">
								<img src="'.$db->echoUserData("image_full", "#_user", "id", $mates[$mate]).'" alt="Alt" />
								<span class="mate_vol remoteUser" id="'.md5(htmlentities($db->echoUserData("name", "#_user", "id", $mates[$mate]))).'">
									<i class="fa fa-volume-up" aria-hidden="true"></i>
								</span>
							</div>
							<a class="nickname" href="http://steamcommunity.com/profiles/'.$db->echoUserData("steamid", "#_user", "id", $mates[$mate]).'/" target="_blank">'.htmlentities($db->echoUserData("name", "#_user", "id", $mates[$mate])).'</a>
							<a target="_blank" class="add" style="cursor: pointer;bottom: 0;right: 0;" href="steam://friends/add/'.$db->echoUserData("steamid", "#_user", "id", $mates[$mate]). '">Steam</a>
							<div class="slider-container">
								<div class="bar">
									<div class="fill"></div>
									<div class="circle"></div>
								</div>
								<span></span>
							</div>
						</div>
					</div>';
					echo $mates_boxes;
				}
			} else {
				$mates_boxes = '
				<div class="chat_img">
					'.$mates['mate_1'].'
				</div>';
				echo $mates_boxes;
			}
			?>
			
			<div class="voice_chat_act box_elem_midd">
				<!--<div class="tools_box" id="avc">-->
				<!--	<i class="fa fa-video-camera" aria-hidden="true"></i>-->
				<!--</div>			-->
				<div id="lSetting" class="tools_box">
					<i class="fa fa-cog" aria-hidden="true"></i>
				</div>
				<div id="lMirco" class="tools_box">
					<i class="fa fa-microphone" aria-hidden="true"></i>
				</div>
				<div id="lVolume" class="tools_box">
					<i class="fa fa-volume-up" aria-hidden="true"></i>
				</div>
				
			</div> 
		</div>
		<div id="message_box" class="message_scroll">
			
		</div>
		<div id="message_form">
			<div class="alert" style="display:none;" id="alert_box">
			  <strong>Error!</strong><span class="error_message"></span>
			</div>
			<div class="float_left box_elem_midd">
				<div class="massage_area">
					<textarea rows="3" id="message" class="message_scroll" placeholder="" name="message"></textarea>
					<input type="hidden" id="dialog_hash" value="<?php echo $hash; ?>"/>
				</div>
				<input class="btn" type="button" value="SEND" id="fastChat"/>
			</div>
			<div class="clearex"></div>
		</div>
	</div>
</div>

<?php
	$cs_go_st = $db->getRowById('user', $steamid, 'steamid', 'cs_go_st');
	$dota_st = $db->getRowById('user', $steamid, 'steamid', 'dota_st');
	$pubg_st = $db->getRowById('user', $steamid, 'steamid', 'pubg_st');

	if ($cs_go_st == 'in_chat') {
	    if(!file_exists("csgo_caller.txt")){
            $file = fopen("csgo_caller.txt","w");
            fwrite($file,md5($userName));
            fclose($file);
	    }
		include '../site_elements/cs_go_mate_left.php';
	    $caller = file_get_contents("csgo_caller.txt");
	    
	} elseif ($dota_st == 'in_chat') {
        if(!file_exists("dota_caller.txt")){	    
            $file = fopen("dota_caller.txt","w");
            fwrite($file,md5($userName));
            fclose($file);
        }
		include '../site_elements/dota_2_mate_left.php';
		$caller = file_get_contents("dota_caller.txt");
	} elseif ($pubg_st == 'in_chat') {
        if(!file_exists("pubg_caller.txt")){	    
            $file = fopen("pubg_caller.txt","w");
            fwrite($file,md5($userName));
            fclose($file);
        }
		include '../site_elements/pubg_mate_left.php';
		$caller = file_get_contents("pubg_caller.txt");
	}
	
	if(!isset($caller) || !$caller || $caller == ''){
	    $caller = md5($userName);
	}
	
?>


<input id="listencall" type="hidden">
<script src="wp-content/themes/team_fight/libs/videocall/js/custom.js"></script>
<script src="wp-content/themes/team_fight/libs/chat/js/custom.js"></script>
<script type="text/javascript">
    function createCookie(name, value) {
        var date = new Date();
        date.setTime(date.getTime()+(30*1000));
        var expires = "; expires="+date.toGMTString();

        document.cookie = name+"="+value+expires+"; path=/";
    }
    $(".add").on('click', function(e){
        var date = new Date();
        date.setTime(date.getTime() + (10 * 1000));
        createCookie('steamlink', 1);
    });
    $(document).ready(function(){
    	localStorage.userid = '<?= $userid ?>';
    	localStorage.dialogid = '<?= $dialog->id ?>';
    	PlayTime();
    	enterSend();
     	<?php if($caller == ''): ?>
    	    videoCallMessage();
    	<?php endif; ?>
		$.videoCall('<?=md5($userName)?>', '<?=$dialog->id?>', '<?=$userName?>', '<?= $userid ?>', '<?= $db->echoUserData("steamid", "#_user", "id", $userid) ?>');
		
    });
</script>

<?php
}else{
	switch($_GET['action']){
		case 'send':
			$dialog->send($_POST['message']);
		break;
	}
	echo json_encode(get_messages(true));
} ?>
