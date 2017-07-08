<?php

namespace ServerGenerator\Libraries;

use Exception;
use stdClass;

class Moryield_Server {

    public static function MerchantCode() {
        $aphabet = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );
//        $rand1 = rand(1, count($aphabet) - 1);
//        $rand2 = rand(1, count($aphabet) - 1);
//        $rand3 =  rand(1030,9090);
//        $code = "{$aphabet[$rand2]}{$aphabet[$rand1]}{$rand3}";
        $code = array();
        for ($i = 2001; $i <= 5000; $i++) {

            $rand2 = rand(1, count($aphabet) - 1);

            $code[] = "{$aphabet[0]}{$aphabet[$rand2]}{$i}";
        }
        return $code;
    }

    public static function GeneratePin($pvalue, $start, $count,$pcode) {
        if ($pvalue > 10 && $pvalue < 1000) {
            $store = array();
            $serial = rand(1000000000,9999999999);
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 5009);

                $res = "{$start}{$num1}{$num3}{$num4}";
                $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=3;
                sleep(0.5);
            }
        } elseif ($pvalue >= 1000 && $pvalue < 2000) {
            $store = array();
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $start = $start + 2;
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 5009);

                $res = "{$start}{$num1}{$num3}{$num4}";
               $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=2;
                sleep(0.5);
            }
        } elseif ($pvalue >= 2000 && $pvalue < 5000) {
            $store = array();
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $start = $start + 5;
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 9009);
                $res = "{$start}{$num1}{$num3}{$num4}";
               $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=4;
                sleep(0.5);
            }
        } elseif ($pvalue >= 5000 && $pvalue < 10000) {
            $store = array();
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $start = $start + 7;
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 9009);
                $res = "{$start}{$num1}{$num3}{$num4}";
               $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=7;
                sleep(0.5);
            }
        } elseif ($pvalue >= 10000 && $pvalue < 50000) {
            $store = array();
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $start = $start + 8;
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 9009);
                $res = "{$start}{$num1}{$num3}{$num4}";
               $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=9;
                sleep(0.5);
            }
        } elseif ($pvalue >= 50000 && $pvalue < 100000) {
            $store = array();
            for ($j = 1; $j <= $count; $j++) {
                $num1 = mt_rand(10, 90);
                $start = $start + 12;
                $go = (int) "{$start}000001";
                $num3 = mt_rand($go, 99999999);



                $num4 = mt_rand(1200, 9009);
                $res = "{$start}{$num1}{$num3}{$num4}";
                $store[] = array(
                    'pin'=>$res,
                    'serial'=>$serial,
                    'code'=>$pcode
                );
                $serial +=10;
                sleep(0.5);
            }
        }

        return $store;
    }

    public static function GenerateBatch($limit) {
        $aphabet = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );

        $rand = rand(1, count($aphabet) - 1);
        $lm = $limit + 1000;
        for ($i = 1001; $i <= $lm; $i++) {
            $arr[] = "{$aphabet[$rand]}$i";
        }

        return $arr;
    }

    public static function mc_encrypt($encrypt, $key) {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

// Decrypt Function
    public static function mc_decrypt($decrypt, $key) {
        $decrypt = explode('|', $decrypt . '|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

}
