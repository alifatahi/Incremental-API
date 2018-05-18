<?php
/**
 * Created by PhpStorm.
 * User: West
 * Date: 5/18/2018
 * Time: 3:44 PM
 */

namespace App\Handlers\Transformers;

/**
 * Class LessonTransformer
 * @package App\Handlers\Transformers
 */
class LessonTransformer extends Transformer
{
    /**
     *  This One is for map over single
     * @param $lesson
     * @return array
     */
    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'body' => $lesson['body'],
            'active' => (boolean)$lesson['some_bool'],
        ];
    }
}
