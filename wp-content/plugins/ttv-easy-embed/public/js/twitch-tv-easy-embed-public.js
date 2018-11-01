( function( $ ) {
var target = '.twitch-rail-'+twitch_rail_vars.id+' #stream-container ul';
var language = '';
if (twitch_rail_vars.language !== '') {
    language = '&language='+twitch_rail_vars.language;
}
if (twitch_rail_vars.twitchGames !== '') {
    getGameName(twitch_rail_vars.twitchGames);
} else if (twitch_rail_vars.twitchNames != '') {
    twitchNamesWithLogin = [];
    twitchNamesWithUserLogin = [];
    twitchNamesArray = twitch_rail_vars.twitchNames;
    twitchNamesArray = twitchNamesArray.split(',')
    twitchNamesArrayLength = twitchNamesArray.length;
    if (twitchNamesArrayLength > 20) {
        twitchNamesArrayLength = 20;
    }
    for (var i=0; i < twitchNamesArrayLength; i++) {  
        var sep='&';
        if (i==0) {var sep='?'};
        twitchNamesWithLogin[i]=sep+"login="+twitchNamesArray[i];
        twitchNamesWithUserLogin[i]=sep+"user_login="+twitchNamesArray[i];
    }
    url1 = 'https://api.twitch.tv/helix/users'+twitchNamesWithLogin.join('');
    url2 = 'https://api.twitch.tv/helix/streams'+twitchNamesWithUserLogin.join('');
    getChannels(url1,url2);
} else if (twitch_rail_vars.twitchTeam != '') {
    getTeam()
}

//---- ******* END Click Options ******* ----//

//---- ******* Teams ******* ----//

function getTeam() {
    $.ajax({
        url: 'https://api.twitch.tv/kraken/teams/'+twitch_rail_vars.twitchTeam,
        type: 'GET',
        headers: {
           'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem',
           'Accept': 'application/vnd.twitchtv.v5+json'
        },
        success: function(data) {
            display_names = '';
            for (var i in data.users) {
                display_names += data.users[i].display_name+',';
            }            
            twitchNamesWithLogin = [];
            twitchNamesWithUserLogin = [];
            twitchNamesArray = display_names.split(',')
            twitchNamesArrayLength = twitchNamesArray.length;
            if (twitchNamesArrayLength > 20) {
                twitchNamesArrayLength = 20;
            }
            for (var i=0; i < twitchNamesArrayLength - 1; i++) {  
                var sep='&';
                if (i==0) {var sep='?'};
                twitchNamesWithLogin[i]=sep+"login="+twitchNamesArray[i];
                twitchNamesWithUserLogin[i]=sep+"user_login="+twitchNamesArray[i];
            }
            url1 = 'https://api.twitch.tv/helix/users'+twitchNamesWithLogin.join('');
            url2 = 'https://api.twitch.tv/helix/streams'+twitchNamesWithUserLogin.join('');
            getChannels(url1,url2);
        },
        error: function(data) {
        },
        complete: function(data) {
        }
    });
}

//---- ******* END Teams ******* ----//

//---- ******* Channels ******* ----//

function getChannels(url1,url2){

$.ajax({
    url: url1,
    type: 'GET',
    headers: {
       'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem'
    },
    success: function(data) {
        console.log('[Easy Embed Twitch] - Success - retrieved Channels')    
        arr1 = data.data;
    },
    error: function(data) {
      console.log('[Easy Embed Twitch] - Failed to retrieve Channels')
    },
    complete: function(data) {
      getChannels2(url2,arr1)
    }
});

}

function getChannels2(url2,arr1){
$.ajax({
    url: url2,
    type: 'GET',
    headers: {
       'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem'
    },
    success: function(data) {
        arr2 = data.data;
        for (var i=0;i<arr2.length;i++) {
            id1 = arr2[i].user_id;
            for (var o=0;o<arr1.length;o++) {
                id2 = arr1[o].id;
                if (id1 == id2) {
                    $.extend( arr2[i], {'display_name':arr1[o].display_name,'login':arr1[o].login} );
                }
            }
        }
        console.log('[Easy Embed Twitch] - Success - retrieved Channels')        
        appendStreams(arr2,arr1);
    },
    error: function(data) {
      console.log('[Easy Embed Twitch] - Failed to retrieve Channels')
    },
    complete: function(data) {
    }
});

}

//---- ******* END Channels ******* ----//

//---- ******* Game ******* ----//

function getGameName(name) {
    $.ajax({
        url: 'https://api.twitch.tv/helix/games?name='+name,
        type: 'GET',
        headers: {
           'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem',
           'Accept': 'application/vnd.twitchtv.v5+json'
        },
        success: function(data) {
            console.log('[Easy Embed Twitch] - Retrieving Game ID - Success - '+data.data[0]['id'])
            id = data.data[0]['id'];
        },
        error: function(data) {
            console.log('[Easy Embed Twitch] - Failed to retrieve Game ID')
        },
        complete: function(data) {
          getGameStreams(id,'');
        }
    });
}

function getGameStreams(id, url) {
    if (url == '') {
        url = 'https://api.twitch.tv/helix/streams?game_id='+id+language;
    }
    $.ajax({
        url: url,
        type: 'GET',
        headers: {
           'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem',
           'Accept': 'application/vnd.twitchtv.v5+json'
        },
        success: function(data) {
            if (data.data.length > 0) {
                console.log('[Easy Embed Twitch] - Retrieving Game Streams - Success')
                arr1 = data.data;
                streamerIdsArray = '';
                streamerIdsCombined = [];
                streamerIdsWithLogin = [];
                for (var i=0; i < data.data.length; i++) {           
                    streamerIdsCombined += data.data[i]['user_id']+',';
                }
                streamerIdsArray = streamerIdsCombined.split(',')
                for (var i=0; i < streamerIdsArray.length - 1; i++) {  
                    var sep='&';
                    if (i==0) {var sep='?'};
                    streamerIdsWithLogin[i]=sep+"id="+streamerIdsArray[i];
                }
                streamerIdsWithLogin = streamerIdsWithLogin.join('');
                getStreamerNames(streamerIdsWithLogin, arr1);
            } else {
                console.log('[Easy Embed Twitch] - Retrieving Game Streams - 0 Results')
                $("#twitch-module.twitch-rail .offline-slide").addClass('show')
                $("#twitch-module.twitch-rail .loader-wrapper").hide();
            }
        },
        error: function(data) {
            console.log('[Easy Embed Twitch] - Failed to retreieve Game Streams')
        }
    });
}

function getStreamerNames(streamerIdsWithLogin, arr1){

$.ajax({
    url: 'https://api.twitch.tv/helix/users'+streamerIdsWithLogin,
    type: 'GET',
    headers: {
       'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem'
    },
    success: function(data) {
        arr2 = data.data;
        fullArray = $.extend(true, arr1, arr2);
        appendStreams(fullArray);
    },
    error: function(data) {
    },
    complete: function(data) {
    }
});
}

//---- ******* End Game ******* ----//

//---- ******* Append Streams ******* ----//

function appendStreams(fullArray,offlineArray) {
    var streamsAdded = [];
    for (var i=0;i<fullArray.length;i++) {
      var user_id = fullArray[i].user_id;
      streamsAdded.push(user_id)
      var display_name = fullArray[i].display_name;
      var channel_name = fullArray[i].title;
      var preview = fullArray[i].thumbnail_url;
      var preview = preview.replace("{height}", "169"); 
      var preview = preview.replace("{width}", "300"); 
      var game = fullArray[i].game_id;
      var login = fullArray[i].login;
      var url = 'https://www.twitch.tv/'+login;
      var viewers = fullArray[i].viewer_count;
        var html = '<li class="stream"><a target="_blank" href="'+url+'" title="Watch '+display_name+' Now!" data-id="'+display_name+'">';
        html += '<div class="twitch-image"><img data-lazy="'+preview+'" src=""></div>';
        html += '<div class="twitch-info"><div class="twitch-title">'+display_name+'</div>';
        html += '<div class="twitch-meta"><span class="twitch-name">'+display_name+'</span> streaming for <span class="twitch-viewers">'+ viewers+ ' viewers</span>';
        html += '</div></div></a>';
        html += '<span class="online-indicator online-indicator--online"></span>';
        html += '</li>';
      $(html).appendTo(target)
      $("#twitch-module.twitch-rail .offline-slide").remove();
      $("#twitch-module.twitch-rail .loader-wrapper").hide();
  }
  
    if (fullArray.length > 0) {
      var slidesToShow = 3;
      if ($('#twitch-module.twitch-rail').width() < 768)
        slidesToShow = 2;
      if ($('#twitch-module.twitch-rail').width() < 560)
        slidesToShow = 1;
      $(target).slick({
          dots: false,
          slidesToShow: slidesToShow,
          slidesToScroll: 1,
          swipeToSlide: true,
          prevArrow: '<button type="button" class="slick-prev"><img src="'+twitch_rail_vars.leftArrow+'"></button>',
          nextArrow: '<button type="button" class="slick-next"><img src="'+twitch_rail_vars.rightArrow+'"></button>',
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 560,
              settings: {
                slidesToShow: 1
              }
            }
          ]
      })
    } else {
      $("#twitch-module.twitch-rail .offline-slide").addClass('show')
      $("#twitch-module.twitch-rail .loader-wrapper").hide();
    } 
}
    
//---- ******* END Append Streams ******* ----//
} )( jQuery );