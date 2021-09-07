<?php //use App\Cart; 
use App\Product;
?>
@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active"> CHECKOUT </li>
    </ul>
	<h3>  CHECKOUT [ <small><span class="totalCartItems"> {{ totalCartItems() }} </span> Item(s) </small>]<a href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart </a></h3>	
	<hr class="soft"/>
    @if(Session::has('success_message'))
            <div class="alert alert-success" role="alert" style="margin-top:10px;">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
			<?php Session::forget('success_message'); ?>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
			<?php Session::forget('error_message'); ?>
        @endif	

    <form id="checkoutForm" action="{{ url('/checkout') }}" method="POST">
    @csrf()
        <table class="table table-bordered">
            <tr><td><strong> DELIVERY ADDRESS </strong> | <a href="{{ url('add-edit-delivery-address') }}"> Add </a> </td></tr>
            @foreach($deliveryAddresses as $address)
                <tr>
                    <td>
                        <div class="control-grounp" style="float:left; margin-top: -2px; margin-right: 5px;">
                            <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" shipping_charges="{{ $address['shipping_charges'] }}" total_price={{ $total_price }} coupon_amount = "{{ Session::get('couponAmount') }}" codpincodeCount = "{{ $address['codpincodeCount'] }}" prepaidpincodeCount = "{{ $address['prepaidpincodeCount'] }}">
                        </div>

                        <div class="control-grounp">
                            <label class="control-label">{{ $address['name'] }},  {{$address['address']}}, {{$address['city'] }} - {{ $address['pincode'] }}, {{ $address['state'] }}, {{ $address['country'] }} ({{ $address['mobile'] }}) </label>
                        </div>
                    </td>
                    <td><a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}">Edit</a> | <a href="{{ url('/delete-delivery-address/'.$address['id']) }}" class="addressDelete">Delete</a></td>
                </tr>
            @endforeach
        </table>	
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Product</th>
                <th colspan="2">Description</th>
                <th>Quantity/Update</th>
                <th>Price</th>
                <th>Category/Product Discount </th>
                <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
                <?php $total_price =0; ?>
                @foreach ($userCartItems as $item)
                <?php
                //$attrPrice= $getProductAttrPrice = Cart::getProductAttrPrice($item['product_id'], $item['size']);
                $attrPrice= Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                ?>
                <tr>
                <td> <img width="60" src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""/></td>
                <td colspan="2">
                    {{ $item['product']['product_name'] }} ( {{ $item['product']['product_code'] }} )<br/>
                    Color : {{ $item['product']['product_color'] }} <br/>
                    Size : {{ $item['size'] }}
                </td>
                <td>
                    {{ $item['quantity'] }}
                </td>
                {{-- <td>Rs. {{ $attrPrice }}</td> --}}
                <td>Rs. {{ $attrPrice['product_price'] * $item['quantity'] }}</td>
                <td>Rs. {{ $attrPrice['discount'] * $item['quantity'] }}</td>
                <td>Rs. {{ $attrPrice['final_price'] * $item['quantity'] }}</td>
                {{-- <td>Rs. {{ $attrPrice * $item['quantity'] }}</td> --}}
                </tr>
                <?php  
                $total_price =  $total_price + ($attrPrice['final_price'] * $item['quantity']); 
            //   $total_price =  $total_price + ($attrPrice * $item['quantity']); 
                ?>
                @endforeach
            
            
            <tr>
                <td colspan="6" style="text-align:right">Sub Total:	</td>
                <td> Rs. {{ $total_price }}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right">Coupon Discount:	</td>
                <td class="couponAmount">
                    @if(Session::has('couponAmount'))
                        - Rs. {{ Session::get('couponAmount') }}
                    @else
                        Rs. 0
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right">Shipping Charges:	</td>
                <td class="shipping_charges">Rs. 0 </td>
            </tr>
                
            <tr>
                <td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Rs.{{ $total_price }}- <span class="couponAmount">Rs.0 </span> + <span class="shipping_charges"> Rs.0 </span> ) =</strong></td>
                <td class="label label-important" style="display:block"> <strong class="grand_total"> Rs.{{ $grand_total = $total_price - Session::get('couponAmount') }}
                <?php Session::put('grand_total', $grand_total) ?>
                </strong></td>
            </tr>
            </tbody>
        </table>
		
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td> 
                        <div class="control-group">
                            <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
                            <div class="controls">
                            <span>
                                <span class="codMethod">
                                    <input type="radio" name="payment_gateway" id="COD" value="COD"><strong>COD</strong> &nbsp;&nbsp;
                                </span>

                                <span class="prepaidMethod">
                                    <input type="radio" name="payment_gateway" id="Paypal" value="Paypal"><strong>Paypal</strong>
                                    <input type="radio" name="payment_gateway" id="Payumoney" value="Payumoney"><strong>Payumoney</strong>
                                </span>
                            </span>
                            </div>
                        </div>
                    </td>
                </tr>  
            </tbody>
		</table>	
        <a href="{{ '/cart' }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>

        <button type="submit" href="{{ url('checkout') }}" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></button>
	</form>
    </div>
    
@endsection