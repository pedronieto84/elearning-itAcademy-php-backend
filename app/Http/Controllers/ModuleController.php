<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Module;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Lista;
use App\Models\Test;
use App\Models\Text;


class ModuleController extends Controller
{

    public function getModules()
    {
        try {
            return response()->json(['modules' => Module::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getModule($id)
    {


        try {
            $module = Module::find($id);
            
            $allTopics = Topic::where('module_id', $id)->get();


            // It will include the topic and its cardType (along with the card type info)
            function topicCard($topicsArray)
            {
               
                $arrayTopicCard = array();

                foreach ( $topicsArray as $top) {

                    if ( $top->cardType == 'video') {
                        $card = Video::find($top->video_id);
                    } elseif ( $top->cardType == 'lista' ) {
                        $card = Lista::find($top->lista_id);
                    } elseif ( $top->cardType == 'test' ) {
                        $card = Test::find($top->test_id);
                    } elseif ($top->cardType == 'text') {
                        $card = Text::find($top->text_id);
                    } else {
                        $card = 'no match';
                    }

                    array_push($arrayTopicCard, array('topic' => $top, 'card' => $card));
                }

                return $arrayTopicCard;
            }

            $topics = topicCard($allTopics);

            return response()->json([
                'module' => $module,
                'topics' => $topics,
            ]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createModule(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imaginUrl' => 'required',
            'route' => 'required',
        ]);

        try {

            $module = Module::create($request->all());

            return response()->json(['module succesfully created' => $module]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateModule(Request $request, $id)
    {
        dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imaginUrl' => 'required',
            'route' => 'required',
        ]);
     
        try {

            $module = Module::where('id', $id)->first();

            $module->update($request->all());
            return response()->json(['module succesfully updated' => $module]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteModule($id)
    {
        try {

            $module = Module::find($id)->delete();
            return response()->json(['module deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}