    @extends('layout.master')
    @section('content')
    
    <!-- Start Bradcaump area -->
    <?php $user=Session::get('user'); 
        
        $sale_code=Session::get('sz');
        $diem=Session::get('diem');
        if($user) 
        { 
           $kh=DB::table('users')->where('id',$user->id)->first();
        }
       
    ?>
    <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Thành toán</h2>
                        <nav class="bradcaump-content">
                          <a class="breadcrumb_item" href="index.html">Home</a>
                          <span class="brd-separetor">/</span>
                          <span class="breadcrumb_item active">Thanh toán</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn_checkout_wrap">
                        @if(!$user)
                        <div class="checkout_info">
                            <span>Have an account ? </span>
                            <a href="{{URL::to('/login')}}">Click here to login</a>
                        </div>
                        
                        @else
                        <div class="checkout_info">
                            <?php 
                                    $mess=Session::get('error') ;
                                    Session::put('error',null);   
                                ?> 
                                @if($mess)
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>{{$mess}}</strong>
                                </div>
                                @endif
                               
                            <span>Have a coupon? </span>
                            <a class="showcoupon" href="#">Click here to enter your code</a>
                        </div>
                        <div class="checkout_coupon">
                            <form action="{{URL::to('/ap-dung')}}" method="POST">
                               
                                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form__coupon">
                                    
                                    <input type="text" name="txtSale" placeholder="Coupon code">
                                    <button>Apply coupon</button>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="customer_details">
                       
                        @if($errors)
                        @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Warning!!</strong><br>
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                        @endif
                        @endif
                        <br>
                        @if($user)
                        <form action="{{URL::to('/su-dung')}}" method="POST">
                        <div class="form__coupon">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input  name="diem" type="checkbox" value="{{$kh->diemtichluy}}"> Điểm tích lũy: {{number_format($kh->diemtichluy)}} điểm
                            <button class="btn">Sử dụng</button>
                        </div>
                        
                        </form>
                        @endif 
                        <br>
                        <h3>Chi tiết đơn hàng</h3>
                        
                        <form action="{{URL::to('/dat-hang')}}" method="POST">
                        <div class="customar__field">
                            <div class="input_box ">
                                <label>Name customer <span>*</span></label>
                                <input type="text" name="txtName" value="@if($user){{$user->name}}  @endif" placeholder="Nhập tên.." required>
                            </div>
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input_box">
                                <label>Address <span>*</span></label>
                                <input type="text" placeholder="Nhập địa chỉ" value="@if($user){{$kh->address}} @endif" name="txtAddress" required>
                            </div>
                           
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" name="txtPhone" value="@if($user) {{$kh->phone}} @endif" placeholder="Nhập số điện thoại.." required>
                                </div>
                                <div class="input_box space_between">
                                    <label>Email address <span>*</span></label>
                                    <input type="email" name="txtEmail" value=" @if($user){{$kh->email}} @endif" placeholder="Nhập email..." required>
                                </div>
                            </div>
                            <div class="input_box">
                                <label>Hình thức thanh toán: <span>*</span></label>
                                </div>
                                <div class="form-group">
                                    <?php $check=DB::table('thanhtoan')->get(); ?>
                                    @foreach($check as $ch)
                                    <input  name="rdoCheck" checked type="radio" value="{{$ch->idCheck}}" > {{$ch->nameCheck}}
                                    {!!$ch->noidung!!}
                                    <br>
                                    @endforeach
                                    
                            </div>
                            <div class="input_box">
                                <label>Ghi chú</label> 
                                <input type="text" placeholder="Ghi chú đơn hàng" name="txtNote" >
                            </div>
                            <button class="btn btn-primary" type="submit">Đặt hàng</button>
                        </div>
                        </form>
                        
                        <div class="create__account">
                            <div class="wn__accountbox">
                                <span><a href="{{URL::to('/signin')}}">Create an account ?</a></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="customer_details mt--20">
                        <div class="differt__address">
                            <input name="ship_to_different_address" value="1" type="checkbox">
                            <span>Ship to a different address ?</span>
                        </div>
                       
                        <div class="customar__field differt__form mt--40">
                        <form action="{{URL::to('/dat-hang')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input_box ">
                                    <label>Name customer <span>*</span></label>
                                    <input type="text" name="txtName" placeholder="Nhập tên.." required>
                                </div>
                            
                           
                            <div class="input_box">
                                <label>Address <span>*</span></label>
                                <input type="text" placeholder="Nhập địa chỉ" name="txtAddress" required>
                            </div>
                           
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" name="txtPhone" placeholder="Nhập số điện thoại.." required>
                                </div>
                                <div class="input_box space_between">
                                    <label>Email address <span>*</span></label>
                                    <input type="email" name="txtEmail" placeholder="Nhập email..." required>
                                </div>
                            </div>
                            <div class="input_box">
                                <label>Hình thức thanh toán: <span>*</span></label>
                                </div>
                                <div class="form-group">
                                    @foreach($check as $ch)
                                    <input  name="rdoCheck" checked type="radio" value="{{$ch->idCheck}}"> {{$ch->nameCheck}}
                                    {!!$ch->noidung!!}
                                    <br>
                                    @endforeach
                            </div>
                            <div class="input_box">
                                <label>Ghi chú</label> 
                                <input type="text" placeholder="Ghi chú đơn hàng" name="txtNote" >
                            </div>
                           
                            <button class="btn btn-primary" type="submit">Đặt hàng</button>
                            <br>
                        </form>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__order__box">
                        <h3 class="onder__title">Đơn hàng</h3>
                        <ul class="order__total">
                            <li>Sách</li>
                            <li>Giá (VND)</li>
                        </ul>
                        <ul class="order_product">
                            @foreach(Cart::instance('shopping')->content() as $cart)
                          
                            <li>{{$cart->name}} × {{$cart->qty}}<span>{{number_format($cart->subtotal)}} VND</span></li>
                            @endforeach
                        </ul>
                        <ul class="shipping__method">
                            <li>Tổng đơn hàng <span>{{Cart::instance('shopping')->subtotal(0,"",",")}} VND</span></li>
                            <li>Shipping 
                                <?php $ship=30000; $subtotal=Cart::instance('shopping')->subtotal(0,"","");?>
                                @if($subtotal>200000)
                                <span>{{number_format(0)}} VND</span>
                                @else
                                <span>{{number_format($ship)}} VND</span>
                                @endif
                            </li>
                        </ul>
                        @if($sale_code)
                        <ul class="shipping__method">
                            <li>Khuyến mãi áp dụng giảm : <span>{{$sale_code->phantram*100}} %</span></li>
                            <li>Mã khuyến mãi : <span>{{$sale_code->nameSale}}<a class="fa fa-trash-o fa-fw " href="{{URL::to('/del-sale')}}"></a></span></li>
                        </ul>
                        @endif
                        @if($diem)
                        <ul class="shipping__method">
                            <li>Điểm tích lũy : <span>{{$diem}} điểm</span></li>
                            <li>Giảm : <span>{{number_format($diem)}} VND</span></li>
                        </ul>
                        @endif
                        <ul class="total__amount">
                            <?php
                            
                            if($subtotal>200000){
                                $total=$subtotal;
                            }else{
                               
                                $total=$subtotal+$ship;
                            }
                            if($sale_code){
                                $total=$total-($total*$sale_code->phantram); 
                                
                            }
                            if($diem){
                                $total=$total-$diem;
                                
                            }
                            
                            ?>
                            <li>Tổng đơn hàng<span>{{number_format($total)}} VND</span></li>
                        </ul>
                        
                    </div>
                    <div class="cartbox__btn">
                        <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                            <li><a href="{{URL::to('/gio-hang')}}">Trở lại giỏ hàng</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout Area -->
       
    @endsection
    @section('title')
	OnBook | Tiến hành đặt hàng
@endsection