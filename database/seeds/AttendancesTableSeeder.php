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
                'start_time'            => Carbon::create(2019, 8, 1, 10, 10, 10),
                'end_time'              => Carbon::create(2019, 8, 1, 10, 10, 10),
                'modification_flg'      => 0,
                'modification_reason'   => null,
                'absence_reason'        => null,
                'modification_time'     => null,
                'created_at'            => Carbon::create(2019, 8, 1, 10, 10, 10),
                'updated_at'            => Carbon::create(2019, 8, 1, 10, 10, 10),
                'deleted_at'            => null,
            ]
        ]);
    }
}
