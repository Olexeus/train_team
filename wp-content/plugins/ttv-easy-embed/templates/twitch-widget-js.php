<script type="text/javascript">
( function( $ ) {
var url = 'https://api.twitch.tv/kraken/streams?channel=<?php echo $instance['channel']; ?>';
getStreams(url);
function getStreams(url) {
console.log('Easy Embed - WIDGET QUERYING API - ' + url)
var streaming;
$.ajax({
    url: url,
    type: 'GET',
    headers: {
       'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem'
    },
    success: function(data)
  {
    for (var i in data.streams) {
      var display_name = data.streams[i].channel.display_name;
      var channel_name = data.streams[i].channel.status
      var preview = data.streams[i].preview.large;
      var game = data.streams[i].game;
      var url = data.streams[i].channel.url;
      var viewers = data.streams[i].viewers;
      var html = '<li class="stream"><a target="_blank" href="'+url+'" title="Watch '+display_name+' Now!"><div class="twitch-image"><img data-lazy="'+preview+'" src=""></div><div class="twitch-info"><div class="twitch-title">"'+channel_name+'"</div><div class="twitch-meta"><span class="twitch-name">"'+display_name+'"</span> playing <span class="twitch-game">'+game+'</span> @ <span class="twitch-viewers">'+ viewers+ ' viewers</span></div></a></li>';
      var stream = html;
      $(stream).appendTo("#twitch-module.twitch-widget #stream-container ul")
      $("#twitch-module.twitch-widget .offline-slide").remove()
  }
    if (data._total > 0) {
      var slidesToShow = 3;
      if ($('#twitch-module.twitch-widget').width() < 768)
        slidesToShow = 2;
      if ($('#twitch-module.twitch-widget').width() < 560)
        slidesToShow = 1;
      $("#twitch-module.twitch-widget #stream-container ul").slick({
          dots: false,
          slidesToShow: slidesToShow,
          slidesToScroll: 1,
          swipeToSlide: true,
          prevArrow: '<button type="button" class="slick-prev"><img src="<?php echo plugins_url("../public/img/slick-left.svg", __FILE__); ?>"></button>',
          nextArrow: '<button type="button" class="slick-next"><img src="<?php echo plugins_url("../public/img/slick-right.svg", __FILE__); ?>"></button>',
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
      $("#twitch-module.twitch-widget .offline-slide").addClass('show')
    }
    },
    error: function(data) {
      $('#twitch-module.twitch-widget').removeClass('loading');
    },
    complete: function(data) {
      $('#twitch-module.twitch-widget').removeClass('loading');
    }
});
}
} )( jQuery );
</script>
