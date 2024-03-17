<?php

namespace App\Http\Controllers;
use App\Events\Notif;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function GetNotification()
    {
        $notifications = Notification::all();
        return response()->json(["data"=>$notifications],200);
    }

    public function store(NotificationRequest $request)
    {

        Notification::create([
            "description"=>$request->description,
            "facture_id"=>$request->facture_id,
        ]);

        return response()->json(["message"=>"Notification Created"],201);
    }

    public function finById($id)
    {
        $Notification=Notification::find($id);
        if($Notification){
            return response()->json(["data"=>$Notification],200);
        }else{
            return response()->json(["message"=>"Notification Not Found"],404);
        }
    }

    public function update(NotificationRequest $request, $id)
    {

        $Notification = Notification::find($id);
        if($Notification){

            $Notification->update([
                "description"=>$request->description,
                "facture_id"=>$request->facture_id,
            ]);

            return response()->json(["message"=>"Notification Updated"],200);

        }else{
            return response()->json(["message"=>"Notification Not Found"],404);
        }
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if($notification){
            $notification->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Notification Not Found"],404);
        }
    }
}
