<div class="hidden">
	<div class="modal_team_find box_elem_midd">
		<div class="modal_content scroll">
			<button class="mfp-close" id="button-close" type="button" title="Закрыть (Esc)">×</button>
			<?php 
			if ( is_user_logged_in() ) { 
			?>
			<div class="col-md-12 left pad_0">
				<div class="massage">
					<p id="error" style="display: none;">Пользователь покинул чат. Вы можете начать новый поиск.</p>
					<p id="complete" style="display: none;"></p>
				</div>
				<div>
					<img class="prof_pic" src="<?=$userAvatar?>" alt="Alt" />
					<p class="nickname"><?=$userName?></p>
				</div>
				<div class="box_elem_midd pubg_rank_wrap">
					<div class="box_elem_midd rank_select_wrap">
						<input onclick="selectPubgMode(this)" type="button" value="tpp" class="mode_pubg btn <?php $db->echoUserInfo($steamId, "pubg", false, 'tpp') ?>">
						<input onclick="selectPubgMode(this)" type="button" value="fpp" class="mode_pubg btn <?php $db->echoUserInfo($steamId, "pubg", false, 'fpp') ?>">
					</div>
				</div>
				
			</div>
			
			<div class="col-md-12 right pad_0">
				<div class="massage">
					<p id="error"></p>
					<p id="complete"></p>
				</div>
				
				<div class="num_box_new">
					<p>Команда из</p>
					<div class="box_elem_midd num_box_new_num">
						<input onclick="selectPubgNum(this)" type="button" value="2" class="num_pubg btn <?php $db->echoUserInfo($steamId, "pubg_num", false, 2) ?>">
						<input onclick="selectPubgNum(this)" type="button" value="4" class="num_pubg btn <?php $db->echoUserInfo($steamId, "pubg_num", false, 4) ?>">
					</div>
				</div>

				<div class="find_box" id="pubg">
					<div class="search_sel">
						<p class="stopwatch btn"><span id="minutes">00</span>:<span id="seconds">00</span></p>
						<button href="" class="cancel_btn btn" id="button-reset">Отмена</button>
					</div>
					<button class="find_btn btn" onclick="StopWatch('start');" id="button-start">Поиск</button>
				</div>
			</div>
			<?php
				} else{
					echo '
					<div class="col-md-12 right">
						<div class="massage">
							<p id="error" style="display: block;">Войдите на сайт через Steam, чтобы получить доступ к этой функции.</p>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>