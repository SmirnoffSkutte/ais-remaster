@php
    $selectorId = uniqid();
@endphp
<div class="row">
{{--    <h2>{{$initialData}}</h2>--}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{$tableName}}</h4>
                <div class="row">
{{--                    <select id="table-per-page-selector-{{$selectorId}}" class="col-4">--}}
{{--                        @foreach($paginationLimitsArray as $limitPerPage)--}}
{{--                            <option>{{$limitPerPage}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                    <div class="collapse show col-6" id="filtersizes-collapse">
                                <div class="flex-1">
                                    <h5 class="font-size-15 mb-0">Записей на странице</h5>
                                </div>
                                <div class="w-xs">
                                    <select class="form-select">
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
                            @foreach($finalColumns as $column)
                                <th>{{$column}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody id="users-tbody-list">
{{--                            Содержание таблицы--}}
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
                            {{--                            В p cнизу написан номер текущей страницы --}}
                            <p class="mb-sm-0" id="pagination-current-info"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-end">
                            <ul id="users-table-pagination-area" class="pagination pagination-rounded mb-sm-0">
{{--                                Пагинация--}}
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
