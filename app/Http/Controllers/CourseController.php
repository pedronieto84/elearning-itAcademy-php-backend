<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function getCourses()
    {
        return response()->json(['title' => 'getCourses']);
    }

    public function getCourse($id)
    {
        return response()->json(['title' => 'getCourse']);
    }

    public function createCourse(Request $request)
    {
        return response()->json(['title' => 'createCourse']);
    }

    public function updateCourse(Request $request, $id)
    {
        return response()->json(['title' => 'updateCourse']);
    }

    public function deleteCourse($id)
    {
        return response()->json(['title' => 'deleteCourse']);
    }

}
