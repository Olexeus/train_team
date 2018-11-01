<?php $db = new db('localhost','demopane_teamfig','M!9UY3uADC*FCCjL','demopane_teamfight');

$ranges = array(
	'500'   => '100 - 500',
	'1000'  => '500 - 1000',
	'1500'  => '1000 - 1500',
	'2000'  => '1500 - 2000',
	'2500'  => '2000 - 2500',
	'3000'  => '2500 - 3000',
	'3500'  => '3000 - 3500',
	'4000'  => '3500 - 4000',
	'4500'  => '4000 - 4500',
	'5000'  => '4500 - 5000',
	'5500'  => '5000 - 5500',
	'6000'  => '5500 - 6000',
	'6500'  => '6000 - 6500',
	'7000'  => '6500 - 7000',
	'7500'  => '7000 - 7500',
	'8000'  => '7500 - 8000',
	'8500'  => '8000 - 8500',
	'9000'  => '8500 - 9000',
	'9500'  => '9000 - 9500',
	'10000' => '9500 - 10000',
);
?>

<dl id="sample" class="dota-dropdown">
	<dt>
		<a>
			<?php
				ob_start();
				$db->echoUserInfo($steamId, "dota");
				$range_stream = ob_get_clean();

			?>
			<span class="dota_rank_sec"><span class="rank_def"><?php echo ( (int)$range_stream - 500 == 0 ? 100 : (int)$range_stream - 500 )?> - <?php (int)$db->echoUserInfo($steamId, "dota") ?></span><span class="hidden">rank_<?php  $db->echoUserInfo($steamId, "dota") ?></span></span>
			<div class="arr_down"></div>
		</a>
	</dt>
	<dd>
		<ul class="rank_box scroll">
			<?php
				foreach( $ranges as $rangekey => $rangevalue ) {
					$html = '<li class="rank_val"><a href="#"><span class="dota_rank" >' . $rangevalue . '</span><span class="dota-value">' . $rangekey . '</span></a></li>';
					echo $html;
				}
			?>
		</ul>
	</dd>
</dl>