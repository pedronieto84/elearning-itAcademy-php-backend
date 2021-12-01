<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;

class CourseController extends Controller
{

    public function getCourses()
    {
        try {
            return response()->json(['courses' => Course::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getCourse($id)
    {
        try {
            $course = Course::find($id);
            return response()->json(['course' => $course, 'modules' => Module::where('course_id', $id)->get()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imaginUrl' => 'required',
            'route' => 'required',
        ]);

        try {

            $course = Course::create($request->all());

            return response()->json(['course succesfully created' => $course]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateCourse(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imaginUrl' => 'required',
            'route' => 'required',
        ]);

        try {

            $course = Course::where('id', $id)->first();
            $course->update($request->all());
            return response()->json(['course succesfully updated' => $course]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteCourse($id)
    {
        try {

            $course = Course::find($id)->delete();
            return response()->json(['course deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}
