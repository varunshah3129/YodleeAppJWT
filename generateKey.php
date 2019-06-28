<?php
    include('Crypt/RSA.php');
    
    $rsa = new Crypt_RSA();
    $rsa->loadKey('...');
    
    $privatekey = $rsa->getPrivateKey();
    $publickey = $rsa->getPublicKey();
?>