<?php

namespace App\Http\Controllers\Front;

use App\CmsPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Session;
use Validator;
class CmsController extends Controller
{
    public function cmsPage(){
        // echo $currentRoute = Route::getFacadeRoot()->current()->url(); die;
        // echo $currentRoute = url()->current(); die;
        $currentRoute = url()->current(); 
        // echo $currentRoute = str_replace("http://localhost:3000/", "", $currentRoute); 
        // echo $currentRoute = str_replace("http://127.0.0.1:3000/", "", $currentRoute); 
        $currentRoute = str_replace("http://127.0.0.1:3000/", "", $currentRoute);
        $cmsRoute = CmsPage::where('status', 1)->get()->pluck('url')->toArray();
        // dd($cmsRoute); die;

        if(in_array($currentRoute, $cmsRoute)){
            $cmsPageDetails = CmsPage::where('url', $currentRoute)->first()->toArray();
            
            $meta_title = $cmsPageDetails['meta_title'];
            $meta_description = $cmsPageDetails['meta_description'];
            $meta_keywords = $cmsPageDetails['meta_keywords'];
            return view('front.pages.cms_page')->with(compact('cmsPageDetails', 'meta_title', 'meta_description', 'meta_keywords'));
        }else{
            abort(404);
        }
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
             
            $rules = [
                "name" => "required",
                "email" => "required|email", 
                "subject" => "required",
                "message" => "required"
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required', 
                'message.required' => 'Message is required'
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                // return response()->json($validator->errors(), 422);
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Send User Query to Admin
            $email = "webxpartt@gmail.com";
            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['message']
                // Note that message is a keyword that you can't use 
            ];

            Mail::send('emails.enquiry', $messageData, function($message) use($email){
                $message->to($email)->subject("Enquiry from E-Commerce Website");
            });

            $message = "Thanks for your Enquiry. We will get back to you soon";
            session::flash('success_message', $message);
            return redirect()->back();
        }
        return view('front.pages.contact');
    }
}
