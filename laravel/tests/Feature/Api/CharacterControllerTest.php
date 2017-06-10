<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use CharacterService;

class CharacterControllerTest extends TestCase
{
    public function testIndexGameId1()
    {
        $response = $this->json('GET', '/api/characters/?gameId=1');
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 2,
            'data' => [
                ['name' => 'リュウ'],
                ['name' => '春麗']
            ]
        ]);
    }

    public function testIndexGameId2()
    {
        $response = $this->json('GET', '/api/characters/?gameId=2');
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 2,
            'data' => [
                ['name' => 'ソル'],
                ['name' => 'カイ']
            ]
        ]);
    }

    public function testValidatorGameId3()
    {
        $response = $this->json('GET', '/api/characters/?gameId=3');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validaor error'
        ]);
    }

    public function testValidatorGameIdNoNum()
    {
        $response = $this->json('GET', '/api/characters/?gameId=a');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validaor error'
        ]);
    }

    public function testValidatorNoGameId()
    {
        $response = $this->json('GET', '/api/characters/');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validaor error'
        ]);
    }
}
