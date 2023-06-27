<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Класс получает данные авторизации,по ним регистрирует/логинит юзера и редиректит на сайт с кукой токена доступа.
 */
class AuthController extends Controller
{
    /**
     * Регистрация по запросу
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(Request $request)
    {
        $body = $request->all();

        $email = $body['email'];
        $username = $body['username'];
        $name = $body['name'];
        $phone = $body['phone'];
        $password = $body['password'];

        $auth_service = new AuthService();
        $new_user_info = $auth_service->registration($username, $password, $email, $phone, $name);

        $responce_array = json_decode($new_user_info, true);
        $access_token = $responce_array['access_token'];
        $cookie = Cookie::make('access_token', $access_token, 576000);

        return redirect()->route('home')->withCookie($cookie);
    }

    /**
     * Логин по
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $body = $request->all();

        $username = $body['username'];
        $password = $body['password'];

        $auth_service = new AuthService();
        $user_info = $auth_service->login($username, $password);

        $responce_array = json_decode($user_info, true);
        $access_token = $responce_array['access_token'];
        $cookie = Cookie::make('access_token', $access_token, 576000);

        return redirect()->route('home')->withCookie($cookie);
    }
}
