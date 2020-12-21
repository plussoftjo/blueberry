<?php

namespace App\Http\Controllers\Api\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\NotificationToken;
class OrderControllers extends Controller
{
    public function index($id) {
        $user = User::where('id',$id)->first();
        if($user->role_id == 1){
            $orders = Orders::with('User')->with('Addresses')->orderBy('id','desc')->get();
            return response()->json($orders);
        }
        
        $orders = Orders::with('User')->with('Addresses')->where('driver_id',$user_id)->get();

        return response()->json($orders);
    }

    public function MainIndex() {
        $users = User::get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function changeUser(Request $request) {
        $orders = Orders::where('id',$request->order_id)->update([
            'driver_id' => $request->user_id
        ]);
    }

    public function changeState(Request $request) {
        $orders = Orders::with('User')->with('Addresses')->where('id',$request->order_id)->update([
            'status' => $request->status
        ]);

        $order = Orders::with('User')->with('Addresses')->where('id',$request->order_id)->first();

        return response()->json($order);
    }

    public function getWithPaig() {
        $orders = Orders::with('User')->with('Addresses')->orderBy('id','desc')->paginate(10);

        return response()->json($orders);
    }

    public function getToken() {
        return response()->json(NotificationToken::pluck('token'));
    }
}
