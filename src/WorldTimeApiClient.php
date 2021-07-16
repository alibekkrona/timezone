<?php

namespace Timezone;

use GuzzleHttp\Client;
use Timezone\Helpers\IpHelper;
use Timezone\Exceptions\TimezoneException;

/**
 * Class WorldTimeApiClient
 * @package Timezone
 */
class WorldTimeApiClient
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * WorldTimeApiClient constructor.
     * @param $options
     */
    public function __construct($options = []) {
        $this->client =  new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://worldtimeapi.org/api/ip/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ] + $options);
    }

    /**
     * @param $responseBody
     * @return array
     */
    public function parseResult($responseBody): array {
        $data = [];
        $parts = explode(PHP_EOL, $responseBody);
        foreach ($parts as $line) {
            $params = explode(':', $line);
            $data[$params[0]] = $params[1];
        }
        return $data;
    }

    /**
     * Get time from WorldTimeApi
     *
     * @param $ip
     * @return \DateTime
     * @throws TimezoneException
     */
    public function getTime($ip): \DateTime {
        if (empty($ip)) {
            $ip = IpHelper::getCurrentIp();
        }
        try {
            $response = $this->client->request('GET', $ip . '.txt');
            $responseBody = $response->getBody();
            $timeData = $this->parseResult($responseBody->getContents());
            $dateTime = new \DateTime();
            $dateTime->setTimezone(new \DateTimeZone($timeData['timezone']));
            $dateTime->setTimestamp($timeData['unixtime']);
            return $dateTime;
        } catch (\Throwable $e) {
            throw new TimezoneException("Time server is not reachable");
        }
    }
}
