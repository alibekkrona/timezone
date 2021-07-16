<?php

require_once "vendor/autoload.php";

use Timezone\WorldTimeApiClient;
use Timezone\Exceptions\TimezoneException;

$client = new WorldTimeApiClient();
try {
    $res = $client->getTime('46.160.91.118');
    var_dump($res->getTimezone());
} catch (TimezoneException $e) {
    $errorMessage = $e->getMessage();
}

