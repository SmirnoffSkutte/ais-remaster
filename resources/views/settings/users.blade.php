@extends('layouts.master')
@section('title')
    @lang('translation.Settings_Area')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') @lang('translation.Settings_Area') @endslot
        @slot('title') @lang('translation.Users_Settings') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    {{-- Кнопка Добавить и элемент поиска --}}
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="{{ route('user.create') }}" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Добавить пользователя</a>
                                @if(request()->get('status') == 'archived')
                                    {!! Form::open(['method' => 'POST','route' => ['user.restore-all'],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Восстановить все', ['class' => 'btn btn-primary waves-effect waves-light']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-inline float-md-end mb-3">
                                <div class="search-box ms-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded bg-light border-0"
                                               placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Фильтрация списка --}}
                    <div class="mt-2">
                        @include('partials.messages')
                        <a href="{{ route('users-list') }}" class="mt-2 mb-2">Все пользователи</a> | <a href="{{ route('users-list') }}?status=archived">Только архивные</a>
                    </div>


                    {{-- Таблица. Список пользователей --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="contacusercheck">
                                        <label class="form-check-label" for="contacusercheck"></label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Email</th>
                                <th scope="col" style="width: 200px;">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                            <label class="form-check-label" for="contacusercheck1"></label>
                                        </div>
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('images/users/avatar-2.jpg') }}" alt=""
                                             class="avatar-xs rounded-circle me-2">
                                        <a href="#" class="text-body">{{ $user->name }}</a>
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('user.destroy', $user->id) }}"
                                                   class="px-2 text-danger"
                                                   title="Удалить пользователя"
                                                ><i class="uil uil-trash-alt font-size-18"></i></a>
                                                @if(request()->get('status') == 'archived')
                                                    {!! Form::open(['method' => 'POST','route' => ['user.restore', $user->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Восстановить', ['class' => 'btn btn-primary btn-sm']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                                                    {!! Form::button('Удалить', ['class' => 'btn btn-danger btn-sm']) !!}
                                                    {!! Form::close() !!}
                                                @endif

                                            </li>
                                            <li class="list-inline-item dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                   role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- Пагинатор --}}
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Showing 1 to 10 of 12 entries</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                <ul class="pagination mb-sm-0">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
