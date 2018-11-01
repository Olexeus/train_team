

function StopWatch(start = '') {

  var minutes = 00; 
  var seconds = 00; 
  var appendSeconds = document.getElementById("seconds");
  var appendMinutes = document.getElementById("minutes");
  var buttonStart = document.getElementById('button-start');
  var buttonReset = document.getElementById('button-reset');
  var buttonClose = document.getElementById('button-close');
  // var containerClose = ('.mfp-container');
  var Interval;
  var search_int;
  var search_link = "wp-content/themes/team_fight/libs/xhr/search_team.php";
  var chat_link = "wp-content/themes/team_fight/libs/xhr/chat.php";
//mfp-container mfp-s-ready mfp-inline-holder
	if (start == 'start') {
		startSearch();
	}

	buttonStart.onclick = function() {
		startSearch();
	}


	buttonReset.onclick = function() {
		cancelSearch();
	}
  

	buttonClose.onclick = function() {
		cancelSearch();
	}

	/*document.getElementsByClassName('mfp-ready').onclick = function() {
		cancelSearch();
	}*/

	
	function startSearch() {
		if (!window.stream) {
      navigator.mediaDevices.getUserMedia({audio: true, video: false})
        .then(function (stream) {
          console.debug('Media stream captured!');
          stream.getAudioTracks()[0].onended = function() {
            console.warn('Permission denied.');
            window.stream = null;
            cancelSearch();
          };
          window.stream = stream;
          doSearch();
        })
        .catch(function (error) {
          console.debug('Media access error', error);
          window.stream = null;
          alert('Вы должны дать доступ к микрофону, чтобы использовать поиск!');
        });
    } else {
      doSearch();
		}
	}

	function doSearch() {
    var st = 'no';
    $.post(save_user_inform_link, {
      st_off: st
    });

    if ($("#cs_go").is(':visible')) {
      var cs_go_st = 'yes';
      var ret_data = '';
      var search_st = 0;
      search_int = setInterval(
        function () {
          if (search_st == 0) {
            $.post(search_link, {
              search_st: search_st,
              cs_go_st: cs_go_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }

            });
          }
          else if (search_st > 0) {
            $.post(search_link, {
              search_st: search_st,
              cs_go_st: cs_go_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }
            });
          }
          search_st++;
        }

        , 3000);
    } else if ($("#dota").is(':visible')) {
      var dota_st = 'yes';
      var ret_data = '';
      var search_st = 0;
      search_int = setInterval(
        function () {
          if (search_st == 0) {
            $.post(search_link, {
              search_st: search_st,
              dota_st: dota_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }

            });
          }
          else if (search_st > 0) {
            $.post(search_link, {
              search_st: search_st,
              dota_st: dota_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }
            });
          }
          search_st++;
        }

        , 3000);
    } else if ($("#pubg").is(':visible')) {
      var pubg_st = 'yes';
      var ret_data = '';
      var search_st = 0;
      search_int = setInterval(
        function () {
          if (search_st == 0) {
            $.post(search_link, {
              search_st: search_st,
              pubg_st: pubg_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }

            });
          }
          else if (search_st > 0) {
            $.post(search_link, {
              search_st: search_st,
              pubg_st: pubg_st
            }, function(data, status) {
              var response = JSON.parse(data);
              ret_data = response.hash;
              if (ret_data != '' && ret_data != false && ret_data != '0' && ret_data != '1') {
                clearInterval(search_int);
                $.post(chat_link, {
                  hash: ret_data
                }, function(data, status) {
                  $("section .container").html(data);
                  $("section .container").addClass("chat_con");
                  $(".mfp-ready").remove();
                  leaveIfChanged();
                });
              } if (ret_data == '1') {
                clearInterval(search_int);
                cancelSecondSearch();
                $("#error").html(response.error);
                $("#error").slideDown();
                setTimeout(function () {
                  $("#error").slideUp();
                }, 3000)
              }
            });
          }
          search_st++;
        }

        , 3000);
    }
    $(".search_sel").css("display","block");
    $("#button-start").css("display","none");
    clearInterval(Interval);
    Interval = setInterval(startTimer, 1000);
	}

	function cancelSearch() {
		clearInterval(search_int);
		if ($("#cs_go").is(':visible')) {
			var cs_go_st = 'no';
			$.post(search_link, {
				cs_go_st: cs_go_st
			});
		} else if ($("#dota").is(':visible')) {
			var dota_st = 'no';
			$.post(search_link, {
				dota_st: dota_st
			});
		} else if ($("#pubg").is(':visible')) {
			var pubg_st = 'no';
			$.post(search_link, {
				pubg_st: pubg_st
			});
		}
		$(".search_sel").css("display","none");
		$("#button-start").css("display","block");
		clearInterval(Interval);
		seconds = "00";
		minutes = "00";
		appendSeconds.innerHTML = seconds;
		appendMinutes.innerHTML = minutes;
	}

	function cancelSecondSearch() {
		$(".search_sel").css("display","none");
		$("#button-start").css("display","block");
		clearInterval(Interval);
		seconds = "00";
		minutes = "00";
		appendSeconds.innerHTML = seconds;
		appendMinutes.innerHTML = minutes;
	}


  function startTimer () {
    seconds++; 
    
    if(seconds <= 9){
      appendSeconds.innerHTML = "0" + seconds;
    }
    
    if (seconds > 9){
      appendSeconds.innerHTML = seconds;
      
    } 
    
    if (seconds > 59) {
      minutes++;
      appendMinutes.innerHTML = "0" + minutes;
      seconds = 0;
      appendSeconds.innerHTML = "0" + 0;
    }
    
    if (minutes > 9){
      appendMinutes.innerHTML = minutes;
    }
  
  }
  
}


function PlayTime() {

	var minutes = 00; 
	var seconds = 00; 
	var appendSeconds = document.getElementById("playSec")
	var appendMinutes = document.getElementById("playMin")
	var SecInterval;
	var search_int;
	
	clearInterval(SecInterval);
	SecInterval = setInterval(startTimer, 1000);

	function startTimer () {
		seconds++; 

		if(seconds <= 9){
			appendSeconds.innerHTML = "0" + seconds;
		}

		if (seconds > 9){
			appendSeconds.innerHTML = seconds;
		} 

		if (seconds > 59) {
			minutes++;
			appendMinutes.innerHTML = "0" + minutes;
			seconds = 0;
			appendSeconds.innerHTML = "0" + 0;
		}

		if (minutes > 9){
			appendMinutes.innerHTML = minutes;
		}
	}

}
