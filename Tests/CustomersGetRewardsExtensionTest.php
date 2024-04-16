<?php

declare(strict_types=1);

use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;

require_once '../vendor/autoload.php';
/** @var Config $config */
require_once 'config.php';

$careCloud = new CareCloud($config);
try {
    $customer_id = "8a91668254a1854f8349e9057e";
    $rewards = true;
    $reward_group = 4;
    $vouchers = false;
    $campaign_products = false;
    $is_valid = true;
    $customer_type_id = null;
    $accept_language = null;
    $result = $careCloud->customersApi()->getAllRewards(
        $customer_id,
        $rewards,
        $reward_group,
        $vouchers,
        $campaign_products,
        $is_valid,
        $customer_type_id,
        $accept_language,
    );
    var_dump($result);
} catch (\Throwable $exception) {
    var_dump($exception);
}
