<?php

use App\Lesson;
use Tests\ApiTester;


/**
 * Class LessonsTest
 *  That Test Our Lessons
 */
class LessonsTest extends ApiTester
{

    /**
     * @test
     *  Test All Lessons pass
     *
     */
    public function it_fetches_lessons()
    {
//        Make Lesson
        $this->times(5)->makeLesson();
//      Get URL we want to test
        $this->getJson('api/v1/lessons');
//        Pass Ok Response
        $this->assertResponseOk();


    }

    public function test_if_it_fetches_single_lesson()
    {
        $this->makeLesson();
        $response = $this->json('GET', 'api/v1/lessons/1');
        $response->assertStatus(200)->assertJson([
            'data' => [
                'title' => true,
                'body' => true,
                'active' => true
            ]
        ]);
    }

    /**
     * Make Lesson method
     * @param array $lessonFields
     */
    private function makeLesson($lessonFields = [])
    {
        $lesson = array_merge([
            'title' => $this->fake->sentence,
            'body' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ], $lessonFields);

        while ($this->times--) Lesson::create($lesson);
    }

}
