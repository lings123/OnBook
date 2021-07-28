<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

class CommentController extends Controller
{
    public function getListComment(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listCom = DB::table('danhgia')->get();
        $manager_danhgia=view('admin.danhgia.list_com')
        ->with('listCom',$listCom);
        return view('admin.layout.master')
        ->with('admin.danhgia.list_com',$manager_danhgia);
        }
       
    }
    public function postTTComment($id_com){
        DB::table('danhgia')->where('idCom',$id_com)->update(['status'=>0,'update_date'=>NOW()]);
        return redirect::back();
    }
    

    
}
