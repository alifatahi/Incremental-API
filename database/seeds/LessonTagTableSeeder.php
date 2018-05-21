<?php

use App\Lesson;
use App\Tag;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
//Because Our Lessons and Tags Table has Different Number of data we check
        $lessonIds = Lesson::pluck('id')->all();
        $tagIds = Tag::pluck('id')->all();

        foreach (range(1, 30) as $index) {
//            Insert To Table
            DB::table('lesson_tag')->insert([
//                Pass Lesson ID use Random Element With Lesson ID
                'lesson_id' => $faker->randomElement($lessonIds),
//                Pass Tag ID use Random Element With Tag ID
                'tag_id' => $faker->randomElement($tagIds),
            ]);
        }
    }
}
