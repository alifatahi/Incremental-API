<?php

use App\Lesson;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{

    /**
     * @var array
     */
    private $tables = [
        'lessons',
        'tags',
        'lesson_tag'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        $this->call(LessonsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(LessonTagTableSeeder::class);
    }

    /**
     *
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
