<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report')->truncate();
        DB::table('report')->insert([
          [
            'title' => 'test',
            'created_at' => Carbon::create(2018, 1, 1),
            'updated_at' => Carbon::create(2018, 1, 4),
            'user_id' => 4,
            'contents'=>'text',
            'reporting_time'=>Carbon::create(2018,1,1),
            'deleted_at'=>Carbon::create(NULL),
          ]
        ]);
    }
}
