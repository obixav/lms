<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomerDesignRequest extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable=['project_category_id','budget','message','customer_id','preview_code','can_preview_request','quantity','response'];

//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this
//            ->addMediaConversion('preview')
//            ->fit(Manipulations::FIT_CROP, 382, 255)
//            ->nonQueued();
//    }
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id');
    }
    public function project_category()
    {
        return $this->belongsTo(ProjectCategory::class,'project_category_id');
    }
}
