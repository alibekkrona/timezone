<?php

namespace Timezone\Helpers;
/**
 * Class IpHelper
 * @package Timezone
 */
class IpHelper {
    public static function getCurrentIp() {
        //whether ip is from the share internet
        if (!emptyempty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } //whether ip is from the proxy
        elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } //whether ip is from the remote address
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}