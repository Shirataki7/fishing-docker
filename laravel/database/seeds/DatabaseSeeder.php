<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class
        ]);
        $this->call([
            Fish_recordsTableSeeder::class
        ]);
        $this->call([
            Notice_Friend_ActionsSeeder::class
        ]);
        $this->call([
            Notice_Post_ActionsTableSeeder::class
        ]);
    }
}
