<?php

if (!class_exists('msPaymentInterface')) {
    require_once dirname(dirname(dirname(__FILE__))) . '/model/minishop2/mspaymenthandler.class.php';
}

class AssistBelarus extends msPaymentHandler implements msPaymentInterface {
    public $config;
    public $modx;

    function __construct(xPDOObject $object, $config = array()) {
        $this->modx = & $object->xpdo;

        $siteUrl = $this->modx->getOption('site_url');
        $assetsUrl = $this->modx->getOption('minishop2.assets_url', $config, $this->modx->getOption('assets_url').'components/minishop2/');
        $paymentUrl = $siteUrl . substr($assetsUrl, 1) . 'payment/assistbelarus.php';

        $this->config = array_merge(
            array(
                'merchant_id' => $this->modx->getOption('ms2_payment_assistbelarus_merchant_id'),
                'secret' => $this->modx->getOption('ms2_payment_assistbelarus_secret_key'),
                'login' => $this->modx->getOption('ms2_payment_assistbelarus_login'),
                'password' => $this->modx->getOption('ms2_payment_assistbelarus_password'),
                'payment_url' => $paymentUrl,
                'checkout_url' => $this->modx->getOption('ms2_payment_assistbelarus_checkout_url'),
                'gate_url' => $this->modx->getOption('ms2_payment_assistbelarus_gate_url'),
                'language' => $this->modx->getOption('ms2_payment_assistbelarus_language', 'RU', true),
                'currency' => $this->modx->getOption('ms2_payment_assistbelarus_currency', 'USD', true),
                'developer_mode' => $this->modx->getOption('ms2_payment_assistbelarus_developer_mode', 0, true),
                'success_payment' => $this->modx->getOption('ms2_payment_assistbelarus_success_payment_id', 2, true),
                'cancel_payment' => $this->modx->getOption('ms2_payment_assistbelarus_cancel_payment_id', 4, true),
                'json_response' => false
            ),
            $config
        );

        if ($this->config['developer_mode']) {
            $this->config['checkout_url'] = 'https://test.paysec.by/pay/order.cfm';
            $this->config['gate_url'] = 'https://test.paysec.by/orderstate/orderstate.cfm';
        }
    }

    public function send(msOrder $order) {
        $link = $this->getPaymentLink($order);

        return $this->success('', array('redirect' => $link));
    }

    public function getPaymentLink(msOrder $order) {
        $id = $order->get('id');
        $cost = $order->get('cost');

        $user = $order->getOne('User');
        if ($user) {
            $user = $user->getOne('Profile');
        }
        $address = $order->getOne('Address');

        $addressLine = '';
        if ($address->get('street')) {
            $addressLine .= 'ул. ' . $address->get('street');
        }
        if ($address->get('building')) {
            $addressLine .= ', ' . $address->get('building');
        }
        if ($address->get('room')) {
            $addressLine .= '-' . $address->get('room');
        }

        list($firstname, $lastname) = explode(' ', $user->fullname);

        $request = array(
            'Merchant_ID' => $this->config['merchant_id'],
            'TestMode' => $this->config['developer_mode'],

            'OrderNumber' => $id,
            'OrderAmount' => $cost,
            'OrderComment' => $address->get('comment'),
            'OrderCurrency' => $this->config['currency'], // Справочник 5.8 в документации
            'Language' => $this->config['language'], // Справочник 5.7 в документации

            'Lastname' => $lastname,
            'Firstname' => $firstname,
            //'Middlename' => '',

            'Email' => $user->get('email'),
            'Address' => $addressLine,
            //'HomePhone' => '',
            //'WorkPhone' => '',
            'MobilePhone' => $address->get('phone'),
            //'Fax' => '',

            //'Country' => $address->get('country'), // TODO: нужно преобразовать в код из справочника 5.9 (ISO 3166)
            //'State' => $address->get('region'), // TODO: нужно преобразовать в код из справочика 5.10
            'City' => $address->get('city'),
            'Zip' => $address->get('index'),

            'URL_RETURN_OK' => $this->config['payment_url'] . '?action=success',
            'URL_RETURN_NO' => $this->config['payment_url'] . '?action=cancel',

            //'Delay' => 0
            //'CardPayment' => 1,
            //'AssistIDPayment' => 1,
            //'Signature' => ''
        );

        $link = $this->config['checkout_url'] . '?' . http_build_query($request);

        return $link;
    }

