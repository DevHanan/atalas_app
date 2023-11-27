<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use DB;


class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $user = Setting::create([
            'id' =>'1',
            'title'=>'أكلس',
            'email'=>'admin@mail.com',
            'phone'=> '1234', 
        ]);

    }
}
