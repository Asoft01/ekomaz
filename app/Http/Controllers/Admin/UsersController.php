<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function users(){
        Session::put('page', 'users');
        $users = User::get();
        // $users = User::get()->toArray();
        // dd($users); die;
        return view('admin.users.users')->with(compact('users'));
    }

    public function updateUserStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'user_id' => $data['user_id']]);
        }
    }
}
