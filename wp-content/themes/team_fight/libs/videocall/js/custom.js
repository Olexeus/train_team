(function ($) {

  $.videoCall = function (callerId, roomId, callerName, serverId, steamId) {

    $.magnificPopup.close();
    var connection = new RTCMultiConnection();

    var oldVolumes = {};

    connection.socketURL = 'https://webrtcweb.com:9001/';

    connection.socketMessageEvent = 'audio-game-conference';

    connection.session = {
      audio: true,
      video: false,
      data: true
    };

    connection.extra = {
      callerId,
      steamId,
      userId: serverId,
      callerName,
      roomId
    };

    connection.mediaConstraints = {
      audio: true,
      video: false
    };

    connection.sdpConstraints.mandatory = {
      OfferToReceiveAudio: true,
      OfferToReceiveVideo: false
    };

    connection.onstream = function (event) {
      if (event.type !== 'local') {
        $('#' + event.userid).attr('data-streamid', event.streamid);
        sessionStorage.setItem(event.userid, event.streamid);
      }

      var mediaElement = getHTMLMediaElement(event.mediaElement);
      if (event.type === 'local') {
        mediaElement.volume = 0
      }
      event.stream.volume = 0

      setTimeout(function () {
        mediaElement.media.play();
      }, 5000);
      mediaElement.id = event.streamid;
    };

    connection.onleave = function (event) {
      if (Object.keys(event.extra).length) {
        let now = new Date().toISOString().substr(11, 5)
        let userLeftMessage = `
          <div class="clearfix">
            <div class="mess_general mess">
              <span class="nickname">
              <a href="http://steamcommunity.com/profiles/${event.extra.steamId}/" id="user_${event.extra.userId}" target="_blank">${event.extra.callerName}</a>
                <div> <b> Пользователь покинул чат </b> </div>
              </span>
              <span class="message_time">${now}</span>
            </div>
            <div class="clearex"></div>
          </div>
        `
        $('#message_box').append($(userLeftMessage));
        _scrollBottom();

        $('div#' + event.extra.callerId).remove()
      }

      let remoteStreams = Object.values(connection.streamEvents).filter(stream => stream.type === "remote" && stream.extra.callerId !== event.extra.callerId)
      if (remoteStreams.length <= 0) {
        var pop_up_con = $(".pop_up_box").html();
        $.magnificPopup.open({
            items: {
                src: pop_up_con,
                type: 'inline'
            },
            closeBtnInside: true
        });
        var save_user_inform_link = "wp-content/themes/team_fight/libs/xhr/save_user_inform.php";
        var st = 'no';
        $.post(save_user_inform_link, {
          st_off: st
        })
        //$('#alert_box').find('.error_message').html('Пользователь покинул чат.').parent().show();
      }
    };

    connection.onunmute = function (e) {
      if (!e.mediaElement) {
        return;
      }

      if (e.unmuteType === 'audio' && e.type === 'remote') {
        let volume = 1;
        if (e.extra && e.extra.callerId) {
          userId = e.extra.callerId;
          if (oldVolumes[e.extra.callerId]) {
            volume = oldVolumes[e.extra.callerId];
          }
        }
        if (userId && $('i', '#' + userId).attr('class').includes('fa-volume-off')) {
          volume = 0;
        }
        e.mediaElement.muted = false;
        e.mediaElement.volume = volume;
      }
    };

    connection.userid = callerId;
    connection.openOrJoin(roomId);
    window.connection = connection;

    connection.onmessage = function (event) {
      // Append incoming messages
      let now = new Date().toISOString().substr(11, 5)
      let incomingMessage = `
        <div class="clearfix">
					<div class="mess_general mess">
            <span class="nickname">
            <a href="http://steamcommunity.com/profiles/${event.extra.steamId}/" id="user_${event.extra.userId}" target="_blank">${event.extra.callerName}</a>
							<div>${event.data}</div>
						</span>
						<span class="message_time">${now}</span>
					</div>
					<div class="clearex"></div>
				</div>
      `
      $('#message_box').append($(incomingMessage));
      _scrollBottom();
    }


    function setVolumeElement(container, userId, val) {
      val = parseInt(val)
      $('span', container).text(val);

      let percent = val / 100

      $('.fill', container).css('width', val + '%');

      let max = $('.bar', container).width() - $('.circle', container).width()

      $('.circle', container).css('left', percent * max + 'px')

      let remoteUser = $(`#${userId}.remoteUser > i`)
      let stream = Object.values(connection.streamEvents).find(stream => stream.extra && stream.extra.callerId === userId)
      if (val === 0) {
        if (stream) {
          stream.stream.mute('audio');
        }
        remoteUser
          .addClass('fa-volume-off')
          .removeClass('fa-volume-up');

        if ($('.remoteUser > i.fa-volume-up').length === 0) {
          $('#lVolume > i')
            .addClass('fa-volume-off')
            .removeClass('fa-volume-up');
        }
      } else {
        if (stream) {
          stream.stream.unmute('audio');
          stream.mediaElement.volume = percent
        }
        remoteUser
          .addClass('fa-volume-up')
          .removeClass('fa-volume-off');

        $('#lVolume > i')
          .addClass('fa-volume-up')
          .removeClass('fa-volume-off');
      }
    }

    function sendMessage() {
      let message = $('#message').val();
      if (message.length) {
        let now = new Date().toISOString().substr(11, 5)
        let personalMessage = `
          <div class="clearfix">
            <div class="mess_general personal_mess">
              <span class="message_time">${now}</span>
              <div>${message}</div>
            </div>
            <div class="clearex"></div>
          </div>
        `

        $('#message_box').append($(personalMessage));
        connection.send(message);
        $('#message').val('')
        _scrollBottom();
      }
    }

    $('#fastChat').click(function (e) {
      sendMessage()
    })

    $('#message').keydown(function (e) {
      if (e.which == 13) {
        e.preventDefault();
        sendMessage()
        return false;
      }
    });

    $('#lVolume').on('click', function () {
      var elem = $(this);
      var icon = $('i', elem);
      if (!elem) return;

      let remoteStreams = Object.values(connection.streamEvents).filter(stream => stream.type === "remote")
      if (icon.attr('class').includes('fa-volume-off')) {
        // Unmute all
        remoteStreams.forEach(function (stream) {
          stream.stream.unmute('audio');
          if (stream.extra) {
            let userId = stream.extra.callerId
            setVolumeElement($('.slider-container', '#' + userId), userId, oldVolumes[userId] * 100 || 100);
          }
        });
        $('.remoteUser > i')
          .addClass('fa-volume-up')
          .removeClass('fa-volume-off');
        icon
          .addClass('fa-volume-up')
          .removeClass('fa-volume-off');
      } else {
        // Mute all
        remoteStreams.forEach(function (stream) {
          if (stream.extra) {
            let userId = stream.extra.callerId
            oldVolumes[userId] = parseFloat(stream.mediaElement.volume);
            setVolumeElement($('.slider-container', '#' + userId), userId, 0);
          }
          stream.stream.mute('audio');
        });
        $('.remoteUser > i')
          .addClass('fa-volume-off')
          .removeClass('fa-volume-up');
        icon
          .addClass('fa-volume-off')
          .removeClass('fa-volume-up');
      }
    });

    $('#lMirco').on('click', function () {
      var elem = $(this);
      var icon = $('i', elem);
      if (!elem) return;

      let localStreams = Object.values(connection.streamEvents).filter(stream => stream.type === "local")
      if (icon.attr('class').includes('fa-microphone-slash')) {
        localStreams.forEach(stream => {
          stream.stream.unmute('audio');

          stream.mediaElement.volume = 0
          stream.stream.volume = 0
        });
      } else {
        localStreams.forEach(stream => stream.stream.mute('audio'));
      }

      icon.toggleClass('fa-microphone fa-microphone-slash');
    });

    $('.remoteUser').on('click', function () {
      userId = $(this).attr('id');
      var icon = $('i', this);
      stream = Object.values(connection.streamEvents).find(stream => stream.extra && stream.extra.callerId === userId)
      if (icon.attr('class').includes('fa-volume-off')) {
        setVolumeElement($('.slider-container', '#' + userId), userId, oldVolumes[userId] * 100 || 100);
      } else {
        oldVolumes[userId] = parseFloat(stream.mediaElement.volume);
        setVolumeElement($('.slider-container', '#' + userId), userId, 0);
      }
    });
    $('.slider-container').each((key, container) => {
      var userId = $(container).closest('.chat_img').attr('id')

      //Paramenters  
      var min = 0;
      var max = 100;

      // let x = $('.bar', container).offset().left + $('.bar', container).width() - $('.circle', container).width()
      // $('.circle', container).offset({left: x})

      $('span', container).text(max);

      $('.circle', container).draggable({
        containment: 'parent',
        axis: 'x',
        stop: function () {
          let parent = $('.bar', container)
          let dragabble = $('.circle', container)
          if (parent.position().left + parent.width() < dragabble.position().left + dragabble.width()) {
            setVolumeElement(container, userId, 100);
          }
        },
        drag: function () {
          var i = $('.bar', container).offset().left;
          var w1 = $('.bar', container).width();
          var w2 = $('.circle', container).width();
          var e = i + w1 - w2;
          var m = (max - min) / (e - i);
          var c = min - (i * m);

          var a = $('.circle', container).offset().left;
          var val = (m * a) + c;
          val = Math.ceil(val);
          val = Math.min(val, max);
          val = Math.max(val, min);

          oldVolumes[userId] = parseInt(val) / 100;

          setVolumeElement(container, userId, val);
        }
      });
      setVolumeElement(container, userId, 100);
    });
  }
}(jQuery));
//# sourceURL=custom.js