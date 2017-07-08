<?php

class Airvend {

    public function CallVTU($amount, $network, $username, $pass, $refid, $phone) {
//        $url = "http://api.airvendng.net/vtu/?username={$username}&password={$pass}&networkid={$network}&amount={$amount}&type=1&msisdn={$phone}&ref={$refid}";
        $url = "https://api.airvendng.net/vtu/?username={$username}&password={$pass}&networkid={$network}&amount={$amount}&type=1&msisdn={$phone}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => ,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                $arr = array(
                    'destination' => $obj->Msisdn,
                    'amount' => $obj->Amount,
                    'status' => $obj->ResponseCode,
                    'response' => $xml
                );
                return $arr;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function CallTV($amount, $service, $username, $pass, $refid, $custnum, $period) {
        if(strcmp("startimes", $service)==0)
        {
             $url = "https://api.airvendng.net/vas/{$service}/?username={$username}&password={$pass}&amount={$amount}&smartcard={$custnum}&ref={$refid}&invoicePeriod={$period}";
        }
        else{
             $url = "https://api.airvendng.net/vas/{$service}/?username={$username}&password={$pass}&amount={$amount}&customerNumber={$custnum}&ref={$refid}&invoicePeriod={$period}";
        }
       

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                $arr = array(
                    'destination' => $custnum,
                    'amount' => $obj->Amount,
                    'status' => $obj->ResponseCode,
                    'response' => $xml
                );
                return $arr;
            }
        }

        return FALSE;
    }

    public function CallElectricity($amount, $type, $username, $pass, $refid, $account) {

//        $url_test = "http://api.airvendng.net/vas/electricity/?username={$username}&password={$pass}&type={$type}&amount={$amount}&ref={$refid}&account={$account}";
        if ($type == 13 || $type == 14) {
            $url = "https://api.airvendng.net/vas/eko/?username={$username}&password={$pass}&type={$type}&amount={$amount}&ref={$refid}&account={$account}";
        } else {
            $url = "https://api.airvendng.net/vas/electricity/?username={$username}&password={$pass}&type={$type}&amount={$amount}&ref={$refid}&account={$account}";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 2,
//            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
//                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {

                if (property_exists($obj, 'vendData')) {

                    if (property_exists($obj->vendData, 'creditToken')) {
                        $arr = array(
                            'destination' => $obj->Account,
                            'amount' => $obj->Amount,
                            'Token' => $bj->vendData->creditToken,
                            'status' => $obj->ResponseCode,
                            'response' => $response
                        );
                        return $arr;
                    } else {
                        $arr = array(
                            'destination' => $obj->Account,
                            'amount' => $obj->Amount,
                            'status' => $obj->ResponseCode,
                            'response' => $response
                        );
                        return $arr;
                    }
                }
            }
        }

//log_message('info', $response);
        return FALSE;
    }

    public function VerifyTV($service, $username, $pass, $card) {

        $url = "https://api.airvendng.net/vas/{$service}/verify/?username={$username}&password={$pass}&smartcard={$card}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);


        $err = curl_error($curl);
        curl_close($curl);

        $xml = json_decode($response);

        if (is_object($xml)) {
//            log_message('info', $obj);
//            var_dump($xml);
//            exit();
//            return $json;
            if (property_exists($xml, 'details')) {
                if (property_exists($xml->details, 'lastName')) {
                    $arr = array(
                        'name' => (string) $xml->details->lastName,
                        'status' => (string) $xml->details->accountStatus,
                        'custnum' => (string) $xml->details->customerNumber,
                        'custtype' => (string) $xml->details->customerType,
                        'period' => (string) $xml->details->invoicePeriod,
                    );
                    return $arr;
                }
                elseif (property_exists($xml->details, 'customerName')) {
                    $arr = array(
                        'name' => (string) $xml->details->customerName,
                        'status' =>0 ,
                        'custnum' => (string) $xml->details->smartCardNumber,
                        'custtype' => (string) $xml->details->customerType,
                        'period' => 1,
                    );
                    return $arr;
                }
                else {
                    $arr = array(
                        'errorMessage' => $xml->details->errorMessage
                    );
                    return $err;
                }
            }
        } else {
            return FALSE;
        }

        return FALSE;
    }

    public function VerifyElectricity($type, $username, $pass, $custnum) {
        if ($type == 13 || $type == 14) {
            $url = "https://api.airvendng.net/vas/eko/verify/?username={$username}&password={$pass}&account={$custnum}&type={$type}";
        } else {
            $url = "https://api.airvendng.net/vas/electricity/verify/?username={$username}&password={$pass}&account={$custnum}&type={$type}";
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_ENCODING => "",
            //CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

//        log_message('info', $response);
        if ($this->isJSON($response)) {
            $xml = json_decode($response);
        } else {
            $xml = simplexml_load_string($response);
        }

//        $xml = new SimpleXMLElement($response);
//        $json = json_encode($xml,JSON_FORCE_OBJECT);
//        $obj = json_decode($json);
//        log_message('info', $obj);


        if (is_object($xml)) {
//            log_message('info', $obj);
//            return $json;
            if (property_exists($xml, 'details')) {
                if ($type == 11) {
                    $arr = array(
                        'name' => (string) $xml->details->name,
                        'address' => (string) $xml->details->address,
                        'meter' => (string) $xml->details->meterNumber,
                    );
                    return $arr;
                } elseif ($type == 10) {
                    $arr = array(
                        'name' => (string) $xml->details->name,
                        'address' => (string) $xml->details->address,
                        'outstanding' => (string) $xml->details->outstandingAmount,
                        'meter' => (string) $xml->details->accountNumber,
                    );
                    return $arr;
                } elseif ($type == 12) { // ibadan prepaid
                } elseif ($type == 13) { // eko prepaid
                    $arr = array(
                        'name' => (string) $xml->details->customerName,
                        'address' => (string) $xml->details->customerAddress,
                        'meter' => $custnum,
                    );
                    return $arr;
                } elseif ($type == 14) { // eko postpaid
                    $arr = array(
                        'name' => (string) $xml->details->customerName,
                        'address' => (string) $xml->details->undertaking,
                        'outstanding' => (string) $xml->details->customerArrears,
                        'meter' => $custnum
                    );
                    return $arr;
                }
            }
        } else {
            return FALSE;
        }
    }

    public function Balance($username, $pass) {

        $url = "https://api.airvendng.net/vtu/balance.php?username={$username}&password={$pass}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                return TRUE;
            } else {
                return $obj;
            }
        } else {
            return $obj;
        }

