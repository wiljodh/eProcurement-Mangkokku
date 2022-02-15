<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TmTenderCategory;


class TenderCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar_tender_categorries=[
            ["id"=>1,"name"=>"Computer Software","symble"=>"CS","active"=>1,"icon"=>"fa fa-desktop"],
            ["id"=>2,"name"=>"Building Materials","symble"=>"BM","active"=>1,"icon"=>"fa fa-building"],
            ["id"=>3,"name"=>"Chemicals","symble"=>"CHEM","active"=>1,"icon"=>"fa fa-flask"],
            ["id"=>4,"name"=>"Electronics","symble"=>"ELEC","active"=>1,"icon"=>"fa fa-plug"],
            ["id"=>5,"name"=>"Civil Works","symble"=>"CIVIL","active"=>1,"icon"=>"fa fa-users"],
            ["id"=>6,"name"=>"Insurence Services","symble"=>"INSUR","active"=>1,"icon"=>"fa fa-heart"],
            ["id"=>7,"name"=>"Painting","symble"=>"PAINT","active"=>1,"icon"=>"fa fa-paint-brush"],
            ["id"=>8,"name"=>"Dairy Products","symble"=>"DIARY","active"=>1,"icon"=>"fa fa-bitbucket"],
        ];

        foreach ($ar_tender_categorries as $tender_category) {
            TmTenderCategory::updateOrCreate([
                'id' => $tender_category['id'],
                'name' => $tender_category['name'],
                'symble' => $tender_category['symble'],
                'active' => $tender_category['active'],
                'icon' => $tender_category['icon'],
            ],$tender_category);
        }
    }
}
