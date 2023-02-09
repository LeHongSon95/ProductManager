<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_catelogy')->insert([
            ['name' => 'Điện thoại', 'parent_id' => '', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Điện thoại SamSung', 'parent_id' => '1', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Điện thoại Iphone', 'parent_id' => '1', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Điện thoại Oppo', 'parent_id' => '1', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Điện thoại Nokia', 'parent_id' => '1', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Laptop', 'parent_id' => '', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Laptop MacBook', 'parent_id' => '2', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Laptop Dell', 'parent_id' => '2', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Laptop Gamming', 'parent_id' => '2', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Tivi', 'parent_id' => '', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Tivi LCD', 'parent_id' => '3', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Tivi SamSung', 'parent_id' => '3', 'created_at' =>  date("Y-m-d H:i:s")],
            ['name' => 'Tivi Panasonic', 'parent_id' => '3', 'created_at' =>  date("Y-m-d H:i:s")],
            
        ]);
    }
}
