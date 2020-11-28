<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\User;
class OrdersController extends Controller
{
    public function store(Request $request) {
        // Store Items 
        $orders_input = $request->order;
        $orders_items_input = $request->orders_items;

        $orders = Orders::create([
            'user_id' => $orders_input['user_id'],
            'addresses_id' => $orders_input['addresses_id'],
            'payment' => $orders_input['payment'],
            'total' => $orders_input['total'],
            'time' => $orders_input['time'],
            'note' => $orders_input['note'],
        ]);

        foreach ($orders_items_input as $order_item) {
            $orderItems = OrderItems::create([
                'orders_id' => $orders->id,
                'items_id' => $order_item['id'],
                'qty' => $order_item['qty'],
                'note' => $order_item['note'],
            ]);
        }

        
        function _IncUserPoints() {
            $user_point = User::where('id',$orders_input['user_id'])->value('point');
            $new_user_point = $user_point + $orders_input['total'];

            User::where('id',$orders_input['user_id'])->update([
                'point' => $new_user_point
            ]);
        }


        _IncUserPoints();

        $order = Orders::where('id',$orders->id)->first();

        return response()->json($order);
    }
}
