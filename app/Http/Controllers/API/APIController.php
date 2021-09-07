<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function pushOrder($id){
        $getResults = Order::pushOrder($id);
        return response()->json(['status' => $getResults['status'], 'message' => $getResults['message']]);
    }
}
