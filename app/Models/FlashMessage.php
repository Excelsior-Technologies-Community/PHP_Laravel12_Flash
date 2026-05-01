<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlashMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'message',
        'type'
    ];
}