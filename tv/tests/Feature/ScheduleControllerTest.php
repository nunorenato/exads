<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNextShow()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/next/?date=2023-06-15');
        $response->assertJson([
            'title' => 'Cambridge Spies',
            'show_date' => '2023-06-15 05:00'
        ]);

        $response = $this->get('/next/?date=2023-06-15 11:00');
        $response->assertJson([
            'title' => 'Lonesome',
            'show_date' => '2023-06-15 12:00'
        ]);

        $response = $this->get('/next/?date=2023-06-15 11:00&series=Raising Helen');
        $response->assertJson([
            'title' => 'Raising Helen',
        ]);

        $response = $this->get('/next/?date=2023-06-15 11:00&series=Helen Raising');
        $response->assertJsonCount(0);

    }
}
