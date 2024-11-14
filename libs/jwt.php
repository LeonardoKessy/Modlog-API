<?php
    function createJWT($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $header = encode($header);

        $payload = json_encode($payload);
        $payload = encode($payload);

        $signature = hash_hmac('sha256', $header . "." . $payload, TOKEN_KEY, true);
        $signature = encode($signature);

        $jwt = $header . "." . $payload . "." . $signature;
        return $jwt;
    }

    function validateJWT($jwt) {
        $jwt = explode('.', $jwt);

        if(count($jwt) != 3) 
            return null;
        
        $header = $jwt[0];
        $payload = $jwt[1];
        $signature = $jwt[2];

        $valid_signature = hash_hmac('sha256', $header . "." . $payload, TOKEN_KEY, true);
        $valid_signature = encode($valid_signature);

        if($signature != $valid_signature)
            return null;


        $payload = base64_decode($payload);
        $payload = json_decode($payload);


        if($payload->exp < time()){
            echo 'Expired Token';
            return null;
        }

        return $payload;
    }

    function encode($var) {
        $var = base64_encode($var);
        $var = str_replace(['+', '/', '='], ['-', '_', ''], $var);
        return $var;
    }

    function checkAdmin($res) {
        if (!$res->user || $res->user->role != 'admin') 
            return false;

        return true;
    }
