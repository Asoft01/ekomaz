<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;

class PayumoneyController extends Controller
{
    public function payumoney(){
        $parameters = [
            'transaction_no' => '28309039994988',
            'amount' => '1200.00',
            'name' => 'Adeleke Hammed',
            'email' => 'prymable@gmail.com'
          ];
          
          $order = Indipay::prepare($parameters);
          return Indipay::process($order);
    }
}
