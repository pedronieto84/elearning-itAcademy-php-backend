<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function getCards()
    {
        try {
            return response()->json(['cards' => Card::all()]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

    public function getCard($id)
    {
        try {
            return response()->json(['card' => Card::find($id)]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function createCard(Request $request)
    {
        $validated = $request->validate([
            'cardType' => 'required',
        ]);

        try {

            $card = Card::create($request->all());

            return response()->json(['card succesfully created' => $card]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function updateCard(Request $request, $id)
    {

        $validated = $request->validate([
            'cardType' => 'required',
        ]);

        try {

            $card = Card::where('id', $id)->first();
            $card->update($request->all());
            return response()->json(['card succesfully updated' => $card]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
    }

    public function deleteCard($id)
    {
        try {

            $card = Card::find($id)->delete();
            return response()->json(['card deleted' => true]);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        };
        
    }

}
