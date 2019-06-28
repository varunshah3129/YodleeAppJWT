
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php


require_once('jwt/vendor/autoload.php');
use \Firebase\JWT\JWT;
    

    
        $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCm9NcwYrHfHU4bshLFAtXcQrY4
k2L2n8PLxHb7w5EqdoOBKEh5wy/TZru3l6ZbGBcEcf2N0bafjcypBSaZuNL7y3V7gV2i0+77u+j8
xEC/peSgQ5FrureXCgVrHB46mhoR3kcHfklSjD4rDxrrfMQw0YEm74rcr7qh8+dhkB+1yc6LRuI9
eICBg4EkyntOccBNt+4Bb1OtqjjNbYaBwaZw/Ck8OWodzNqf2AaY6f7mbWXniZhC3NX63Hc0wIsY
VQDQCIChOCuRMGCSDlFEd9Vtpd/QFOROfKqycXY6xfIrlkBj7AAwM98cMdNfau7RBbRKT4d8epE9
Ha6Dsir/YJbXAgMBAAECggEAefUGMCkYJ5Qfl2mX/mPY1uHAfElllCQWgYXNKJGuO+eAnltPvepP
yEwWOcFEWuyY+71M60jS73BEnP7POKFjNV1lP0e7n5LS0v5r7iBp79T90fgphRlKvMEsPha3GjWx
b3YASr/8TZl2XDvXfUeRhNu1TTzUIesYGO+zCHigQUivv6kJKuwmfiJYlnvdZfDTKM+HkEwWBSHS
bR6JI/tuP9qPsDJOl6f9UHmTB5mj58i5YyZqagjPjr6FS7ij7OKVESRbTDWELE1AeSEvCpH66R4a
ierpMI4I/jJPUk0xJ25Vkgupgxa2jI7jRbpoL/yJdde/tnMcoIXArZ+m4leD8QKBgQDcFcSP4S/e
rjd63KxY5VUCn48L42dUDh95NV9cyx8J8MV3B4U9/7idXYiWXB2tMH/Y62kjLcLG4BmnP/clPEqa
qjjp0JplbkMkEK+C342EZVt8gdBtZ8vv+hFw3Fo+bUy1TEqDLhaORiMc2v4oTxTlFkpXBYOGVfVR
SCIgP0UriQKBgQDCM5TEH39H+xakYYQNfgZrhgdMkLGec/ScCfOYYzIE1CS1qr/eT9Q0DxJCsokP
qr+SeNjfeTizxvtIEe5KxDGIOopy/TW/UyBrFdF6CfsziP/BRCcngoqgKdNdBt52RUrkESi73Sgo
NF0C/mGcPow+BFzF0vxERHFFS5p0x8M3XwKBgQC9pzhycDALKX//rQgLttwx3YOsT/Mr2NvAXIDn
+tWtgED5mI52ZdYWLZLVV13vb5rMN9irCvUM4fLZUGLOQI1diJBw1GUoQQM0ofhMxA40aA+VVFxi
2w4/pvO+mPRfVVrD5JFVR7MCOWhqpkBcRgGQhEvdf4/ehFZZC9r0hPE7WQKBgQC8R+wctXjenbZX
CuBPgHbS+m/LMKG0QTHPsupEPS/6dH9ezjwVWoofKtmGZrfxw5bWeGmzSEDMM8feGNxSCqMHM9KV
J59bbkmI6O9eBZ1RWqqzgtL/QFYMcGCm2YkHW6j/Mw+uC/3p9NKUm3KhXBb17Z7QgPzpZv32tBT8
0cwXuwKBgQCTx29d2k2wXrzP5bzO4iUsN41VpGnJF6j5h21Td4inqd1WjILR/e3GW4hbqLmQJECW
UIXg/V2ZODkDv/+8H9sowdhkn8TAwzhEzOfJXK6Q8uf4ET+deABC2DaLATNWbv6ZD7gelw+dmT/+
ZDmVRCt1GuFq6e//Xx4rSdXzyRMiAQ==
-----END PRIVATE KEY-----
EOD;
    
    
        $iat = time();
        $exp = strtotime("+10 minutes");
    
        $issuerId = "0098e940-e3d57465-809e-4bb0-9c2a-30694bae489c";
    
//        $userId = array("username1" => 'sbMem5c3411fa5be561', "username2" => 'sbMem5c3411fa5be562', "username3" => 'sbMem5c3411fa5be563', "username4" => 'sbMem5c3411fa5be564', "username5" => 'sbMem5c3411fa5be565');
    $userId ='sbMem5cf06e8c224244';
//        foreach ($userId as $newuser) {
        
            $token = array(
                "isadm" => false,
                "iat"   => $iat,
                "exp"   => $exp,
                "iss"   => $issuerId,
                "sub"   => $userId
            );
        
        
            $jwt = JWT::encode($token, $privateKey, 'RS512');
            echo $jwt;
//    echo "<div id=\"container-fastlink\">
//    <div style=\"text-align: center;\">
//        <lable>$newuser</lable><a class=\"testacc\" href=\"#\" onClick=\"launchFL('".$jwt.",".$newuser."');return false;\">Launch FastLink</a>
//    </div>
//</div>";
        
        echo "<form method='post' id='passJwt'><button type=\"button\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#myModal1\" onClick=\"launchFL('" . $jwt . "');return false;\">
  $userId
</button></form><br><br>";
//    }
    

?>

<script type='text/javascript' src='https://cdn.yodlee.com/fastlink/v1/initialize.js'></script>

<script>
    function launchFL(jwt) {

        //Open FastLink
        var jwtToken = jwt;

        console.log(jwtToken);


            window.fastlink.open({
                fastLinkURL: 'https://node.sandbox.yodlee.uk/authenticate/uksandbox',
                jwtToken:'Bearer '+jwtToken,
                params: '',
                onSuccess: function (data) {
                    console.log(data);
                },
                onError: function (data) {
                    console.log(data);
                },
                onExit: function (data) {
                    
                    console.log(data);
                    $("#close-FL[data-dismiss=modal]").trigger({ type: "click" });
                    window.location.reload(true);
                },
                onEvent: function (data) {
                    console.log(data);
                }
            }, 'container-fastlink');

        }

</script>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 700px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body" id="container-fastlink" style="height: 75%;width: 700px;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

