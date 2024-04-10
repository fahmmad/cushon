<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Services\DepositService;

use Tests\TestCase;

class DepositTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    // fixtures
    private $productId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->actingAs(User::find(1));
        $this->productId = 1;
    }

    public function testDeposit()
    {
        $data = [
            "amount" => $this->faker->randomFloat(),
            "product_id" => $this->productId,
        ];
        (new DepositService)
                ->create($data);
        $this->assertDatabaseHas('deposits', $data);
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
