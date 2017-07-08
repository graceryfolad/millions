<?php
namespace ServerGenerator\Libraries;
use Exception;
use stdClass;
class Generator {
    public static function MerchantCode() {
        $aphabet=array(
            'A','B','C','D','E','F','G','H','J','K','L','N','P','Q','R','S','T','U','V','W','X','Y','Z'
            );
        $rand1 = rand(1, count($aphabet) - 1);
        $rand2 = rand(1, count($aphabet) - 1);
        $rand3 =  rand(1030,9090);
        $code = "{$aphabet[$rand2]}{$aphabet[$rand1]}{$rand3}";
        
        return $code;
        
    }
}
