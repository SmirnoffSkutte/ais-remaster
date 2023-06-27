@extends('layouts.master')
@section('title')
    @lang('translation.Users_Settings')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') @lang('translation.Users_Settings') @endslot
        @slot('title') @lang('translation.User_Create') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">

            <div class="bg-light rounded">
                <h1>Добавить нового пользователя</h1>
                <div class="lead">
                    Добавьте нового пользователя и назначьте роль.
                </div>

                <div class="mt-4">
                    <form method="POST" action="" class="row">
                        @csrf
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">Имя пользователя</label>
                            <input value="{{ old('name') }}"
                                type="text"
                                class="form-control"
                                name="name"
                                placeholder="ФИО" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="username" class="form-label">Юзернейм</label>
                            <input value="{{ old('username') }}"
                                   type="text"
                                   class="form-control"
                                   name="username"
                                   placeholder="Username" required>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Адрес электронной почты</label>
                            <input value="{{ old('email') }}"
                                type="email"
                                class="form-control"
                                name="email"
                                placeholder="Email адрес" required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Роль</label>
                            <div class="col-md-12">
                                <select class="form-select" name="role">
                                    <option value="0">- выберите роль -</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                            <a href="{{ route('users-list') }}" class="btn btn-default">Отменить и вернуться в список пользователей</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
