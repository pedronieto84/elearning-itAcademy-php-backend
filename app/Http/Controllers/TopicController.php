<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Lista;
use App\Models\Test;
use App\Models\Text;
use App\Models\Video;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function getTopics()
    {
        try {
            return response()->json(['topics' => Topic::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getTopic($id)
    {
        try {

            return response()->json([
                'topic' => Topic::find($id),
                'lista' => Lista::where('topic_id', $id)->get(),
                'test' => Test::where('topic_id', $id)->get(),
                'text' => Text::where('topic_id', $id)->get(),
                'video' => Video::where('topic_id', $id)->get(),
            ]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createTopic(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'position' => 'required',
        ]);

        try {

            $topic = Topic::create($request->all());

            return response()->json(['topic succesfully created' => $topic]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateTopic(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required',
            'position' => 'required',
        ]);

        try {

            $topic = Topic::where('id', $id)->first();
            $topic->update($request->all());
            return response()->json(['topic succesfully updated' => $topic]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteTopic($id)
    {
        try {

            $topic = Topic::find($id)->delete();
            return response()->json(['topic deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}
