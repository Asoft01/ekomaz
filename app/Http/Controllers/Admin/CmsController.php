<?php

namespace App\Http\Controllers\Admin;

use App\CmsPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Validator;

class CmsController extends Controller
{
    public function cmsPages(){
        Session::put('page', 'cmspages');
        // $cms_pages = CmsPage::get()->toArray();
        $cms_pages = CmsPage::get();
        // dd($cms_pages); die;
        return view('admin.pages.cms_pages')->with(compact('cms_pages'));
    }

    public function updateCmsPageStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            CmsPage::where('id', $data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'page_id'=> $data['page_id']]);
        }
    }

    public function addEditCmsPage(Request $request, $id = null){
        if($id==""){
            $title = "Add CMS Page";
            $cmspage = new CmsPage();
            $message = "CMS Page added Successfully";
        }else{
            $title = "Edit CMS Page";
            $cmspage = CmsPage::find($id);
            $message = "CMS Page Updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Category Validations
            $rules = [
                'title'=> 'required',
                'url' => 'required',
                'description' => 'required'
            ];
            $customMessages = [
                'title.required' => 'Title is required',
                'title.regex' => 'Valid Title is required',
                'url.required' => 'URL is required',
                'description' => 'Description is required'
            ];
            $this->validate($request, $rules, $customMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description  = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();
            Session::flash('success_message', $message);
            return redirect('/admin/cms-pages');

        }
        return view('admin.pages.add_edit_cmspage')->with(compact('title', 'cmspage'));
    }

    public function deleteCmsPage($id){
        // Delete Cms Page
        CmsPage::where('id', $id)->delete();
        $message = 'Cms Page been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
