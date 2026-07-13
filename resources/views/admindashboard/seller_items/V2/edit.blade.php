@extends('layouts.adminindex')

@section('content')
    <style>
        .seller-item-edit-page { direction: rtl; }

        .seller-item-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 28px rgba(0,0,0,.06);
        }

        .seller-item-card .card-header {
            background: #fff;
            border-bottom: 1px solid #edf0f5;
            padding: 22px 26px;
        }

        .seller-item-card .card-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .seller-item-card .card-label {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #181c32;
        }

        .seller-item-card .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eaf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*.seller-item-card .card-icon svg path,*/
        /*.seller-item-card .card-icon svg polygon {*/
        /*    fill: #3699ff !important;*/
        /*}*/

        .seller-item-body {
            padding: 28px;
            background: #fff;
        }

        .seller-item-section {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .seller-item-section-title {
            font-size: 16px;
            font-weight: 800;
            color: #181c32;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .seller-item-section-title::before {
            content: "";
            width: 5px;
            height: 18px;
            border-radius: 10px;
            background: #3699ff;
            display: inline-block;
        }

        .seller-item-edit-page .form-group label {
            font-weight: 700;
            color: #3f4254;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .seller-item-edit-page .form-control,
        .seller-item-edit-page .bootstrap-select > .dropdown-toggle {
            min-height: 44px;
            border-radius: 10px !important;
            border: 1px solid #e4e6ef !important;
            color: #3f4254 !important;
            background: #fff !important;
            box-shadow: none !important;
            transition: .15s;
        }

        .seller-item-edit-page .form-control:focus,
        .seller-item-edit-page .bootstrap-select.show > .dropdown-toggle {
            border-color: #3699ff !important;
            box-shadow: 0 0 0 3px rgba(54,153,255,.12) !important;
        }

        .seller-item-edit-page textarea.form-control {
            min-height: 125px;
            resize: vertical;
        }

        .seller-item-edit-page .bootstrap-select .filter-option {
            text-align: right !important;
        }

        .seller-item-edit-page .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #edf0f5;
            box-shadow: 0 10px 26px rgba(0,0,0,.12);
        }

        .seller-item-edit-page .text-danger,
        .seller-item-edit-page p[style*="color:red"] {
            color: #f64e60 !important;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .seller-item-upload-card {
            background: #fff;
            border: 1px dashed #b5d9ff;
            border-radius: 14px;
            padding: 22px;
            text-align: center;
        }

        .seller-item-upload-label {
            min-width: 180px;
            height: 46px;
            border-radius: 12px;
            background: #eaf4ff;
            color: #3699ff;
            border: 1px solid #b5d9ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: .15s;
            margin: 0;
        }

        .seller-item-upload-label:hover {
            background: #3699ff;
            color: #fff;
        }

        .seller-item-upload-label svg {
            fill: currentColor;
        }

        .seller-item-upload-label input {
            display: none;
        }

        .seller-item-images-row {
            margin-top: 18px;
            row-gap: 14px;
        }

        .seller-item-image-preview {
            width: 110px;
            height: 110px;
            border-radius: 14px;
            object-fit: cover;
            border: 1px solid #edf0f5;
            background: #f3f6f9;
            box-shadow: 0 4px 14px rgba(0,0,0,.05);
        }

        .seller-item-product-upload-box {
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

        .seller-item-product-upload-box:hover {
            background: #eaf4ff;
            border-color: #3699ff;
        }

        .seller-item-product-upload-box svg {
            width: 22px;
            height: 22px;
            fill: #3699ff;
        }

        .seller-item-product-upload-input {
            display: none !important;
        }

        .seller-item-product-images {
            margin-top: 18px;
        }

        .seller-item-product-images figure {
            width: 100%;
            margin: 0 0 14px;
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .seller-item-product-images img {
            width: 110px !important;
            height: 110px !important;
            object-fit: cover;
            border-radius: 12px;
        }

        .seller-item-add-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin: 26px 0;
        }

        .seller-item-add-btn {
            min-width: 180px;
            height: 44px;
            border-radius: 10px !important;
            border: 0 !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
        }

        .seller-item-add-size {
            background: #3699ff !important;
            color: #fff !important;
        }

        .seller-item-add-extra {
            background: #1bc5bd !important;
            color: #fff !important;
        }

        .seller-item-dynamic-section {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 20px;
            min-height: 70px;
        }

        .seller-item-repeat-row,
        .seller-item-extra-card,
        .seller-item-extra-detail-row {
            background: #fbfcfe;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 14px 10px;
            margin: 0 0 14px;
            align-items: flex-end;
        }

        .seller-item-extra-card {
            padding-bottom: 14px;
        }

        .seller-item-extra-detail-row {
            background: #fff;
            border-style: dashed;
            margin-top: 10px;
        }

        .seller-item-small-btn {
            min-width: 68px;
            height: 38px;
            border-radius: 9px !important;
            font-weight: 800 !important;
        }

        .seller-item-danger-btn {
            background: #fff5f6 !important;
            color: #f64e60 !important;
            border: 1px solid #ffd0d6 !important;
        }

        .seller-item-success-btn {
            background: #e8fff3 !important;
            color: #1bc5bd !important;
            border: 1px solid #bdf4dd !important;
        }

        .seller-item-check {
            height: 24px !important;
            min-height: 24px !important;
            width: 24px !important;
            margin-top: 10px;
            box-shadow: none !important;
        }

        .seller-item-submit-wrapper {
            display: flex;
            justify-content: center;
            padding: 0 28px 28px;
        }

        .seller-item-submit-btn {
            min-width: 220px;
            height: 48px;
            border-radius: 12px !important;
            background: #3699ff !important;
            border: 0 !important;
            color: #fff !important;
            font-size: 16px;
            font-weight: 900 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 18px rgba(54,153,255,.25);
        }

        .seller-item-submit-btn:hover {
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(54,153,255,.32);
        }

        .seller-item-submit-btn svg path {
            fill: #fff !important;
        }

        @media (max-width: 768px) {
            .seller-item-body { padding: 18px; }
            .seller-item-section { padding: 16px; }
            .seller-item-submit-wrapper { padding: 0 18px 18px; }
            .seller-item-submit-btn,
            .seller-item-add-btn { width: 100%; }
            .seller-item-extra-detail-row { margin-right: 0; }
        }
    </style>

    <div class="seller-item-edit-page">
        <div class="card card-custom seller-item-card">
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

                    <h3 class="card-label">تعديل منتج</h3>
                </div>
            </div>

            <form method="post" action="{{ route('update_seller_items', $item->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card-body seller-item-body">
                    <div class="seller-item-section">
                        <div class="seller-item-section-title">صور المنتج</div>

                        <div class="row">
                            <div class="mx-auto col-lg-4 col-md-6 col-sm-12">
                                <label id="label" for="gallery-photo-add" class="seller-item-product-upload-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                    </svg>
                                    تحميل صور المنتج
                                </label>

                                <input type="file" multiple id="gallery-photo-add"
                                       class="image custom-file-input seller-item-product-upload-input" name="image[]">
                            </div>

                            @error('image')
                            <p style="color:red;">{{ $message }}</p>
                            @enderror
                        </div>

                            <div class="row seller-item-product-images" id="row">
                                @if($item->images)
                                    @foreach($item->images as $image)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center">
                                            <figure class="imghvr-fade">
                                                <img src="{{ asset('uploads/' . $image->image) }}">
                                            </figure>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                    </div>

                    <div class="seller-item-section">
                        <div class="seller-item-section-title">بيانات المنتج</div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label>الاسم <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $item->title }}" name="title" required="required"/>
                                @error('title')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>السعر <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{ $item->price }}" name="price" required="required"/>
                                @error('price')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>الخصم <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{ $item->discount }}" name="discount"/>
                                @error('discount')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>الخصم من <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="discount_from" value="{{ $item->discount_from }}"/>
                                @error('discount_from')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>الخصم الى <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="discount_to" value="{{ $item->discount_to }}"/>
                                @error('discount_to')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>وقت التحضير <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{ $item->prepare_time }}" name="prepare_time" required="required"/>
                                @error('prepare_time')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>السعرات الحراريه <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{ $item->calory }}" name="calory"/>
                                @error('calory')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>القسم الرئيسى <span class="text-danger">*</span></label>
                                <select name="category_id"
                                        class="form-control selectpicker"
                                        onchange="filter_subcategories(this)"
                                        id="category_id"
                                        required="required"
                                        data-live-search="true">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if($item->subcategory)
                                <div class="form-group col-lg-6 col-md-6">
                                    <label>القسم الفرعى <span class="text-danger">*</span></label>
                                    <select name="subcategory_id"
                                            class="form-control selectpicker"
                                            id="subcategory_id"
                                            data-live-search="true">
                                        <option value="{{ $item->subcategory_id }}" selected>
                                            {{ $item->subcategory->title ?? "" }}
                                        </option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group col-lg-12 col-md-12">
                                <label>الوصف <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" name="description">{{ $item->description }}</textarea>
                                @error('description')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="seller-item-add-actions">
                        <button type="button" id="addf" class="btn seller-item-add-btn seller-item-add-size">
                            اضافه حجم
                        </button>

                        <button type="button" id="adds" class="btn seller-item-add-btn seller-item-add-extra">
                            اضافه اكسترا
                        </button>
                    </div>

                    <div class="seller-item-section">
                        <div class="seller-item-section-title">الاحجام</div>

                        <section id="section1" class="seller-item-dynamic-section">
                            @if($item->sizes)
                                @foreach($item->sizes as $size)
                                    <div class="row seller-item-repeat-row" id="remov{{ $size->id }}">
                                        <div class="form-group col-lg-3 col-md-6">
                                            <label>اسم الحجم <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sizename[]" required="required" value="{{ $size->title }}"/>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label>السعر <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" value="{{ $size->price }}" name="sizeprice[]" required="required"/>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label>السعرات الحراريه <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" value="{{ $size->calory }}" name="sizecalory[]" required="required"/>
                                        </div>

                                        <div class="form-group col-lg-1 col-md-3">
                                            <label>default <span class="text-danger">*</span></label>
                                            <input type="checkbox" class="form-control seller-item-check" value="1" name="size_default[]" @if($size->size_default == 1) checked @endif/>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-3">
                                            <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removef({{ $size->id }})">مسح</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </section>
                    </div>

                    <div class="seller-item-section">
                        <div class="seller-item-section-title">الاضافات</div>

                        <section id="section2" class="seller-item-dynamic-section">
                            @if($item->extras)
                                @foreach($item->extras as $key3 => $extra)
                                    <div id="removes{{ $key3 }}" class="seller-item-extra-card">
                                        <div class="row all" style="position: relative;">
                                            <div class="form-group col-lg-2 col-md-6">
                                                <label>الاسم <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="extrname[]" required="required" value="{{ $extra->title }}"/>
                                            </div>

                                            <div class="form-group col-lg-2 col-md-6">
                                                <label>السعرات <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="extracalory[]" required="required" value="{{ $extra->calory }}"/>
                                            </div>

