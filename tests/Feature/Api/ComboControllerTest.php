<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ComboControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @dataProvider storeDataProvider
     * @param array $params
     * @param int $status
     */
    public function testStore(array $params, int $status)
    {
        $this->withSession(['UserInfo' => [['id' => 1]]]);
        $response = $this->json('POST', '/api/combos', $params);
        $response->assertStatus($status);
    }

    /**
     * @dataProvider indexDataProvider
     * @param array $params
     * @param int $status
     */
    public function testIndex(array $params, int $status)
    {
        $this->withSession(['UserInfo' => [['id' => 1]]]);
        $response = $this->json('GET', '/api/combos', $params);
        $response->assertStatus($status);
    }

    /**
     * @dataProvider showDataProvider
     * @param int $comboId
     * @param int $status
     */
    public function testShow(int $comboId, int $status)
    {
        $this->withSession(['UserInfo' => [['id' => 1]]]);
        $response = $this->json('GET', '/api/combos/' . $comboId);
        $response->assertStatus($status);
    }

    /**
     * @dataProvider updateDataProvider
     * @param array $params
     * @param int $status
     */
    public function testUpdate(array $params, int $status)
    {
        $this->withSession(['UserInfo' => [['id' => 1]]]);
        $response = $this->json('PUT', '/api/combos/' . $params['id'], $params);
        $response->assertStatus($status);
    }

    /**
     * @dataProvider deleteDataProvider
     * @param int $comboId
     * @param int $status
     */
    public function testDelete(int $comboId, int $status)
    {
        $this->withSession(['UserInfo' => [['id' => 1]]]);
        $response = $this->json('DELETE', '/api/combos/' . $comboId);
        $response->assertStatus($status);
    }

    public function storeDataProvider()
    {
        return [
            [['selectCharacterId' => 1, 'damage' => 100, 'stun' => 200, 'meter' => 0, 'memo' => 'test' , 'combo' => [1 => ['id' => 1]], 'status' => [1,2]], 200],
            [['selectCharacterId' => 1, 'damage' => 100, 'stun' => 200, 'meter' => 0, 'memo' => 'test' , 'combo' => [1 => ['id' => 1]]], 200],
            [['damage' => 100, 'stun' => 200, 'meter' => 0, 'memo' => 'test' , 'combo' => [1 => ['id' => 1]]], 422]
        ];
    }

    public function indexDataProvider()
    {
        return [
            [[], 200],
            [['character_id' => 1], 200],
            [['status' => [2]], 200],
        ];
    }

    public function showDataProvider()
    {
        return [
            [1, 200]
        ];
    }

    public function updateDataProvider()
    {
        return [
            [['id'=>1, 'damage'=>999, 'stun'=>999, 'meter'=>3, 'memo' =>'test', 'combo' => [1 => ['id' => 1]], 'status' => [1,2]], 200],
            [['id'=>1, 'damage'=>999, 'stun'=>999, 'meter'=>3, 'memo' =>'test', 'combo' => [1 => ['id' => 1]]], 200],
            [['id'=>3, 'damage'=>999, 'stun'=>999, 'meter'=>3, 'memo' =>'test', 'combo' => [1 => ['id' => 1]]], 400],
            [['id'=>1, 'damage'=>999, 'stun'=>999, 'meter'=>3], 422],
        ];
    }

    public function deleteDataProvider()
    {
        return [
            [1, 200],
            [10, 400]
        ];
    }
}
