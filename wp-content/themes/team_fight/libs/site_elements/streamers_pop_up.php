<div class="hidden">
    <div class="modal_team_find box_elem_midd" id="streamers">
        <div class="modal_content scroll" style="">
            <button class="mfp-close" id="button-close" type="button" title="Закрыть (Esc)">×</button>
            <div class="col-md-12 right">
                <div class="massage">
                    <p id="error"></p>
                    <p id="complete"></p>
                </div>
                <div class="desc_text">
                    <!-- <h2 style="text-align: center; padding: 0">Наши стримеры</h2> -->
                    <!-- <ul>
                        <li>Мы очень благодарны пользователям которые решились нас поддержать , и в качестве благодарности мы предлагаем выставить ваш Steam профиль на показ в отдельной таблице ниже. Расположение вашего профиля в таблице будет зависеть от количества вложенной суммы, а также от вложенной суммы других пользователей.</li>
                        <li></li>
                    </ul> -->
                </div>
            </div>
            <div class="col-md-12 right">
                <div class="">
                   <table class="user_stats_table">
                        <!-- <div class="streamer_wrapper">
                            <div class="streamer">
                                <div class="streamer_inner"> <a href="https://www.twitch.tv/dmitriifiv" target="_blank">dmitriifiv</a> </div>
                            </div>
                           <div class="streamer_description">
                                <div class="streamer_description_inner">Обычный игрок PUBG, пытается играть на убийства, ежели на Top 1. Делает акцент на общение с аудиторией во время игры.</div>
                            </div></!
                        </div>
                        <div class="streamer_wrapper">
                            <div class="streamer">
                                <div class="streamer_inner"> <a href="https://www.twitch.tv/enoootuuuk" target="_blank">enoootuuuk</a> </div>
                            </div>
                            <div class="streamer_description">
                                <div class="streamer_description_inner">Киберспортсмен играющий преимущественно в Solo режиме. На его стриме вы увидите агресивный геймплей , много убийств , а также интерестный контент.</div>
                            </div>
                        </div>
                            <div class="streamer_wrapper">
                            <div class="streamer">
                                <div class="streamer_inner"> <a href="https://www.twitch.tv/artoksi" target="_blank">artoksi</a> </div>
                            </div>
                            <div class="streamer_description">
                                <div class="streamer_description_inner">Артем очень быстро набирает популярность , на данный момент он один из наших самых рейтинговых стримеров. Его стримы отличаются агресивным геймплеем , и веселым общением. Ему не важен skill его зрителей , он играет со всеми без разбора.</div>
                            </div>
                        </div> -->
                        <!-- <div class="streamer_wrapper">
                             <div class="streamer"> 
                                  <div class="streamer_inner"> <a href="https://www.twitch.tv/tvdonbassa" target="_blank">tvdonbassa</a> </div>
                        </div>
                              <div class="streamer_description">
                                <div class="streamer_description_inner">Стримерство — его творческое хобби, он любит веселится и играть со своими подписчиками , тут то мы и предложили делать это на нашем сервисе)</div>
                            </div>
                             </div>
                           </!-->
                    </table>    
                    
                        <?php if ( is_active_sidebar( 'twitch-widget' ) ) : ?>
                            <div id="twitch-widget" class="chw-widget-area widget-area" role="complementary">
                            <?php dynamic_sidebar( 'twitch-widget' ); ?>
                            </div>
                        <?php endif; ?>
                    <?php// echo do_shortcode('[getTwitchRail]') ?>                                        
                </div>
            </div>
        </div>
    </div>
</div>