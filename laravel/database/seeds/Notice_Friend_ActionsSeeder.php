<?php

use Illuminate\Database\Seeder;

class Notice_Friend_ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_friend_actions')->insert([

            [
                'id'=>1,
                'user_id'=>3,
                'added_friend_id'=>1,
                'state'=>1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]

        ]);
    }
}
