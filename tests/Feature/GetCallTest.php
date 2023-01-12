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


    //  Skús napr držať takýto naming:

    // createEvent_validRequest_eventReturned

    // tzn.
    // čoRobíš_akéDátaTamPosielaš_čoTiToVráti


    // Navyše testy by mali pokrývať nielen tie správne scénare, ale aj tie chybné.
    // Čiže napr, ak by si tam poslal zlé dáta, tak si chceš byť istý že to neuloží.
    // Čiže skús napísať aj také testy, pre ten create a update

    // ak by si tam poslal zlé dáta, tak si chceš byť istý že to neuloží.
    // Čiže skús napísať aj také testy, pre ten create a update


    // sending wrong data test
    public function test_createEvent_invalidRequest_status422()
    {

        $request = [
            'city' => null,
            'city_postcode' => null,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/events/', $request);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                "errors" => [
                    "city_postcode" => [
                        "The city postcode field is required."
                    ],
                    "city" => [
                        "The city field is required."
                    ]
                ]
            ]);
    }

    public function test_createEvent_validRequest_status201()
    {
        $request = [
            'city' => 'skalica',
            'city_postcode' => '909',
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/events/', $request);

        $response->assertStatus(201);
    }


    // sending wrong data test
    public function test_updateEvent_invalidRequest_status422()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/events/5', []);

        $response->assertStatus(422)
            ->assertJsonFragment([
                "errors" => [
                    "city_postcode" => [
                        "The city postcode field is required."
                    ],
                    "city" => [
                        "The city field is required."
                    ]
                ]
            ]);
    }

    public function test_destroyEvent_notExistEvent_status404()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/events/999');

        $response->assertStatus(404);
    }


    public function test_destroyEvent_Event_status204()
    {
        $newEvent = [
            "city" => "sdf12",
            "city_postcode" => "0000",
        ];
        $event = Event::create($newEvent);
        
        $savedId = $event->id;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/events/' . $event->id);

        $response->assertStatus(204);
        $this->assertFalse(Event::where(["id" =>$event->id])->exists());
        $this->assertTrue(Event::find($event->id) == null);
    }






    // // sending right data test
    // public function test_if_sendRightDataToStore___Route_postApiEvents_ReturnAssetStatus200()
    // {
    //     $this->withoutExceptionHandling();
    //     $data = [
    //         'city' => 'skalica',
    //         'city_postcode' => '9023889',
    //     ];

    //     $response = $this->post('api/events/', $data);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('events', [
    //         'city' => $data['city'],
    //         'city_postcode' => $data['city_postcode'],
    //     ]);
    // }

    // // structural tests
    // public function test_returnintStructure_inGetApiEventsAndInIndexFunction_returnAssertJsonStructureAndAssertStatus200()
    // {
    //     $response = $this->get('api/events/');

    //     $response->assertJsonStructure([
    //         [
    //             'id',
    //             'city',
    //             'city_postcode'
    //         ]
    //     ]);
    //     $response->assertStatus(200);
    // }

    // // structural tests
    // public function test_returnintStructure_inGetApiEvents5AndInShowFunction_returnAssertJsonStructureAndAssertStatus200()
    // {
    //     $response = $this->get('api/events/5');

    //     $response->assertJsonStructure([
    //         [
    //             'id',
    //             'city',
    //             'city_postcode'
    //         ]
    //     ]);
    //     $response->assertStatus(200);
    // }

    // // structural tests
    // // Wrong naming or testing
    // public function test_ifValidationWork_postApiEvents_ReturnAssetValidAndAssetStatus200()
    // {
    //     $response = $this->post('api/events/', [
    //         'city' => 'skalica',
    //         'city_postcode' => '902388'
    //     ]);

    //     // Assert that the given keys do not have validation errors...
    //     $response->assertValid(['city', 'city_postcode'])
    //         ->assertStatus(200);
    // }


    // // route tests
    // public function test_ifRouteAndFunctionExist_getApiEvents_ReturnAssetStatus200()
    // {
    //     $response = $this->get('api/events/');

    //     $response->assertStatus(200);
    // }
}
