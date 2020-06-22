<?php
namespace Zoom;
class Tools
{
    public static function generateJWT($apiKey, $apiSecret)
    {
        $token = [
            'iss' => $apiKey,
            'exp' => time() + 60,
        ];
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256',
        ];

        $toSign =
            self::urlsafeB64Encode(json_encode($header)) .
            '.' .
            self::urlsafeB64Encode(json_encode($token));

        $signature = hash_hmac('SHA256', $toSign, $apiSecret, true);

        return $toSign . '.' . self::urlsafeB64Encode($signature);
    }
    public static function urlsafeB64Encode($string)
    {
        return str_replace('=', '', strtr(base64_encode($string), '+/', '-_'));
    }
    public static function generateSignature(
        $api_key,
        $api_secret,
        $meeting_number,
        $role
    ) {
        $time = time() * 1000 - 30000; //time in milliseconds (or close enough)

        $data = base64_encode($api_key . $meeting_number . $time . $role);

        $hash = hash_hmac('sha256', $data, $api_secret, true);

        $_sig =
            $api_key .
            '.' .
            $meeting_number .
            '.' .
            $time .
            '.' .
            $role .
            '.' .
            base64_encode($hash);

        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
}