<?php
    /**
     * Created by PhpStorm.
     * User: vshah
     * Date: 6/18/19
     * Time: 12:53 PM
     */
    
    require_once('jwt/vendor/autoload.php');
    
    use \Firebase\JWT\JWT;
    
   
        $key = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCKuOGW4QEZ0Tlc75x4nsjcBjKz7R3RmP6K3VFtFD++aH3fum9Y
jCd3Du2iURYFICkD7/z1odkY9AHCaJ53dCooidMFV9wbCbYiCXO/tds5EVSM2lxJ
Q7oRqdH2QnHHJl/iJIjFhLw2Jhhq/Jwt3X0H+N+HHT7dMPRdsHBHslk5iQIDAQAB
AoGAeW5NSt27MPZM2GWG+q9D9BYY3Bd8OrVKXBRP6sQG6I5fYTC5tzE4eqe+rI9+
Tw5P2PqC3CHJAGbYA23BCZ/OJlRKf1Kt9LCrDe4njD0PBmZyPFTGfwTsrO63dW7C
slyhb/T5IWeXd7RaVhS/9szIqvFtsdkl6CCbaIb47JqUmGECQQC/IQIEL3LLc/cX
hgXVEeUO6mLMT8tqFZ4KcpmzspPQMWTTPKI9sqcstUafz+R7zDAZ/ndXCeKDrcPi
583kZbbDAkEAuc5Oc2xdkPmY5MRN3fOdz67fhOEZl1UMSyNePlDQKrfyfWq9R/9Q
4D7umnWg5SyBykcchinV134JbJE0yDLBwwJAJNzY5rXADj1virnupgmthBLwuzco
pG1G7fzsaBwpJh5gs90d7YhnddgApxIRn07ieCD8I21kosEA5uKOc16qwQJBAJIp
imkd29TJo86B5cctdv0C0W4ULS9whcUtw1s98yNHpIeoSdGzNInSt5vl4HWnN0pJ
+lRH4KIt0XgIGf9KfkUCQCFcyNaQyF7Bul+Y4BRpIpAuneCitXGAYA3ASleIAORX
sQtyMShMs13+rYdoPPPqMoXECPCTB4Naf0y/vaZ/nZg=
-----END RSA PRIVATE KEY-----";
        $issuer = "0098e798-63a8501e-7050-4ea7-9c87-4906efe02982";
        $email =  "abc@gmail.com";
        $user_name = "test@123";
//    if (isset($_POST['devPrivateKey']))
//        $key = htmlentities($_POST['devPrivateKey']);
//
//    if (isset($_POST['DevIssuerID']))
//        $issuer = htmlentities($_POST['DevIssuerID']);
//    if (isset($_POST['DevEmail']))
//        $email = htmlentities($_POST['DevEmail']);
//
//    if (isset($_POST['DevUser']))
//        $user_name = htmlentities($_POST['DevUser']);
        //echo '<pre>'.$key.'</pre>';
    

        
//        $userLogin = $_POST['username'];
//        $node_url = $_POST['node_url'];
    
    
        $iat = time() - 90;
        $exp = strtotime("+10 minutes");
    
        $token = array(
            "iat" => $iat,
            "exp" => $exp,
            "iss" => $issuer
            
        );

    
    
        
        $jwt = JWT::encode($token, $key, 'RS512');
        echo $jwt;
        
        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_PORT           => "443",
            CURLOPT_URL            => "https://development.api.yodlee.com/ysl/user/register",
            CURLOPT_VERBOSE => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => "{\r\n\"user\": {\r\n  \"loginName\": \"$user_name\", \r\n  \"email\": \"$email\", \r\n  \"name\": {\r\n    \"first\": \"\",\r\n    \"last\": \"\" \r\n    },\r\n\"address\": {\r\n    \"address1\": \"\",\r\n    \"state\": \"\",\r\n    \"city\": \"\",\r\n    \"zip\": \"\",\r\n    \"country\": \"USA\"\r\n    },\r\n\"preferences\": {\r\n    \"currency\": \"USD\",\r\n    \"timeZone\": \"GMT\",\r\n    \"dateFormat\": \"YYYY-MMM-DD\",\r\n    \"locale\": \"en_US\"\r\n    }\r\n  }\r\n}",
            CURLOPT_HTTPHEADER     => array(
                "Accept: */*",
                "Api-Version: 1.1",
                "Authorization: Bearer $jwt",
                "Content-Type: application/json"

            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;

        }
    