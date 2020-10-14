<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        factory(User::class,20)->create();

        factory(Profile::class, 20)->create();
    }
}
