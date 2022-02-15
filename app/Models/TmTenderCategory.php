<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TmTenderCategory extends Model
{
    use HasFactory;
    protected $table = 'tm_tender_category';
    protected $fillable = ['id','name','symble','active','icon'];
    public $incrementing = false;
 
    /**
     * Get all of the Tenders for the category.
     */
   
    public function tenders()
    {
        return $this->hasMany(TmTender::class,'tm_tender_category_id','id')->where('tm_tender_status_id', 1)->where('end_date','>',Carbon::now());
    }


    

}
