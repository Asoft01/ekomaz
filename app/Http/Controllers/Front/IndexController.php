<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class IndexController extends Controller
{
    //
    public function index(){
        // Get Featured Items
        // echo $featuredItemsCount = Product::where('is_featured', 'Yes')->count(); die;
        $featuredItemsCount = Product::where('is_featured', 'Yes')->where('status', 1)->count();
        $featuredItems = Product::where('is_featured', 'Yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // echo "<pre>"; print_r($featuredItemsChunk); die;
        // dd($featuredItemsCount); die;

        // Get New Products 
        // $newProducts = Product::orderBy('id', 'Desc')->limit(3)->get();
        // $newProducts = json_decode(json_encode($newProducts), true);
        // echo "<pre>"; print_r($newProducts); die;

        $newProducts = Product::orderBy('id', 'Desc')->where('status', 1)->limit(6)->get()->toArray();
        // dd($newProducts); die;
        // echo "<pre>"; print_r($newProducts); die;

        $page_name = "index";
        $meta_title = "E-commerce Website by Stack Developers";
        $meta_description = "Subscribe to Soft Developers";
        $meta_keywords = "buy the product, subscribe to our product, get discounted price";
        return view('front.index')->with(compact('page_name', 'featuredItemsChunk', 'featuredItemsCount', 'newProducts', 'meta_title', 'meta_description', 'meta_keywords'));
    }
}
