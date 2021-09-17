<?php

namespace App\Models;

use App\Events\ProductDeletedEvent;
use App\Events\ProductUpdatedEvent;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use BroadcastsEvents;

    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'regular_price', 'sale_price', 'SKU', 'stock_status',
        'featured', 'quantity', 'image', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
//    protected static function booted()
//    {
//        static::updated(function ($product) {
//            event(new ProductUpdatedEvent($product->id));
//        });
//        static::deleted(function ($product) {
//            event(new ProductDeletedEvent($product->id));
//        });
//    }

}
