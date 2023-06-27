@php
    $uniqueId = uniqid();
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{$tableName}}</h4>
                <div class="row">
                    <div class="collapse show col-6" id="filtersizes-collapse">
                        <div class="flex-1">
                            <h5 class="font-size-15 mb-0">Записей на странице</h5>
                        </div>
                        <div class="w-xs">
                            <select class="form-select">
                                {{--Выбор количества записей на странице--}}
                                @foreach($paginationLimitsArray as $limitPerPage)
                                    <option>{{$limitPerPage}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                        <tr>
                            {{--Названия колонок--}}
                            @foreach($finalColumns as $column)
                                <th>{{$column}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody id="users-tbody-list-{{$uniqueId}}">
                        {{--Содержание таблицы--}}
                        @foreach($initialData as $tableRow)
                            <tr>
                                @foreach($tableRow as $infoField)
                                    <td>{{$infoField}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
                <div class="row mt-4" id="users-table-pagination">
                    <div class="col-sm-6">
                        <div>
                            {{--В p cнизу написан номер текущей страницы --}}
                            <p class="mb-sm-0" id="pagination-current-info"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-end">
                            <ul id="users-table-pagination-area" class="pagination pagination-rounded mb-sm-0">
                                {{--Пагинация--}}
                                <li id="back-page-{{$uniqueId}}" class="page-item disabled">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link page-number">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link page-number">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link page-number">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link page-number">...</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link page-number">5</a>
                                </li>
                                <li id="next-page-{{$uniqueId}}" class="page-item">
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

<script>

</script>