//        return FALSE;
    }

    public function CallData($amount, $network, $username, $pass, $refid, $phone) {
        $url = "https://api.airvendng.net/vtu/?username={$username}&password={$pass}&networkid={$network}&amount={$amount}&type=2&msisdn={$phone}&ref={$refid}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                $arr = array(
                    'destination' => $obj->Msisdn,
                    'amount' => $obj->Amount,
                    'status' => $obj->ResponseCode,
                    'response' => $xml
                );
                return $arr;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function CallWAEC($username, $pass, $refid, $pins, $pinvalue) {
        $amount = $pins * $pinvalue;
        $url = "https://api.airvendng.net/vas/waec/?username={$username}&password={$pass}&pins={$pins}&amount={$amount}&ref={$refid}&pinvalue={$pinvalue}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                if (property_exists($obj, 'vendData')) {

                    $toreturn = array(
                        'response' => $response,
                    );




                    return $toreturn;
                }
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function WAECPRODUCTS($username, $pass) {

        $url = "https://api.airvendng.net/vas/waec/product/?username={$username}&password={$pass}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
//        $xml = simplexml_load_string($response);
//        $json = json_encode($xml);
        $obj = json_decode($response);
        if (is_object($obj)) {
            if (property_exists($obj, 'details')) {
                $pv = $obj->details->pinValues;
                $ret = array(
                    'amount' => $pv[0]->amount
                );

                return $ret;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function VerifySmile($username, $pass, $account) {

        $url = "https://api.airvendng.net/vas/smile/verify/?username={$username}&password={$pass}&account={$account}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
//        $xml = simplexml_load_string($response);
//        $json = json_encode();
        $obj = json_decode($response);
        if (is_object($obj)) {
            if (property_exists($obj, 'details')) {

                $ret = array(
                    'fn' => $obj->details->firstName,
                    'ln' => $obj->details->lastName,
                    'mn' => $obj->details->middleName,
                );

                return $ret;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function SmileBundleList($username, $pass, $account) {

        $url = "https://api.airvendng.net/vas/smilebundle/product/?username={$username}&password={$pass}&account={$account}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
//        $xml = simplexml_load_string($response);
//        $json = json_encode();
        $obj = json_decode($response);
        if (is_object($obj)) {
            if (property_exists($obj, 'details')) {
                if (property_exists($obj->details, 'bundles')) {
                    $bundles = $obj->details->bundles;
//                    $list = json_decode($bundles, TRUE);
                    return $bundles;
                } else {
                    return FALSE;
                }


                return FALSE;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function ValidateUsername($username) {
        // Provide Values for Database
        $dbhost = "localhost";
        $dbname = "millions_umatrix";
        $dbuser = "millions_umatrix";
        $dbpass = "umatrix";

//Don't change the below 2 lines
        $dbconnect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


// Check connection
// Perform queries 

        if ($dbconnect) {

            $sql = "select * from users where username='{$username}' and status > 1";
            $result = mysqli_query($dbconnect, $sql);
            if ($result) {
                $array = mysqli_fetch_assoc($result);
                if (is_array($array) && count($array) > 0) {
                    $retur = array(
                        'name' => $array['Name'],
                        'phone' => $array['Phone'],
                        'email' => $array['Email'],
                        'username' => $array['Username'],
                        'status' => $array['status']
                    );

                    return $retur;
                } else {
                    return FALSE;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

    public function CallSmileBundle($username, $pass, $refid, $amount, $account, $typecode) {

        $url = "https://api.airvendng.net/vas/smilebundle/?username={$username}&password={$pass}&account={$account}&ref={$refid}&bundleCode={$typecode}&amount={$amount}&quantity=1";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                if (property_exists($obj, 'vendData')) {

                    $arr = array(
                        'destination' => $obj->Account,
                        'amount' => $obj->Amount,
                        'status' => $obj->ResponseCode,
                        'response' => $xml
                    );
                    return $arr;
                }
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    public function CallSmileRecharge($username, $pass, $refid, $amount, $account) {

        $url = "https://api.airvendng.net/vas/smile/?username={$username}&password={$pass}&account={$account}&ref={$refid}&amount={$amount}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "connection: Keep-Alive",
            // "content-type: text/html",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

// var_dump($url);
// exit();
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $obj = json_decode($json);
        if (is_object($obj)) {
            if ($obj->ResponseCode == 0) {
                if (property_exists($obj, 'vendData')) {

                    $arr = array(
                        'destination' => $obj->Account,
                        'amount' => $obj->Amount,
                        'status' => $obj->ResponseCode,
                        'response' => $xml
                    );
                    return $arr;
                }
            } else {
                return false;
            }
        } else {
            return FALSE;
        }

//        return FALSE;
    }

    function isJSON($string) {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

}
