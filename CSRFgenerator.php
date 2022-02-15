<?php
function csrf_token()
{
    $token = '';
    if (!isset($_SESSION['token'])) {
        //time value
        $time = time();
        //date value
        $numbers = explode("-", date("Y-m-d"));
        $number = (int)$numbers[0] + (int)$numbers[1] + (int)$numbers[2];
        //ip value
        $ip = intval(preg_replace('/[^0-9]+/', '', $_SERVER['REMOTE_ADDR']), 10);
        $ip = (int)$ip;
        $_SESSION['token'] = md5(($time + $number + $ip));
    }
    $token = $_SESSION['token'];
    return $token;
}
