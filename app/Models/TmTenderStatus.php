<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmTenderStatus extends Model
{
    use HasFactory;
    protected $table = 'tm_tender_status';
    protected $fillable = ['id','name','class_name'];
    public $incrementing = false;
}
