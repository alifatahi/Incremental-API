<?php

namespace App\Http\Controllers;

use App\Lesson;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class LessonsController
 * @package App\Http\Controllers
 */
class LessonsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();

        return Response::json([
            'data' => $this->transformCollection($lessons)
        ], 200);
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
    public function store(Request $request)
    {
        //
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
            return Response::json([
                'message' => 'Lesson Not Found'
            ], 404);
        }

        return Response::json([
            'data' => $this->transform($lesson->toArray())
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * This one for Collection
     * @param $lessons
     * @return array
     */
    private function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }

    /**
     *  This One is for map over single
     * @param $lesson
     * @return array
     */
    private function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'body' => $lesson['body'],
            'active' => (boolean)$lesson['some_bool'],
        ];
    }
}
