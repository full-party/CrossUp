<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use UserService;

class AuthControllerTest extends TestCase
{
    public function testLogin()
    {
        $response = $this->json('POST', '/api/login', ['loginId' => 'admin', 'password' => 'admin1234']);
        $response->assertStatus(200);
        $response->assertSessionHas('UserInfo');
    }

    /**
     * @param string $loginId
     * @param string $password
     * @param array $errorkeys
     * @dataProvider failedValidationDataProvider
     */
    public function testLoginValidationFailed(string $loginId, string $password, array $errorkeys)
    {
        $response = $this->json('POST', '/api/login', ['loginId' => $loginId, 'password' => $password]);
        $response->assertStatus(422);
        $data = $response->json();
        foreach ($errorkeys as $key) {
            $this->assertArrayHasKey($key, $data);
        }
        $response->assertSessionMissing('UserInfo');
    }

    /**
     * @dataProvider failedLoginDataProvider
     */
    public function testLoginFailed(string $loginId, string $password)
    {
        $response = $this->json('POST', '/api/login', ['loginId' => $loginId, 'password' => $password]);
        $response->assertStatus(401);
        $response->assertSessionMissing('UserInfo');
    }

    /**
     * バリデーション失敗データプロバイダー
     */
    public function failedValidationDataProvider()
    {
        // 配列3番目はバリデーションエラーとなるキー値を指定する
        return [
            // 必須
            ['', '', ['loginId', 'password']],
            // 半角英数字以外（現状通ってしまうので別チケットで対応）
//            ['あああ', 'ああああああああ', ['loginId', 'password']],
            // パスワード最小8桁
            ['test', '1234', ['password']]
        ];
    }

    /**
     * ログイン失敗データプロバイダー
     * @return array
     */
    public function failedLoginDataProvider()
    {
        return [
            // ID、パスワードともに間違い
            ['test', 'test1234'],
            // IDのみ間違い
            ['test', 'admin1234'],
            // パスワードのみ間違い
            ['admin', 'test1234']
        ];
    }
}
