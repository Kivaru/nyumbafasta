<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public $table = 'wishlist';

    protected $fillable = [
        'user_id',
        'house_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
