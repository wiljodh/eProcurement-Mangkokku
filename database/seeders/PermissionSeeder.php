<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\PmPermissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_permissions=[
            //admin permissions
            ["id"=>1000,"permission"=>"Create/Edit Tender Categories","tab_name"=>"Tender Categories",'url_path'=>'tender/categorries','is_tab'=>1,'order_no'=>1],
            ["id"=>1001,"permission"=>"Create Tender","tab_name"=>"Create Tender",'url_path'=>'tender/new','is_tab'=>1,'order_no'=>2],
            ["id"=>1002,"permission"=>"List Unpublished/Draft Tenders","tab_name"=>"Draft Tenders",'url_path'=>'tender/drafts','is_tab'=>1,'order_no'=>3],
            ["id"=>1003,"permission"=>"View Tender Bids","tab_name"=>"Tender Bids",'url_path'=>'tender/bids','is_tab'=>1,'order_no'=>4],
            ["id"=>1004,"permission"=>"Active/Block users","tab_name"=>"User Management",'url_path'=>'user-management','is_tab'=>1,'order_no'=>5],

           
            //vendor permissions
            ["id"=>2000,"permission"=>"View all bids of user","tab_name"=>"View My Bids",'url_path'=>'my-account/bids','is_tab'=>1,'order_no'=>2000],
            ["id"=>2001,"permission"=>"View all approved of user","tab_name"=>"Approved Bids",'url_path'=>'my-account/approved-bids','is_tab'=>1,'order_no'=>2001],
            
            ["id"=>2100,"permission"=>"Create Offer","tab_name"=>"Create Offer",'url_path'=>'','is_tab'=>0,'order_no'=>2100],
            
   
        ];

        foreach ($ar_permissions as $permission) {
            PmPermissions::updateOrCreate([
                'id' => $permission['id']
            ],$permission);
        }
    }
}
