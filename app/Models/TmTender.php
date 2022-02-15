<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TmTender extends Model
{
    use HasFactory;
    protected $table = 'tm_tender';
    protected $fillable = ['id', 'title', 'description', 'start_date', 'end_date', 'tm_tender_status_id', 'crby', 'deposit', 'estimate_cost', 'location', 'tm_tender_category_id', 'attachment_path'];
    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(TmTenderCategory::class, 'tm_tender_category_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(OmOffer::class,'tm_tender_id','id');
    }

    public function getTenderCorrectStatus(){
        if($this->tm_tender_status_id===config("global.tender_publish") && $this->isExpired()){
            return TmTenderStatus::find(config("global.tender_closed"));
        }else{
            return TmTenderStatus::find($this->tm_tender_status_id);
        }
    }

    public function getPDFFileURL()
    {
        // $url = Storage::url($this->attachment_path);
        // return ($url);
        return asset('storage/' . $this->attachment_path);
    }
    public function hasPDF()
    {
        if ($this->attachment_path !== "") {
            return Storage::exists($this->attachment_path);
        } else {
            return false;
        }
    }

  

    public function isExpired()
    {
        return ($this->end_date < Carbon::now());
    }
    public function daysRemain()
    {
        $days = Carbon::now()->diffInDays($this->end_date, false);
        if ($days === 0) {
            return "Closing Today";
        } else if ($days > 0) {
            return $days . " Day" . ($days === 1 ? "" : "s") . " to go";
        } else {
            return "Closed";
        }
    }

    public function getStartDate()
    {
        $startDate = Carbon::parse($this->start_date);
        return $startDate->format('M d Y');
    }
    public function getEndDate()
    {
        $startDate = Carbon::parse($this->end_date);
        return $startDate->format('M d Y');
    }

    public function getOfferUserAlreadySubmited($userid){
        $offer = OmOffer::where("tm_tender_id","=",$this->id)->where("vm_vendor_id","=",$userid)->first();
        //dd($offer);
        return $offer;
    }
}
