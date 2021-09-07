<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use App\Sms;
use Session;
use Auth;

class PaypalController extends Controller
{
    public function paypal(){
        if(Session::has('order_id')){
            // Empty the User Cart
            // Cart::where('user_id', Auth::user()->id)->delete();
            $orderDetails = Order::where('id', Session::get('order_id'))->first()->toArray();
            // echo "<pre>"; print_r($orderDetails); die;
            $nameArr = explode(' ', $orderDetails['name']);
            // echo "<pre>"; print_r($nameArr); die;
            return view('front.paypal.paypal')->with(compact('orderDetails', 'nameArr'));
        }else{
            return redirect('/cart');
        }
    }
    
    public function success(){
        if(Session::has('order_id')){
            // Empty the User Cart
            Cart::where('user_id', Auth::user()->id)->delete();
            // echo "<pre>"; print_r($nameArr); die;
            return view('front.paypal.success');
        }else{
            return redirect('/cart');
        }
    }

    public function fail(){
        if(Session::has('order_id')){
            return view('front.paypal.fail');
        }
    }

    public function ipn(Request $request){
        $data = $request->all();
        echo "<pre>"; print_r($data); die;
        // $data['payment_status'] = "Completed";

        if($data['payment_status'] =="Completed"){
            // Process the Order 
            $order_id = Session::get('order_id');

            // Update Order Status to Paid
            Order::where('id', $order_id)->update(['order_status' => 'Paid']);
            
            // Send Order SMS
            $message = "Dear Customer, your order ".$order_id. " has been successfully placed with Prymable Tech Company. We will intimate you once order is shipped.";
            $mobile = Auth::user()->mobile;
            Sms::sendSms($message, $mobile);

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
            // $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();

            // echo "<pre>"; print_r($orderDetails); die;
            
            // Reduce Stock Script Starts
            foreach($orderDetails['orders_products'] as $order){
                $getProductStock = ProductsAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']])->first()->toArray();
                // dd($getProductStock); die;
                $newStock = $getProductStock['stock'] - $item['quantity'];
                ProductsAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']])->update(['stock' => $newStock]);
            }

            // Reduce Stock Script Ends 

            // Send Order Email
            $email = Auth::user()->email;
            $messageData = [
                'email'=> $email,
                'name' => Auth::user()->name,
                'order_id'=> $order_id,
                'orderDetails'=> $orderDetails
            ];
            Mail::send('emails.order', $messageData, function($message) use($email){
                $message->to($email)->subject('Order Placed - Prymable Tech');
            });
        }
    }
}
