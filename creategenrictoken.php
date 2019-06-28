<?php
    /**
     * Created by PhpStorm.
     * User: vshah
     * Date: 6/12/19
     * Time: 2:50 PM
     */
    require_once('jwt/vendor/autoload.php');
    
    use \Firebase\JWT\JWT;
    
    
    

        $key = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgHPN06Ak1xscqJI137aiBTXSi5xopkquI6QG311mYR2/wfLAAe7t
+YXyUXXlQc8wtFSXVp9jM3bbl9oQAxb4SiTwVKerGEYg7QSKJeQpvzrOxv4Fb443
jacxfvus+INLm8EWOs2gjkKvV0hDiikdmxiBz2bSGCBsQRcK9iINk6wLAgMBAAEC
gYAetBPIAfyGU7LeESqfYZXAD3K0pYpxgnowoyHVwa8+E/l4QzBACRh/SyAOAhrQ
tDkbtIRi/gpHGTHJvzUSggImKp8m+Z0k1Q8tDVSO+BkYXee9lE4+bSJU4bLUuCSW
djCu99SlK2LFmNIlB1V1xXXadYFS4jdkdRCg2YyY5+CiAQJBAN+2hl77Gv6Ux6Qr
IX5jQS3bh77+FgdMI/2cdqAXor7U+VYcrNOcdaIj3GoU+lYTW64E7yDSS3sUKRyV
GeJZqiMCQQCEhGmJV6bbzZla4GnZcWthvkTUpf8XuqWPO8QQRve6Zv+6aDDUXu2l
mjrqCjSC/30DeE+RD/zVDIwwp/MfiRD5AkEAnb4zI1gGIcrAttaeyGKuO+qW3iqF
V+HtYs9nqdzgqZS8t2aCyreBDrIgokBmgDkoJR1fjBIcnQ2LK5dK6Br3ZwJAQpGp
2n6Xqa9crFQzmDHruYw1U4WX4bm3VX62fV7JL3ByYpfYf7a4NwqFMfCydGQXzthv
T/XyEqxc+ExGS781MQJAIHfbBjnGZBgVnHrWZBiWJECVbdANgRs/trezKUXsd0fN
/bj/22TZwwjSztppGxITNmly4dBUeGDJ2NVp3ZQXeA==
-----END RSA PRIVATE KEY-----
EOD;

        
        //echo '<pre>'.$key.'</pre>';
        $privateKey =$key;
        $issuer = "0098e798-41050ae5-2673-433b-8114-73a56f551d67";
        
        //$node_url =$_POST['node_url'];
        
        
        $iat = time() - 90;
        $exp = strtotime("+10 minutes");
        
        $token = array(
            "iat" => $iat,
            "exp" => $exp,
            "iss" => $issuer,
            
        );
        
        $jwt = JWT::encode($token, $privateKey, 'RS512');
        echo $jwt;
        echo "\n";