<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\User::class, 500)->create();

        factory(App\Concert::class, 150)->create();

        $categories = App\Category::all();
        $concerts = App\Concert::all();

        App\User::all()->each(function($user) use ($concerts) {
            $user->favorites()->attach(
                $concerts->random(rand(0,5))->pluck('id')->toArray()
            );
        });

        App\User::where("role", "2")->each(function($user) use ($categories, $concerts) {
            $user->concerts()->attach(
                $concerts->random(rand(0,30))->pluck('id')->toArray()
            );
            $user->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')->toArray()
            );
        });

        App\Concert::all()->each(function($concert) use ($categories){
            $concert->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')->toArray()
            );
        });

    }
}
