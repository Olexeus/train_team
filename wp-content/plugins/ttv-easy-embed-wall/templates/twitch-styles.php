<style>
#twitch-module.twitch-wall *, #twitch-module.twitch-wall *:before, #twitch-module.twitch-wall *:after {box-sizing: border-box!important;}
#twitch-module.twitch-wall #twitch-embed {display:inline-block;width:100%;height: 0px;}
#twitch-module.twitch-wall #twitch-embed.active {height: 432px;margin: 0 0 17px;}
#twitch-module.twitch-wall #stream-container ul li {position:relative;margin:0;padding:0;list-style: none;}
#twitch-module.twitch-wall #stream-container ul li a {width:100%; text-decoration: none;}
#twitch-module.twitch-wall #stream-container ul li a:hover .twitch-image-overlay {opacity: 1;transform: scale(1)}
#twitch-module.twitch-wall #stream-container ul li a .twitch-image {position: relative;overflow: hidden;}
#twitch-module.twitch-wall #stream-container ul li a .twitch-image-overlay {opacity: 0; position: absolute;height: 100%;width: 100%;left: 0;top: 0;display: flex;transform: scale(2);justify-content: center; align-items: center;background-color: rgba(0,0,0,0.5);transition: all .35s ease;}
#twitch-module.twitch-wall #stream-container ul li a .twitch-image-overlay img {width: 40px;height: auto;}
#twitch-module.twitch-wall.light-theme #stream-container ul li a .twitch-image {border: solid 2px #fff;}
#twitch-module.twitch-wall.dark-theme #stream-container ul li a .twitch-image {border: solid 2px #17141f;}
#twitch-module.twitch-wall #stream-container ul li a img {display: block;width: 100%;}
#twitch-module.twitch-wall #stream-container ul {display:grid;grid-template-columns: repeat(auto-fill, minmax(308px, 1fr));margin: 0;
padding: 0;list-style: none;grid-gap: 20px;}
#twitch-module.twitch-wall #stream-container ul li .twitch-info {position:relative;bottom:0;width: calc(100%);text-align:left;padding: 0 4px 0;font-family: "Helvetica Neue", Helvetica, Arial, 'sans-serif';}
#twitch-module.twitch-wall.light-theme #stream-container ul li .twitch-info {background:#fff;}
#twitch-module.twitch-wall.dark-theme #stream-container ul li .twitch-info {background:#17141f;}
#twitch-module.twitch-wall #stream-container ul li .twitch-title {height: 21px; line-height: 21px; margin: 4px 0 0; overflow: hidden; position: absolute; left:4px;font-size:14px;font-weight:500;}
#twitch-module.twitch-wall.light-theme #stream-container ul li .twitch-title {color: #19171c}
#twitch-module.twitch-wall.dark-theme #stream-container ul li .twitch-title {color: #dad8de}
#twitch-module.twitch-wall #stream-container ul li .twitch-meta {padding: 25px 0 4px;font-size:12px;line-height: 18px; overflow: hidden;height: 47px;overflow: hidden;}
#twitch-module.twitch-wall.light-theme #stream-container ul li .twitch-meta {color:#6e6779;}
#twitch-module.twitch-wall.dark-theme #stream-container ul li .twitch-meta {color:#898395;}


@media screen and (max-width:780px) {
  .twitch-stream__item {width:calc(50% - 20px);}
}

@media screen and (max-width:480px) {
  .twitch-stream__item {width:calc(100% - 20px);}
}

#twitch-module.twitch-wall .loader-wrapper {display:none;height: 100px;align-items:center;}
#twitch-module.twitch-wall.loading .loader-wrapper {display:flex}
#twitch-module.twitch-wall .loader,
#twitch-module.twitch-wall .loader:before,
#twitch-module.twitch-wall .loader:after {
  background: #ffffff;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
#twitch-module.twitch-wall.light-theme .loader,
#twitch-module.twitch-wall.light-theme .loader:before,
#twitch-module.twitch-wall.light-theme .loader:after {
  background: #ffffff;
  color: #ffffff;
}
#twitch-module.twitch-wall.dark-theme .loader,
#twitch-module.twitch-wall.dark-theme .loader:before,
#twitch-module.twitch-wall.dark-theme .loader:after {
  background: #17141f;
  color: #17141f;
}
#twitch-module.twitch-wall .loader {
  text-indent: -9999em;
  margin: 0 auto;
  position: relative;
  font-size: 8px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
#twitch-module.twitch-wall .loader:before,
#twitch-module.twitch-wall .loader:after {
  position: absolute;
  top: 0;
  content: '';
}
#twitch-module.twitch-wall .loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
#twitch-module.twitch-wall .loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}

</style>