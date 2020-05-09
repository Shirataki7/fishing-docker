<?php

use Illuminate\Database\Seeder;

class Fish_recordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fish_records')->insert([
            [   
                'id'=>1,
                'user_id'=>1,
                'fishing_date'=>'2020-04-04',
                'harbor'=>'東京湾',
                'ship'=>'真田丸',
                'fish_name'=>'アジ',
                'size'=>20,
                'other_fish'=>'鯖',
                'weather'=>'晴れ',
                'temperature'=>18,
                'depth'=>15,
                'tool'=>'サビキ',
                'tackle'=>'ライトタックル',
                'fish_image'=>null,
                'memo'=>'20枚釣れた',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [   'id'=>2,
                'user_id'=>1,
                'fishing_date'=>'2020-03-05',
                'harbor'=>'神奈川県真鶴港',
                'ship'=>'富丸',
                'fish_name'=>'カワハギ',
                'size'=>20,
                'other_fish'=>'トラギス',
                'weather'=>'晴れ',
                'temperature'=>14,
                'depth'=>20,
                'tool'=>'サビキ',
                'tackle'=>'カワハギX',
                'fish_image'=>null,
                'memo'=>'5枚釣れた',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id'=>3,
                'user_id'=>2,
                'fishing_date'=>'2020-03-7',
                'harbor'=>'真鶴',
                'ship'=>'里丸',
                'fish_name'=>'アマダイ',
                'size'=>20,
                'other_fish'=>'',
                'weather'=>'晴れ',
                'temperature'=>14,
                'depth'=>20,
                'tool'=>'サビキ',
                'tackle'=>'ライト',
                'fish_image'=>null,
                'memo'=>'14枚釣れた',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id'=>4,
                'user_id'=>3,
                'fishing_date'=>'2020-03-09',
                'harbor'=>'神奈川県真鶴港',
                'ship'=>null,
                'fish_name'=>'カワハギ',
                'size'=>null,
                'other_fish'=>null,
                'weather'=>'晴れ',
                'temperature'=>14,
                'depth'=>20,
                'tool'=>'サビキ',
                'tackle'=>null,
                'fish_image'=>null,
                'memo'=>'5枚釣れた',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
    }
}
