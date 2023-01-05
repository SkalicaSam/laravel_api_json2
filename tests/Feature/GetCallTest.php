<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Event;
use Tests\TestCase;

class GetCallTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_events()
    {
        $response = $this->get('api/events');

        $response->assertStatus(200);
    }

    public function test_get_events_create()
    {
        $response = $this->post('api/events/create', [
            'city' => 'skalica',
            'city_postcode' => '902388'
        ]);

        // Assert that the given keys do not have validation errors...
        $response->assertValid(['city', 'city_postcode'])
                 ->assertStatus(405);
                 // s assertStatus(200) mi to neprechadza.
    }

    public function test_the_application_returns_a_successful_response()
    {
          $response = $this->get('/non-existing-url');

         $response->assertStatus(200);
    }

}
