<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class typeController extends Controller
{
    public function getAddtype(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $cate=DB::table('category')->get();
            Session::put('cate',$cate);
            return view('admin.Type.add_type');
        }
        
    }

    public function postAddtype(Request $request){
        $data=array();
        $data['nameType']=$request->txtTypeName;
        $data['mota']=$request->txtDescription;
        $data['idCate']=$request->cate;
        $data['status']=$request->status;

        DB::table('type')->insert($data);
        Session::put('message',"Thêm loại sách thành công!");
        return redirect::to('admin/loai-sach/them');
    }

    public function getListtype(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listType = DB::table('type')->get();
            $manager_type=view('admin.Type.list_type')
            ->with('listType',$listType);
            return view('admin.layout.master')
            ->with('admin.Type.list_type',$manager_type);
        }
        
    }

    public function getedittype($id_type){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $type=DB::table('type')->where('idType',$id_type)->first();
            $cate=DB::table('category')->get();
            Session::put('cate',$cate);
            Session::put('type',$type);
            return view('admin.Type.edit_type');
        }
       
    }

    public function postedittype($id_type,Request $request){
        $data=array();
        $data['nameType']=$request->txtTypeName;
        $data['mota']=$request->txtDescription;
        $data['idCate']=$request->cate;
        $data['status']=$request->status;

        DB::table('type')->where('idType',$id_type)->update($data);
        DB::table('type')->where('idType',$id_type)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa loại sách thành công!");
        return redirect::to('admin/loai-sach/sua/'.$id_type);
    }

    public function getDeltype($id_type){
        $books=DB::table('books')->where('idType',$id_type)->get();
        if($books->count()>0){
            return redirect('admin/loai-sach/danh-sach');
        }else{
            DB::table('type')->where('idType',$id_type)->delete();
            return redirect('admin/loai-sach/danh-sach');
        }
        
    }

    public function postTTtype($id_type,Request $request){
        DB::table('type')->where('idType',$id_type)->update(['status'=>$request->trangthai,'update_date'=>NOW()]);
        return redirect('admin/loai-sach/danh-sach');
    }

    
}
session_destroy();