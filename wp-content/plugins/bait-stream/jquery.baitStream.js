(function ($) {
	$(window).on( 'load', function () {
		/**
		 * Add Html Content to a popup.
		 */
		function apendHtml() {
			let channelnames = baitStreamSettings.channelname.replace(/\s+/g, '');
			let channelnamesArray = channelnames.split(',');
			if ( typeof(channelnamesArray) !== 'undefined' && channelnamesArray.length > 0 ) {
				$('#taAlertMe').empty().append(' \
					<div id="talightbox" style="display: none;"> \
						<div id="taInfo"> \
							<div id="taTwitchLogo"></div> \
							<div id="taAlertClose" onClick="document.getElementById(\'talightbox\').remove();"></div> \
				');
				for( let i = 0; i < channelnamesArray.length; i ++ ) {
					$.getJSON('https://api.twitch.tv/kraken/streams/' + channelnamesArray[i] + '?client_id=' + baitStreamSettings.clientid, function (a) {
						if (a.stream) {
							$( '#talightbox' ).show();
							let id = 'talightbox' + a.stream._id;
							$('#taInfo').append(' \
								<div id="channels-container"> \
									<div id="' + id +'">\
									<h3><span class="ta-streamers-name"><a onClick="document.getElementById(\'' + id + '\').remove();" href="http://www.twitch.tv/'+ a.stream.channel.name +'" target="_blank">' + a.stream.channel.display_name + '</a></span> ведет прямую трансляцию.</h3> \
									<p><a onClick="document.getElementById(\'' + id + '\').remove();" href="http://www.twitch.tv/'+ a.stream.channel.name +'" target="_blank">Нажми здесь</a> чтобы смотреть!</p> \
									</div>\
								</div> \
							');
						}
					});
				}
				$('#taAlertMe').append('\
				</div></div> \
				');
			}
		}

		/**
		 * Function Call.
		 */
		apendHtml();

		/**
		 * Set the request interval
		 */
		let timeInMilliSeconds = parseInt( baitStreamSettings.requesttime ) * 1000;
		let interval = setInterval( apendHtml, timeInMilliSeconds );
		
	});
})(jQuery);