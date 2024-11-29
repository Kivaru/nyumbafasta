<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = 'selcom_payments';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function house(){
        return $this->belongsTo(House::class, 'house_id');
    }

}
