<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
      DB::table('users')->insert([
        [
          'id'=>1,
          'name' => 'shira',
          'sex' => '女',
          'email' => 'aaa@aaa',
          'password' => bcrypt('aaaaaaaa'),
          
        ],
        [
            'id'=>2,
            'name' => 'どせいさん',
            'sex' => '男',
            'email' => 'bbb@bbb',
            'password' => bcrypt('aaaaaaaa'),
        ],
        [   
            'id'=> 3,
            'name' => 'とまと',
            'sex' => '女',
            'email' => 'ccc@ccc',
            'password' => bcrypt('aaaaaaaa'),
          ],
          [
            'id'=>4,
            'name' => 'さかな',
            'sex' => '男',
            'email' => 'ddd@ddd',
            'password' => bcrypt('aaaaaaaa'),
          ],
        ]);
        
    }
}
