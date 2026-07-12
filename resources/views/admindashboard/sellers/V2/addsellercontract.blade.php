@extends('layouts.adminindex')

@section('content')
    <style>
        .seller-contract-create-page {
            direction: rtl;
        }

        .seller-contract-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }

        .seller-contract-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .seller-contract-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .seller-contract-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .seller-contract-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seller-contract-create-card .card-icon svg path,
        .seller-contract-create-card .card-icon svg polygon {
            fill: #3699ff !important;
        }

        .seller-contract-create-body {
            padding: 28px;
            background: #ffffff;
        }

        .seller-contract-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .seller-contract-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .seller-contract-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .seller-contract-create-page .form-group label,
        .seller-contract-upload-label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .seller-contract-create-page .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            background-color: #ffffff;
            box-shadow: none !important;
            transition: all 0.15s ease;
        }

        .seller-contract-create-page .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .seller-contract-create-page textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .seller-contract-upload-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seller-contract-upload-box {
            width: 100%;
            max-width: 360px;
            min-height: 190px;
            border: 2px dashed #b5d9ff;
            background: #f3f9ff;
            border-radius: 16px;
            padding: 22px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .seller-contract-create-page .image-input {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .seller-contract-create-page .image-input-wrapper {
            width: 115px !important;
            height: 115px !important;
            border-radius: 16px !important;
            background-color: #ffffff;
            background-size: cover;
            background-position: center;
            border: 1px solid #edf0f5;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }

        .seller-contract-upload-btn {
            width: 46px !important;
            height: 46px !important;
            border-radius: 14px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #ffffff !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.22);
        }

        .seller-contract-upload-btn svg path,
        .seller-contract-upload-btn svg rect,
        .seller-contract-upload-btn svg circle {
            fill: #ffffff !important;
        }

        .seller-contract-upload-btn input[type="file"] {
            display: none;
        }

        .seller-contract-create-page .text-danger,
        .seller-contract-create-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .seller-contract-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .seller-contract-submit-btn {
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
        }

        .seller-contract-submit-btn:hover {
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54, 153, 255, 0.32);
        }

        .seller-contract-submit-btn svg path {
            fill: #ffffff !important;
        }

        @media (max-width: 768px) {
            .seller-contract-create-body {
                padding: 18px;
            }

            .seller-contract-section {
                padding: 16px;
            }

            .seller-contract-submit-wrapper {
                padding: 0 18px 18px;
            }

            .seller-contract-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="seller-contract-create-page">
        <div class="card card-custom seller-contract-create-card">
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
                                <path
                                    d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                    fill="#000000"
                                    fill-rule="nonzero"
                                    opacity="0.3"/>
                                <path
                                    d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                    fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                </span>

                    <h3 class="card-label">اضافه عقد عمل</h3>
                </div>
            </div>

            <form method="post" action="{{ route('storesellercontract', $id) }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body seller-contract-create-body">
                    <div class="seller-contract-section">
                        <div class="seller-contract-section-title">صورة العقد</div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 mx-auto seller-contract-upload-wrapper">
                                <div class="seller-contract-upload-box">
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                        <div class="image-input-wrapper mb-5" id="im4"></div>

                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow p-5 seller-contract-upload-btn"
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
                                                    <path
                                                        d="M5,7 L19,7 C20.1045695,7 21,7.8954305 21,9 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,9 C3,7.8954305 3.8954305,7 5,7 Z M12,17 C14.209139,17 16,15.209139 16,13 C16,10.790861 14.209139,9 12,9 C9.790861,9 8,10.790861 8,13 C8,15.209139 9.790861,17 12,17 Z"
                                                        fill="#000000"/>
                                                    <rect fill="#000000" opacity="0.3" x="9" y="4" width="6" height="2" rx="1"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="13" r="2"/>
                                                </g>
                                            </svg>
                                        </span>

                                            <input type="file" name="paper_contract_image" id="do4" required/>
                                            <input type="hidden" name="profile_avatar_remove"/>
                                        </label>

                                        <label class="seller-contract-upload-label">صوره عقد العمل</label>

                                        @error('paper_contract_image')
                                        <p style="color:red;">{{ $message }}</p>
                                        @enderror

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                              data-action="cancel"
                                              data-toggle="tooltip"
                                              title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="seller-contract-section">
                        <div class="seller-contract-section-title">بيانات العقد</div>

                        <div class="row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label>تاريخ العمل من <span class="text-danger">*</span></label>
                                <input type="date"
                                       class="form-control"
                                       value="{{ old('from_day') }}"
                                       name="from_day"
                                       required="required"/>
                                @error('from_day')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label>تاريخ العمل الى <span class="text-danger">*</span></label>
                                <input type="date"
                                       class="form-control"
                                       value="{{ old('to_day') }}"
                                       name="to_day"
                                       required="required"/>
                                @error('to_day')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label>النسبه المئويه <span class="text-danger">*</span></label>
                                <input type="number"
                                       class="form-control"
                                       value="{{ old('percentage') }}"
                                       name="percentage"
                                       required="required"/>
                                @error('percentage')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label>ملاحظات عن العمل <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
                                @error('notes')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="seller-contract-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold seller-contract-submit-btn">
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
                                <path
                                    d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                    fill="#000000"
                                    fill-rule="nonzero"
                                    transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                <path
                                    d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
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

                reader.onload = function (e) {
                    $('#im').css('background-image', 0);
                    $('#im').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do").change(function(){
            readURL(this);
            console.log($('#im').css('background-image'));
        });

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#im1').css('background-image', 0);
                    $('#im1').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do1").change(function(){
            readURL1(this);
            console.log($('#im1').css('background-image'));
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#im2').css('background-image', 0);
                    $('#im2').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do2").change(function(){
            readURL2(this);
            console.log($('#im2').css('background-image'));
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#im4').css('background-image', 0);
                    $('#im4').css('background-image', "url(" + e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#do4").change(function(){
            readURL4(this);
            console.log($('#im4').css('background-image'));
        });

        function getstates(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `../getstates/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#state').empty();
                        $('#state').append(result.data);
                        $('select#state').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getcities(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `../getcities/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#city').empty();
                        $('#city').append(result.data);
                        $('select#city').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getzones(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `../getzones/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#zone').empty();
                        $('#zone').append(result.data);
                        $('select#zone').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function getsubcategories(selected){
            let id = selected.value;
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"get",
                url: `../getsubcategories/${id}`,
                dataType: "Json",
                success: function(result){
                    if(result.status == true){
                        $('#sub').empty();
                        $('#sub').append(result.data);
                        $('select#sub').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        $(".image:file").change(function() {
            $('#row').empty();

            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);
                }
            }
        });

        function imageIsLoaded(e) {
            $('#row').append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src=' + e.target.result + '></figure></div>');
        };
    </script>
@endsection
