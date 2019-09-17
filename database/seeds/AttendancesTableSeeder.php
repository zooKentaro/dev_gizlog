<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->truncate();
        DB::table('attendances')->insert([
            [
                'user_id'               => 4,
                'start_time'            => Carbon::now(),
                'end_time'              => Carbon::now(),
                'modification_flg'      => 0,
                'modification_reason'   => null,
                'absence_reason'        => null,
                'modification_time'     => null,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
                'deleted_at'            => null,
            ]
        ]);
    }
}
