<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmUserRolePermissions extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'um_user_role_has_pm_permissions';
    public $incrementing = false;

    public function userRoles()
    {
        return $this->hasMany(UmUserRole::class);
    }

    public function permissions()
    {
        return $this->hasMany(PmPermissions::class);
    }
}
