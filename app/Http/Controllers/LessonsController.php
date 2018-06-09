<?php

namespace App\Http\Controllers;

use App\Handlers\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

/**
 * Class LessonsController
 * @package App\Http\Controllers
 */
class LessonsController extends ApiController
{
    /*
     * Status Code:
     * 200 to end is Success
     * 300 to end is Redirect
     * 400 to end is Not Found
     * 500 to end is Server Error
     *
     */


    /**
     * @var Handlers\Transformers\LessonTransformer
     */
    protected $lessonTransformer;

    /**
     * LessonsController constructor.
     * @param Handlers\Transformers\LessonTransformer $lessonTransformer
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic', ['only' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?: 3;
        $lessons = Lesson::paginate($limit);

//        use Our Method For Pagination in API Class
        return $this->respondWithPagination($lessons, [
            'data' => $this->lessonTransformer->transformCollection($lessons->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        if (!Request::input('title') or !Request::input('body')) {
            return $this->setStatusCode(422)
                ->respondWithError('Parameters failed validation for a lesson.');
        }

        Lesson::create(Request::all());

        return $this->respondCreated('Lessons Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return $this->respondNotFound('Lesson Does Not Exists');
        }

        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }
}
