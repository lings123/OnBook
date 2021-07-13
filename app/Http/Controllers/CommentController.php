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
    
    public function getDelCom($id_com){
        $idBook=DB::table('danhgia')->select('idBook')->where('idCom',$id_com)->first();
        $idBook=get_object_vars($idBook);
        
        $comment=DB::table('danhgia')->where('idBook',$idBook)->get();
        $diem=0;
            $sl=0;
            if($comment->count()>1){
                foreach($comment as $com){
                    $sl=$sl+1;
                    $diem=$diem+$com->diem;
                }
                $tb=$diem/$sl;
                DB::table('books')->where('idBook',$idBook)->update(['diem'=>$tb,'update_date'=>NOW()]);
            }else{
                DB::table('books')->where('idBook',$idBook)->update(['diem'=>0,'update_date'=>NOW()]);
            }
        DB::table('danhgia')->where('idCom',$id_com)->delete();
        return redirect('admin/danh-gia/danh-sach');
    }

    
}
session_destroy();