<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    public $table = 'agents';

    protected $fillable = [
        'name',
        'phonenumber',
        'email',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
