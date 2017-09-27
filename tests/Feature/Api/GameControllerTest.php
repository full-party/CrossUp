<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GameService;

class GameControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->json('GET', '/api/games');
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 2,
            'data' => [
                ['name' => 'Street Fighter V'],
                ['name' => 'Guilty Gear Xrd']
            ]
        ]);
    }

    public function testShow()
    {
        $response = $this->json('GET', '/api/games/1');
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'Street Fighter V'
        ]);
    }

    public function testShow400()
    {
        $response = $this->json('GET', '/api/games/0');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'invalid game id'
        ]);
    }

    public function testShow500()
    {
        $response = $this->json('GET', '/api/games/AAA');
        $response->assertStatus(500);
        $response->assertJson([
            'message' => 'internal server error'
        ]);
    }
}
