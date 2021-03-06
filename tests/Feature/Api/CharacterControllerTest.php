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
        $this->login();
        $response = $this->json('GET', '/api/characters/?gameId=1');
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 28,
            'data' => [
                ['name' => 'リュウ'],
                ['name' => '春麗']
            ]
        ]);
    }

    public function testIndexGameId2()
    {
        $this->login();
        $response = $this->json('GET', '/api/characters/?gameId=2');
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 25,
            'data' => [
                ['name' => 'ソル'],
                ['name' => 'カイ']
            ]
        ]);
    }

    public function testValidatorGameId3()
    {
        $this->login();
        $response = $this->json('GET', '/api/characters/?gameId=3');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validator error'
        ]);
    }

    public function testValidatorGameIdNoNum()
    {
        $this->login();
        $response = $this->json('GET', '/api/characters/?gameId=a');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validator error'
        ]);
    }

    public function testValidatorNoGameId()
    {
        $this->login();
        $response = $this->json('GET', '/api/characters/');
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'validator error'
        ]);
    }
}
