<?php

use CareCloud\ApiException;
use CareCloud\Model\Order;
use CareCloud\Model\OrderInvoicing;
use CareCloud\Model\OrderItem;
use CareCloud\Model\OrdersBody;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Create an order
    $order_item = new OrderItem();
    $order_item->setProductVariantId('8fcc724e1514dafb0a70228d3')
    ->setAmount(1)
    ->setUnitPrice(36)
    ->setVatRate(16);

    $order_items[] = $order_item;

    $invoicing_data = new OrderInvoicing();
    $invoicing_data->setPaymentId('8bd481170064960b1788109b8');

    $order = new Order();
    $order->setCustomerId('8bed991c68a470e7aaeffbf048')
    ->setCurrencyId('86e05affc7a7abefcd513ab400')
    ->setTotalPrice(36)
    ->setOrderItems($order_items)
    ->setInvoicingData($invoicing_data);

    $body = new OrdersBody();
    $body->setOrder($order);

    $createOrder = $careCloud->ordersApi()->postOrder($body);
    $order_id = $createOrder->getData()->getOrderId();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
