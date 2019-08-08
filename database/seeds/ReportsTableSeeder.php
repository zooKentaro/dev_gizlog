<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->truncate();
        DB::table('reports')->insert([
          [
            'title' => 'test',
            'created_at' => Carbon::create(2018, 1, 1),
            'updated_at' => Carbon::create(2018, 1, 4),
            'user_id' => 4,
            'contents'=> 'text',
            'reporting_time'=> Carbon::create(2018, 1, 1, 1, 1, 1),
            'deleted_at'=> 'NULL',
          ]
        ]);
    }
}
