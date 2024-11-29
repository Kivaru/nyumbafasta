<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    public $table = 'properties_for_sale';

    protected $fillable = [
        'name',
        'contact',
        'address',
        'area_id',
        'district_id',
        'region_id',
        'user_id',
        'property_type',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

}
