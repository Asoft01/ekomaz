@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $categoryDetails['breadcrumbs']; ?></li>
    </ul>
    <h3> {{ $categoryDetails['catDetails']['category_name'] }} <small class="pull-right"> {{ count($categoryProducts) }} products available </small></h3>
    <hr class="soft"/>
    <p>
       {{ $categoryDetails['catDetails']['description'] }}
    </p>
    <hr class="soft"/>
    <form name="sortProducts" id="sortProducts" class="form-horizontal span6">
        <input type="hidden" name="url" value="{{ $url }}">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort">
                <option value="">Select</option>
                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest")  selected="" @endif>Latest Products</option>
                <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_a_z")  selected="" @endif>Product name A - Z</option>
                <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_z_a")  selected="" @endif>Product name Z - A</option>
                <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == "price_lowest")  selected="" @endif> Lowest Price First</option>
                <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == "price_highest")  selected="" @endif> Highest Price First</option>
            </select>
        </div>
    </form>
    
    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>
    <br class="clr"/>
    <div class="tab-content">
        <div class="tab-pane" id="listView">
            @foreach($categoryProducts as $product)
                <div class="row">
                    <div class="span2">
                        @if(isset($product['main_image']))
                            <?php $product_image_path= "images/product_images/small/".$product['main_image']; ?>
                        @else
                            <?php $product_image_path= ''; ?>
                        @endif
                        @if(!empty($product['main_image']) && file_exists($product_image_path))
                            <img style="width:250px;" src="{{asset($product_image_path) }}" alt="">
                        @else
                            <img style="width:250px;" src="{{asset('images/product_images/small/small-no-image.png') }}" alt="">
                        @endif
                    </div>
                    <div class="span4">
                        <h3>{{ $product['brand']['name'] }}</h3>
                        <hr class="soft"/>
                        <h5> {{ $product['product_name'] }}  </h5>
                        <p>
                            {{ $product['description'] }}
                        </p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3> Rs. {{ $product['product_price'] }}</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compare
                            </label><br/>
                            
                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                            
                        </form>
                    </div>
                </div>
                <hr class="soft"/>
            @endforeach
        </div>
        <div class="tab-pane  active" id="blockView">
            <ul class="thumbnails">
                @foreach($categoryProducts as $product)
                    <li class="span3">
                        <div class="thumbnail">
                            <a href="product_details.html">
                                @if(isset($product['main_image']))
                                    <?php $product_image_path= "images/product_images/small/".$product['main_image']; ?>
                                @else
                                    <?php $product_image_path= ''; ?>
                                @endif
                                <?php $product_image_path= "images/product_images/small/".$product['main_image']; ?>
                                                @if(!empty($product['main_image']) && file_exists($product_image_path))
                                                    <img style="width:250px; height:250px" src="{{asset($product_image_path) }}" alt="">
                                                @else
                                                    <img style="width:250px; height:250px" src="{{asset('images/product_images/small/small-no-image.png') }}" alt="">
                                                @endif
                            </a>
                            <div class="caption">
                                <h5>{{ $product['product_name'] }} {{ $product['id'] }}</h5>
                                <p>{{ $product['brand']['name'] }} </p>
                                <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs. {{ $product['product_price'] }}</a></h4>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <hr class="soft"/>
        </div>
    </div>
    <a href="compare.html" class="btn btn-large pull-right">Compare Product</a>
    <div class="pagination">
        {{-- <ul>
            <li><a href="#">&lsaquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#">&rsaquo;</a></li>
        </ul> --}}
        @if(isset($_GET['sort']) && !empty($_GET['sort']))
            {{ $categoryProducts->appends(['sort'=> 'price_lowest'])->links() }}
        @else
             {{ $categoryProducts->links() }}
        @endif
    </div>
    <br class="clr"/>
</div>
@endsection