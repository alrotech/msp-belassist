<?php
/**
 * Loads system settings into build
 *
 * @package mspassistbelarus
 * @subpackage build
 */
$settings = array();

$tmp = array(
    'merchant_id' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'secret_key' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'login' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'password' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'checkout_url' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'gate_url' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
    'developer_mode' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'language' => array(
        'xtype' => 'textfield',
        'value' => 'RU'
    ),
    'currency' => array(
        'xtype' => 'textfield',
        'value' => 'USD'
    ),
    'success_id' => array(
        'xtype' => 'numberfield',
        'value' => 0
    ),
    'failure_id' => array(
        'xtype' => 'numberfield',
        'value' => 0
    ),
    'success_payment_id' => array(
        'xtype' => 'numberfield',
        'value' => 2
    ),
    'cancel_payment_id' => array(
        'xtype' => 'numberfield',
        'value' => 4
    )
);

foreach ($tmp as $k => $v) {
    /* @var modSystemSetting $setting */
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge(
        array(
            'key' => 'ms2_payment_assistbelarus_' . $k,
            'namespace' => 'minishop2',
            'area' => 'ms2_payment_assistbelarus',
        ), $v
    ),'',true,true);

    $settings[] = $setting;
}

unset($tmp);
return $settings;