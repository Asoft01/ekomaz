<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orders_products(){
        return $this->hasMany('App\OrdersProduct', 'order_id');
    }

    public function order_items(){
        return $this->hasMany('App\OrdersProduct', 'order_id');
    }

    public static function pushOrder($order_id){
        $orderDetails = Order::with('order_items')->where('id', $order_id)->first()->toArray();
        // dd($orderDetails); die;
        $orderApiDetails['order_id'] =                                $orderDetails['id'];
        $orderApiDetails['order_date'] =                              $orderDetails['created_at'];
        $orderApiDetails['pickup_location'] =                         "Test";
        $orderApiDetails['channel_id'] =                              "2017341";
        $orderApiDetails['comment'] =                                 "Test Order";
        $orderApiDetails['billing_customer_name'] =                   $orderDetails['name'];
        $orderApiDetails['billing_last_name'] =                       "";
        $orderApiDetails['billing_address'] =                         $orderDetails['address'];
        $orderApiDetails['billing_address_2'] =                       "";
        $orderApiDetails['billing_city'] =                            $orderDetails['city'];
        $orderApiDetails['billing_pincode'] =                         $orderDetails['pincode'];
        $orderApiDetails['billing_state'] =                           $orderDetails['state'];
        $orderApiDetails['billing_country'] =                         $orderDetails['country'];
        $orderApiDetails['billing_email'] =                           $orderDetails['email'];
        $orderApiDetails['billing_phone'] =                           $orderDetails['mobile'];
        $orderApiDetails['shipping_is_billing'] =                     true;
        $orderApiDetails['shipping_customer_name'] =                  $orderDetails['name'];
        $orderApiDetails['shipping_last_name'] =                      "";
        $orderApiDetails['shipping_address'] =                        $orderDetails['address'];
        $orderApiDetails['shipping_address_2'] =                      "";
        $orderApiDetails['shipping_city'] =                           $orderDetails['city'];
        $orderApiDetails['shipping_pincode'] =                        $orderDetails['pincode'];
        $orderApiDetails['shipping_state'] =                          $orderDetails['state'];
        $orderApiDetails['shipping_country'] =                        $orderDetails['country'];
        $orderApiDetails['shipping_email'] =                          $orderDetails['email'];
        $orderApiDetails['shipping_phone'] =                          $orderDetails['mobile'];

        foreach($orderDetails['order_items'] as $key => $item){
            $orderApiDetails['order_items'][$key]['name'] =          $item['product_name'];
            $orderApiDetails['order_items'][$key]['sku'] =           $item['product_code'];
            $orderApiDetails['order_items'][$key]['units'] =         $item['product_qty'];
            $orderApiDetails['order_items'][$key]['selling_price'] = $item['product_price'];
            $orderApiDetails['order_items'][$key]['discount'] =      "";
            $orderApiDetails['order_items'][$key]['tax'] =           "";
            $orderApiDetails['order_items'][$key]['hsn'] =           "";
        }

        $orderApiDetails['shipping_charges'] = 0;
        $orderApiDetails['giftwrap_charges'] = 0;
        $orderApiDetails['transaction_charges'] = 0;
        $orderApiDetails['total_discount'] = 0;
        $orderApiDetails['sub_total'] = $orderDetails['grand_total'];
        $orderApiDetails['length'] =   1;
        $orderApiDetails['breadth'] =  1;
        $orderApiDetails['height'] =   1;
        $orderApiDetails['weight'] =   1;
        echo "<pre>"; print_r(json_encode($orderApiDetails)); die;
        $orderDetails = json_encode($orderDetails);

        // Generate Access Token
        $c = curl_init();
        $url = "https://apiv2.shiprocket.in/v1/external/auth/login";
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        // curl_setopt($c, CURLOPT_POSTFIELDS, "email=prymable@gmail.com&password=Adeleke1992");
        curl_setopt($c, CURLOPT_POSTFIELDS, "email=stackdevelopers2@gmail.com&password=123456");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $server_output = curl_exec($c);
        curl_close($c);
        $server_output = json_decode($server_output, true);
        // echo "<pre>"; print_r($server_output); die;

        // Create Order in ShipRocket
        $url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $orderDetails);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer '.$server_output['token'].''));
        $result = curl_exec($c);
        curl_close($c);

        // print_r($result); die;

        // Converting the result to array
        $result = json_decode($result, true);

        print_r($result); die;

        if(isset($result['status_code']) && $result['status_code'] == 1){
            // Update Orders Table Column is pushed to 1
            Order::where('id', $order_id)->update(['is_pushed' => 1]);
            $status = "true";
            $message = "Order Successfully pushed to ShipRocket";
        }else{
            $status = "false";
            $message = "Order not pushed to ShipRocket. Please Contact Admin";
        }
        return array(['statuss' => $status, 'messages' => $message]);
    }
}
