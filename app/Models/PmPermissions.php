<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmPermissions extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pm_permissions';
    public $incrementing = false;
}
