<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelFollow\Traits\CanLike;
session_start();

class PageController extends Controller
{
    public function __construct(){
        $cate=DB::table('category')->get();
        Session::put('cate',$cate);
        $Type=DB::table('type')->get();
        Session::put('type',$Type);
        $author=DB::table('author')->get();
        Session::put('author',$author);
        $publisher=DB::table('publisher')->get();
        Session::put('publisher',$publisher);
        $user=Session::get('user');
        
    }
    /////Trang chủ////
    public function getHome(){
        $listNew=DB::table('books')->where('status',1)->orderBy('create_date','DESC')->where('new',1)->get();
        $listslider=DB::table('slider')->get();
        $listBlog=DB::table('blog')->orderBy('create_date','DESC')->get();
        Session::put('listslider',$listslider);
        Session::put('listNew',$listNew);
        Session::put('listBlog',$listBlog);
        return view('pages.home');
    }

    public function getSalecode(){
        $khuyenmai=DB::table('sale')->where('active',1)->get();
        
        Session::put('khuyenmai',$khuyenmai);

        return  view('pages.sale_code');
    }
    ////Blog/////
    public function getBlog(){
        $listBlog=DB::table('blog')->select('*')->orderBy('create_date','DESC')->paginate(5);
        $recent=DB::table('blog')->select('*')->orderBy('create_date','DESC')->limit(5)->get();
        Session::put('recent',$recent);
        Session::put('listBlog',$listBlog);
        return view('pages.blog');
    }
    ///Chi tiết blog///
    public function getBlogDetail($slug_name){
        $blog=DB::table('blog')->where('slug_name',$slug_name)->first();
       Session::put('blog',$blog);
       return view('pages.blog_detail');
    }
    ///tìm kiếm Blog///
    public function getBlogSearch(Request $request){
        $keyword=$request->keyword;
        $result=DB::table('blog')->select('*')->where('tieude','LIKE', "%{$keyword}%")->orderBy('create_date','DESC')->paginate(5);
        Session::put('keyword',$keyword);
        Session::put('result',$result);
        return view('pages.blog_search');
    }
    ////END BLOG////