    public function receive(msOrder $order, $params = array()) {
        switch ($params['action']) {
            case 'success':
                $postdata = array(
                    'Ordernumber' => $order->get('id'),
                    'Merchant_ID' => $this->config['merchant_id'],
                    'Login' => $this->config['login'],
                    'Password' => $this->config['password'],
                    'Format' => 3
                );

                $curl = curl_init($this->config['gate_url']);
                curl_setopt ($curl, CURLOPT_HEADER, 0);
                curl_setopt ($curl, CURLOPT_POST, 1);
                curl_setopt ($curl, CURLOPT_POSTFIELDS, http_build_query($postdata));
                curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
                if ($this->config['developer_mode']) {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                }
                $response = curl_exec ($curl);
                curl_close ($curl);

                $xml = simplexml_load_string($response);

                if ((string) $xml->order->orderstate == 'Approved'
                    && (string) $xml->order->ordernumber == $order->get('id')
                    && (string) $xml->order->billnumber == $params['billnumber']
                    && (float) $xml->order->orderamount === (float) $order->get('cost')
                ) {
                    $salt = $this->config['secret'];
                    $x = $this->config['merchant_id']
                        . $xml->order->ordernumber
                        . $xml->order->orderamount
                        . $xml->order->ordercurrency
                        . $xml->order->orderstate;

                    $crc = strtoupper(md5(strtoupper(md5($salt) . md5($x))));

                    if ($crc == $xml->order->checkvalue) {
                        $miniShop2 = $this->modx->getService('miniShop2');
                        @$this->modx->context->key = 'mgr';
                        $miniShop2->changeOrderStatus($order->get('id'), $this->config['success_payment']);
                    } else {
                        $this->paymentError('Transaction with id ' . $params['billnumber'] . ' is not valid.');
                    }
                } else {
                    $this->paymentError('Could not check transaction with id ' . $params['billnumber']);
                }
                break;
            case 'notify':
                if ($params['merchant_id'] == $this->config['merchant_id']
                    && $params['ordernumber'] == $order->get('id')
                    && $params['orderamount'] == $order->get('cost')
                    && $params['orderstate'] == 'Approved'
                ) {
                    $salt = $this->config['secret'];
                    $x = $params['merchant_id']
                        . $params['ordernumber']
                        . $params['amount']
                        . $params['currency']
                        . $params['orderstate'];

                    $crc = strtoupper(md5(strtoupper(md5($salt) . md5($x))));

                    if ($crc == $params['checkvalue']) {
                        $miniShop2 = $this->modx->getService('miniShop2');
                        @$this->modx->context->key = 'mgr';
                        $miniShop2->changeOrderStatus($order->get('id'), $this->config['success_payment']);

                        $answer = '<?xml version="1.0" encoding="UTF-8"?><pushpaymentresult firstcode="0" secondcode="0"><order><billnumber>' . $params['billnumber'] . '</billnumber><packetdate>' . $params['packetdate'] . '</packetdate></order></pushpaymentresult>';
                        echo $answer;
                    } else {
                        $this->paymentError('[NOTIFY] Transaction with id ' . $params['billnumber'] . ' is not valid.');

                        $error = '<?xml version="1.0" encoding="UTF-8"?><pushpaymentresult firstcode="9" secondcode="0"></pushpaymentresult>';
                        echo $error;
                    }
                } else {
                    $this->paymentError('[NOTIFY] Order ' . $params['ordernumber'] . ' is not valid. ');
                    $error = '<?xml version="1.0" encoding="UTF-8"?><pushpaymentresult firstcode="13" secondcode="0"></pushpaymentresult>';
                    echo $error;
                }

                exit;
                break;
            case 'cancel':
                $miniShop2 = $this->modx->getService('miniShop2');
                @$this->modx->context->key = 'mgr';
                $miniShop2->changeOrderStatus($order->get('id'), $this->config['cancel_payment']);
                break;
        }
    }

    public function paymentError($text, $request = array()) {
        $this->modx->log(modX::LOG_LEVEL_ERROR,'[miniShop2:AssistBelarus] ' . $text . ', request: ' . print_r($request, 1));
        header("HTTP/1.0 400 Bad Request");

        die('ERROR: ' . $text);
    }
}