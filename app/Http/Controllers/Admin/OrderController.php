<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\Addresses;
use App\Models\OrderItems;

class OrderController extends Controller
{
    public function index() {
        return view('Order');
    }

    public function GetIndex() {
        $orders = Orders::orderBy('id','desc')->get();

        return response()->json($orders);
    }

    public function ShowOrder($id) {

        $order = Orders::where('id',$id)->first();
        $user = User::where('id',$order->user_id)->first();
        $address = Addresses::where('id',$order->addresses_id)->first();
        $order_items = OrderItems::where('orders_id',$order->id)->get();
        return response()->json([
            'order' => $order,
            'user' => $user,
            'address' => $address,
            'order_items' => $order_items
        ]);

    }

    public function UpdateStatus(Request $request) {
        $order = Orders::where('id',$request->order_id)->update([
            'status' => $request->status
        ]);
    }
}
