<div class="hidden">
    <div class="modal_team_find box_elem_midd" id="premium">
        <div class="modal_content scroll">
            <button class="mfp-close" id="button-close" type="button" title="Закрыть (Esc)">×</button>
            <?php
            if (is_user_logged_in()) {
            ?>
            <div class="col-md-12 right">
                <div class="massage">
                    <p id="error"></p>
                    <p id="complete"></p>
                </div>
                <div class="desc_text" id="supp_title">
                    <h2 style="text-align: center; padding: 0;">Поддержка</h2>
                    <ul id="supp_text" style="">
                        <li>Мы очень благодарны пользователям которые решились нас поддержать , и в качестве благодарности мы предлагаем выставить ваш Steam профиль на показ в отдельной таблице ниже. Расположение вашего профиля в таблице будет зависеть от количества вложенной суммы, а также от вложенной суммы других пользователей.</li>
                        <li>Для того чтобы мы выставили ваш профиль вам нужно указать свой Steam id как комментарий к платежу. Ваш профиль будет выставлен в течении 24 часов.</li>
                    </ul>
                        <?php

                        /*$member_subscriptions = pms_get_member_subscriptions(array('user_id' => get_current_user_id()));

                        echo do_shortcode('[pms-subscriptions]');
                        if (count($member_subscriptions)) {


                            if ($member_subscriptions[0]->status == 'pending') {
                                $_REQUEST['pms-action'] = 'retry_payment_subscription';

                                $_REQUEST['subscription_plan'] = $member_subscriptions[0]->subscription_plan_id;
                                $_REQUEST['pmstkn'] = wp_nonce_field('pms_retry_payment_subscription', 'pmstkn');
                            } elseif ($member_subscriptions[0]->status == 'active') {

                                $_GET['pms-action'] = 'abandon_subscription';
                                $_GET['subscription_id'] = $member_subscriptions[0]->id;

                            } elseif ($member_subscriptions[0]->status == 'canceled') {

                                $_REQUEST['pms-action'] = 'renew_subscription';
                                $_REQUEST['subscription_plan'] = $member_subscriptions[0]->subscription_plan_id;
                                $_REQUEST['subscription_id'] = $member_subscriptions[0]->id;


                            }
                        }


                        the_content();
*/

                        ?>
                </div>
                <button class="btn btn_supp" onclick="" id="btn_supp">Поддержать</button>
                <iframe src="https://funding.webmoney.ru/widgets/horizontal/519dbe2e-ab48-49fe-93bb-ec6ff1641edd?hs=1&bt=0&sum=100" width="468" height="200" scrolling="no" style="border:none; display:none; margin-top: 15px;" id="supp_form"></iframe>
            </div>
            <div class="col-md-12 right">
                <div class="prof_stats">
                    <table class="user_stats_table">
                        <tbody>
                            <tr>
                                <td class="user_st_name">Ваш профиль</td>
                                <td class="user_stats">Вложенная сумма</td>
                            </tr>
                        </tbody>
                    </table>                                               
                </div>
            </div>

                <?php
                } else {
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