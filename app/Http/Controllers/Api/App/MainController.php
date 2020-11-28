<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Items;
use App\Models\DeliveryTime;
class MainController extends Controller
{
    public function index() {
        $categories = Categories::get();
        $top_items = Items::take(15)->inRandomOrder()->get();

        $items= Items::take(20)->inRandomOrder()->get();

        $offers_items = Items::take(15)->inRandomOrder()->where('discount','!=',0.00)->get();

        $new_items = Items::take(15)->inRandomOrder()->where('new_item',1)->get();

        $deliverTime = DeliveryTime::get();

        return response()->json([
            'categories' => $categories,
            'top_items' => $top_items,
            'items' => $items,
            'deliverTime' => $deliverTime,
            "offers_items" => $offers_items,
            "new_items" => $new_items
        ]);
    }

    public function getItemsWithCategoryId($id) {
        $items = Items::where('categories_id',$id)->get();

        return response()->json($items);
    }

    public function search(Request $request) {
        $items = Items::where('title','like','%'.$request->searchText.'%')->get();
        return response()->json($items);
    }
}
