<?php

namespace Tests\Unit\Service;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GameService;

class GameServiceTest extends TestCase
{
    public function testLists()
    {
        $game = GameService::lists();
        $this->assertArrayHasKey('count', $game);
        $this->assertArrayHasKey('data', $game);
        $this->assertArrayHasKey('name', $game['data'][0]);
        $this->assertEquals('Street Fighter V', $game['data'][0]['name']);
        $this->assertEquals('Guilty Gear Xrd', $game['data'][1]['name']);
    }
}
