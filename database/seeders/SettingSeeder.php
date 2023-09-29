<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'key' => 'Site_Name',
            'value' => 'Goldu',
        ]);
        DB::table('settings')->insert([
            'key' => 'Site_Description',
            'value' => 'Boost affiliate marketing success with our private affiliate network. Create customized links, access comprehensive reports, and maximize earnings. Join us today!',
        ]);
        DB::table('settings')->insert([
            'key' => 'Default_Fee',
            'value' => '30',
        ]);
        DB::table('settings')->insert([
            'key' => 'Activation_Link',
            'value' => 'https://t.me/id241097',
        ]);
        DB::table('settings')->insert([
            'key' => 'IP_Dns',
            'value' => '127.0.0.1',
        ]);
        DB::table('settings')->insert([
            'key' => 'Default_Promotion',
            'value' => 'https://www.youtube.com/@gulalidesa',
        ]);
        DB::table('settings')->insert([
            'key' => 'Default_Offer',
            'value' => 'https://jhcbbi.hornylocls.com/s/607fbb1ac7fe5',
        ]);
    }
}
