
@extends('layouts.front_layout.front_layout')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> CONFIRMED </li>
        </ul>
        <h3>  CONFIRMED </h3>	
        <hr class="soft"/>
        <div align="center">
            <h3>YOUR PAYMENT HAS BEEN CONFIRMED</h3>
            <p>Thanks for the payment. We will process your order very soon</p>
            <p>Your Order Number is {{ Session::get('order_id') }} and total amount paid is INR {{ Session::get('grand_total') }}</p>
            <p>Please make payment by clicking on below Payment button</p>
    
        </div>
    </div>    
@endsection

<?php 
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>