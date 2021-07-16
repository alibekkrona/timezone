<?php

use PHPUnit\Framework\TestCase;
use Timezone\WorldTimeApiClient;

/**
 * Class WorldTimeApiClientTest
 */
class WorldTimeApiClientTest extends TestCase {

    /**
     * @return false
     * @throws \Timezone\Exceptions\TimezoneException
     */
    public function testGetTime() {
        $client = new WorldTimeApiClient();
        try {
            $dateTimeObject = $client->getTime('46.160.91.118');
            $timezone = $dateTimeObject->getTimezone();
            $this->assertSame("Europe/Kiev", $timezone->getName());
        } catch (TimezoneException $e) {
            return false;
        }
    }
}
