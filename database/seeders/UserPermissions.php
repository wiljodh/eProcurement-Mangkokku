<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UmUserRolePermissions;

class UserPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UmUserRolePermissions::truncate();

        $ar_userrole_has_permissions = [
            //Admin
            ['um_user_role_id'=>config('global.user_role_admin'),'pm_permissions_id'=>1000],
            ['um_user_role_id'=>config('global.user_role_admin'),'pm_permissions_id'=>1001],
            ['um_user_role_id'=>config('global.user_role_admin'),'pm_permissions_id'=>1002],
            ['um_user_role_id'=>config('global.user_role_admin'),'pm_permissions_id'=>1003],
            ['um_user_role_id'=>config('global.user_role_admin'),'pm_permissions_id'=>1004],

            //Vendor
            ['um_user_role_id'=>config('global.user_role_vendor'),'pm_permissions_id'=>2000],
            ['um_user_role_id'=>config('global.user_role_vendor'),'pm_permissions_id'=>2001],

        ];

        foreach ($ar_userrole_has_permissions as $userrole_has_permission) {
            UmUserRolePermissions::updateOrCreate([
                'um_user_role_id' => $userrole_has_permission['um_user_role_id'],
                'pm_permissions_id' => $userrole_has_permission['pm_permissions_id'],
            ],$userrole_has_permission);
        }

    }
}
