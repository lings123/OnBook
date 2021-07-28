<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
session_start();

class UserController extends Controller
{
    public function getListUser(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listKH = DB::table('users')->get();
            $manager_user=view('admin.userKH.list_user')
            ->with('listKH',$listKH);
            return view('admin.layout.master')
            ->with('admin.userKH.list_user',$manager_user);
        }
       
    }

    public function getDelUser($id_kh){
       
        DB::table('users')->where('id',$id_kh)->delete();
        
        return redirect('admin/khach-hang/danh-sach');
    }

    public function postTTUser($id_kh,Request $request){
        $trangthai=$request->trangthai;
        DB::table('users')->where('id',$id_kh)->update(['active'=>$trangthai,'updated_at'=>NOW()]);

        return redirect('admin/khach-hang/danh-sach');
    }
}
session_destroy();