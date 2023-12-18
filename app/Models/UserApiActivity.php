<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApiActivity extends Model
{
    use HasFactory;

    protected $table = 'user_api_activity';

    protected $fillable = [
        'endpoint_url',
        'parameters',
        'user_id',
    ];
}
