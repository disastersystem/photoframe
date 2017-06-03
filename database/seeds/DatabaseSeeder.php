<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Trip::class, 6)->create();
        // factory(App\TripActivity::class, 8)->create();

        factory(App\Trip::class, 2)->create()->each(function($u) {
            $u->tripActivities()->save(factory(App\TripActivity::class)->make());
            $u->tripActivities()->save(factory(App\TripActivity::class)->make());
        });
    }
}
