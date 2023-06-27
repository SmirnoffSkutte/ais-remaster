@extends('layouts.master')
@section('title')
    @lang('translation.Panel_Settings')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Пользователь @endslot
        @slot('title') @lang('translation.Panel_Settings') @endslot
    @endcomponent

    <div class="row">

        <div class="col-12">
            {{-- Поле загрузки файла --}}
            <form id="panel-settings" action="{{ route('panel-settings-submit') }}" class="my-5" method="post">
                @csrf

                {{-- Заголовок раздела --}}
                <h5 class="settings-group-title mb-5">Демонстрационный шаблон</h5>

                <div class="d-flex">
                    <div class="form-check">
                        <input type="checkbox" id="example-show" switch="none" name="example_show" @if($form['example_show']) checked @endif()/>
                        <label for="example-show" data-on-label="" data-off-label=""></label>
                    </div>
                    <div class="font-size-15 ms-4">
                        Отображать страницы демонстрационных шаблонов
                    </div>
                </div>

                {{-- Заголовок раздела --}}
                <h5 class="settings-group-title mt-5 mb-5">Дебаг</h5>

                <div class="d-flex">
                    <div class="form-check">
                        <input type="checkbox" id="debug-show" switch="none" name="debug_show" @if($form['debug_show']) checked @endif()/>
                        <label for="debug-show" data-on-label="" data-off-label=""></label>
                    </div>
                    <div class="font-size-15 ms-4">
                        Отображать элементы для дебага
                    </div>
                </div>

                {{-- Asterisk --}}
                <h5 class="settings-group-title mt-5 mb-5">Доступ к Asterisk</h5>

                <div class="d-flex">
                    <div class="form-check">
                        <input type="checkbox" id="asterisk-show" switch="none" name="asterisk_show" @if($form['asterisk_show']) checked @endif()/>
                        <label for="asterisk-show" data-on-label="" data-off-label=""></label>
                    </div>
                    <div class="font-size-15 ms-4">
                        Отображать страницы Asterisk
                    </div>
                </div>

                {{-- Сабмит --}}
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary w-md">Сохранить</button>
                </div>

            </form>

        </div>

    </div>




@endsection
