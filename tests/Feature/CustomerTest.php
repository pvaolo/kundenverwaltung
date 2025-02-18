<?php

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Customer::factory()->count(3)->create();

        $response = $this->get('/api/customers');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        echo "testIndex passed\n";
    }

    public function testShow()
    {
        $customer = Customer::factory()->create();

        $response = $this->get("/api/customers/{$customer->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $customer->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'street' => $customer->street,
            'postal_code' => $customer->postal_code,
            'city' => $customer->city,
        ]);

        echo "testShow passed\n";
    }

    public function testStore()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'street' => '123 Main St',
            'postal_code' => '12345',
            'city' => 'Anytown',
        ];

        $response = $this->post('/api/customers', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('customers', $data);

        echo "testStore passed\n";
    }

    public function testUpdate()
    {
        $customer = Customer::factory()->create();

        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'street' => '456 Elm St',
            'postal_code' => '54321',
            'city' => 'Othertown',
        ];

        $response = $this->put("/api/customers/{$customer->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('customers', $data);

        echo "testUpdate passed\n";
    }

    public function testDestroy()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete("/api/customers/{$customer->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);

        echo "testDestroy passed\n";
    }

    public function testInvalidStore()
    {
        $data = [
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid-email',
            'phone' => '',
            'street' => '',
            'postal_code' => '',
            'city' => '',
        ];

        $response = $this->post('/api/customers', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'phone', 'street', 'postal_code', 'city']);

        echo "testInvalidStore passed\n";
    }
}