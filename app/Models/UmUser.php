<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmUser extends Model
{
    use HasFactory;

    protected $table = 'um_user';
    protected $fillable = ['id', 'firstname', 'lastname', 'um_user_status_id', 'um_user_role_id'];
    public $incrementing = false;

    public function vendor()
    {
        if ($this->um_user_role_id === config("global.user_role_admin")) {
            return null;
        }
        return $this->hasOne(VmVendor::class, 'um_user_id', "id");
    }

}
