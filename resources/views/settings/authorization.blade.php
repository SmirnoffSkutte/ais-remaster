@extends('layouts.master')
@section('title')
    @lang('translation.Settings_Area')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') @lang('translation.Settings_Area') @endslot
        @slot('title') @lang('translation.Users_Auth_Settings') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">

            Настройки авторизации.

        </div>
    </div>

@endsection
