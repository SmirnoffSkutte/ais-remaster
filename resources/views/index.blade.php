@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Minible @endslot
    @slot('title') Dashboard @endslot
@endcomponent

<div class="row">
    <button id="load-users-button" class="col-4">Получить всех пользователей</button>
    <select id="table-per-page-selector" class="col-4">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
    </select>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Список пользователей</h4>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16">
{{--                                        <input type="checkbox" class="form-check-input" id="customCheck1">--}}
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>

                                <th>Id</th>
                                <th>Username</th>
                                <th>Телефон</th>
                                <th>Дата создания</th>
                                <th>Дата обновления</th>
                            </tr>
                        </thead>
                        <tbody id="users-tbody-list">
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <div class="form-check font-size-16">--}}
{{--                                        <input type="checkbox" class="form-check-input" id="customCheck2">--}}
{{--                                        <label class="form-check-label" for="customCheck2">&nbsp;</label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td><a href="javascript: void(0);" class="text-body fw-bold">#MB2540</a> </td>--}}
{{--                                <td>Neal Matthews</td>--}}
{{--                                <td>--}}
{{--                                    07 Oct, 2019--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    $400--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <span class="badge rounded-pill bg-soft-success font-size-12">Paid</span>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
{{--                style="display:none"--}}
                <div class="row mt-4" id="users-table-pagination">
                    <div class="col-sm-6">
                        <div>
{{--                            В p cнизу написан номер текущей страницы --}}
                            <p class="mb-sm-0" id="pagination-current-info"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-end">
                            <ul id="users-table-pagination-area" class="pagination pagination-rounded mb-sm-0">
{{--                                <li class="page-item disabled">--}}
{{--                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a href="#" class="page-link page-number">1</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item active">--}}
{{--                                    <a href="#" class="page-link page-number">2</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a href="#" class="page-link page-number">3</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a href="#" class="page-link page-number">...</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a href="#" class="page-link page-number">5</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

        <x-tables.table paginationLimits="1,2,3,4,5" columnsLabels="id,Никнейм,Телефон,Имя,Email,Пароль,Дата создания,Дата обновления" dbTableName="users" tableName="Полная инфа о юзерах" hiddenColumns=""/>
@endsection
@section('script')
       <!-- apexcharts -->
       <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
       <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>
@endsection
