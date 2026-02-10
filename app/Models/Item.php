<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Size;
use App\Models\Extra;
use App\Models\Major;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\ItemImage;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'title',
        'description',
        'price',
        'discount',
        'discount_from',
        'discount_to',
        'category_id',
        'subcategory_id',
        'major_id',
        'seller_id',
        'availability',
        'not_available_reason',
        'appear',
        'not_appear_reason',
        'prepare_time',
        'calory',
        'fav',
        'menu_type_id',
    );
    protected $visible = array(
        'id',
        'title',
        'description',
        'price',
        'discount_from',
        'discount_to',
        'category_id',
        'subcategory_id',
        'major_id',
        'discount',
        'seller_id',
        'availability',
        'not_available_reason',
        'appear',
        'not_appear_reason',
        'prepare_time',
        'calory',
        'fav',
        'menu_type_id',
    );
    protected $appends = [
        'count_number',
        'currency'

    ];
    public function images()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }
    public function imageone()
    {
        return $this->hasOne(ItemImage::class, 'item_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function extras()
    {
        return $this->hasMany(Extra::class, 'item_id')->where("hidden", 0);
    }
    public function extrasdetails()
    {
        $arry_ids = [];
        if (count($this->extras) > 0) {
            foreach ($this->extras as $extra) {
                if (count($extra->extraDetails) > 0) {
                    foreach ($extra->extraDetails as $extras) {
                        $arry_ids[] = $extras->id;
                    }
                }
            }
        }
        return $arry_ids;
    }
    public function item_extras_details()
    {
        return $this->hasManyThrough(
            Extradetail::class,
            Extra::class,
            'item_id', // Foreign key on the environments table...
            'extra_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
    public function sizes()
    {
        return $this->hasMany(Size::class, 'item_id')->where("hidden", 0);
    }
    public function orderitems()
    {
        return $this->hasMany(OrderItem::class, "item_id");
    }
    public function getCountNumberAttribute()
    {
        $number = 0;
        if (count($this->orderitems) > 0) {
            foreach ($this->orderitems as $orderitem) {
                if ($orderitem->order) {
                    if ($orderitem->order->status == 1) {
                        $number += $orderitem->quantity;
                    }
                }
            }
        }
        return $number;
    }
    public function getCurrencyAttribute()
    {
        if ($this->seller) {
            if ($this->seller->address) {

                if ($this->seller->address->country) {
                    if ($this->seller->address->country->coin) {
                        $currency = $this->seller->address->country->coin->title;
                    } else {
                        $currency = '';
                    }
                } else {
                    $currency = '';
                }
            } else {
                $currency = '';
            }
        } else {
            $currency = '';
        }
        return $currency;
    }
    public function getImageLinkAttribute()
    {
        return $this->imageone ? asset('uploads/' . $this->imageone->image) : $this->seller->image_link;
    }

    public function menu_type(): BelongsTo
    {
        return $this->belongsTo(MenuType::class, 'menu_type_id');
    }
}
