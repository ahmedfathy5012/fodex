<?php

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\OrderItemExtra;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class,10)->create()
        ->each(function ($order) {
    //create 5 posts for each user
    OrderItem::create([
   'item_id'=>7,
        'size_id' => 10,
        'order_id' => $order->id,
       'quantity' => 4,
         'price' => 100,
        ])
        ->each(function ($item) {
    //create 5 posts for each user
    factory(OrderItemExtra::class, 3)->create([
        'order_item_id'=>$item->id,
        'extra_id' => 7,
         'price' => 50
        ]);
});
   });
    }
}
