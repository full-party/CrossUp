<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use CharacterService;

class CharacterServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testList() {
        $character = CharacterService::list(1);
        $this->assertArrayHasKey('count', $character);
        $this->assertArrayHasKey('data', $character);
        $this->assertArrayHasKey('name', $character['data'][0]);
        $this->assertEquals('リュウ', $character['data'][0]['name']);
        $this->assertEquals('春麗', $character['data'][1]['name']);
    }

    public function testListNonData() {
        $character = CharacterService::list(0);
        $this->assertArrayHasKey('count', $character);
        $this->assertArrayHasKey('data', $character);
        $this->assertEquals('0', $character['count']);
    }
}
