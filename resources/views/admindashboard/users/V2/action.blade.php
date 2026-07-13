<?php
$user = \App\User::where("id", $id)->first();
?>

@once
    <style>
        .user-actions-inline {
            width: 180px;
            display: grid;
            grid-template-columns: 34px 82px 34px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            direction: rtl;
            margin: auto;
        }

        .user-action-icon-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            background: #f3f6f9 !important;
            border: 1px solid #e4e6ef !important;
            color: #3699ff !important;
            cursor: pointer;
            line-height: 1;
            text-decoration: none !important;
        }

        .user-action-icon-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
        }

        .user-action-icon-btn img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
            border-radius: 0 !important;
        }

        .user-action-profile img {
            width: 22px !important;
            height: 22px !important;
            object-fit: cover;
            border-radius: 50% !important;
        }

        .user-block-switch-wrapper {
            width: 82px;
            height: 34px;
            border-radius: 8px;
            background: #fbfcfe;
            border: 1px solid #e4e6ef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .user-input-switch {
            display: none;
        }

        .user-label-switch {
            width: 38px;
            height: 20px;
            border-radius: 30px;
            background: #f64e60;
            position: relative;
            cursor: pointer;
            margin: 0 !important;
            transition: all 0.2s ease;
        }

        .user-label-switch::after {
            content: "";
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ffffff;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .user-input-switch:checked + .user-label-switch {
            background: #1bc5bd;
        }

        .user-input-switch:checked + .user-label-switch::after {
            left: 20px;
        }

        .user-switch-text {
            font-size: 10px;
            font-weight: 900;
            color: #3f4254;
            white-space: nowrap;
        }

        .user-switch-text::before {
            content: "Block";
            color: #f64e60;
        }

        .user-input-switch:checked ~ .user-switch-text::before {
            content: "Active";
            color: #1bc5bd;
        }
    </style>
@endonce

<div class="user-actions-inline">
    <a href="{{ route('user_orders', $id) }}"
       title="الطلبات"
       class="user-action-icon-btn">
        <img src="{{ asset('order-food.png') }}" alt="orders">
    </a>

    <div class="user-block-switch-wrapper" title="حالة المستخدم">
        <input class="user-input-switch"
               type="checkbox"
               id="demo{{ $id }}"
               @if($user->block == 0) checked @endif
               onchange="block_user({{ $id }})"/>

        <label class="user-label-switch" for="demo{{ $id }}"></label>

        <span class="user-switch-text"></span>
    </div>

    <a href="{{ route('user_profile', $id) }}"
       title="البروفايل"
       class="user-action-icon-btn user-action-profile">
        <img src="{{ asset('user.png') }}" alt="profile">
    </a>
</div>

@once
    <script>
        function block_user(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: `block_user/${id}`,
                dataType: "Json",
                success: function(result) {
                    if (result.status == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم تغيير الحالة بنجاح',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    }
                }
            });
        }
    </script>
@endonce
