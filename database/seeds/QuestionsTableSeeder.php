<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id' => '4',
                'tag_category_id' => '1',
                'title' => '質問第一号',
                'content' => 'シードファイルによる挿入された文字列です。',
                'created_at' => Carbon::create(2018, 1, 1),
                'updated_at' => Carbon::create(2018, 1, 1),
            ],
        ]);
    }
}
