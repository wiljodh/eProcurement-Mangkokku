<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmOffer extends Model
{
    use HasFactory;
    protected $table = 'om_offer';
    protected $fillable = ['id', 'bid_amount','period','om_offer_status_id','vm_vendor_id','tm_tender_id','note'];
    public $incrementing = false;

    public function offerStatus()
    {
        return $this->belongsTo(OmOfferStatus::class, 'om_offer_status_id', 'id');
    }

    public function tender()
    {
        return $this->belongsTo(TmTender::class, 'tm_tender_id', 'id');
    }

    public function createdBy(){
        return $this->belongsTo(VmVendor::class, 'vm_vendor_id', 'id');
    }
}
