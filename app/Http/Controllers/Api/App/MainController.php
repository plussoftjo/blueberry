<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Items;
use App\Models\DeliveryTime;
use App\Models\DiscountCodes;
use App\Models\Orders;
use App\Models\GoodsBasket;
use Illuminate\Support\Facades\DB;
use App\Models\DeliverFee;
use App\Models\NotificationToken;
class MainController extends Controller
{
    public function index() {
        $categories = Categories::with('translations')->get();
        $top_items = Items::with('translations')->take(15)->inRandomOrder()->get();

        $items= Items::with('translations')->take(20)->inRandomOrder()->get();

        $offers_items = Items::with('translations')->take(15)->inRandomOrder()->where('discount','!=',0.00)->get();

        $new_items = Items::with('translations')->take(15)->inRandomOrder()->where('new_item',1)->get();

        $deliverTime = DeliveryTime::orderBy('time','asc')->get();

        $goods_basket = GoodsBasket::first();

        $deliver_fee = DeliverFee::first();

        if($goods_basket !== null) {
            
        }else {
            $goods_basket = GoodsBasket::create([
                'amount' => 0,
                'complete' => 0,
                'qty' => 0
            ]);
        }

        if($deliver_fee !== null) {
            
        }else {
            $deliver_fee = DeliverFee::create([
                'fee' => 0
            ]);
        }

        return response()->json([
            'categories' => $categories,
            'top_items' => $top_items,
            'items' => $items,
            'deliverTime' => $deliverTime,
            "offers_items" => $offers_items,
            "new_items" => $new_items,
            'goods_basket' => $goods_basket,
            'deliver_fee' => $deliver_fee
        ]);
    }

    public function getItemsWithCategoryId($id) {
        $items = Items::with('translations')->where('categories_id',$id)->get();

        return response()->json($items);
    }

    public function search(Request $request) {
        $_itemsSearch = Items::where('title','like','%'.$request->searchText.'%')->pluck('id');
        $_translationsItems = DB::table('translations')
        ->where('table_name','items')
        ->where('column_name','title')
        ->where('value','like','%'.$request->searchText.'%')->pluck('foreign_key');

        // return response()->json(count($_translationsItems));
        if(count($_itemsSearch) == 0 && count($_translationsItems) == 0) {

        return response()->json([]);
        }else if(count($_itemsSearch) >= 1) {
            $items = Items::with('translations')->whereIn('id',$_itemsSearch)->get();
            return response()->json($items);
        }else if(count($_translationsItems) >= 1) {
            $items = Items::with('translations')->whereIn('id',$_translationsItems)->get();
            return response()->json($items);
        }

        // $ids = array_merge($_itemsSearch,$_translationsItems);

        // $items = Items::whereIn('id',$ids)->get();
        // return response()->json($items);
    }

    public function checkCode(Request $request) {
        $code = $request->code;
        $discount_code = DiscountCodes::where('code',$code)->first();
        if($discount_code !== null) {
            $order = Orders::where('discount_id',$discount_code->id)->where('user_id',$request->user_id)->first();
            if($order === null) {
                return response()->json([
                    'status' => 0, // Not Use Avaiable
                    'discount_code' => $discount_code
                ]);
            }else {
                return response()->json([
                    'status' => 1 // User Before
                ]);
            }
        }else {
            return response()->json([
                'status' => 2   // Not Abailable
            ]);
        }

    }

    public function SaveNotificationToken(Request $request) {

        $_checker = NotificationToken::where('token',$request->token)->first();

        if($_checker == null) {
            $NotificationToken = NotificationToken::create([
                'token' => $request->token
            ]);

            return response()->json($NotificationToken);

        }
    }

    

}
