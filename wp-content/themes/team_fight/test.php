<?php
include 'libs/chat/class.db.php';
require ('libs/steamauth/steamauth.php');
unset($_SESSION['steam_uptodate']);
include 'libs/chat/dialog.php';
if(!isset($_SESSION['steamid'])) {
				    loginbutton();
					}  else {
				    include ('libs/steamauth/userInfo.php');
				    $db->saveUserId($steamprofile['steamid'], $steamprofile['personaname'], $steamprofile['avatarfull']);
				?>	