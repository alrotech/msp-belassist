<?php

$_lang['area_ms2_payment_assistbelarus'] = 'Assist Belarus';

$_lang['setting_ms2_payment_assistbelarus_merchant_id'] = 'Идентификатор магазина (мерчанта) в системе Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_merchant_id_desc'] = 'Cодержит уникальный идентификатор магазина (мерчанта). Данный идентификатор создается при регистрации в системе Assist Belarus и высылается в письме.';

$_lang['setting_ms2_payment_assistbelarus_secret_key'] = 'Секретный ключ';
$_lang['setting_ms2_payment_assistbelarus_secret_key_desc'] = 'Последовательность случайных символов, задаваемая в панели Assist Belarus (Настройки мерчанта -> Настройка отправки результатов платежей). Участвует в формировании электронной подписи и используется для проверки платежей.';

$_lang['setting_ms2_payment_assistbelarus_login'] = 'Логин в системе Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_login_desc'] = 'Специальный логин для работы с web-сервисами. Нужен для проверки платежа.';

$_lang['setting_ms2_payment_assistbelarus_password'] = 'Пароль в системе Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_password_desc'] = 'Пароль, с которым вы входите в панель управления Assist Belarus. Нужен для проверки платежа.';

$_lang['setting_ms2_payment_assistbelarus_checkout_url'] = 'Адрес для выполнения запросов';
$_lang['setting_ms2_payment_assistbelarus_checkout_url_desc'] = 'Адрес, куда будет отправляться пользователь для выполнения оплаты заказа. Выдается тех. поддержкой Assist Belarus.';

$_lang['setting_ms2_payment_assistbelarus_gate_url'] = 'Адрес для выполнения проверки платежа';
$_lang['setting_ms2_payment_assistbelarus_gate_url_desc'] = 'Адрес, куда будет отправляться запрос на проверку платежа. Выдается тех. поддержкой Assist Belarus.';

$_lang['setting_ms2_payment_assistbelarus_developer_mode'] = 'Режим совершения тестовых платежей';
$_lang['setting_ms2_payment_assistbelarus_developer_mode_desc'] = 'При значении "Да", все запросы оплаты будут отправляться на тестовую среду обработки платежей Assist Belarus. При включении данного режима настройки checkout_url и gate_url игнорируются.';

$_lang['setting_ms2_payment_assistbelarus_currency'] = 'Валюта платежа';
$_lang['setting_ms2_payment_assistbelarus_currency_desc'] = 'Буквенный трехзначный код валюты согласно ISO4271. Возможные варианты перечислены в разделе 5.8 документации.';

$_lang['setting_ms2_payment_assistbelarus_language'] = 'Язык Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_language_desc'] = 'Укажите код языка, на котором показывать сайт Assist при оплате. Доступны варианты: <strong>RU</strong>, <strong>EN</strong>.';

$_lang['setting_ms2_payment_assistbelarus_success_id'] = 'Страница успешной оплаты Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_success_id_desc'] = 'Пользователь будет отправлен на эту страницу после завершения оплаты. Рекомендуется указать id страницы с корзиной, для вывода заказа.';

$_lang['setting_ms2_payment_assistbelarus_failure_id'] = 'Страница отказа от оплаты Assist Belarus';
$_lang['setting_ms2_payment_assistbelarus_failure_id_desc'] = 'Пользователь будет отправлен на эту страницу при неудачной оплате. Рекомендуется указать id страницы с корзиной, для вывода заказа';

$_lang['setting_ms2_payment_assistbelarus_success_payment_id'] = 'Статус заказа при успешной оплате';
$_lang['setting_ms2_payment_assistbelarus_success_payment_id_desc'] = 'При успешной оплате заказа ему будет установлен указанный номер статуса. Сами статусы редактируются в настройках miniShop2.';

$_lang['setting_ms2_payment_assistbelarus_cancel_payment_id'] = 'Статус заказа при отмененной оплате';
$_lang['setting_ms2_payment_assistbelarus_cancel_payment_id_desc'] = 'При отмене оплаты заказа ему будет установлен указанный номер статуса. Сами статусы редактируются в настройках miniShop2.';
