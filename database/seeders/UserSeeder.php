<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\UmUser;
use App\Models\UmUserLogin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_users=[
            ["id"=>0,"firstname"=>"Admin","lastname"=>"User","um_user_status_id"=>config("global.user_status_active"),"um_user_role_id"=>config("global.user_role_admin")],
        ];
        foreach ($ar_users as $user) {
            UmUser::updateOrCreate([
                'id' => $user['id']
            ],$user);

            $user_login=[
                "id"=>$user['id'],
                "username"=>"admin",
                "password"=>Hash::make('123'),
                "um_user_id"=>$user['id']
            ];
            UmUserLogin::updateOrCreate([
                'id' => $user_login['id']
            ],$user_login);
        }

        

    }
}
