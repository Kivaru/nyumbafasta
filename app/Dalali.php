<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dalali extends Model
{
    use HasFactory;

    public $table = 'dalali';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
