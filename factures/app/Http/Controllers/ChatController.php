<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function GetChat()
    {
        $Chats = Chat::all();
        return response()->json(["data"=>$Chats],200);
    }

    public function store(ChatRequest $request)
    {

        Chat::create([
            "message"=>$request->message,
            "emetteur_id"=>$request->emetteur_id,
            "recepteur_id"=>$request->recepteur_id,
        ]);

        return response()->json(["message"=>"Chat Created"],201);
    }

    public function finById($id)
    {
        $Chat=Chat::find($id);
        if($Chat){
            return response()->json(["data"=>$Chat],200);
        }else{
            return response()->json(["message"=>"Chat Not Found"],404);
        }
    }

    public function update(ChatRequest $request, $id)
    {

        $Chat = Chat::find($id);
        if($Chat){

            $Chat->update([
                "message"=>$request->message,
                "emetteur_id"=>$request->emetteur_id,
                "recepteur_id"=>$request->recepteur_id,
            ]);

            return response()->json(["message"=>"Chat Updated"],200);

        }else{
            return response()->json(["message"=>"Chat Not Found"],404);
        }
    }

    public function destroy($id)
    {
        $chat = Chat::find($id);
        if($chat){
            $chat->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Chat Not Found"],404);
        }
    }
}
