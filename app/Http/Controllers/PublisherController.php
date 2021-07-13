<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class PublisherController extends Controller
{
    public function getAddPublisher(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.publisher.add_pub');
        }
       
    }

    public function postAddPublisher(Request $request){
        $data=array();
        $data['namePub']=$request->txtPubName;
        $data['address_pub']=$request->txtPubAdress;
        $data['desc_pub']=$request->txtDescription;

        DB::table('publisher')->insert($data);
        Session::put('message',"Thêm nhà xuất bản thành công!");

        return redirect('admin/nha-xuat-ban/them');
    }

    public function getListPublisher(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listPub = DB::table('publisher')->get();
            $Pubs=view('admin.publisher.list_pub')
            ->with('listPub',$listPub);
            return view('admin.layout.master')
            ->with('admin.publisher.list_pub', $Pubs);
        }
       
    }

    public function geteditPublisher($id_Pub){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $pub=DB::table('publisher')->where('idPub',$id_Pub)->first();

        Session::put('pub',$pub);
        return view('admin.publisher.edit_pub');
        }
        
    }

    public function posteditPublisher($id_Pub,Request $request){
        $data = array();
        $data['namePub']=$request->txtPubName;
        $data['address_pub']=$request->txtPubAdress;
        $data['desc_pub']=$request->txtDescription;

        DB::table('publisher')->where('idPub',$id_Pub)->update($data);
        DB::table('publisher')->where('idPub',$id_Pub)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa nhà xuất bản thành công!");

        return redirect('admin/nha-xuat-ban/sua/'.$id_Pub);
    }

    public function getDelPublisher($id_Pub){
        $books=DB::table('books')->where('idPub',$id_Pub)->get();
        if($books->count()>0){
            return redirect('admin/nha-xuat-ban/danh-sach');
        }
        else{
            DB::table('publisher')->where('idPub',$id_Pub)->delete();
            return redirect('admin/nha-xuat-ban/danh-sach');
        }
        
    }
}
session_destroy();