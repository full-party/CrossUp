<?php

namespace Tests\Unit\Service;

use Mockery\Mock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GameService;
use Exception;

class GameServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testList()
    {
        $game = GameService::list();
        $this->assertArrayHasKey('count', $game);
        $this->assertArrayHasKey('data', $game);
        $this->assertArrayHasKey('name', $game['data'][0]);
        $this->assertEquals('Street Fighter V', $game['data'][0]['name']);
        $this->assertEquals('Guilty Gear Xrd', $game['data'][1]['name']);
    }

    public function testFind()
    {
        $game = GameService::find(1);
        $this->assertArrayHasKey('name', $game);
        $this->assertEquals('Street Fighter V', $game['name']);
    }

    public function testFindNonData()
    {
        $game = GameService::find(0);
        $this->assertNull($game);
    }
}
