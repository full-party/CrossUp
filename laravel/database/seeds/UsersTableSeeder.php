<?php

use App\Model\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [['admin', 'password', 'admin@example.com', '格メモ管理者']];
        foreach ($users as $user) {
            $model = new User();
            $model->login_id = $user[0];
            $model->password = Hash::make($user[1]);
            $model->email = $user[2];
            $model->name = $user[3];
            $model->save();
        }
    }
}
