<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use HasSku;
    use InteractsWithMedia;

    protected $fillable = ['product_category_id', 'name', 'price', 'available', 'description', 'information',
        'vendor_information', 'discount', 'is_featured', 'sku'];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this
//            ->addMediaConversion('preview')
//            ->fit(Manipulations::FIT_CROP, 250, 250)
//            ->nonQueued();
//    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class,'product_id');
    }

    public function getDiscountPriceAttribute()
    {
        if($this->discount>0)
        {
            return round($this->price-($this->price*($this->discount/100)),2);
        }else{
            return $this->price;
        }
    }
}
