<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VmVendor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vm_vendor';
    protected $fillable = ['id', 'company_name', 'address', 'contact_email', 'contact_mobile', 'contact_office', 'um_user_id'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(UmUser::class, "um_user_id", "id");
    }

    public function allOffers()
    {
        return $this->hasMany(OmOffer::class, "vm_vendor_id", "id");
    }

    public function approvedOffers()
    {
        return $this->hasMany(OmOffer::class, "vm_vendor_id", "id")->where('om_offer_status_id',"=",config("global.offer_status_approved"));
    }

    public function rejectedOffers()
    {
        return $this->hasMany(OmOffer::class, "vm_vendor_id", "id")->where('om_offer_status_id',"=",config("global.offer_status_rejected"));
    }

}
