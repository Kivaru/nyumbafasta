<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function houses(){
        return $this->hasMany(House::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}
