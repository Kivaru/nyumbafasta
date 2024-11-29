<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class House extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    protected $fillable = ['status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'house_id', 'id');
    }
    public function payment(){
        return $this->hasMany(Payment::class, 'house_id', 'id');
    }

    //media conversions
    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('featured_image')
              ->width(368)
              ->height(232)
              ->sharpen(10);

        $this->addMediaConversion('images')
              ->width(368)
              ->height(232)
              ->sharpen(10);

        // $this->addMediaConversion('large')
        //       ->width(1024)
        //       ->watermark(public_path('assets/img/nyumbafasta-watermark.png'))
        //       ->watermarkOpacity(50)
        //       ->sharpen(10)
        //       ->withResponsiveImages()
        //       ->performOnCollections('featured_image')
        //       ->nonQueued();
    }

}
