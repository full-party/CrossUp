<?php

namespace Tests;

/**
 * Trait TestTrait
 * @package Tests
 */
trait TestTrait
{
    /**
     * テスト用ログイン状態作成関数
     * @param int $id
     */
    public function login(int $id = 1)
    {
        $this->withSession(['UserInfo' => [['id' => $id]]]);
    }
}
