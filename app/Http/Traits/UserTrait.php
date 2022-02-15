<?php
namespace App\Http\Traits;
use App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{

    
    public function user_role_getUserRolePermissions($user_role)
    {
        $permissions = DB::select("select per.* from pm_permissions per inner join um_user_role_has_pm_permissions ur_per on per.id=ur_per.pm_permissions_id
        where ur_per.um_user_role_id='" . $user_role . "'  order by `order_no` asc ");
        return $permissions;
    }
    public function user_role_getUserRolePermissions_tabs($user_role)
    {
        $permissions = DB::select("select per.* from pm_permissions per inner join um_user_role_has_pm_permissions ur_per on per.id=ur_per.pm_permissions_id
        where ur_per.um_user_role_id='" . $user_role . "' and per.is_tab=1  order by `order_no` asc ");
        return $permissions;
    }

    public function user_role_isPermissionAvilable($permissions, $perid)
    {
        $isAvilable = false;
        foreach ($permissions as $key => $value) {
            if ($value->id == $perid) {
                $isAvilable = true;
                break;
            }
        }
        return $isAvilable;
    }
}