<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Model\Post;
use App\Model\Category;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 30; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->sentence(6, true);
            $newPost->content = $faker->paragraph(6, true);
            $title = "$newPost->title-$i";
            $newPost->slug = Str::slug($title, '-');
            $newPost->user_id = User::inRandomOrder()->first()->id;
            $newPost->category_id = Category::inRandomOrder()->first()->id;
            $newPost->save();
        }
    }
}
