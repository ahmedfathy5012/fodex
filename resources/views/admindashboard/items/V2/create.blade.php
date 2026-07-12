@extends('layouts.adminindex')

@section('content')
    <style>
        .product-create-page {
            direction: rtl;
        }

        .product-create-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
            background: #ffffff;
        }

        .product-create-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .product-create-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-create-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #181c32;
        }

        .product-create-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.product-create-card .card-icon svg path,*/
        /*.product-create-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .product-form-body {
            padding: 28px;
            background: #ffffff;
        }

        .product-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .product-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .product-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .product-create-page .form-group label {
            font-weight: 600;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .product-create-page .form-control {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #e4e6ef;
            color: #3f4254;
            box-shadow: none !important;
            transition: all 0.15s ease;
            background-color: #ffffff;
        }

        .product-create-page .form-control:focus {
            border-color: #3699ff;
            box-shadow: 0 0 0 3px rgba(54, 153, 255, 0.12) !important;
        }

        .product-create-page textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .product-upload-box {
            width: 100%;
            max-width: 360px;
            margin: 0 auto;
            border: 2px dashed #b5d9ff;
            background: #f3f9ff;
            color: #3699ff;
            border-radius: 16px;
            padding: 26px 18px;
            text-align: center;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 700;
        }

        .product-upload-box:hover {
            background: #eaf4ff;
            border-color: #3699ff;
        }

        .product-upload-box svg {
            width: 22px;
            height: 22px;
            fill: #3699ff;
        }

        .product-upload-input {
            display: none !important;
        }

        #row {
            margin-top: 18px;
        }

        #row figure {
            width: 100%;
            margin: 0 0 14px 0;
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        #row img {
            width: 110px !important;
            height: 110px !important;
            object-fit: cover;
            border-radius: 12px;
        }

        .product-action-buttons {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin: 26px 0;
        }

        .product-action-btn {
            min-width: 180px;
            height: 44px;
            border-radius: 10px !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0 !important;
        }

        .product-action-btn-primary {
            background: #3699ff !important;
            color: #fff !important;
        }

        .product-action-btn-success {
            background: #1bc5bd !important;
            color: #fff !important;
        }

        .product-dynamic-section {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 20px;
            min-height: 70px;
        }

        #section1 .row,
        #section2 .row {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 14px 10px;
            margin: 0 0 14px 0;
            align-items: flex-end;
        }

        #section2 .news {
            background: #ffffff;
            border-style: dashed;
            margin-top: 10px;
        }

        #section1 .btn,
        #section2 .btn {
            border-radius: 9px !important;
            min-height: 38px;
            font-weight: 700;
        }

        .product-submit-wrapper {
            display: flex;
            justify-content: center;
            margin: 30px 0 10px;
        }

        .product-submit-btn {
            min-width: 220px;
            height: 48px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #fff !important;
            font-size: 16px;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 18px rgba(54, 153, 255, 0.25);
        }

        .product-submit-btn svg path {
            fill: #ffffff !important;
        }

        .product-create-page .text-danger {
            color: #f64e60 !important;
        }

        .product-create-page p[style*="color:red"] {
            margin-top: 6px;
            font-size: 13px;
            color: #f64e60 !important;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .product-form-body {
                padding: 18px;
            }

            .product-section {
                padding: 16px;
            }

            .product-action-btn,
            .product-submit-btn {
                width: 100%;
            }
        }
    </style>

    <div class="product-create-page">
        <div class="card card-custom product-create-card">

            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path
                                        d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                        fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                    </span>

                    <h3 class="card-label"> اضافه منتج </h3>
                </div>
            </div>

            <form method="post" action="{{route('item.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="card-body product-form-body">

                    <div class="product-section">
                        <div class="product-section-title">صور المنتج</div>

                        <div class="row">
                            <div class="mx-auto col-lg-4 col-md-6 col-sm-12">
                                <label id="label" for="gallery-photo-add" class="product-upload-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                         viewBox="0 0 20 17">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                    </svg>
                                    تحميل صور المنتج
                                </label>

                                <input type="file" multiple id="gallery-photo-add"
                                       class="image custom-file-input product-upload-input" name="image[]">
                            </div>

                            @error('image')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row" id="row"></div>
                    </div>

                    <div class="product-section">
                        <div class="product-section-title">بيانات المنتج</div>

                        <div class='row'>
                            <div class="form-group col-lg-6 col-md-12">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " value="{{old('title')}}" name="title"
                                       required="required"/>
                                @error('title')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>السعر <span class="text-danger">*</span></label>
                                <input type="number" class="form-control " value="{{old('price')}}" name="price"
                                       required="required"/>
                                @error('price')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>الخصم <span class="text-danger">*</span></label>
                                <input type="number" class="form-control " value="0" name="discount"/>
                                @error('discount')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>الخصم من <span class="text-danger">*</span></label>
                                <input type="date" class="form-control " name="discount_from"/>
                                @error('discount_from')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>الخصم الى <span class="text-danger">*</span></label>
                                <input type="date" class="form-control " name="discount_to"/>
                                @error('discount_to')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>وقت التحضير <span class="text-danger">*</span></label>
                                <input type="number" class="form-control " value="0" name="prepare_time"
                                       required="required"/>
                                @error('prepare_time')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>السعرات الحراريه <span class="text-danger">*</span></label>
                                <input type="number" class="form-control " value="0" name="calory"/>
                                @error('calory')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>البائعين <span class="text-danger">*</span></label>
                                <select name="seller_id" class="form-control selectpicker"
                                        onchange="getsellerscategory(this)"
                                        required="required" id="seller_id" required="required" data-live-search="true">
                                    @foreach($sellers as $seller)
                                        <option value="{{$seller->id}}">{{$seller->name}}</option>
                                    @endforeach
                                </select>
                                @error('seller_id')
                                <p style="color:red;">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>القسم الرئيسى <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control selectpicker"
                                        onchange="filter_subcategories(this)"
                                        required="required" id="category_id"
                                        required="required" data-live-search="true">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label>القسم الفرعى <span class="text-danger">*</span></label>
                                <select name="subcategory_id" class="form-control selectpicker" id="subcategory_id"
                                        data-live-search="true">
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-12">
                                <label> الوصف <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" name="description">{{old('description')}}</textarea>
                                @error('description')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="product-action-buttons">
                        <button type="button" id="addf" class="btn product-action-btn product-action-btn-primary">
                            اضافه حجم
                        </button>

                        <button type="button" id="adds" class="btn product-action-btn product-action-btn-success">
                            اضافه اكسترا
                        </button>
                    </div>

                    <div class="product-section">
                        <div class="product-section-title">الاحجام</div>
                        <section id="section1" class="product-dynamic-section"></section>
                    </div>

                    <div class="product-section">
                        <div class="product-section-title">الاضافات</div>
                        <section id="section2" class="product-dynamic-section"></section>
                    </div>

                    <div class="product-submit-wrapper">
                        <button type="submit" class="btn product-submit-btn">
                            إضافة
                            <span class="svg-icon svg-icon m-0 svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                        <path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                                    </g>
                                </svg>
                            </span>
                        </button>
                    </div>

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

        $("#do").change(function () {
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

        $("#do1").change(function () {
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

        $("#do2").change(function () {
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

        $("#do4").change(function () {
            readURL4(this);
            console.log($('#im4').css('background-image'));

        });

        let id = $("#section1 .row").length;
        $('#addf').click(function () {
            $('#section1').append(`
 <div class="row" style="position: relative;"  id="remov${id}">
  <div class="form-group col-3">
        <label>اسم الحجم <span class="text-danger">*</span></label>
    <input type="text" class="form-control " required="required" name="sizename[]"  value="{{old('sizename')}}"    />
   @error('sizename')
            <p style="color:red;">{{$message}}</p>
   @enderror

            </div>

            <div class="form-group col-3">
              <label>السعر    <span class="text-danger">*</span></label>
              <input type="number" class="form-control " value="{{old('sizeprice')}}" name="sizeprice[]"  required="required"/>
    @error('sizeprice')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
            <div class="form-group col-2">
             <label>السعرات الحراريه<span class="text-danger">*</span></label>
             <input type="number" class="form-control " value="{{old('sizecalory')}}" name="sizecalory[]"  required="required"/>
    @error('sizecalory')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
              <div class="form-group col-1">
             <label>default     <span class="text-danger">*</span></label>
             <input type="checkbox" class="form-control " value="1" name="size_default[]"  />
@error('size_default')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
            <div class="form-group col-1 mt-4">
                 <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removef(${id})">مسح</button>
</div>

</div>`);
            id++;
            console.log(id);
        });

        function removef(id) {
            $(`#remove${id}`).remove();
            $(`#remov${id}`).remove();
            id--;
        }

        let id1 = $("#section2 .all").length;
        $('#adds').click(function () {
            $('#section2').append(`
        <div id="removes${id1}" class="col-12">
 <div class="row all" style="position: relative;"  >
  <div class="form-group col-2">
        <label>الاسم  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " required="required" name="extrname[]"  value="{{old('extrname')}}"    />
   @error('extrname')
            <p style="color:red;">{{$message}}</p>
   @enderror

            </div>
                <div class="form-group col-2">
                  <label> السعرات   <span class="text-danger">*</span></label>
              <input type="text" class="form-control " name="extracalory[]" required="required"   />
@error('calory')
            <p style="color:red;">{{$message}}</p>
   @enderror

            </div>
 {{--                   <div class="form-group col-2">--}}
            {{--                     <label>السعر     <span class="text-danger">*</span></label>--}}
            {{--                     <input type="number" class="form-control " value="{{old('extrprice')}}" name="extrprice[]"  required="required"/>--}}
            {{--   @error('extrprice')--}}
            {{--                   <p style="color:red;">{{ $message }}</p>--}}
            {{--@enderror--}}
            {{--                   </div>--}}
            <div class="form-group col-1">
            <label>العدد     <span class="text-danger">*</span></label>
            <input type="number" class="form-control " value="0" name="count_number[]"  required="required"/>
@error('count_number')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>      <div class="form-group col-1">
             <label>متعدد     <span class="text-danger">*</span></label>
             <input type="checkbox" class="form-control " value="1" name="multiple[]"  />
@error('multiple')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
            <div class="form-group col-1 mt-4">
                 <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removes(${id1})">مسح</button>
</div>
<div class="form-group col-1 mt-4">
<button class="btn btn-sm  font-weight-bolder btn-light-success" type="button" onclick="get1(${id1})">اضافه</button>
</div>

</div>
</div>`);
            id1++;
            console.log(id);
        });

        function removes(id) {
            $(`#removes${id}`).remove();
            id1--;
        }

        let id2 = $("#section2 .news").length;

        function get1(i) {
            $(`#removes${i}`).append(`
 <div class="row news" style="position: relative;"  id="removec${id2}">
 <div class="col-2"></div>
<div class="form-group col-3">
        <label>اسم ال extra  <span class="text-danger">*</span></label>
    <input type="text" class="form-control " name="extrname${i}[]" required="required" value="{{old('extrname2')}}"    />
   @error('extrname2')
            <p style="color:red;">{{$message}}</p>
   @enderror

            </div>
            <div class="form-group col-2">
              <label>السعر     <span class="text-danger">*</span></label>
              <input type="number" class="form-control " value="{{old('extrprice')}}" name="extrprice${i}[]"  required="required"/>
    @error('extrprice')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
            <div class="form-group col-1">
             <label>default     <span class="text-danger">*</span></label>
             <input type="checkbox" class="form-control " value="1" name="default${i}[]"  />
    @error('default')
            <p style="color:red;">{{ $message }}</p>
 @enderror
            </div>
              <div class="form-group col-1 mt-4">
                 <button class="btn btn-sm  font-weight-bolder btn-light-danger" type="button" onclick="removec(${id2})">مسح</button>
</div>

</div>`);

            id2++;
        }

        function removec(id) {
            $(`#removec${id}`).remove();
            id2--;
        }

        $(".image:file").change(function () {
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

        function getsellerscategory(selected) {
            let id = selected.value;
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `../getsellerscategory/${id}`,
                dataType: "Json",
                success: function (result) {
                    if (result.status == true) {
                        $('#category_id').empty();
                        $('#category_id').append(result.data);
                        $('select#category_id').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }

        function filter_subcategories(selected) {
            let id = selected.value;
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: `../filter_subcategories/${id}`,
                dataType: "Json",
                success: function (result) {
                    if (result.status == true) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append(result.data);
                        $('select#subcategory_id').selectpicker("refresh");
                        console.log(result);
                    }
                }
            });
        }
    </script>
@endsection
