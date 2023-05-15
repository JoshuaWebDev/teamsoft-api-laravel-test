<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Address;

class AddressTest extends TestCase
{
    /**
     * @test
     *
     * test that the fields are fillable
     *
     * @return void
     */
    public function address_fields_should_be_fillable(): void
    {
        /** @var Address $address */
        $address = new Address();

        $expected = [
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

        $this->assertEquals($expected, $address->getFillable());
    }
}
