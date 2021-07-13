<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use File;
use Illuminate\Support\Str;
session_start();

class productController extends Controller
{
    public function getAddProduct(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $type=DB::table('type')->get();
        $author=DB::table('author')->get();
        $pub=DB::table('publisher')->get();
        $bia=$bia=DB::table('bia')->get();
        Session::put('type',$type);
        Session::put('author',$author);
        Session::put('pub',$pub);
        Session::put('bia',$bia);
        return view('admin.product.add_product');
        }
       

    }

    public function postAddProduct(Request $request){
        $this->validate($request,[
            "txtName"     => "unique:books,NameBook",
            "txtHinh"     => "required|image",
            "txtPage"     =>"numeric",
            "txtRong"   =>"numeric",
            "txtDai"    =>"numeric",
            "txtUnitPrice" =>"numeric",
            "txtPromoPrice" =>"numeric",
            "txtQty"        =>"numeric",
         ],[
            "txtName.unique"       => "Tên sản phẩm bị trùng",
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
            "txtHinh.required"     => "Bạn chưa chọn hình đại diện",
            "txtPage.numeric"     =>" Số trang phải là số",
            "txtRong.numeric"   =>"Chiều rộng phải là số",
            "txtDai.numeric"    =>"Chiều dài phải là số",
            "txtUnitPrice.numeric" =>"Đơn giá phải là số",
            "txtPromoPrice.numeric" =>"Giá khuyến mãi phải là số",
            "txtQty.numeric" =>"Số lượng phải là số",
        ]);

        if($request->txtUnitPrice<=$request->txtPromoPrice){
            Session::put('error','Giá phải lớn hơn Giá khuyến mãi');
        }
        else{
            $data=array();
        $data['NameBook']=$request->txtName;
        $data['idAuthor']=$request->selectAuthorId;
        $data['idType']=$request->selectTypeId;
        $data['idPub']=$request->selectPubId;
        $data['idBia']=$request->selectBiaId;
        $data['pages']=$request->txtPage;
        $data['slug_name']=Str::slug($request->txtName,"-");
        $data['description']=$request->txtDescription;
        $data['unit_price']=$request->txtUnitPrice;
        $data['sale_price']=$request->txtPromoPrice;
        $data['chieu_rong']=$request->txtRong;
        $data['chieu_dai']=$request->txtDai;
        $data['new']=$request->rdoNew;
        $data['quantity']=$request->txtQty;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('public/uploaded/books',$renamed_h)){
                    $data['hinh_dai_dien']  = $renamed_h;
                }
            }
        }
        if(DB::table('books')->insert($data)){
            $max_id = DB::table('books')->max('idBook');
            if($request->hasFile('hinh'))
            {
                foreach($request->file('hinh') as $file){

                    $product_image = array();
                    $ext = $file->getClientOriginalExtension();
                    $renamed = uniqid('_anh',true). "." .$ext;

                    if(in_array($file->getClientMimeType(),$allowed)){
                        if($file->move('public/uploaded/books',$renamed)){
                            $product_image['NameImg']       = $renamed;
                            $product_image['idBook'] = $max_id;
                            DB::table('img_book')->insert($product_image);
                        }
                    }
                }
            }
        }

        Session::put('message',"Thêm sản phẩm thành công!");
        }
        

        return redirect('admin/san-pham/them');

    }

    public function getListProduct(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listBook = DB::table('books')->where('status',1)->get();
            $manager_book=view('admin.product.list_product')
            ->with('listBook',$listBook);
            return view('admin.layout.master')
            ->with('admin.product.list_product',$manager_book);
        }
       
    }

    public function postQtyProduct($id_book, Request $request){
        $qtynew=$request->txtQty;
        $book=DB::table('books')->where('idBook',$id_book)->first();
        $qty=$book->quantity+$qtynew;
        DB::table('books')->where('idBook',$id_book)->update(['quantity'=>$qty,'update_date'=>NOW()]);

        return redirect('admin/san-pham/danh-sach');
    }

    public function getEditProduct($id_book){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $book = DB::table('books')->where('idBook',$id_book)->first();
            $type=DB::table('type')->get();
            $author=DB::table('author')->get();
            $pub=DB::table('publisher')->get();
            $bia=DB::table('bia')->get();
            $image_books=DB::table('img_book')->where('idBook',$book->idBook)->get();
    
            Session::put('type',$type);
            Session::put('author',$author);
            Session::put('pub',$pub);
            Session::put('bia',$bia);
            Session::put('book',$book);
            Session::put('image_books',$image_books);
    
            return view('admin.product.edit_product');
        }
        
    }

    public function getEditImage($id_img){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $img=DB::table('img_book')->where('idImg',$id_img)->first();
            $product=DB::table('books')->where('idBook',$img->idBook)->first();
    
            Session::put('img',$img);
            Session::put('product',$product);
    
            return view('admin.product.edit_image');
        }
        

    }

    public function postEditImage($id_img,Request $request){
        $this->validate($request,[
            "txtHinh"     => "image",
         ],[
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
        ]);
       
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $image =DB::table('img_book')->where('idImg',$id_img)->first();
            $image_name= $image->NameImg;
            $image_path = "public/uploaded/books/".$image_name;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('public/uploaded/books',$renamed_h)){
                    $data  = $renamed_h;
                }
            }
        }

        DB::table('img_book')->where('idImg',$id_img)->update(['nameImg'=>$data,'update_date'=>NOW()]);
        Session::put('message',"Sửa ảnh thành công!");

        return redirect('admin/san-pham/hinh/sua/'.$id_img);
    }

    public function postDelImage(Request $request){
        $image_id = $request->id;
        
        $image =DB::table('img_book')->where('idImg',$request->id)->first();
        if($image){
            $image_name= $image->NameImg;
            $image_path = "public/uploaded/books/".$image_name;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            DB::table('img_book')->where('idImg',$request->id)->delete();
            
            echo "true";
        }else{
            $image =DB::table('img_blog')->where('id',$request->id)->first();
            $image_name= $image->name;
            $image_path = "public/uploaded/blog/".$image_name;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            DB::table('img_blog')->where('id',$request->id)->delete();
            
            echo "true";
        }
        
    }

    public function postEditProduct($id_book,Request $request){
        $this->validate($request,[
            "txtName"     => 'unique:books,NameBook,'.$id_book.',idBook',
            "txtHinh"     => "image",
            "txtPage"     =>"numeric",
            "txtRong"   =>"numeric",
            "txtDai"    =>"numeric",
            "txtUnitPrice" =>"numeric",
            "txtPromoPrice" =>"numeric",
            "txtQty"        =>"numeric",
         ],[
            "txtName.unique"       => "Tên sản phẩm bị trùng",
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
            "txtPage.numeric"     =>" Số trang phải là số",
            "txtRong.numeric"   =>"Chiều rộng phải là số",
            "txtDai.numeric"    =>"Chiều dài phải là số",
            "txtUnitPrice.numeric" =>"Đơn giá phải là số",
            "txtPromoPrice.numeric" =>"Giá khuyến mãi phải là số",
            "txtQty.numeric" =>"Số lượng phải là số",
        ]);
        if($request->txtUnitPrice<=$request->txtPromoPrice){
            Session::put('error','Giá phải lớn hơn Giá khuyến mãi');
        }
        else{

            $data=array();
            $data['NameBook']=$request->txtName;
            $data['idAuthor']=$request->selectAuthorId;
            $data['idType']=$request->selectTypeId;
            $data['idPub']=$request->selectPubId;
            $data['idBia']=$request->selectBiaId;
            $data['pages']=$request->txtPage;
            $data['slug_name']=Str::slug($request->txtName,"-");
            $data['description']=$request->txtDescription;
            $data['unit_price']=$request->txtUnitPrice;
            $data['sale_price']=$request->txtPromoPrice;
            $data['chieu_rong']=$request->txtRong;
            $data['chieu_dai']=$request->txtDai;
            $data['new']=$request->rdoNew;
            $data['quantity']=$request->txtQty;
            $allowed = array('image/jpg','image/png','image/jpeg');
            if($request->hasFile('txtHinh')){
                $image =DB::table('books')->where('idBook',$id_book)->first();
                $image_name= $image->hinh_dai_dien;
                $image_path = "public/uploaded/books/".$image_name;
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
                $hinh      = $request->file('txtHinh');
                $ext_image = $hinh->getClientOriginalExtension();
                $renamed_h = uniqid('_anh',true). "." .$ext_image;
                if(in_array($hinh->getClientMimeType(),$allowed)){
                    if($hinh->move('public/uploaded/books',$renamed_h)){
                        $data['hinh_dai_dien']  = $renamed_h;
                    }
                }
            }
            DB::table('books')->where('idBook',$id_book)->update($data);
            DB::table('books')->where('idBook',$id_book)->update(['update_date'=>NOW()]);
                if($request->hasFile('hinh'))
                {
                    foreach($request->file('hinh') as $file){
    
                        $product_image = array();
                        $ext = $file->getClientOriginalExtension();
                        $renamed = uniqid('_anh',true). "." .$ext;
    
                        if(in_array($file->getClientMimeType(),$allowed)){
                            if($file->move('public/uploaded/books',$renamed)){
                                $product_image['NameImg']  = $renamed;
                                $product_image['idBook'] = $id_book;
                                DB::table('img_book')->insert($product_image);
                            }
                        }
                    }
                }
            
    
            Session::put('message',"Sửa sản phẩm thành công!");
        }
       

        return redirect('admin/san-pham/sua/'.$id_book);
    }

    public function getDelProduct($id_book){
      /* $book=DB::table('books')->where('idBook',$id_book)->first();
        $image_name= $book->hinh_dai_dien;
        $image_path = "public/uploaded/books/".$image_name;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $images=DB::table('img_book')->where('idBook',$book->idBook)->get();
        foreach($images as $img){
            $image_name= $img->NameImg;
            $image_path = "public/uploaded/books/".$image_name;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            DB::table('img_book')->where('idImg',$img->idImg)->delete();
        }
        
        DB::table('books')->where('idBook',$id_book)->delete();
        return redirect('admin/san-pham/danh-sach');*/

        $book=DB::table('books')->where('idBook',$id_book)->first();
        $bill=DB::table('detailbill')->where('idBook',$book->idBook)->get();
        $count=0;
        foreach($bill as $b){
               $count++; 
        }
        if($count>0){
            return Redirect::back();
        }
        else{
            DB::table('books')->where('idBook',$id_book)->update(['status'=>0]);
            return Redirect::back();
        }
    }

}
session_destroy();