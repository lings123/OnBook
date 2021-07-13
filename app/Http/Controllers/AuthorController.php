<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class AuthorController extends Controller
{
   
    public function getAddauthor(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return View('admin.author.add_author');
        }
       
    }

    public function postAddauthor(Request $request){
        $data = array();
        $data['nameAuthor']=$request->txtAuthorName;
        $data['gioitinh_author']=$request->gioitinh;
        $data['desc_author']=$request->txtDescription;

        DB::table('author')->insert($data);
        Session::put('message',"Thêm tác giả thành công!");

        return redirect('admin/tac-gia/them');
    }

    public function getListauthor(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listAuthor = DB::table('author')->get();
            $authors=view('admin.author.list_author')
            ->with('listAuthor',$listAuthor);
            return view('admin.layout.master')
            ->with('admin.author.list_author', $authors);
        }
       
    }

    public function geteditauthor($id_Author){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $author=DB::table('author')->where('idAuthor',$id_Author)->first();

        Session::put('author',$author);
        return view('admin.author.edit_author');
        }
        
    }

    public function postEditauthor($id_Author,Request $request){
        $data = array();
        $data['nameAuthor']=$request->txtAuthorName;
        $data['gioitinh_author']=$request->gioitinh;
        $data['desc_author']=$request->txtDescription;

        DB::table('author')->where('idAuthor',$id_Author)->update($data);
        DB::table('author')->where('idAuthor',$id_Author)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa tác giả thành công!");

        return redirect('admin/tac-gia/sua/'.$id_Author);
    }

    public function getDelauthor($id_Author){
        $books=DB::table('books')->where('idAuthor',$id_Author)->get();
        if($books->count()>0){
            return redirect('admin/tac-gia/danh-sach/');
        }
        else{
            DB::table('author')->where('idAuthor',$id_Author)->delete();
            return redirect('admin/tac-gia/danh-sach/');
        }
        
    }
}
session_destroy();