<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add CSV Excel Export Button in Yajra Laravel Datatable</title>

    {{-- Bootstrap 3 --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    {{-- Bootstrap Select --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
            padding: 30px 0;
        }

        .page-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e9f2;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .page-card .panel-heading {
            background: #fff;
            border-bottom: 1px solid #edf0f5;
            padding: 18px 22px;
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .page-card .panel-body {
            padding: 22px;
        }

        .filter-box {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .filter-box label {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .bootstrap-select > .dropdown-toggle,
        .form-control {
            min-height: 40px;
            border-radius: 8px !important;
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }

        table.dataTable {
            width: 100% !important;
        }

        table.dataTable thead th {
            text-align: center;
            background: #f3f6f9;
            color: #333;
            font-weight: 700;
        }

        table.dataTable tbody td {
            text-align: center;
            vertical-align: middle !important;
        }

        .dt-buttons {
            margin-bottom: 12px;
        }

        .dt-button {
            border-radius: 6px !important;
            border: 0 !important;
            background: #337ab7 !important;
            color: #fff !important;
            padding: 7px 14px !important;
        }
    </style>
</head>

<body>
<div class="container">
    <h3 class="text-center">Add CSV Excel Export Button in Yajra Laravel Datatable</h3>
    <br>

    <div class="page-card panel panel-default">
        <div class="panel-heading">
            Sample Data
        </div>

        <div class="panel-body">
            <div class="filter-box">
                <div class="row">
                    <div class="form-group col-lg-4 col-md-6">
                        <label>الدوله <span class="text-danger">*</span></label>

                        <select name="country_id"
                                class="form-control selectpicker"
                                required="required"
                                data-live-search="true">
                            <option value="">sdsdsdsd</option>
                            <option value="assa">sdsdds</option>
                            <option value="34">sdsddsds</option>
                            <option value="43">namesd</option>
                        </select>

                        @error('name')
                        <p style="color:red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                {!! $dataTable->table([
                    'class' => 'table table-bordered table-striped table-hover',
                    'style' => 'width:100%',
                ], true) !!}
            </div>
        </div>
    </div>
</div>

{{-- jQuery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

{{-- Bootstrap 3 JS --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

{{-- Buttons --}}
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{-- Bootstrap Select --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

{!! $dataTable->scripts() !!}

<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>
</body>
</html>
