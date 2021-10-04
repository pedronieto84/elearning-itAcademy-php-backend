<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function getModules()
    {
        return response()->json(['title' => 'getModules']);
    }

    public function getModule($id)
    {
        return response()->json(['title' => 'getModule']);
    }

    public function createModule(Request $request)
    {
        return response()->json(['title' => 'createModule']);
    }

    public function updateModule(Request $request, $id)
    {
        return response()->json(['title' => 'updateModule']);
    }

    public function deleteModule($id)
    {
        return response()->json(['title' => 'deleteModule']);
    }

}
