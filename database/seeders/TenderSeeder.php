<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Http\Traits\CommonTrait;

use App\Models\TmTender;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class TenderSeeder extends Seeder
{
    use CommonTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    
        Storage::deleteDirectory("upload_files");
       
        for ($i = 0; $i < 30; $i++) {
            $start=Carbon::now()->subDays(rand(1,20));
            $end=Carbon::parse($start)->addDays(rand(1,20));



            $maxId=TmTender::max("id");

            $tenderId=$this->common_generate_next_tender_no($maxId);

            $tender=["id"=>$tenderId,"title"=>"Sample Tender".$i,"description"=>"This is sample description","start_date"=>$start->format('Y-m-d 00:00:00'),"end_date"=>$end->format('Y-m-d 23:59:59'),"tm_tender_status_id"=>config("global.tender_publish"),"crby"=>0,"location"=>"Test Location","tm_tender_category_id"=>rand(1,8),"deposit"=>5000,"estimate_cost"=>rand(50000,100000)];
            
            TmTender::updateOrCreate([
                'id' => $tender["id"]
            ],$tender);
        }
    }
}
