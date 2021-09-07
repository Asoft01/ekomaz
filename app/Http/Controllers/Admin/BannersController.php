<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Session;
use Image;

class BannersController extends Controller
{
    //
    public function banners(){
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        // dd($banners); die;
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function addEditBanner($id= null, Request $request){
        if($id == ""){
            // Add Banner
            $banner = new Banner;
            $title= "Add Banner Image";
            $message = "Banner added Successfully";
        }else{
            $banner = Banner::find($id);
            $title= "Edit Banner Image";
            $message = "Banner Updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            

            //Upload Banner Image
            if($request->hasFile('image')){
                // echo $image_tmp = $request->file('main_image'); die;
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    // Get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName= $image_name . '-'. rand(111, 9999).'.'.$extension;
                    // Set Paths for Image
                    $banner_image_path = 'images/banner_images/'.$imageName;

                    // Upload Banner Image after Resize
                    Image::make($image_tmp)->save($banner_image_path);
                    // Upload Medium and Small Images after resize
                    Image::make($image_tmp)->resize(1170, 480)->save($banner_image_path);
                    // Save Banner Image in banners table
                    $banner->image = $imageName;
                    
                }
            }

            $banner->save();
            session::flash('success_message', $message);
            return redirect('admin/banners');
        }

        return view('admin.banners.add_edit_banner')->with(compact('title', 'banner'));
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'banner_id'=> $data['banner_id']]);
        }
    }

    public function deleteBanner($id){
        // Get Banner Image
        $bannerImage = Banner::where('id', $id)->first();

        // Get Banner Image Path
        $banner_image_path= 'images/banner_images/';

        // Delete Banner Image if banners folder
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }

        // Delete Banner from Banners table
        Banner::where('id', $id)->delete();
        session::flash('success_message', 'Banner deleted Successfully!');
        return redirect()->back();

    }
}
