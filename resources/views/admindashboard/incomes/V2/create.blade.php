@extends('layouts.adminindex')

@section('content')
    <style>
        .income-create-page {
            direction: rtl;
        }

        .income-create-card {
            border: 0;
            border-radius: 16px;
            overflow: visible !important;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            max-width: 1500px;
            margin: 0 auto;
        }

        .income-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
            border-radius: 16px 16px 0 0;
        }

        .income-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .income-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .income-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.income-create-card .card-icon svg path,*/
        /*.income-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .income-create-body {
            padding: 28px;
            background: #ffffff;
            overflow: visible !important;
        }

        .income-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            overflow: visible !important;
            position: relative;
            z-index: 5;
        }

        .income-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .income-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .income-create-page .form-group {
            overflow: visible !important;
        }

        .income-create-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .income-create-page .form-control,
        .income-create-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .income-create-page .form-control:focus,
        .income-create-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .income-create-page .bootstrap-select {
            width: 100% !important;
            z-index: 9999 !important;
        }

        .income-create-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .income-create-page .bootstrap-select .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.14);
            z-index: 999999 !important;
            max-height: none !important;
            overflow: visible !important;
        }

        .income-create-page .bootstrap-select .dropdown-menu.inner {
            max-height: 300px !important;
            overflow-y: auto !important;
        }

        .income-create-page .form-control:disabled {
            background: #f3f6f9 !important;
            color: #7e8299 !important;
            cursor: not-allowed;
        }

        .income-create-page .text-danger,
        .income-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .income-value-hint {
            margin-top: 8px;
            color: #7e8299;
            font-size: 13px;
            font-weight: 600;
        }

        .income-submit-wrapper {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 0 28px 28px;
        }

        .income-submit-btn,
        .income-back-btn {
            min-width: 180px;
            height: 48px;
            border-radius: 12px !important;
            border: 0 !important;
            font-size: 15px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.15s ease;
            text-decoration: none !important;
        }

        .income-submit-btn {
            background: #3699ff !important;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
        }

        .income-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .income-back-btn {
            background: #f3f6f9 !important;
            color: #3f4254 !important;
            border: 1px solid #e4e6ef !important;
        }

        .income-back-btn:hover {
            background: #eaf4ff !important;
            color: #3699ff !important;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .income-create-body {
                padding: 18px;
            }

            .income-section {
                padding: 16px;
            }

            .income-submit-wrapper {
                padding: 0 18px 18px;
            }

            .income-submit-btn,
            .income-back-btn {
                width: 100%;
            }
        }
    </style>

    <div class="income-create-page">
        <div class="card card-custom income-create-card">
            <div class="card-header">
                <div class="card-title">
                <span class="card-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      opacity="0.3"/>
                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                      fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">إضافة إيراد</h3>
                </div>
            </div>

            <form method="post" action="{{ route('incomes.store') }}">
                @csrf

                <div class="card-body income-create-body">
                    <div class="income-section">
                        <div class="income-section-title">بيانات الإيراد</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>نوع الإيراد <span class="text-danger">*</span></label>

                                <select name="collectiontype_id"
                                        class="form-control selectpicker"
                                        onchange="filtercollectiontype(this)"
                                        required
                                        data-live-search="true"
                                        data-size="8">
                                    <option value="0" disabled="disabled" selected>الكل</option>

                                    @foreach($expenses as $expense)
                                        <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>القيمة <span class="text-danger">*</span></label>

                                <input type="number"
                                       class="form-control"
                                       id="value"
                                       disabled
                                       value="{{ old('value') }}"
                                       min="0"
                                       required/>

                                <input type="hidden"
                                       class="form-control"
                                       id="value1"
                                       value="{{ old('value') }}"
                                       min="0"
                                       name="value"
                                       required/>

                                <div class="income-value-hint">
                                    يتم تحديد القيمة تلقائياً بعد اختيار نوع الإيراد.
                                </div>

                                @error('value')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="income-submit-wrapper">
                    <button type="submit" class="btn income-submit-btn">
                        <i class="fa fa-plus"></i>
                        إضافة
                    </button>

                    <a href="{{ route('incomes.index') }}" class="btn income-back-btn">
                        <i class="fa fa-arrow-right"></i>
                        رجوع
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function filtercollectiontype(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `../filtercollectiontype/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $("#value").empty();
                        $("#value").val(result.value);

                        $("#value1").empty();
                        $("#value1").val(result.value);
                    }
                }
            });
        }

        $(document).ready(function() {
            $('.selectpicker').selectpicker('refresh');
        });
    </script>
@endsection
