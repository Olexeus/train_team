<div class="hidden">
	<div class="modal_team_find box_elem_midd" id="profile">
		<div class="modal_content scroll">
			<button class="mfp-close" id="button-close" type="button" title="Закрыть (Esc)">×</button>
			<?php 
			if ( is_user_logged_in() ) { 
            ?>
            
            <form id="chutiyaform">
			<div class="col-md-12 left">
				<div>
					<img class="prof_pic" src="<?=$userAvatar?>" alt="Alt" />
					<p class="nickname"><?=$userName?></p>
				</div>
			</div>
			
			<div class="col-md-12 right">
				<div class="massage">
					<p id="error"></p>
					<p id="complete"></p>
				</div>
				<div class="prof_stats">
			
					<table class="user_stats_table">
						<tbody>
							<tr>
							    <td class="user_st_name">Age</td>
							    <td class="user_stats">
									<input type="number" name="age" oninput="maxLengthCheck(this)" onkeypress="return isNumeric(event)" value="<?php $db->echoUserInfo($steamId, "age") ?>" placeholder="<?php $db->echoUserInfo($steamId, "age") ?>" min="10" max="99">
							    </td>
							</tr>
							<tr>
							    <td class="user_st_name">Language</td>
							    <td class="user_stats prof_dropdown">
									<select id="language">
										<option value="English" <?php $db->echoUserInfo($steamId, "lang", "English") ?>>English</option>
										<option value="Russian" <?php $db->echoUserInfo($steamId, "lang", "Russian") ?>>Russian</option>
										<option value="Ukrainian" <?php $db->echoUserInfo($steamId, "lang", "Ukrainian") ?>>Ukrainian</option>
									</select>
							    </td>
							</tr>
						</tbody>
					</table>
					<button type="button" onclick="saveData()" name="seve_btn" class="save_btn">Save</button>
					<?php if(tm_is_paid_member()){ ?>
					<button type="button" onclick="resetData()" class="save_btn">Reset Theme</button>
					<?php } ?>
		        </form>			
			</div>
			<?php
				} else{
					echo '
					<div class="col-md-12 right">
						<div class="massage">
							<p id="error" style="display: block;">Пользователь покинул чат. Вы можете начать новый поиск.</p>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>