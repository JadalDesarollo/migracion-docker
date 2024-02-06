<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    //use HasFactory;
    protected $table = 'LOCAL_CENTRALIZADO';

    protected $fillable = [
        'code', 'description'
    ];

}
