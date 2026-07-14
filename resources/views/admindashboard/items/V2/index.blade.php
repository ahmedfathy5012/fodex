@extends('layouts.adminindex')

@section('content')
    <style>
        .items-index-page {
            direction: rtl;
        }

        .items-index-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .items-index-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .items-index-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .items-index-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #181c32;
            text-transform: capitalize;
        }

        .items-index-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.items-index-card .card-icon svg path,*/
        /*.items-index-card .card-icon svg rect {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .items-index-body {
            padding: 28px;
            background: #ffffff;
        }

        .items-toolbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 18px 26px 0;
        }

        .items-add-btn {
            min-width: 130px;
            height: 42px;
            border-radius: 10px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
            transition: all 0.15s ease;
        }

        .items-add-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.28);
            color: #ffffff !important;
        }

        .items-filter-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .items-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .items-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .items-index-page .form-group label {
            font-weight: 600;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .items-index-page .form-control,
        .items-index-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .items-index-page .form-control:focus,
        .items-index-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .items-index-page .bootstrap-select .filter-option {
            text-align: right !important;
        }


        .items-index-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .items-search-row {
            display: flex;
            justify-content: center;
            margin-top: 6px;
        }

        .items-search-btn {
            min-width: 150px;
            height: 42px;
            border-radius: 10px !important;
            background: #1bc5bd !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(27, 197, 189, 0.22);
            transition: all 0.15s ease;
        }

        .items-search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(27, 197, 189, 0.28);
            color: #ffffff !important;
        }

        .items-table-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            overflow-x: auto;
        }

        .items-index-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            margin-top: 0 !important;
        }

        .items-index-page table.dataTable thead th {
            background: #f3f6f9;
            color: #3f4254;
            font-weight: 800;
            border: 0 !important;
            padding: 14px 12px !important;
            white-space: nowrap;
            text-align: center;
        }

        .items-index-page table.dataTable thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .items-index-page table.dataTable thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .items-index-page table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .items-index-page table.dataTable tbody td {
            border-top: 1px solid #edf0f5 !important;
            border-bottom: 1px solid #edf0f5 !important;
            padding: 13px 12px !important;
            vertical-align: middle !important;
            text-align: center;
            color: #3f4254;
        }

        .items-index-page table.dataTable tbody td:first-child {
            border-right: 1px solid #edf0f5 !important;
            border-radius: 0 10px 10px 0;
        }

        .items-index-page table.dataTable tbody td:last-child {
            border-left: 1px solid #edf0f5 !important;
            border-radius: 10px 0 0 10px;
        }

        .items-index-page .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            min-height: 38px;
            padding: 6px 12px;
            margin-right: 8px;
            box-shadow: none !important;
        }

        .items-index-page .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .items-index-page .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e4e6ef;
            min-height: 36px;
            padding: 4px 8px;
        }

        .items-index-page .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 6px 12px !important;
            color: #3f4254 !important;
        }

        .items-index-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3699ff !important;
            color: #ffffff !important;
        }

        .items-index-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
        }

        @media (max-width: 768px) {
            .items-index-body {
                padding: 18px;
            }

            .items-toolbar {
                padding: 18px 18px 0;
            }

            .items-add-btn,
            .items-search-btn {
                width: 100%;
            }

            .items-search-row {
                padding: 0 15px;
            }

            .items-filter-section {
                padding: 16px;
            }
        }
    </style>

    <div class="items-index-page">
        <!--begin::Card-->
        <div class="card card-custom gutter-b items-index-card">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                    <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                          fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                    </span>

                    <h3 class="card-label">items</h3>
                </div>
            </div>

            <div class="items-toolbar">
                <a class="btn btn-sm btning items-add-btn" href="{{route('item.create')}}">اضافه</a>
            </div>

            <div class="card-body items-index-body">
                <div class="items-filter-section">
                    <div class="items-section-title">فلترة المنتجات</div>

                    <div class="row">
                        <x-filter-component />

                            <div class="form-group col-lg-3 col-md-6">
                                <label>القسم العام</label>
                                <select name="major_id" class="form-control selectpicker" id="major"
                                        data-live-search="true">
                                    <option value="0">الكل</option>
                                    @foreach($majors as $major)
                                        <option value="{{$major->id}}">{{$major->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        <!--     <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">-->
                        <!--    <i class="fa fa-calendar"></i>&nbsp;-->
                        <!--    <span></span> <i class="fa fa-caret-down"></i>-->
                        <!--</div>-->
                    </div>

                    <div class="row">
                        <div class="col-12 items-search-row">
                            <span id="btn" class="btn btn-sm btning items-search-btn">بحث</span>
                        </div>
                    </div>
                </div>

                <div class="items-table-section">
                    <!--begin: Datatable-->
                    {!! $dataTable->table([

                    ],true) !!}
                    <!--end: Datatable-->
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('scripts')
    {{$dataTable->scripts()}}

    <script>
        $("#btn").on("click", function () {

            $('#dataTableBuilder').off('preXhr.dt').on('preXhr.dt', function (e, settings, data) {
                data.country_id = $('#country').val();
                data.state_id = $('#state').val();
                data.city_id = $('#city').val();
                data.zone_id = $('#zone').val();
                data.major_id = $('#major').val();
            });

            $('#dataTableBuilder').DataTable().ajax.reload();
        });
    </script>
@endsection
