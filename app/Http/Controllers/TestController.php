<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function getTests()
    {
        try {
            return response()->json(['tests' => Test::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getTest($id)
    {
        try {
            return response()->json(['test' => Test::find($id)]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createTest(Request $request)
    {
        $validated = $request->validate([
            'testUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $test = Test::create($request->all());

            return response()->json(['test succesfully created' => $test]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateTest(Request $request, $id)
    {

        $validated = $request->validate([
            'testUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $test = Test::where('id', $id)->first();
            $test->update($request->all());
            return response()->json(['test succesfully updated' => $test]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteTest($id)
    {
        try {

            $test = Test::find($id)->delete();
            return response()->json(['test deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}