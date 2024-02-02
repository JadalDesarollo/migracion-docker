<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyUserRol extends Pivot
{
    use HasFactory;

    protected $table = 'company_user_rol';

    protected $fillable = [
        'user_id',
        'company_id',
        'rol_id',
    ];
}
