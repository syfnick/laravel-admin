<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('zh_CN');

        $userIds = \App\User::lists('id')->all();
        $categoryIds = \App\Category::lists('id')->all();

        foreach (range(1, 150) as $index) {
            $article = \App\Article::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph(20),
                'click' => $faker->numberBetween(100, 9000),
                'slug' => $faker->unique()->slug,
                'category_id' => $faker->randomElement($categoryIds),
                'user_id' => $faker->randomElement($userIds),
                'original' => $faker->optional(0.5)->url,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
                'deleted_at' => $faker->optional(0.1)->dateTimeThisYear(),
            ]);

            //$article->tags()->sync($tags);
        }
    }
}