{{--                                            <div class="form-group col-lg-2 col-md-6">--}}
{{--                                                <label>السعر <span class="text-danger">*</span></label>--}}
{{--                                                <input type="number" class="form-control" value="{{ $extra->price }}" name="extrprice[]" required="required"/>--}}
{{--                                            </div>--}}

                                            <div class="form-group col-lg-1 col-md-6">
                                                <label>العدد <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="{{ $extra->count_number }}" name="count_number[]" required="required"/>
                                            </div>

                                            <div class="form-group col-lg-1 col-md-3">
                                                <label>متعدد <span class="text-danger">*</span></label>
                                                <input type="checkbox" class="form-control seller-item-check" value="1" @if($extra->multiple == 1) checked @endif name="multiple[]"/>
                                            </div>

                                            <div class="form-group col-lg-2 col-md-4">
                                                <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removes({{ $key3 }})">مسح</button>
                                            </div>

                                            <div class="form-group col-lg-2 col-md-4">
                                                <button class="btn btn-sm seller-item-small-btn seller-item-success-btn" type="button" onclick="get1({{ $key3 }})">اضافه</button>
                                            </div>
                                        </div>

                                        @if($extra->extraDetails)
                                            @foreach($extra->extraDetails as $key => $de)
                                                <div class="row news seller-item-extra-detail-row" id="removec{{ $de->id }}">
                                                    <div class="form-group col-lg-4 col-md-6">
                                                        <label>اسم ال extra <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="extrname{{ $key3 }}[]" required="required" value="{{ $de->title }}"/>
                                                    </div>

