<?php

$_lang['area_ms2_payment_assistbelarus'] = 'Assist Belarus';

$_lang['setting_ms2_payment_assistbelarus_merchant_id'] = 'ID of shop (merchant) in Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_merchant_id_desc'] = 'It\'s contains an unique ID of shop (merchant). This ID was created after your registration in Assist Belarus and was sent by email.';

$_lang['setting_ms2_payment_assistbelarus_secret_key'] = 'Secret Key';
$_lang['setting_ms2_payment_assistbelarus_secret_key_desc'] = 'The sequence of random characters, given in panel Assist Belarus (Merchant options -> Payment result options). Participates in the formation of an signature and is used to verify the payment.';

$_lang['setting_ms2_payment_assistbelarus_login'] = 'Login in Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_login_desc'] = 'Special login for work with web-services. Needed for payment\'s check.';

$_lang['setting_ms2_payment_assistbelarus_password'] = 'Password in Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_password_desc'] = 'Password, with that you enter to control panel of Assist Belarus. Needed for payment\'s check.';

$_lang['setting_ms2_payment_assistbelarus_checkout_url'] = 'Address for checkout queries';
$_lang['setting_ms2_payment_assistbelarus_checkout_url_desc'] = 'Address to be sent to the user to execute the payment order. Need ask support of Assist Belarus.';

$_lang['setting_ms2_payment_assistbelarus_gate_url'] = 'Address for payment\'s check';
$_lang['setting_ms2_payment_assistbelarus_gate_url_desc'] = 'Address to be sent to a request to check the payment. Need ask support of Assist Belarus.';

$_lang['setting_ms2_payment_assistbelarus_developer_mode'] = 'Test mode of payments';
$_lang['setting_ms2_payment_assistbelarus_developer_mode_desc'] = 'If the value "Yes", all requests payments will be send to a Assist Belarus testing environment of payment processing. If you enabled this mode settings checkout_url and gate_url will be ignored.';

$_lang['setting_ms2_payment_assistbelarus_currency'] = 'Currency of payment';
$_lang['setting_ms2_payment_assistbelarus_currency_desc'] = 'Literal-digit currency code according to ISO4271. Available variants see in documentation, section 5.8.';

$_lang['setting_ms2_payment_assistbelarus_language'] = 'Assist Belarus language';
$_lang['setting_ms2_payment_assistbelarus_language_desc'] = 'Specify the language code, which show\'s Assist when paying. Available variants: <strong>RU</strong>, <strong>EN</strong>.';

$_lang['setting_ms2_payment_assistbelarus_success_id'] = 'Assist Belarus successful page id';
$_lang['setting_ms2_payment_assistbelarus_success_id_desc'] = 'The customer will be sent to this page after the completion of the payment. It is recommended to specify the id of the page with the shopping cart to order output.';

$_lang['setting_ms2_payment_assistbelarus_failure_id'] = 'Assist Belarus failure page id';
$_lang['setting_ms2_payment_assistbelarus_failure_id_desc'] = 'The customer will be sent to this page if something went wrong. It is recommended to specify the id of the page with the shopping cart to order output.';

$_lang['setting_ms2_payment_assistbelarus_success_payment_id'] = 'Order status after succeed payment';
$_lang['setting_ms2_payment_assistbelarus_success_payment_id_desc'] = 'After succeed payment order status will be set to specified number. You can edit statuses in settings of miniShop2.';

$_lang['setting_ms2_payment_assistbelarus_cancel_payment_id'] = 'Order status after cancel payment';
$_lang['setting_ms2_payment_assistbelarus_cancel_payment_id_desc'] = 'After cancel payment order status will be set to specified number. You can edit statuses in settings of miniShop2.';
