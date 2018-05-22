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
class TagTransformer extends Transformer
{
    /**
     *  This One is for map over single
     * @param $lesson
     * @return array
     */
    public function transform($tag)
    {
        return [
            'name' => $tag['name']
        ];
    }
}
