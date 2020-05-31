<?php

use Illuminate\Database\Seeder;

class Notice_Post_ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('notice_post_actions')->insert([

            [
                'id'=>1,
                'user_id'=>1,
                'fish_record_id'=>4,
                'state'=>1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]

        ]);
    }
}
