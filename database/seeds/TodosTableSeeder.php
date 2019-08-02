<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('todos')->truncate();
        DB::table('todos')->insert([
		[
	        'title' => 'test',
            'created_at' => Carbon::create(2018, 1, 1),
		    'updated_at' => Carbon::create(2018, 1, 4),
		    'user_id' => Carbon::create(1),
		    'content'=>'text',
		    'reporting_time'=>Carbon::create(2018,1,1),
		    'deleted_at'=>Carbon::create(NULL),
		]
	]);
    }
}
