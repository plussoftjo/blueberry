<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\NotificationToken;
class NotificationHandler extends Controller
{

    public function SendNotifiaction(Request $request) {

        // $notification_tokens = NotificationToken::get();

        // foreach ($notification_tokens as $token) {
        //     $channelName = 'offers';
        //     $recipient= $token->token;
            
        //     // You can quickly bootup an expo instance
        //     $expo = \ExponentPhpSDK\Expo::normalSetup();
            
        //     // Subscribe the recipient to the server
        //     $expo->subscribe($channelName, $recipient);
            
        //     // Build the notification data
        //     $notification = ['title' => $request->title,'body' => $request->body];
            
        //     // Notify an interest with a notification
        //     $expo->notify([$channelName], $notification);
        // }

       
        
    }
    public function getToken() {
        return response()->json(NotificationToken::pluck('token'));
    }
}
