<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UmUserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_user_role=[
            ["id"=>0,"name"=>"admin"],
            ["id"=>1,"name"=>"vendor"],
        ];

        foreach ($ar_user_role as $user_role) {
            UmUserRole::updateOrCreate([
                'id' => $user_role['id']
            ],$user_role);
        }

    }
}
