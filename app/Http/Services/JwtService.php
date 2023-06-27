<?php namespace App\Http\Services;

/**
 * Сервис токенов доступа jwt.Создает,проверяет их.
 */
class JwtService
{
    /**
     * Декодирование ассоциативного массива в base64
     * @param $data
     * @return string
     */
    private function base64url_encode($data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Кодирование ассоциативного массива в base64
     * @param $data
     * @return string
     */
    private function base64url_decode($data): string
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    /**
     * Функция проверки валидности токена,т.е. не подделан ли он.
     * @param string $token
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function verifyToken(string $token)
    {
        try {
            $tokenParts = explode('.', $token);
            if (count($tokenParts) < 3) {
                return false;
            }
            $headers_encoded = $tokenParts[0];
            $payload_encoded = $tokenParts[1];
            $userSignature = $tokenParts[2];

            $payload_decodedArray = json_decode($this->base64url_decode($payload_encoded), true);

            //build the signature to verify
            $key = 'wefjnnjwjef34230r0fewf';
            $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
            $signature_encoded = $this->base64url_encode($signature);

            if ($signature_encoded === $userSignature) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    /**
     * Создание токена доступа из данных пользователя.
     * @param array $userData
     * @return string|void
     */
    public function issueAccessToken(array $userData)
    {
        $userTokenInfo = [];
        if (isset($userData['id']) && isset($userData['username']) && isset($userData['phone'])) {
            $userTokenInfo['id'] = $userData['id'];
            $userTokenInfo['username'] = $userData['username'];
            $userTokenInfo['phone'] = $userData['phone'];

            $userTokenInfo['iat'] = time();
            $userTokenInfo['exp'] = time() + 631152000;

            /**
             * Создание заголовка токена
             */
            $headers = ['alg' => 'HS256', 'typ' => 'JWT'];
            $headers_encoded = $this->base64url_encode(json_encode($headers));

            /**
             * Создание данных пользователя в токене
             */
            //$payload = ['sub'=>'1234567890','name'=>'John Doe', 'admin'=>true];
            $payload_encoded = $this->base64url_encode(json_encode($userTokenInfo));

            /**
             * Создание подписи,по которой потом проверяется валидность токена(то,что его не подделали)
             */
            $key = 'wefjnnjwjef34230r0fewf';
            $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
            $signature_encoded = $this->base64url_encode($signature);

            $token = "$headers_encoded.$payload_encoded.$signature_encoded";

            return $token;
        }
    }

    /**
     * Получение id пользователя из его токена доступа
     * @param string $token
     * @return mixed|null
     */
    public function identifyUsersId(string $token)
    {
        $tokenParts = explode('.', $token);
        $payload = $tokenParts[1];
        $decodedTokenPayload = json_decode($this->base64url_decode($payload), true);
        $id = $decodedTokenPayload['id'];

        return $id;
    }
}
