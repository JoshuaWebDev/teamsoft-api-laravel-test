<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'razaoSocial',
        'contactName',
        'phoneNumber'
    ];

    /**
     * Get Customer addresses.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'customerId');
    }
}
