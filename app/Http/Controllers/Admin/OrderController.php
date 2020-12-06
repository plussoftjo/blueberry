<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\Addresses;
use App\Models\OrderItems;
use App\Models\GoodsBasket;
use App\Models\DeliverFee;

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

    public function BasketOfGoodsGet() {
        $goodsbasket = GoodsBasket::first();
        if($goodsbasket !== null) {
            return response()->json($goodsbasket);
        }else {
            $goods_basket = GoodsBasket::create([
                'amount' => 0,
                'complete' => 0,
                'qty' => 0
            ]);
            return response()->json($goods_basket);
        }
    }

    public function ChangeGoodsBasketValue(Request $request) {
        $goodsbasket = GoodsBasket::where('id',$request->id)->update([
            'amount' => $request->amount,
            'complete' => $request->complete,
            'qty' => $request->qty
        ]);
    }

    public function GetDeliveryFee() {
        $deliver_fee = DeliverFee::first();

        if($deliver_fee !== null) {
            return response()->json($deliver_fee);
        }else {
            $deliver_fee = DeliverFee::create([
                'fee' => 2
            ]);
            return response()->json($deliver_fee);
        }
    }

    public function SetDeliverFee(Request $request) {
        $deliver_fee = DeliverFee::where('id',$request->id)->update([
            'fee' => $request->fee
        ]);

    }
}
