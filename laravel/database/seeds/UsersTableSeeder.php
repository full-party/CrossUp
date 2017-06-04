<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [['admin', 'admin@example.com', '格メモ管理者']];
        foreach ($users as $user) {
            $model = new User();
            $model->login_id = $user[0];
            $model->email = $user[1];
            $model->name = $user[2];
            $model->save();
        }
    }
}