    /////Tình trạng////
    public function getTT($tt,Request $request){
        if($tt=='new'){
            if($request->orderbyBook){
                $sort=$request->orderbyBook;
                if($sort=="md"){
                 $books=DB::table('books')->select('*')->where('new',1)->where('status',1)->orderBy('create_date','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_low"){
                 $books=DB::table('books')->select('*')->where('new',1)->where('status',1)->orderBy('unit_price','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_high"){
                 $books=DB::table('books')->select('*')->where('new',1)->where('status',1)->orderBy('unit_price','ASC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
            }
            else{
            $new = DB::table('books')->select('*')->where('new',1)->where('status',1)->orderBy('create_date','DESC')->paginate(9);
            Session::put('books',$new);
            }
            Session::put('mess_new','Sản phẩm mới');
        }
        if($tt=='sale'){
            if($request->orderbyBook){
                $sort=$request->orderbyBook;
                if($sort=="md"){
                 $books=DB::table('books')->select('*')->where('sale_price','>',0)->where('status',1)->orderBy('create_date','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_low"){
                 $books=DB::table('books')->select('*')->where('sale_price','>',0)->where('status',1)->orderBy('unit_price','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_high"){
                 $books=DB::table('books')->select('*')->where('sale_price','>',0)->where('status',1)->orderBy('unit_price','ASC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
            }
            else{
            $sale=DB::table('books')->select('*')->where('sale_price','>',0)->where('status',1)->orderBy('create_date','DESC')->paginate(9);
            Session::put('books',$sale);
            }
            Session::put('mess_sale','Sản phẩm khuyến mãi');
        }
        
        if($tt=='all'){
            if($request->orderbyBook){
                $sort=$request->orderbyBook;
                if($sort=="md"){
                 $books=DB::table('books')->select('*')->where('status',1)->orderBy('create_date','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_low"){
                 $books=DB::table('books')->select('*')->where('status',1)->orderBy('unit_price','DESC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
                if($sort=="price_high"){
                 $books=DB::table('books')->select('*')->where('status',1)->orderBy('unit_price','ASC')->paginate(9);
                 Session::put('books',$books);
                 Session::put('sort',$sort);
                }
            }
            else{
            $all=DB::table('books')->select('*')->orderBy('create_date','DESC')->where('status',1)->paginate(9);
            Session::put('books',$all);
            }
            Session::put('mess_all','Tất cả sản phẩm');
        }
       
        return view('pages.category');
    }

    ////END///
    ////Theo loại////
    public function getCategory($idType,Request $request){
        $typeName=DB::table('type')->where('idType',$idType)->first();
        Session::put('typeName',$typeName->nameType);
        
       if($request->orderbyBook){
           $sort=$request->orderbyBook;
           if($sort=="md"){
            $books=DB::table('books')->select('*')->where('status',1)->where('idType',$idType)->orderBy('create_date','DESC')->paginate(9);
            Session::put('books',$books);
            Session::put('sort',$sort);
           }
           if($sort=="price_low"){
            $books=DB::table('books')->select('*')->where('status',1)->where('idType',$idType)->orderBy('unit_price','DESC')->paginate(9);
            Session::put('books',$books);
            Session::put('sort',$sort);
           }
           if($sort=="price_high"){
            $books=DB::table('books')->select('*')->where('status',1)->where('idType',$idType)->orderBy('unit_price','ASC')->paginate(9);
            Session::put('books',$books);
            Session::put('sort',$sort);
           }
       }
       else{
        $books=DB::table('books')->select('*')->where('status',1)->where('idType',$idType)->orderBy('create_date','DESC')->paginate(9);
        Session::put('books',$books);
       }
       
       
        return view('pages.category');
    }
    ////Theo nhà sản xuất///
    public function getPublisher($idPub,Request $request){
       
        $PubName=DB::table('publisher')->where('idPub',$idPub)->first();
        Session::put('PubName',$PubName->namePub);
        if($request->orderbyBook){
            $sort=$request->orderbyBook;
            if($sort=="md"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idPub',$idPub)->orderBy('create_date','DESC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
            if($sort=="price_low"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idPub',$idPub)->orderBy('unit_price','DESC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
            if($sort=="price_high"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idPub',$idPub)->orderBy('unit_price','ASC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
        }
        else{
            $books=DB::table('books')->select('*')->where('status',1)->where('idPub',$idPub)->orderBy('create_date','DESC')->paginate(9);
            Session::put('books',$books);
        }
        return view('pages.category');
    }
    ////Theo tác giả////
    public function getAuthor($idAuthor,Request $request){
        
        $AuthorName=DB::table('author')->where('idAuthor',$idAuthor)->first();
        Session::put('AuthorName',$AuthorName->nameAuthor);
        if($request->orderbyBook){
            $sort=$request->orderbyBook;
            if($sort=="md"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idAuthor',$idAuthor)->orderBy('create_date','DESC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
            if($sort=="price_low"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idAuthor',$idAuthor)->orderBy('unit_price','DESC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
            if($sort=="price_high"){
             $books=DB::table('books')->select('*')->where('status',1)->where('idAuthor',$idAuthor)->orderBy('unit_price','ASC')->paginate(9);
             Session::put('books',$books);
             Session::put('sort',$sort);
            }
        }
        else{
            $books=DB::table('books')->select('*')->where('idAuthor',$idAuthor)->orderBy('create_date','DESC')->paginate(9);
            Session::put('books',$books);
        }
        return view('pages.category');
    }


    public function getDetail($slug_name){
        $book=DB::table('books')->where('slug_name',$slug_name)->first();
        Session::put('book',$book);
        $img_book=DB::table('img_book')->where('idBook',$book->idBook)->get();
        Session::put('img_book',$img_book);
        $book_relate=DB::table('books')->where('idType',$book->idType)->get();
        Session::put('book_relate',$book_relate);
        $comment=DB::table('danhgia')->select('*')->where('idBook',$book->idBook)->orderBy('create_date','DESC')->paginate(4);
        Session::put('comment',$comment);
        return view('pages.detail');
    }
    public function getContact(){
        return view('pages.contact');
    }
    public function getType(){
        return view('pages.type');
    }
    public function getLogin(){
        return view('pages.login');
    }

    ///Đăng ký///
    public function postSignin(Request $request){
        $this->validate($request,[
    		'txtEmail' => 'unique:users,email',
            'txtName'       =>'regex:/^[\p{L}\s-]+$/u',
            /*
                Should have At least one Uppercase letter.
                At least one Lower case letter.
                Also,At least one numeric value.
                And, At least one special character.
                Must be more than 6 characters long.
            */
            'txtPass'        => "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/",
            'txtConfirmPass' => "same:txtPass", 
    	],[
    		"txtEmail.unique"          => "Email đã tồn tại",
            'txtName.regex'         => "Tên không có số",
            "txtPass.regex"     =>"Password phải có 
                                    , ít nhất 1 ký tự viết hoa
                                    , ít nhất 1 ký tự thường
                                    , ít nhất 1 số
                                    , ít nhất 1 ký tự đặc biệt
                                    , phải nhiều hơn 6 ký tự",
            "txtConfirmPass.same"     =>"Xác nhận password không đúng",
    	]);
        $data=array();
        $data['name']=$request->txtName;
        $data['email']=$request->txtEmail;
        $data['password']=md5($request->txtPass);
        $token = hash_hmac('sha256', $request->txtPass, config('app.key'));
        $data['token_remember']=$token;
        $mailData = [
            'title' => 'Cảm ơn '.$request->txtName.' đã đăng ký dịch vụ của OnBook. ',
            'content' => 'Chúng tôi gửi bạn mã khuyến mãi giảm 10% giá trị đơn hàng : NEW (được sử dụng 3 lần).
                            Mời bạn nhập mã xác nhận đã được cấp để kích hoạt tài khoản. ',
            'email' => 'Email : ' .$request->txtEmail,
            'password' => 'Mã xác nhận : ' .$token,
        ];
        \Mail::to($request->txtEmail)->send(new \App\Mail\welcomeNhanVien($mailData));
        DB::table('users')->insert($data);
        return view('pages.confirm');
    }

    
    ///Xác nhận tài khoản////
    public function postConfirm(Request $request){
        $token = $request->txtToken;
        DB::table('users')->where('token_remember',$token)->update(['email_verified_at'=>NOW(),'active'=>1]);
        Session::put('message','Xác nhận thành công');
        return redirect('/confirm');
    }

    ///Đăng nhập////
    public function postLogin(Request $request){
        
        $email=$request->txtEmail;
        $password = md5($request->txtPass);

        $result= DB::table('users')
        ->where('email',$email)->where('password',$password)->where('active',1)
        ->first();

       
        if($result){
            Session::put('user',$result);
            return redirect::to('/');
        }else{
            Session::put('error',"Email hoặc Password không đúng! Hoặc chưa kích hoạt! Vui lòng kiểm tra lại!");
            return redirect::to('/login');
        }
    }

    ////Cập nhật thông tin cá nhân////
    public function getInfo(){
        return view('pages.info');
    }

    ////Đổi mật khẩu/////
    public function getNewPass(){
        return view('pages.changePass');
    }

    public function postNewPass(Request $request){
        $this->validate($request,[
    		
            /*
                Should have At least one Uppercase letter.
                At least one Lower case letter.
                Also,At least one numeric value.
                And, At least one special character.
                Must be more than 6 characters long.
            */
            'txtNewPass'        => "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/",
            'txtConfirmPass' => "same:txtNewPass", 
    	],[
            "txtNewPass.regex"     =>"Password phải có 
                                    , ít nhất 1 ký tự viết hoa
                                    , ít nhất 1 ký tự thường
                                    , ít nhất 1 số
                                    , ít nhất 1 ký tự đặc biệt
                                    , phải nhiều hơn 6 ký tự",
            "txtConfirmPass.same"     =>"Xác nhận password không đúng",
    	]);
        $old_pass=$request->txtPass;
        $new_pass=$request->txtNewPass;
        $confirm=$request->txtConfirmPass;

        $user=Session::get('user');
        $password=DB::table('users')->where('id',$user->id)->first();
        if(md5($old_pass)==$password->password){
            if(md5($new_pass)==$password->password){
                Session::put('error','Mật khẩu mới không được giống với mật khẩu cũ');
                return Redirect::back();
            }
            else{
                DB::table('users')->where('id',$user->id)->update(['password'=>md5($new_pass),'updated_at'=>NOW()]);
                $kh=DB::table('users')->where('id',$user->id)->first();
                $date=Carbon::parse($kh->updated_at)->format('d/m/Y H:i:s');
                $mailData = [
                    'title' => 'Bạn đã thay đổi mật khẩu thành công ',
                    'content' => 'Bạn đã thay đổi mật khẩu cho email '.$kh->email. 'vào lúc '. $date.' thành công.',
                    'email' => 'Nếu không phải chính chủ đổi vui lòng liên hệ lại. Còn nếu là chính chủ thì vui lòng bỏ qua email này.',
                    'password' => 'Xin lỗi đã làm phiền. Chúc bạn một ngày vui vẻ.',
                ];
                \Mail::to($kh->email)->send(new \App\Mail\welcomeNhanVien($mailData));
                Session::put('user',null);
                return redirect('/');
            }
           
        }
        else{
            Session::put('error','Mật khẩu cũ không chính xác');
            return Redirect::back();
        }

    }

    ////Quên mật khẩu////
    public function getReset(){
        return view('pages.reset');
    }
    public function SendNewPass(Request $request){
        $kq=false;
        $users=DB::table('users')->get();
        foreach($users as $user){
            if($user->email==$request->txtEmail){
                $kq=true;
            }
        }
        if($kq==true){
            $pass=Str::random(12);
            DB::table('users')->update(['password'=>md5($pass),'updated_at'=>NOW()]);
            $mailData = [
                'title' => 'Yêu cầu thay đổi mật khẩu thành công',
                'content' => 'Mật khẩu mới của bạn là '.$pass,
                'email' => 'Bạn vui lòng đăng nhập là đổi lại mật khẩu',
                'password' => '',
            ];
            \Mail::to($request->txtEmail)->send(new \App\Mail\welcomeNhanVien($mailData));
            return redirect('/login');
        }
        else{
            Session::put('message','Email này chưa đăng ký!');
            return Redirect::back();
        }
    }

    

    public function postInfo(Request $request){
        $user=Session::get('user');
        $phone=DB::table('users')->select('phone')->where('id',$user->id)->first();
        $this->validate($request,[
            'txtName'       =>'regex:/^[\p{L}\s-]+$/u',
            'txtAddress'       =>'min:50',
            /*
                Should have At least one Uppercase letter.
                At least one Lower case letter.
                Also,At least one numeric value.
                And, At least one special character.
                Must be more than 6 characters long.
            */
            'txtPass'        => "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/",
            'txtConfirmPass' => "same:txtPass", 
            'txtPhone'       =>'phone:AUTO,VN|unique:users,phone,'.$user->id.',id',
    	],[
            "txtPhone.unique"          => "Phone đã tồn tại",
            'txtAddress.min'       => 'Địa chỉ phải nhiều hơn 50 ký tự',
            'txtName.regex'         => "Tên không có số",
            "txtPhone.phone"          =>"Không đúng định dạng điện thoại"
    	]);

        $data=array();
        $data['name']=$request->txtName;
        $data['address']=$request->txtAddress;
        $data['gioitinh']=$request->rdoGt;
        $data['phone']=preg_replace('[^0-9]', '',phone($request->txtPhone ,'VN')->formatNational());
       
        DB::table('users')->where('id',$user->id)->update($data);
        Session::put('message',"Cập nhật thành công!");

        return Redirect::back();

    }

    ////Danh sách đơn hàng/////
    public function getBills(){
        $user=Session::get('user');
        $listBill=DB::table('bills')->where('idKh',$user->id)->get();
        Session::put('listBill',$listBill);
        return view('pages.list_Bill');
    }
    ////Xem chi tiết đơn hàng///
    public function getDetailBill($id_bill){
        $Detail = DB::table('detailbill')->where('idBill',$id_bill)->get();
        $Bill=DB::table('bills')->where('idBill',$id_bill)->first();
        Session::put('bill',$Bill);
        Session::put('Detail',$Detail);

        return view('pages.detail_bill');
    }
    /////Hủy đơn hàng///
    public function postBillDes(Request $request,$id_bill){
        DB::table('bills')->where('idBill',$id_bill)->update(['trangthai'=>4,'note'=>$request->txtnote,'update_date'=>NOW()]);

        return redirect('listBill');

    }

    ///Đăng xuất///
   public function getLogout(){
        Session::put('user',null);
        return redirect::to('/');
   }

    ////trang CHECKOUT//////
    public function getCheckout(){
        if(Cart::instance('shopping')->count()==0){
            return redirect('/gio-hang');
        }
        else{
             return view('pages.checkout');
        }
       
    }

    ////Khuyến mãi////
    public function postSale(Request $request){
        $sale=$request->txtSale;
        $coupon=DB::table('sale')->where('nameSale',$sale)->where('active',1)->first();
        $user=Session::get('user');
        $bills=DB::table('bills')->where('idKH',$user->id)->get();
        if($coupon->active==0){
            Session::put('error','Không có mã khuyến mãi này!');
            Session::put('sz',null);
            return redirect('/thanh-toan');
        }
        else{
            
            foreach($bills as $bill){
                $sl=1;
                if($bill->idSale==$coupon->idSale){
                    $sl=$sl+1;
                }
            }
           
            if($sl>$coupon->solan){
                Session::put('error','Áp dung quá số lần cho phép!');
                Session::put('sz',null);
                return redirect('/thanh-toan');
            }
            else{
               
                Session::put('sz',$coupon);
                $sale=Session::get('sz');
                
                return redirect('/thanh-toan');
            }
        }
    }
    ///xóa khuyến mãi///
    public function delSale(){
        Session::put('sz',null);
        return redirect::back();
    }

    ////Sử dụng điểm tích lũy///
    public function postTichluy(Request $request){
        $diem=$request->diem;
        if($diem>0){
            Session::put('diem',$diem);
            return Redirect::back();
        }else{
            Session::put('error','Không điểm tích lũy!');
            Session::put('diem',null);
            return Redirect::back();
        }
    }

    /////đặt hàng////
    public function postBill(Request $request){
        $user=Session::get('user');
        $sale_code=Session::get('sz');
        $diem=Session::get('diem');
        $data=array();
        $this->validate($request,[
                'txtName'       =>'min:5|regex:/^[\p{L}\s-]+$/u',
                'txtPhone'       => "phone:AUTO,VN",
                'txtAddress'    =>'min:10',
            ],[
                'txtAddress.min'        =>"Địa chỉ phải trên 10 ký tự",
                'txtName.min'           =>"Tên phải trên 6 ký tự",
                'txtName.regex'         => "Tên không có số",
                "txtPhone.phone"          =>"Điện thoại không đúng"
            ]);
            
            $data['nameKH']=$request->txtName;
            $data['address']=$request->txtAddress;
            $data['phone']=$request->txtPhone;
            $data['email']=$request->txtEmail;
            $data['idCheck']=$request->rdoCheck;
            $check=DB::table('thanhtoan')->where('idCheck',$request->rdoCheck)->first();
           
                $data['trangthai']=0;
           
            
            $data['note']=$request->txtNote;
            $total=Cart::instance('shopping')->subtotal(0,"","");
            $ship=30000;
            if($total>200000){
                $total=$total;
            }
            else{
                $total=$total+$ship;
            }
            if($sale_code){
                $data['idSale']=$sale_code->idSale;
                $total=$total-($total*$sale_code->phantram);
            }
            if($diem>0){
                $total=$total-$diem;
                
            }
            if($user){
                $data['idKH']=$user->id;
                $kh=DB::table('users')->where('id',$user->id)->first();
                DB::table('users')->where('id',$user->id)->update(['diemtichluy'=>'0','updated_at'=>NOW()]);
                
                if($total>=200000&&$total<500000){
                    $qty=$kh->diemtichluy+500;
                    DB::table('users')->where('id',$user->id)->update(['diemtichluy'=>$qty,'updated_at'=>NOW()]);
                }
                
                if($total>=500000&&$total<1000000){
                    $qty=$kh->diemtichluy+1000;
                    DB::table('users')->where('id',$user->id)->update(['diemtichluy'=>$qty,'updated_at'=>NOW()]);
                }
                if($total>=1000000&&$total<2000000){
                    $qty=$kh->diemtichluy+1500;
                    DB::table('users')->where('id',$user->id)->update(['diemtichluy'=>$qty,'updated_at'=>NOW()]);
                }
                if($total>=2000000){
                    $qty=$kh->diemtichluy+3000;
                    DB::table('users')->where('id',$user->id)->update(['diemtichluy'=>$qty,'updated_at'=>NOW()]);
                }
                
            }

            $data['totalPrice']=$total;

            if(DB::table('bills')->insert($data)){
                $bill_id = DB::table('bills')->max('idBill');
                $details=array();
                foreach(Cart::instance('shopping')->content() as $cart)
                {
                    $details['idBill']=$bill_id;
                    $details['idBook']=$cart->id;
                    $details['quantity']=$cart->qty;
                    $details['unit_price']=$cart->subtotal(0,'','');
                    DB::table('detailbill')->insert($details);
                    $book=DB::table('books')->where('idBook',$cart->id)->first();
                    $qty=$book->quantity-$cart->qty;
                    DB::table('books')->where('idBook',$cart->id)->update(['quantity'=>$qty,'update_date'=>NOW()]);
                }
            }

            $mailData = [
                'nameCus' => $request->txtName,
                'address' => $request->txtAddress,
                'phone' => $request->txtPhone,
                'email' => $request->txtEmail,
                'check' => $check,
                'sale'  =>$sale_code,
                'diem'  =>$diem,
                'create_date' => NOW(),
                'trangthai' => 'Đã xử lý',
                'Cart' => Cart::instance('shopping')->content(),
            ];
            Session::put('sz',null);
            Session::put('diem',null);
            \Mail::to($request->txtEmail)->send(new \App\Mail\BillMail($mailData));
            
            Session::put('check',$check);
            Cart::instance('shopping')->destroy();
           
            return view('pages.complete');
       
        
    }

    /////tìm kiếm/////
    public function getSearch(Request $request){
        $keyword=$request->keyword;
        $result=DB::table('books')->select('*')->where('NameBook','LIKE', "%{$keyword}%")->where('status',1)->orderBy('create_date','DESC')->paginate(9);
        Session::put('keyword',$keyword);
        Session::put('result',$result);
        return view('pages.search');
    }
    ////END/////

    ////Comment////
    public function postComment($idBook,Request $request){

        $user=Session::get('user');
        
					
        $book=DB::table('books')->where('idBook',$idBook)->first();
        $comment=DB::table('danhgia')->where('idBook',$idBook)->get();
        

       $user_com=DB::table('danhgia')->where('idKH',$user->id)->where('idBook',$idBook)->first();
       if($user_com){
           Session::put('error','Bạn đã đánh giá sách này!');
           return Redirect::back();
       }
       else{
            $diem=0;
            $sl=0;
            if($comment->count()>1){
                foreach($comment as $com){
                    $sl=$sl+1;
                    $diem=$diem+$com->diem;
                }
                $tb=$diem/$sl;
                DB::table('books')->where('idBook',$idBook)->update(['diem'=>$tb]);
            }else{
                DB::table('books')->where('idBook',$idBook)->update(['diem'=>$request->diem]);
            }

            $data=array();
            $data['tieude']=$request->tieude;
            $data['noidung']=$request->noidung;
            $data['diem']=$request->diem;
            $data['idBook']=$idBook;
            $data['idKH']=$user->id;

            
            DB::table('danhgia')->insert($data);
            return Redirect::back();

       }

        
    }

    public function save_likedislike(Request $request){
       
        $data=array();
        $data['idCom']=$request->post;
        if($request->type=='like'){
            $data['like_com']=1;
        }else{
            $data['dislike_com']=1;
        }
        DB::table('like_dislikes')->insert($data);
        return response()->json([
            'bool'=>true
        ]);
        
     }
    /////END//////


    ////Trending////
    /*public function getTrend(){
        $book=DB::table('trending')->select('*')->paginate(9);
        Session::put('books',$book);

        return view('pages.trending');
    }
    */

    ////END////

    ////Giá////
    /*public function getGia($type){
        
        if($type=="asc"){
            $listBook=Session::get('books')->orderBy('unit_price','ASC')->get();
            Session::put('sort','asc');
        }
        if($type=='desc'){
            $listBook=Session::get('books')->orderBy('unit_price','DESC')->get();
            Session::put('sort','asc');
        }
        Session::put('books',$listBook);
        
        return view('pages.category');
    }*/
    ////
}

session_destroy();
