@extends('layouts.master-without-nav')
@section('title')
    Register
@endsection
@section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="{{ url('index') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="mb-5 d-block auth-logo">
                            <img src="{{ asset('images/logo-dark.png') }}" alt="" height="22"
                                class="logo logo-dark">
                            <img src="{{ asset('images/logo-light.png') }}" alt="" height="22"
                                class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mt-2">
                                <h5 class="text-primary">Register Account zzzzzzz</h5>
                                <p class="text-muted">Get your free Minible account now.</p>
                            </div>
                            <div class="p-2 mt-4">
                               <form method="POST" action="/api/registration">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control"
                                            name="email" id="email" placeholder="Enter email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control"
                                            name="username" id="username"
                                            placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="name">Имя</label>
                                        <input type="text" class="form-control"
                                               name="name" id="name"
                                               placeholder="Enter name">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Телефон</label>
                                        <input type="text" class="form-control"
                                               name="phone" id="phone"
                                               placeholder="Введите телефон">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Пароль</label>
                                        <input type="password" class="form-control"
                                            name="password" id="password" placeholder="Enter password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Повторите пароль</label>
                                        <input type="password"
                                            class="form-control"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Enter confirm password">
                                    </div>


                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="auth-terms-condition-check">
                                        <label class="form-check-label" for="auth-terms-condition-check">I accept <a
                                                href="javascript: void(0);" class="text-dark">Terms and
                                                Conditions</a></label>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light"
                                        id="reg-button">Регистрация</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 title">Sign up using</h5>
                                        </div>


                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Already have an account ? <a href="{{ url('login') }}"
                                                class="fw-medium text-primary"> Login</a></p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>©<script>
                                document.write(new Date().getFullYear())

                            </script> Minible. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
{{--    <script type="module" src="{{ asset('js/auth/registration.js') }}"></script>--}}
@endsection
