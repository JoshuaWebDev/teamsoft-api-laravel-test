<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'streetName',       // logradouro
        'buildingNumber',   // número
        'secondaryAddress', // complemento
        'neighborhood',     // bairro
        'city',             // cidade
        'state',            // estado
        'postcode',         // CEP
        'latitude',
        'longitude'
    ];
}
