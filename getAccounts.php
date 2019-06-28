<?php
    
    require_once('jwt/vendor/autoload.php');
    
    use \Firebase\JWT\JWT;
    
    error_reporting(E_ALL ^ E_ALL);
    ob_end_flush();
    session_start();
    $ini_array = parse_ini_file(__DIR__."/myapp.ini");
    
    $url = $ini_array["BASE_URL"];
    
    $node_url = $ini_array["NODE_URL"];
    $linked_acc_url = $ini_array["BASE_URL"].$ini_array["GET_ACCOUNTS_URL"];
    $trans_url = $ini_array["BASE_URL"].$ini_array["GET_TRANSACTIONS_URL"];
    $cobrand = $ini_array["COBRAND_NAME"];
    $apiVersion=$ini_array["API_VERSION"];
    
    if (isset($_POST['submit'])) {
        $key = $_POST['privateKey'];
        //echo '<pre>'.$key.'</pre>';
        $privateKey = $key;
        $issuer = $_POST['issuerID'];
        $userLogin = $_POST['username'];
        $node_url = $_POST['node_url'];
    
    
        $iat = time() - 90;
        $exp = strtotime("+10 minutes");
    
        $token = array(
            "iat" => $iat,
            "exp" => $exp,
            "iss" => $issuer,
            "sub" => $userLogin
        );
    
        $jwt = JWT::encode($token, $privateKey, 'RS512');
//    echo '<pre class="prettyprint" style="overflow-y: hidden;">'.$jwt.'</pre>';
    
    
        //Accounts

//    function getUserAccounts($url,$cobrand,$apiVersion,$token)
//    {
    
        $jwtToken = 'Authorization: Bearer' . $jwt;
    
    
        $newDate = date("Y-m-d", strtotime("-3 month"));
        //echo $newDate;
        $jwtToken= 'Authorization:'.$token ;
    
        $transactions_acc_url = $trans_url.'?fromDate='.$newDate.'&accountId=';
        echo $transactions_acc_url;
    
        $ch3 = curl_init($url);
        curl_setopt($ch3, CURLOPT_URL, $transactions_acc_url);
        curl_setopt($ch3, CURLOPT_HEADER, 0);
        curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Cobrand-Name:'.$cobrand, 'Api-Version:'.$apiVersion, $jwtToken));
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch3);
        curl_close($ch3);
        $trans_data = json_decode($output, true);
        print_r($trans_data);
    
    
    
    }
    ?>