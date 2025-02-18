<?php

use App\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerModelTest extends TestCase
{
    public function testCustomerName()
    {
        $customer = new Customer();
        $customer->first_name = 'John';
        $customer->last_name = 'Doe';
        $this->assertEquals('John', $customer->first_name);
        $this->assertEquals('Doe', $customer->last_name);
    }

    public function testCustomerEmail()
    {
        $customer = new Customer();
        $customer->email = 'john@example.com';
        $this->assertEquals('john@example.com', $customer->email);
    }

    public function testCustomerPhone()
    {
        $customer = new Customer();
        $customer->phone = '1234567890';
        $this->assertEquals('1234567890', $customer->phone);
    }

    public function testCustomerAddress()
    {
        $customer = new Customer();
        $customer->street = '123 Main St';
        $customer->postal_code = '12345';
        $customer->city = 'Anytown';
        $this->assertEquals('123 Main St', $customer->street);
        $this->assertEquals('12345', $customer->postal_code);
        $this->assertEquals('Anytown', $customer->city);
    }
}