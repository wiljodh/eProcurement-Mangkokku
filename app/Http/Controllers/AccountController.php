<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\TmTender;
use App\Models\OmOffer;
use App\Models\TmTenderCategory;
use Carbon\Carbon;
use stdClass;

class AccountController extends Controller
{
    /*
     * Tender create function
     */


    

    public function account_show_dashboard(Request $request){

        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));

            
            if($userSession->um_user_role_id==config("global.user_role_admin")){
                $tenders=TmTender::where('tm_tender_status_id',config("global.tender_publish"))->where("end_date", '>', Carbon::now());
                $tendersCount=count($tenders->get());

                $offers_approved=OmOffer::where('om_offer_status_id',config("global.offer_status_approved"));
                $offersApprovedCount=count($offers_approved->get());

                $offers_pending=OmOffer::where('om_offer_status_id',config("global.offer_status_pending"));
                $offersPendingCount=count($offers_pending->get());

                $Categorries=TmTenderCategory::pluck('name')->toArray();
                $CategorriesAll=TmTenderCategory::get();

                $dataPoints=[];
                $dataPoints_Tenders=[];

                foreach ($CategorriesAll as $Categorry){ 
                    
                    $offers = OmOffer::cursor()->filter(function ($offer) use ($Categorry) {
                       
                        if($offer->tender!==null){
                            return ($offer->tender->tm_tender_category_id===$Categorry->id);
                        }else{
                            return false;
                        }
                        
                    });

                    $tenders = TmTender::cursor()->filter(function ($tender) use ($Categorry) {
                       
                        if($tender->tm_tender_category_id===$Categorry->id){
                            return true;
                        }else{
                            return false;
                        }
                        
                    });
          
                    if($offers->count()>0){
                        array_push($dataPoints,$offers->count());
                    }if($tenders->count()>0){
                        array_push($dataPoints_Tenders,$tenders->count());
                    }
                   
                    
                }

                $graph= new stdClass;
                $graph->labels=$Categorries;
                $graph->datasets=array(
                    array(
                        "label"=>"Category wise Bids",
                        "data"=>$dataPoints,
                        "fill"=>false,
                        "tension"=>0.4,
                        "borderColor"=>"#ed5565"
                    ),
                    array(
                        "label"=>"Category wise Tenders",
                        "data"=>$dataPoints_Tenders,
                        "fill"=>false,
                        "tension"=>0.4,
                        "borderColor"=>"#23c6c8"
                    )
                );


                return view('account.dashboard.admin',compact('tendersCount','offersApprovedCount','offersPendingCount','graph'));
            }else if($userSession->um_user_role_id==config("global.user_role_vendor")){
                $myoffers=OmOffer::where('vm_vendor_id',$userSession->id);
                $MyoffersCount=count($myoffers->get());

                $offers_approved=$myoffers->where('om_offer_status_id',config("global.offer_status_approved"));
                $offersApprovedCount=count($offers_approved->get());

                $offers_pending=$myoffers->where('om_offer_status_id',config("global.offer_status_pending"));
                $offersPendingCount=count($offers_pending->get());

                $offers_rejected=$myoffers->where('om_offer_status_id',config("global.offer_status_rejected"));
                $offersRejectedCount=count($offers_rejected->get());


                $Categorries=TmTenderCategory::pluck('name')->toArray();
                $CategorriesAll=TmTenderCategory::get();

                $dataPoints_Tenders=[];

                foreach ($CategorriesAll as $Categorry){ 
                    $tenders = TmTender::cursor()->filter(function ($tender) use ($Categorry) {
                        if($tender->tm_tender_category_id===$Categorry->id){
                            return true;
                        }else{
                            return false;
                        }
                    });
          
                    if($tenders->count()>0){
                        array_push($dataPoints_Tenders,$tenders->count());
                    }
                                 
                }

                $graph= new stdClass;
                $graph->labels=$Categorries;
                $graph->datasets=array(
                    array(
                        "label"=>"Category wise Tenders",
                        "data"=>$dataPoints_Tenders,
                        "fill"=>false,
                        "tension"=>0.4,
                        "borderColor"=>"#23c6c8"
                    )
                );

                return view('account.dashboard.user',compact('MyoffersCount','offersApprovedCount','offersPendingCount','offersRejectedCount','graph'));
            }else{
                throw new Exception("Something wrong");
            }

            
        } catch (\Exception $th) {
            dd($th);
          return redirect()->back();
        }
        
    }
}
