<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{
    /**
     * @test
     *
     * test that the fields are fillable
     *
     * @return void
     */
    public function customer_fields_should_be_fillable(): void
    {
        $customer = new Customer();

        $expected = [
            'cnpj',
            'razao_social',
            'contact_name',
            'telephone'
        ];

        $this->assertEquals($expected, $customer->getFillable());
    }
}
