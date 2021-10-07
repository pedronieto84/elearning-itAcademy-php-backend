<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Module;
use App\Models\Topic;


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
            return response()->json(['module' => $module, 'topics' => Topic::where('module_id', $id)->get()]);

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