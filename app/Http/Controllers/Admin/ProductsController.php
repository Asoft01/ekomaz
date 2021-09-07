<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\Brand;
use App\Category;
use App\ProductsAttribute;
use App\ProductsImage;
use Session;
use Image;

class ProductsController extends Controller
{
    //
    public function products(){
        Session::put('page', 'products');
        // $products = Product::get();
        $products = Product::with(['category'=>function($query){
            $query->select('id', 'category_name');
        }, 'section'=> function($query){
            $query->select('id', 'name');
        }])->get();
        // $products = json_decode(json_encode($products));
        // echo "<pre>"; print_r($products); die;
        // return response()->json(['products'=> $products]);
        // echo "<pre>"; print_r($products); die;
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=> $data['product_id']]);
        }
    }

    public function deleteProduct($id){
        // Delete Category
        Product::where('id', $id)->delete();
        $message = 'Product been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addEditProduct(Request $request, $id= null){
        if($id== ""){
            $title = "Add Product";
            $product = new Product;
            // To Avoid Issues with the add product form 
            $productdata= array();
            $message = "Product added successfully";

        }else{
            $title  = "Edit Product";
            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata), true);
            // echo "<pre>"; print_r($productdata);die;
            // To Save the product details just the way $product = new Product; was done
            $product = Product::find($id);
            $message = "Product updated successfully";

        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Products Validations
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name'=> 'required|regex:/^[\pL\s-]+$/u',
                'product_code'=> 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s-]+$/u'

            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required' => 'Product Price is required',
                'product_price.numeric' => 'Valid Product Price is required',
                'product_color.required' => 'Product Color is required',
                'product_color.regex' => 'Valid Product Color is required'
            ];
            
            $this->validate($request, $rules, $customMessages);

            // if(empty($data['is_featured'])){
            //     $is_featured = "No";
            // }else{
            //     $is_featured = "Yes";
            // }

            // if(empty($data['is_featured'])){
            //     $is_featured = "No";
            // }else {
            //     $is_featured ="Yes";
            // }

            // echo "<pre>"; print_r($is_featured); die;
            // echo $is_featured; die;

            // under config/database.php change strict to be false and the if comments is no more necessary, the code will work flawlessly

            // if(empty($data['status'])){
            //     $status = 0;
            // }else{
            //     $status =1;
            // }
            // if(empty($data['fabric'])){
            //     $data['fabric'] = "";
            // }
            // if(empty($data['pattern'])){
            //     $data['pattern'] = "";
            // }
            // if(empty($data['sleeve'])){
            //     $data['sleeve'] = "";
            // }
            // if(empty($data['fit'])){
            //     $data['fit'] = "";
            // }

            // if(empty($data['occasion'])){
            //     $data['occasion'] = "";
            // }

            // if(empty($data['meta_title'])){
            //     $data['meta_title'] = "";
            // }
            // if(empty($data['description'])){
            //     $data['description'] = "";
            // }
            // if(empty($data['wash_care'])){
            //     $data['wash_care'] = "";
            // }
            
            // if(empty($data['meta_description'])){
            //     $data['meta_description'] = "";
            // }

            // if(empty($data['meta_keywords'])){
            //     $data['meta_keywords'] = "";
            // }

            // if(empty($data['product_video'])){
            //     $data['product_video'] = "";
            // }
            // if(empty($data['main_image'])){
            //     $data['main_image'] = "";
            // }
            
            // if(empty($data['product_discount'])){
            //     $data['product_discount']= 0;
            // }
            // if(empty($data['product_weight'])){
            //     $data['product_weight']= 0;
            // }

            // Upload Product Image
            
            if($request->hasFile('main_image')){
                // echo $image_tmp = $request->file('main_image'); die;
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()){
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    // Get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName= $image_name . '-'. rand(111, 9999).'.'.$extension;
                    // Set Paths for Image
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;

                    // Upload Large Image
                    Image::make($image_tmp)->save($large_image_path); /// 1000 by 1000
                    // Upload Medium and Small Images after resize
                    Image::make($image_tmp)->resize(500, 500)->save($medium_image_path);
                    Image::make($image_tmp)->resize(250, 250)->save($small_image_path);
                    // Save product Main Image in product table
                    $product->main_image = $imageName;
                    
                }
            }
            
            // Upload Product Video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    //Upload Video 
                    $video_name = $video_tmp->getClientOriginalName();
                    $video_extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand().'.'.$video_extension;
                    $video_path = 'videos/product_videos';
                    $video_tmp->move($video_path, $videoName);
                    
                    // Save Video in Product Table 
                    $product->product_video= $videoName;
                }
            }
            // Save Product Details in product table
            $categoryDetails = Category::find($data['category_id']);
            // echo "<pre>"; print_r($categoryDetails); die;
            $product->section_id= $categoryDetails['section_id'];
            $product->brand_id=        $data['brand_id'];
            $product->category_id =    $data['category_id'];
            $product->product_name =   $data['product_name'];
            $product->product_code =   $data['product_code'];
            $product->product_color =  $data['product_color'];
            $product->group_code =     $data['group_code'];
            $product->product_price =  $data['product_price'];
            $product->product_discount =$data['product_discount'];
            $product->product_weight =  $data['product_weight'];
            // $product->product_video =$data['product_video'];           
            // $product->main_image =$data['main_image'];           
            $product->description =    $data['description'];
            $product->wash_care =      $data['wash_care'];
            $product->fabric =         $data['fabric'];
            $product->pattern =        $data['pattern'];
            $product->sleeve =         $data['sleeve'];
            $product->fit =            $data['fit'];
            $product->occasion =       $data['occasion'];
            $product->meta_title =     $data['meta_title'];
            $product->meta_keywords =  $data['meta_keywords'];
            $product->meta_description =$data['meta_description'];
            if(!empty($data['is_featured'])){
                $product->is_featured= $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            session::flash('success_message', $message);
            return redirect('admin/products');
            
        }

        // Product Filters
        $productFilters = Product::productFilters();
        // echo "<pre>"; print_r($productFilters); die;
        $fabricArray =   $productFilters['fabricArray'];
        $sleeveArray =   $productFilters['sleeveArray'];
        $patternArray =  $productFilters['patternArray'];
        $fitArray =      $productFilters['fitArray'];
        $occasionArray = $productFilters['occasionArray'];

        // // Filter Arrays
        // $fabricArray = array('Cotton', 'Polyseter', 'Wool');
        // $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        // $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        // $fitArray = array('Regular', 'Slim');
        // $occasionArray = array('Casual', 'Formal');  
        
        // Sections with Categories and Sub Categories from the Section Model
        $categories = Section::with(['categories'])->get();
        $categories = json_decode(json_encode($categories), true);
        // echo "<pre>"; print_r($categories); die;

        // Get All Brands
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands), true); 

        return view('admin.products.add_edit_product')->with(compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories', 'productdata', 'brands'));
    }

    public function deleteProductImage($id){
        // Get Category Image
        $productImage = Product::select('main_image')->where('id', $id)->first();

        // Get Product Image Path
        $small_image_path= 'images/product_images/small/';
        $medium_image_path= 'images/product_images/medium/';
        $large_image_path= 'images/product_images/large/';

        // Delete Product small Image if exists in small folder
        if(file_exists($small_image_path.$productImage->main_image)){
            unlink($small_image_path.$productImage->main_image);
        }
        // Delete Product medium Image if exists in small folder
        if(file_exists($medium_image_path.$productImage->main_image)){
            unlink($medium_image_path.$productImage->main_image);
        }
        // Delete Product small Image if exists in small folder
        if(file_exists($large_image_path.$productImage->main_image)){
            unlink($large_image_path.$productImage->main_image);
        }
        

        // Delete Product Image from products table 
        Product::where('id', $id)->update(['main_image'=> '']);

        $message = 'Product image has been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();

    }

    public function deleteProductVideo($id){
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get Product Image Path
        $product_video_path= 'videos/product_videos/';
       

        // Delete Product Video from the product_videos if exists
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }
        

        // Delete Product Videos from products table 
        Product::where('id', $id)->update(['product_video'=> '']);

        $message = 'Product video has been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();

    }

    public function addAttributes(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['sku'] as $key => $value) {
                if(!empty($value)){
                    // SKU already exists check
                    $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                    if($attrCountSKU> 0){
                        // return redirect()->back()->with('flash_message_error', 'SKU already exists. Please add another SKU');
                        $message = 'SKU already exists. Please add another SKU!';
                        session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    // Size already exists
                    $attrCountSize = ProductsAttribute::where(['product_id'=> $id, 'size'=> $data['size'][$key]])->count();
                    if($attrCountSize > 0){
                        $message = "Size already exists. Please add another Size!";
                        session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    $attribute= new ProductsAttribute;
                    $attribute->product_id= $id;
                    $attribute->sku =   $value;
                    $attribute->size =  $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();

                }
            }

            $success_message = "Product Attributes has added successfully";
            session::flash('success_message', $success_message);
            return redirect()->back();
        }
        // $productdata = Product::find($id);
        // $productdata = Product::with('attributes')->find($id);
        $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'main_image')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        // echo "<pre>"; print_r($productdata); die;
        $title = "Product Attributes";
        return view('admin.products.add_attributes')->with(compact('productdata', 'title'));
    }

    public function editAttributes(Request $request, $id){
        if($request->isMethod('post')){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['attrId'] as $key => $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=> $data['price'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
            $message ="Product Attributes has been updated successfully";
            session::flash('success_message', $message);
            return redirect()->back();
        }
    }

    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=> $data['attribute_id']]);
        }
    }

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            ProductsAttribute::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=> $data['image_id']]);
        }
    }

    public function deleteAttribute($id){
        // Delete Attribute
        ProductsAttribute::where('id', $id)->delete();
        $message = "Product Attribute has been deleted successfully";
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addImages(Request $request, $id){
        // $productdata= Product::find($id);
        // $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->where('id', $id)->first();
        // $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->find($id);
        if($request->isMethod('post')){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            // echo "<pre>"; print_r($request->hasFile('image')); die;
            if($request->hasFile('images')){
                $images = $request->file('images');
                // echo "test"; die;
                // echo "<pre>"; print_r($images);die;
                foreach ($images as $key => $image) {
                    # code...
                    $productImage= new ProductsImage;
                    $image_tmp= Image::make($image);
                    // echo $originalName = $image->getClientOriginalName(); die;
                    $extension = $image->getClientOriginalExtension();
                    // echo $imageName= rand(111, 999999).time().".".$extension; die;
                    $imageName= rand(111, 999999).time().".".$extension; 
                      // Set Paths for Image
                      $large_image_path = 'images/product_images/large/'.$imageName;
                      $medium_image_path = 'images/product_images/medium/'.$imageName;
                      $small_image_path = 'images/product_images/small/'.$imageName;
  
                      // Upload Large Image
                      Image::make($image_tmp)->save($large_image_path);
                      // Upload Medium and Small Images after resize
                      Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                      Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                      // Save product Main Image in product table
                      $productImage->image = $imageName;
                      $productImage->product_id =$id;
                      $productImage->status =1;
                      $productImage->save();
                }
                $message ="Product Images has been added successfully";
                session::flash('success_message', $message);
                return redirect()->back();
            }
        }
        $productdata = Product::with('images')->select('id', 'product_name', 'product_code', 'product_color', 'main_image')->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        // echo "<pre>"; print_r($productdata); die;
        $title= "Product Images";
        return view('admin.products.add_images')->with(compact('title', 'productdata'));
    }

    public function deleteImage($id){
        // Get Category Image
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        // Get Product Image Path
        $small_image_path= 'images/product_images/small/';
        $medium_image_path= 'images/product_images/medium/';
        $large_image_path= 'images/product_images/large/';

        // Delete Product small Image if exists in small folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        // Delete Product medium Image if exists in small folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        // Delete Product small Image if exists in small folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        

        // Delete Product Image from products_images table 
        ProductsImage::where('id', $id)->delete();

        $message = 'Product image has been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();

    }

}

