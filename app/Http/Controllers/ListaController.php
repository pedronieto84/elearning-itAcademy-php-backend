<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class ListaController extends Controller
{

    public function getListas()
    {
        try {
            return response()->json(['listas' => Lista::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getLista($id)
    {
        try {
            return response()->json(['lista' => Lista::find($id)]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createLista(Request $request)
    {
        $validated = $request->validate([
            'listaUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $lista = Lista::create($request->all());

            return response()->json(['lista succesfully created' => $lista]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateLista(Request $request, $id)
    {

        $validated = $request->validate([
            'listaUrl' => 'required',
            'subTitle' => 'required',
        ]);

        try {

            $lista = Lista::where('id', $id)->first();
            $lista->update($request->all());
            return response()->json(['lista succesfully updated' => $lista]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteLista($id)
    {
        try {

            $lista = Lista::find($id)->delete();
            return response()->json(['lista deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}