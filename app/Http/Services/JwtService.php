<?php
namespace App\Http\Services;
use Exception;

class JwtService {
    private function base64url_encode($data):string {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode($data):string {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function verifyToken(string $token){
        try {
            $tokenParts = explode('.', $token);
            if (count($tokenParts) < 3) {
                return false;
            }
            $headers_encoded = $tokenParts[0];
            $payload_encoded = $tokenParts[1];
            $userSignature = $tokenParts[2];

            $payload_decodedArray = json_decode($this->base64url_decode($payload_encoded), true);
            // Решил сделать один вечный токен вместо 2 с временами жизни
            //checking time
//            $currentTime = time();
//            if ($currentTime > $payload_decodedArray['exp']) {
//                throw new Exception('Токен истек',402);
//            }

            //build the signature to verify
            $key = 'wefjnnjwjef34230r0fewf';
            $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
            $signature_encoded = $this->base64url_encode($signature);

            if ($signature_encoded === $userSignature) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ],$exception->getCode());
        }
    }

    public function issueAccessToken(array $userData){
        $userTokenInfo=[];
            if (isset($userData['id']) && isset($userData['username']) && isset($userData['phone'])) {
                $userTokenInfo['id'] = $userData['id'];
                $userTokenInfo['username'] = $userData['username'];
                $userTokenInfo['phone']=$userData['phone'];

                $userTokenInfo['iat'] = time();
                $userTokenInfo['exp'] = time() + 631152000;
//                7200
                //build the headers
                $headers = ['alg' => 'HS256', 'typ' => 'JWT'];
                $headers_encoded = $this->base64url_encode(json_encode($headers));

                //build the payload
                //$payload = ['sub'=>'1234567890','name'=>'John Doe', 'admin'=>true];
                $payload_encoded = $this->base64url_encode(json_encode($userTokenInfo));

                //build the signature
                $key = 'wefjnnjwjef34230r0fewf';
                $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
                $signature_encoded = $this->base64url_encode($signature);

                //build and return the token
                $token = "$headers_encoded.$payload_encoded.$signature_encoded";
                return $token;
            }
    }

    public function identifyUsersId(string $token){
        if ($token==null){
            return null;
        }

        $tokenParts=explode('.',$token);
        $payload=$tokenParts[1];
        $decodedTokenPayload=json_decode($this->base64url_decode($payload),true);
        $id=$decodedTokenPayload['id'];
        return $id;
    }
}
