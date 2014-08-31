<?php

/**
 * Build the setup options form.
 */
$exists = false;
$output = null;

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
        $exists = $modx->getCount('modSystemSetting', array('key:LIKE' => '%_assistbelarus_%'));
        break;

    case xPDOTransport::ACTION_UPGRADE:
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

if (!$exists) {
    if ($modx->getOption('manager_language') == 'ru') {
        $text = '
            Для полноценной работы оплаты Assist Belarus необходимо заполнить параметры, выданные вам после заключения договора.
            <label for="assistbelarus-store-id">Идентификатор мерчанта:</label>
            <input type="text" name="assistbelarus-merchant-id" id="assistbelarus-merchant-id" width="300" value="" />

            <label for="assistbelarus-login">Логин в системе Assist Belarus:</label>
            <input type="text" name="assistbelarus-login" id="assistbelarus-login" width="300" value="" />

            <label for="assistbelarus-password">Пароль в системе Assist Belarus:</label>
            <input type="text" name="assistbelarus-password" id="assistbelarus-password" width="300" value="" />

            <label for="assistbelarus-secret-key">Секретный ключ:</label>
            <input type="text" name="assistbelarus-secret-key" id="assistbelarus-secret-key" width="300" value="" />

			<small>Вы можете пропустить этот шаг и заполнить эти поля позже в системных настройках.</small>';
    }
    else {
        $text = '
            To complete the work necessary to complete the payment Assist Belarus options given to you after the conclusion of the contract.
            <label for="assistbelarus-merchant-id">Merchant ID:</label>
            <input type="text" name="assistbelarus-merchant-id" id="assistbelarus-merchant-id" width="300" value="" />

            <label for="assistbelarus-login">Login in Assist Belarus:</label>
            <input type="text" name="assistbelarus-login" id="assistbelarus-login" width="300" value="" />

            <label for="assistbelarus-password">Password in Assist Belarus:</label>
            <input type="text" name="assistbelarus-password" id="assistbelarus-password" width="300" value="" />

            <label for="assistbelarus-secret-key">Secret Key:</label>
            <input type="text" name="assistbelarus-secret-key" id="assistbelarus-secret-key" width="300" value="" />

			<small>You can skip this step and complete these fields later in the system settings.</small>';
    }

    $output = '
		<style>
			#setup_form_wrapper {font: normal 12px Arial;line-height:18px;}
			#setup_form_wrapper ul {margin-left: 5px; font-size: 10px; list-style: disc inside;}
			#setup_form_wrapper a {color: #08C;}
			#setup_form_wrapper small {font-size: 10px; color:#555; font-style:italic;}
			#setup_form_wrapper label {color: black; font-weight: bold;}
		</style>
		<div id="setup_form_wrapper">'.$text.'</div>
	';
}

return $output;
