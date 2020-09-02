<?php

use App\Models\Data;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Data::class, 2)->create([
            "page_uid" => "c9517253-975d-3877-8298-b7a8a8f5a0b5"
        ]);

        factory(Data::class)->create([
            "page_uid" => "2b823c4e-0bb7-3a2b-8b42-a7da7d98c658"
        ]);
    }
}