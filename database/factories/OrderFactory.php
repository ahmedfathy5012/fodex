<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemExtra;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => 1,
       'driver_id' => 5,
       'price' => 100,
       'priceafterdiscount' => 500,
        'seller_id' => 5
    ];
});$factory->define(OrderItem::class, function (Faker $faker) {
    return [
           'item_id'=>7,
        'size_id' => 10,
          'order_id' => function() {
            return factory(Order::class)->create()->id;
        },
         'quantity' => 4,
         'price ' => 100,
    ];
});$factory->define(OrderItemExtra::class, function (Faker $faker) {
    return [
          'order_item_id' => function() {
            return factory(OrderItem::class)->create()->id;
        },
             'extra_id' => 7,
         'price' => 50
    ];
});

