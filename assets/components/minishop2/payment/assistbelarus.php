<?php

define('MODX_API_MODE', true);
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';

$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

/* @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('minishop2');
$miniShop2->loadCustomClasses('payment');

if (!class_exists('AssistBelarus')) {
    exit('Error: could not load payment class "AssistBelarus".');
}

$context = '';
$params = array();

/* @var msPaymentInterface|AssistBelarus $handler */
$handler = new AssistBelarus($modx->newObject('msOrder'));

switch ($_GET['action']) {
    case 'notify':
        if (empty($_POST['ordernumber'])) {
            $modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:AssistBelarus] Returned empty order id.');
        }
        if ($order = $modx->getObject('msOrder', $_POST['ordernumber'])) {
            $_POST['action'] = $_GET['action'];
            $handler->receive($order, $_POST);
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:AssistBelarus] Could not retrieve order with id ' . $_POST['ordernumber']);
        }
        exit;
        break;
    case 'success':
    case 'cancel':
        if (empty($_REQUEST['ordernumber'])) {
            $modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:AssistBelarus] Returned empty order id.');
        }
        if ($order = $modx->getObject('msOrder', $_REQUEST['ordernumber'])) {
            $handler->receive($order, $_REQUEST);
            $params['msorder'] = $_REQUEST['ordernumber'];
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2:AssistBelarus] Could not retrieve order with id ' . $_REQUEST['ordernumber']);
        }
        break;
}

$success = $cancel = $modx->getOption('site_url');

if ($id = $modx->getOption('ms2_payment_assistbelarus_success_id', null, 0)) {
    $success = $modx->makeUrl($id, $context, $params, 'full');
}
if ($id = $modx->getOption('ms2_payment_assistbelarus_cancel_id', null, 0)) {
    $cancel = $modx->makeUrl($id, $context, $params, 'full');
}

$redirect = !empty($_REQUEST['action']) && ($_REQUEST['action'] == 'success') ? $success : $cancel;
$modx->sendRedirect($redirect);
