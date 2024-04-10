<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class DepositWebTest extends TestCase
{
    use WithFaker;
    // fixtures
    private $productId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->productId = 1;
    }

    /**
     * Test route without auth.
     */
    public function testRoute(): void
    {
        $response = $this->get('/invest');

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testShouldReturnSuccessfulResponse(): void
    {
        $this->actingAs(User::find(1));

        $response = $this->get('/invest');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testFundShouldBePopulated(): void
    {
        $this->actingAs(User::find(1));

        $response = $this->get('/invest');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($data["funds"][0]->name, "Equities Fund");
    }

    /**
     * Test validation for duplicate name
     *
     * @return void
     */
    public function testShouldFailOnMissingAmount()
    {
        $this->actingAs(User::find(1));
        $data = [
            /*"amount" => $this->faker->randomFloat(),*/
            "product_id" => $this->productId,
        ];
        $response = $this->post('/invest', $data);

        $response->assertSessionHasErrors(['amount']);
    }

    /**
     * Test validation for duplicate name
     *
     * @return void
     */
    public function testShouldWorkWithData()
    {
        $this->actingAs(User::find(1));
        $data = [
            "amount" => $this->faker->randomFloat(),
            "product_id" => $this->productId,
        ];
        $response = $this->post('/invest', $data);

        $response->assertStatus(Response::HTTP_OK);
    }

}
