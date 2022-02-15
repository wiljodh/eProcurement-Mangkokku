<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmOfferStatus extends Model
{
    use HasFactory;
    protected $table = 'om_offer_status';
    protected $fillable = ['id','name','class_name'];
    public $incrementing = false;
}
