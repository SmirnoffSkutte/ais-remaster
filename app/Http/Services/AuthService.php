<?php namespace App\Http\Services;

use App\Models\User;
use App\Http\Services\JwtService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Сервис авторизации,работает с бд во время авторизации
 */
class AuthService
{
    /**
     * Логика регистрации в бд + возращает токен доступа
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $phone
     * @param string $name
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function registration(string $username, string $password, string $email, string $phone, string $name)
    {
        try {
            $jwt = new JwtService();
            /**
             * Валидация регистрации
             */
            $isOldUser = \App\Models\User::where('username', $username)->first();
            $isOldPhone = \App\Models\User::where('phone', $phone)->first();
            $isOldEmail = \App\Models\User::where('email', $email)->first();
            if ($isOldUser) {
                throw new Exception("Пользователь $username уже зарегистрирован", 406);
            }
            if ($isOldPhone) {
                throw new Exception("Телефон $phone уже зарегистрирован", 406);
            }
            if ($isOldEmail) {
                throw new Exception("Email $email уже зарегистрирован", 406);
            }
            if (strlen($password) < 1) {
                throw new Exception("Придумайте пароль", 406);
            }
            /**
             * Создание нового пользователя
             */
            $new_user = new \App\Models\User();
            $new_user->username = $username;
            $new_user->phone = $phone;
            $new_user->password = password_hash($password, PASSWORD_DEFAULT);
            $new_user->name = $name;
            $new_user->email = $email;
            $new_user->save();

            /**
             * Получаем данные нового юзера из бд
             */
            $user_info = \App\Models\User::where('username', $username)->first();
            $data = [
                'username' => $user_info->username,
                'phone' => $user_info->phone,
                'id' => $user_info->id,
            ];
            /**
             * Присваиваем пользователю роль по умолчанию
             */
            DB::table('users_roles')->insert([
                'user_id' => $user_info->id,
                'role_id' => 1
            ]);

            /**
             * Генерируем токен доступа,отдаем данные о новом юзере и его токен доступа
             */
            $token = $jwt->issueAccessToken($data);
            $responce = [
                'user' => [
                    'username' => $user_info->username,
                    'phone' => $user_info->phone,
                    'id' => $user_info->id,
                ],
                'access_token' => $token,
            ];
            return json_encode($responce);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Логика логина в бд + возращает токен доступа
     * @param string $username
     * @param string $password
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function login(string $username, string $password)
    {
        $userData = $this->validateUser($username, $password);
        if ($userData instanceof \Illuminate\Http\JsonResponse) {
            return $userData;
        }
        $jwt = new JwtService();
        $token = $jwt->issueAccessToken($userData);

        $user_info = [
            'user' => $userData,
            'access_token' => $token
        ];
        return json_encode($user_info);
    }

    /**
     * Проверка пользователя перед логином
     * @param string $username
     * @param string $password
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function validateUser(string $username, string $password)
    {
        try {
            $user = User::where('username', $username)->first();
            if (!$user) {
                throw new \Exception("Нет пользователя с логином $username", 404);
            }
            $passwordDb = $user->password;
            if (!password_verify($password, $passwordDb)) {
                throw new \Exception("Пароль неверен", 406);
            }
            $data = [
                'username' => $user->username,
                'phone' => $user->phone,
                'id' => $user->id
            ];
            return $data;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}
