<?php

namespace App\Http\Controllers;

use App\Handlers\Transformers\TagTransformer;
use App\Lesson;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Class TagsController
 * @package App\Http\Controllers
 */
class TagsController extends ApiController
{
    /**
     * @var TagTransformer
     */
    protected $tagTransformer;

    /**
     * TagsController constructor.
     * @param $tagTransformer
     */
    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }


    /**
     * @param null $lessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($lessonId = null)
    {
        $tags = $this->getTags($lessonId);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
        ]);
    }

    /**
     * @param $lessonId
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTags($lessonId)
    {
        return $tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();
    }
}
