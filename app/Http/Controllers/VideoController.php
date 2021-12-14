<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function getVideos()
    {
        try {
            return response()->json(['videos' => Video::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getVideo($id)
    {
        try {
            return response()->json(['video' => Video::find($id)]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createVideo(Request $request)
    {
        $validated = $request->validate([
            'videoUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $video = Video::create($request->all());

            return response()->json(['video succesfully created' => $video]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateVideo(Request $request, $id)
    {

        $validated = $request->validate([
            'videoUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $video = Video::where('id', $id)->first();
            $video->update($request->all());
            return response()->json(['video succesfully updated' => $video]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteVideo($id)
    {
        try {

            $video = Video::find($id)->delete();
            return response()->json(['video deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}