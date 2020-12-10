<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use NotificationChannels\ExpoPushNotifications\ExpoChannel;
use App\Notifications\SendOffers;
use App\Models\User;
class NotificationHandler extends Controller
{

    public function TestSendNotification() {
        $channelName = 'news';
        $recipient= 'ExponentPushToken[5jelL0NkW9g9AgNxK_Wl35]';
        
        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();
        
        // Subscribe the recipient to the server
        $expo->subscribe($channelName, $recipient);
        
        // Build the notification data
        $notification = ['body' => 'Hello World!'];
        
        // Notify an interest with a notification
        $expo->notify([$channelName], $notification);
        
    }
}
