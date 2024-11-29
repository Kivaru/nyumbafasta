<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    use HasFactory;

    public $table = 'oauth_access_tokens';

    protected $fillable = [
        'user_id',
        'name',
        'scopes',
        'revoked',
        'created_at',
        'updated_at',
        'deleted_at',
        'expires_at'
    ];
}
