<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{

    public function getTexts()
    {
        try {
            return response()->json(['texts' => Text::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getText($id)
    {
        try {
            return response()->json(['text' => Text::find($id)]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createText(Request $request)
    {
        $validated = $request->validate([
            'textUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $text = Text::create($request->all());

            return response()->json(['text succesfully created' => $text]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateText(Request $request, $id)
    {

        $validated = $request->validate([
            'textUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $text = Text::where('id', $id)->first();
            $text->update($request->all());
            return response()->json(['text succesfully updated' => $text]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteText($id)
    {
        try {

            $text = Text::find($id)->delete();
            return response()->json(['text deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}