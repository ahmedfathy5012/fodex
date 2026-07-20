@extends('layouts.adminindex')

@section('content')
    <style>
        .package-create-page {
            direction: rtl;
        }

        .package-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .package-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .package-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .package-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .package-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.package-create-card .card-icon svg path,*/
        /*.package-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .package-create-body {
            padding: 28px;
            background: #ffffff;
        }

        .package-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .package-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .package-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .package-create-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .package-create-page .form-control,
        .package-create-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .package-create-page .form-control:focus,
        .package-create-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .package-create-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .package-create-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .package-create-page .text-danger,
        .package-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .package-price-row {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px 16px 8px;
            margin-bottom: 14px;
            position: relative;
            align-items: flex-start;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.035);
        }

        .package-row-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 74px;
        }

        .package-add-row-btn,
        .package-remove-row-btn {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
            border: 1px solid transparent;
        }

        .package-add-row-btn {
            background: #eaf4ff;
            border-color: #b5d9ff;
        }

        .package-add-row-btn:hover {
            background: #dff0ff;
            transform: translateY(-1px);
        }

        .package-remove-row-btn {
            background: #fff5f6;
            border-color: #ffd0d6;
        }

        .package-remove-row-btn:hover {
            background: #ffecef;
            transform: translateY(-1px);
        }

        .package-add-row-btn svg path,
        .package-add-row-btn svg circle {
            fill: #3699ff !important;
        }

        .package-remove-row-btn svg path,
        .package-remove-row-btn svg circle {
            fill: #f64e60 !important;
        }

        .package-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .package-submit-btn {
            min-width: 220px;
            height: 48px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            font-size: 16px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
            transition: all 0.15s ease;
        }

        .package-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .package-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .package-create-body {
                padding: 18px;
            }

            .package-section {
                padding: 16px;
            }

            .package-row-actions {
                min-height: auto;
                margin-bottom: 10px;
            }

            .package-submit-wrapper {
                padding: 0 18px 18px;
            }

            .package-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="package-create-page">
        <div class="card card-custom package-create-card">
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

                    <h3 class="card-label">إضافة باقة</h3>
                </div>
            </div>

            <form method="post"
                  action="{{ route('packages.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="card-body package-create-body">
                    <div class="package-section">
                        <div class="package-section-title">بيانات الباقة الأساسية</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       name="name"
                                       required="required"/>

                                @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>عدد أيام الظهور <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ old('showdays') }}"
                                       name="showdays"
                                       required="required"/>

                                @error('showdays')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4 col-md-6">
                                <label>نوع الفئة <span class="text-danger">*</span></label>
                                <select name="packagecategory_id"
                                        class="form-control selectpicker"
                                        id="packagecategory_id"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>

                                @error('packagecategory_id')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="package-section">
                        <div class="package-section-title">أسعار الباقة حسب الدولة</div>

                        <section id="section">
                            <div class="row package-price-row">
                                <div class="form-group col-lg-4 col-md-5">
                                    <label>الدولة <span class="text-danger">*</span></label>
                                    <select name="country_id[]"
                                            class="form-control selectpicker"
                                            onchange="getstates(this)"
                                            id="country_id"
                                            required="required"
                                            data-live-search="true">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-4 col-md-5">
                                    <label>السعر <span class="text-danger">*</span></label>
                                    <input type="number"
                                           class="form-control"
                                           value="{{ old('price') }}"
                                           name="price[]"
                                           required="required"/>
                                </div>

                                <div class="col-lg-2 col-md-2 package-row-actions">
                                <span class="package-add-row-btn" id="addf" title="إضافة سعر دولة">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px"
                                         height="24px"
                                         viewBox="0 0 24 24"
                                         version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                  fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="package-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold package-submit-btn">
                        إضافة

                        <span class="svg-icon svg-icon m-0 svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                      fill="#000000"
                                      fill-rule="nonzero"
                                      opacity="0.3"
                                      transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                            </g>
                        </svg>
                    </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let packageRowId = 1;

        $("#addf").click(function() {
            $("#section").append(`
            <div class="row package-price-row" id="file${packageRowId}">
                <div class="form-group col-lg-4 col-md-5">
                    <label>الدولة <span class="text-danger">*</span></label>
                    <select name="country_id[]"
                            class="form-control selectpicker"
                            onchange="getstates(this)"
                            required="required"
                            data-live-search="true">
                        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
            </select>

@error('country_id')
            <p style="color:red;">{{ $message }}</p>
                    @enderror
            </div>

            <div class="form-group col-lg-4 col-md-5">
                <label>السعر <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control"
                       value="{{ old('price') }}"
                           name="price[]"
                           required="required"/>
                </div>

                <div class="col-lg-2 col-md-2 package-row-actions">
                    <span class="package-remove-row-btn"
                          onclick="removef(${packageRowId})"
                          title="حذف السعر">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px"
                             height="24px"
                             viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z"
                                      fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
        `);

            $('.selectpicker').selectpicker("refresh");
            packageRowId++;
        });

        function removef(id) {
            $(`#file${id}`).remove();
        }
    </script>
@endsection
