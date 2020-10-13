<?php

use App\Category;
use Illuminate\Database\Seeder;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugger = new AsciiSlugger();
        $categories = ["rock", "jazz", "pop", "opera", "electro", "dubstep", "dance", "funk", "blues", "country", "disco", "gospel", "K Pop"];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => $slugger->slug($category)
            ]);
        }
    }
}
