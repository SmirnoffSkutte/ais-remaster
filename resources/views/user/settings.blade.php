@extends('layouts.master')
@section('title')
    @lang('translation.Settings_Title')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Пользователь @endslot
        @slot('title') @lang('translation.Settings') @endslot
    @endcomponent

    <div class="row">

        <div class="col-12">

            Настройки пользователя.

        </div>

    </div>




@endsection
