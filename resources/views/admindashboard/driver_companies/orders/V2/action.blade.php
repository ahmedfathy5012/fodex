<?php
$order = \App\Models\Order::where('id', $id)->first();
?>

@once
    <style>
        .company-order-actions-inline {
            width: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            direction: rtl;
        }

        .company-order-action-btn {
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
            transition: all 0.15s ease;
        }

        .company-order-action-btn:hover {
            background: #eaf4ff !important;
            border-color: #b5d9ff !important;
            color: #3699ff !important;
            text-decoration: none !important;
            transform: translateY(-1px);
        }

        .company-order-action-btn i {
            font-size: 14px;
            color: #3699ff !important;
        }

        .company-order-action-btn img {
            width: 18px !important;
            height: 18px !important;
            object-fit: contain;
        }

        .fa-star.checked {
            color: orange;
        }
    </style>
@endonce

<div class="company-order-actions-inline">
    <a href="{{ route('showorders', $id) }}"
       class="company-order-action-btn"
       title="عرض الطلب">
        <i class="fas fa-eye"></i>
    </a>
</div>


{{--<a href="{{ route('showorders', $id) }}"--}}
{{--   class="company-order-action-btn"--}}
{{--   title="عرض الطلب">--}}
{{--    <img src="{{ asset('visibility.png') }}" alt="show">--}}
{{--</a>--}}
