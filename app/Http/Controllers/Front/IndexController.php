<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

/**
 *
 * Класс,возвращающий blade файлы для роутов
 */
class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function users()
    {
        return view('users');
    }


    public function register()
    {
        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function shop()
    {
        return view('ecommerce-products');
    }
}