{{--                                                    <div class="form-group col-lg-3 col-md-6">--}}
{{--                                                        <label>السعر <span class="text-danger">*</span></label>--}}
{{--                                                        <input type="number" class="form-control" value="{{ $de->extra_price }}" name="extrprice{{ $key3 }}[]" required="required"/>--}}
{{--                                                    </div>--}}

                                                    <div class="form-group col-lg-2 col-md-3">
                                                        <label>default <span class="text-danger">*</span></label>
                                                        <input type="checkbox" class="form-control seller-item-check" value="1" name="default{{ $key3 }}[]" @if($de->default_new == 1) checked @endif/>
                                                    </div>

                                                    <div class="form-group col-lg-2 col-md-3">
                                                        <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removec({{ $de->id }})">مسح</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </section>
                    </div>
                </div>

                <div class="seller-item-submit-wrapper">
                    <button type="submit" class="btn btn-shadow btn-primary font-weight-bold seller-item-submit-btn">
                        حفظ التعديل

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
        let id = $("#section1 .seller-item-repeat-row").length;

        $('#addf').click(function() {
            $('#section1').append(`
            <div class="row seller-item-repeat-row" id="remov${id}">
                <div class="form-group col-lg-3 col-md-6">
                    <label>اسم الحجم <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required="required" name="sizename[]" value="{{ old('sizename') }}"/>
                </div>

                <div class="form-group col-lg-3 col-md-6">
                    <label>السعر <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" value="{{ old('sizeprice') }}" name="sizeprice[]" required="required"/>
                </div>

                <div class="form-group col-lg-3 col-md-6">
                    <label>السعرات الحراريه <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" value="{{ old('sizecalory') }}" name="sizecalory[]" required="required"/>
                </div>

                <div class="form-group col-lg-1 col-md-3">
                    <label>default <span class="text-danger">*</span></label>
                    <input type="checkbox" class="form-control seller-item-check" value="1" name="size_default[]"/>
                </div>

                <div class="form-group col-lg-2 col-md-3">
                    <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removef(${id})">مسح</button>
                </div>
            </div>
        `);

            id++;
        });

        function removef(id) {
            $(`#remove${id}`).remove();
            $(`#remov${id}`).remove();
        }

        let id1 = $('#section2 .all').length;

        $('#adds').click(function() {
            $('#section2').append(`
            <div id="removes${id1}" class="seller-item-extra-card">
                <div class="row all" style="position: relative;">
                    <div class="form-group col-lg-2 col-md-6">
                        <label>الاسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" name="extrname[]" value="{{ old('extrname') }}"/>
                    </div>

                    <div class="form-group col-lg-2 col-md-6">
                        <label>السعرات <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="extracalory[]" required="required"/>
                    </div>

                    {{--<div class="form-group col-lg-2 col-md-6">--}}
                    {{--    <label>السعر <span class="text-danger">*</span></label>--}}
                    {{--    <input type="number" class="form-control" value="{{ old('extrprice') }}" name="extrprice[]" required="required"/>--}}
                    {{--</div>--}}

                    <div class="form-group col-lg-1 col-md-6">
                        <label>العدد <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" value="0" name="count_number[]" required="required"/>
                    </div>

                    <div class="form-group col-lg-1 col-md-3">
                        <label>متعدد <span class="text-danger">*</span></label>
                        <input type="checkbox" class="form-control seller-item-check" value="1" name="multiple[]"/>
                    </div>

                    <div class="form-group col-lg-2 col-md-4">
                        <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removes(${id1})">مسح</button>
                    </div>

                    <div class="form-group col-lg-2 col-md-4">
                        <button class="btn btn-sm seller-item-small-btn seller-item-success-btn" type="button" onclick="get1(${id1})">اضافه</button>
                    </div>
                </div>
            </div>
        `);

            id1++;
        });

        function removes(id) {
            $(`#removes${id}`).remove();
        }

        let id2 = $("#section2 .news").length;

        function get1(i) {
            $(`#removes${i}`).append(`
            <div class="row news seller-item-extra-detail-row" id="removec${id2}">
                <div class="form-group col-lg-4 col-md-6">
                    <label>اسم ال extra <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="extrname${i}[]" required="required" value="{{ old('extrname2') }}"/>
                </div>

                {{--<div class="form-group col-lg-3 col-md-6">--}}
                {{--    <label>السعر <span class="text-danger">*</span></label>--}}
                {{--    <input type="number" class="form-control" value="{{ old('extrprice') }}" name="extrprice${i}[]" required="required"/>--}}
                {{--</div>--}}

                <div class="form-group col-lg-2 col-md-3">
                    <label>default <span class="text-danger">*</span></label>
                    <input type="checkbox" class="form-control seller-item-check" value="1" name="default${i}[]"/>
                </div>

                <div class="form-group col-lg-2 col-md-3">
                    <button class="btn btn-sm seller-item-small-btn seller-item-danger-btn" type="button" onclick="removec(${id2})">مسح</button>
                </div>
            </div>
        `);

            id2++;
        }

        function removec(id) {
            $(`#removec${id}`).remove();
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
            $('#row').append(`
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center">
                    <figure class="imghvr-fade">
                        <img src="${e.target.result}">
                    </figure>
                </div>
            `);
        }

        function getsellerscategory(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `../getsellerscategory/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#category_id').empty();
                        $('#category_id').append(result.data);
                        $('select#category_id').selectpicker("refresh");
                    }
                }
            });
        }

        function filter_subcategories(selected) {
            let id = selected.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `../filter_subcategories/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append(result.data);
                        $('select#subcategory_id').selectpicker("refresh");
                    }
                }
            });
        }
    </script>
@endsection
