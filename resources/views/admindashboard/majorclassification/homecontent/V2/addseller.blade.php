@extends('layouts.adminindex')

@section('content')
    <style>
        .major-content-seller-page {
            direction: rtl;
        }

        .major-content-seller-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .major-content-seller-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .major-content-seller-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .major-content-seller-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .major-content-seller-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .major-content-seller-card .card-icon svg path,
        .major-content-seller-card .card-icon svg rect,
        .major-content-seller-card .card-icon svg polygon {
            fill: #3699ff !important;
        }

        .major-content-seller-body {
            padding: 28px;
            background: #ffffff;
        }

        .major-content-seller-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .major-content-seller-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .major-content-seller-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .major-content-seller-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .major-content-seller-page .form-control,
        .major-content-seller-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .major-content-seller-page .form-control:focus,
        .major-content-seller-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .major-content-seller-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .major-content-seller-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
        }

        .major-content-image-wrapper {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .major-content-seller-page .image-input {
            margin: 0;
        }

        .major-content-seller-page .image-input-wrapper {
            width: 118px;
            height: 118px;
            border-radius: 18px !important;
            background-color: #f3f6f9;
            background-size: cover;
            background-position: center;
            border: 1px solid #e4e6ef;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
        }

        .major-content-image-note {
            color: #7e8299;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.8;
        }

        .major-content-image-note strong {
            display: block;
            color: #181c32;
            font-size: 15px;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .major-content-selected-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            min-height: 42px;
            padding: 10px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px dashed #dce3ef;
        }

        .major-content-selected-badge {
            min-height: 30px;
            border-radius: 999px;
            padding: 7px 30px 7px 12px;
            margin: 0 !important;
            font-size: 13px !important;
            font-weight: 800;
            position: relative;
            background: #e8fff3 !important;
            color: #1bc56e !important;
            border: 1px solid #bdf4d5;
            display: inline-flex;
            align-items: center;
        }

        .major-content-selected-badge .remove-seller {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 17px;
            height: 17px;
            border-radius: 50%;
            background: #fff5f6;
            color: #f64e60;
            font-size: 11px;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            line-height: 1;
        }

        .major-content-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .major-content-submit-btn {
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

        .major-content-submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(54, 153, 255, 0.32);
            color: #ffffff !important;
        }

        .major-content-submit-btn svg path {
            fill: #ffffff !important;
        }

        .major-content-error {
            color: #f64e60;
            font-size: 13px;
            font-weight: 700;
            margin-top: 7px;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .major-content-seller-card .card-header {
                padding: 18px;
            }

            .major-content-seller-body {
                padding: 18px;
            }

            .major-content-seller-section {
                padding: 16px;
            }

            .major-content-submit-wrapper {
                padding: 0 18px 18px;
            }

            .major-content-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="major-content-seller-page">
        <div class="card card-custom major-content-seller-card">
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

                    <h3 class="card-label">تعديل بائعين محتوى التصنيف</h3>
                </div>
            </div>

            <form method="post"
                  action="{{ route('updatemajorcontentseller', $home->id) }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="card-body major-content-seller-body">
                    <div class="major-content-seller-section">
                        <div class="major-content-seller-section-title">الصورة</div>

                        <div class="major-content-image-wrapper">
                            <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                <div class="image-input-wrapper mb-5"
                                     id="im"
                                     style="background-image:url({{ asset('uploads/' . $home->image) }})"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5"
                                       data-action="change"
                                       data-toggle="tooltip"
                                       title=""
                                       data-original-title="Change avatar">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px"
                                         height="24px"
                                         viewBox="0 0 24 24"
                                         version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z"
                                                  fill="#000000"/>
                                            <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
                                        </g>
                                    </svg>
                                </span>

                                    <input type="file" name="image" id="do"/>
                                    <input type="hidden" name="profile_avatar_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel"
                                      data-toggle="tooltip"
                                      title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            </div>

                            <div class="major-content-image-note">
                                <strong>صورة المحتوى</strong>
                                يمكنك تغيير الصورة الحالية، أو تركها كما هي بدون تعديل.
                            </div>
                        </div>

                        @error('image')
                        <p class="major-content-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="major-content-seller-section">
                        <div class="major-content-seller-section-title">بيانات المحتوى</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $home->title }}"
                                       name="title"
                                       required="required"/>

                                @error('title')
                                <p class="major-content-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="major-content-seller-section">
                        <div class="major-content-seller-section-title">البائعين</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>البائعين <span class="text-danger">*</span></label>
                                <select name="seller_id[]"
                                        class="form-control selectpicker"
                                        multiple
                                        required="required"
                                        id="seller_id"
                                        onchange="addseller()"
                                        data-live-search="true">
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id }}"
                                                style="padding-left:30px;"
                                                @if(in_array($seller->id, $home->sellers->pluck('id')->toArray())) selected @endif>
                                            {{ $seller->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('seller_id')
                                <p class="major-content-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="major-content-selected-row" id="row">
                            @foreach($home->sellers as $seller)
                                <span class="major-content-selected-badge" id="{{ $seller->id }}">
                                {{ $seller->name }}
                                <span class="remove-seller"
                                      onClick='deleteselect({{ $seller->id }}, "{{ $seller->name }}");'>
                                    X
                                </span>
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="major-content-submit-wrapper">
                    <button type="submit" class="btn major-content-submit-btn">
                        حفظ
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#im').css('background-image', 0);
                    $('#im').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do").change(function() {
            readURL(this);
            console.log($('#im').css('background-image'));
        });

        function addseller() {
            var values = $('#seller_id').find(":selected").text();
            console.log(values);

            $("#row").empty();

            $("#seller_id option:selected").each(function() {
                var $this = $(this);

                if ($this.length) {
                    $("#row").append(`<span id="${$this.val()}" class="major-content-selected-badge">
                    ${$this.text()}
                    <span class="remove-seller" onClick='deleteselect(${$this.val()}, "${$this.text()}")'>X</span>
                </span>`);
                }
            });
        }

        function deleteselect(id, text) {
            $(`#${id}`).remove();

            $('#seller_id :selected').each(function(i, selected) {
                if ($(this).val() == id) {
                    $("select option[value='" + id + "']").prop("selected", false);

                    let divElem = $(`.filter-option-inner-inner`);
                    let newContent = $(`.filter-option-inner-inner`).html().replace(text + ',', '');

                    divElem.html(newContent);
                }
            });

            $('#seller_id').selectpicker('refresh');
        }
    </script>
@endsection
