<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = true;

    use HasFactory;

    protected $fillable = [
        'identity_document_type_id',
        'number',
        'name',
        'trade_name',
        'soap_send_id',
        'soap_type_id',
        'soap_username',
        'soap_password',
        'soap_url',
        'certificate',
        'certificate_due',
        'logo',
        'detraction_account',
        'logo_store',
        'favicon',
        'img_firm',
        'operation_amazonia',
        'cod_digemid',
        'commerce_code',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
