<?php
$seller = \App\Models\Seller::withoutGlobalScope(\App\Scopes\CentralRestaurantVisibilityScope::class)->where('id', $id)->first();
$sellers = \App\Models\WebsiteSeller::get();
?>
<style>
    .span {
        width: 160px !important;
        margin-top: 3px !important;
    }

    .icon {
        font-size: 2rem;
        margin: auto;
        cursor: pointer;
        display: flex;
        justify-content: center;
    }

    .font_icon {
        font-size: 1.4rem;
        cursor: pointer;
    }

    .btn_container {
        display: none;
    }
</style>
<i class="fas fa-ellipsis-v icon" onclick="toggle_btns({{ $id }})"></i>
<div class="btns{{ $id }} btn_container">
    @php
        $collect = \App\Models\AllCollection::where('seller_id', $id)->latest()->first();

        if (isset($collect)) {
            $orders = \App\Models\Order::where('seller_id', $id)
                ->where('status', 1)
                ->whereBetween('created_at', [$collect->created_at, now()]);
            $countorders = $orders->count();
            $money = $orders->sum('priceafterdiscount');
            $value = $money * ($seller->commission / 100) + $collect->money_left;
        } else {
            $orders = \App\Models\Order::where('seller_id', $id)->where('status', 1);
            $countorders = $orders->count();
            $money = $orders->sum('priceafterdiscount');
            $value = $money * ($seller->commission / 100);
        }

    @endphp


    @include('admindashboard.sellers.__global_seller_action')
</div>
