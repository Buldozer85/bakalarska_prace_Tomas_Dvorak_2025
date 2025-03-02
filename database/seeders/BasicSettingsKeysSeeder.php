<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicSettingsKeysSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('website_settings')->insert([
            'key' => 'opening.days.shortcuts',
            'value' => 'PO,ÚT,ST,ČT,PÁ,SO',
        ]);

        DB::table('website_settings')->insert([
            'key' => 'opening.start',
            'value' => '8:00',
        ]);

        DB::table('website_settings')->insert([
            'key' => 'opening.end',
            'value' => '18:00',
        ]);
    }
}
