<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @dataProvider updateDataProvider
     * @param int $userId
     * @param array $params
     * @param int $status
     */
    public function testUpdate(int $userId, array $params, int $status)
    {
        $this->createTestUser();

        $this->login($userId);
        $response = $this->json('PUT', '/api/users/1', $params);
        $response->assertStatus($status);
    }

    /**
     * @dataProvider destroyDataProvider
     * @param int $userId
     * @param int $status
     */
    public function testDestroy(int $userId, int $status)
    {
        $this->createTestUser();

        $this->login();
        $response = $this->json('DELETE', '/api/users/' . $userId);
        $response->assertStatus($status);
    }

    /**
     * updateAPI用テストデータ
     * @return array
     */
    public function updateDataProvider()
    {
        return [
            [1, ['email' => 'test'], 422],
            [2, ['email' => 'test@example.com'], 403],
            [1, ['email' => 'test@example.com'], 412],
            [1, ['email' => 'admin@example.com'], 200],
            [1, ['login_id' => 'test'], 412],
            [1, ['login_id' => 'admin2'], 200],
            [1, ['login_id' => 'admin3', 'email' => 'admin3@example.com'], 200]
        ];
    }

    /**
     * @return array
     */
    public function destroyDataProvider()
    {
        return [
            [1, 200],
            [2, 403]
        ];
    }

    /**
     * テストユーザー作成メソッド
     */
    private function createTestUser()
    {
        $user = new User();
        $user->login_id = 'test';
        $user->password = 'testtest';
        $user->email = 'test@example.com';
        $user->save();
    }
}
