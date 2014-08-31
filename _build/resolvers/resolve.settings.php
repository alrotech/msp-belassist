<?php

if ($object->xpdo) {
    /* @var modX $modx */
    $modx =& $object->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            if (!empty($options['assistbelarus-merchant-id'])) {
                if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ms2_payment_assistbelarus_merchant_id'))) {
                    $tmp = $modx->newObject('modSystemSetting');
                }
                $tmp->fromArray(array(
                    'namespace' => 'minishop2',
                    'area' => 'ms2_payment_assistbelarus',
                    'xtype' => 'textfield',
                    'value' => $options['assistbelarus-merchant-id'],
                    'key' => 'ms2_payment_assistbelarus_merchant_id',
                ), '', true, true);
                $tmp->save();
            }
            if (!empty($options['assistbelarus-login'])) {
                if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ms2_payment_assistbelarus_login'))) {
                    $tmp = $modx->newObject('modSystemSetting');
                }
                $tmp->fromArray(array(
                        'namespace' => 'minishop2',
                        'area' => 'ms2_payment_assistbelarus',
                        'xtype' => 'textfield',
                        'value' => $options['assistbelarus-login'],
                        'key' => 'ms2_payment_assistbelarus_login',
                    ), '', true, true);
                $tmp->save();
            }
            if (!empty($options['assistbelarus-password'])) {
                if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ms2_payment_assistbelarus_password'))) {
                    $tmp = $modx->newObject('modSystemSetting');
                }
                $tmp->fromArray(array(
                        'namespace' => 'minishop2',
                        'area' => 'ms2_payment_assistbelarus',
                        'xtype' => 'textfield',
                        'value' => $options['assistbelarus-password'],
                        'key' => 'ms2_payment_assistbelarus_password',
                    ), '', true, true);
                $tmp->save();
            }
            if (!empty($options['assistbelarus-secret-key'])) {
                if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ms2_payment_assistbelarus_secret_key'))) {
                    $tmp = $modx->newObject('modSystemSetting');
                }
                $tmp->fromArray(array(
                        'namespace' => 'minishop2',
                        'area' => 'ms2_payment_assistbelarus',
                        'xtype' => 'textfield',
                        'value' => $options['assistbelarus-secret-key'],
                        'key' => 'ms2_payment_assistbelarus_secret_key',
                    ), '', true, true);
                $tmp->save();
            }
            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $modelPath = $modx->getOption('minishop2.core_path', null, $modx->getOption('core_path') . 'components/minishop2/') . 'model/';
            $modx->addPackage('minishop2', $modelPath);
            /* @var msPayment $payment */
            $modx->removeCollection('msPayment', array('class' => 'AssistBelarus'));
            $modx->removeCollection('modSystemSetting', array('key:LIKE' => 'ms2\_payment\_assistbelarus\_%'));
            break;
    }
}

return true;