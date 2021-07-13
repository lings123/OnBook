@extends('layout.master')
@section('content')
  <!-- Start Bradcaump area -->
  <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Shopping Cart</h2>
                    <nav class="bradcaump-content">
                      <a class="breadcrumb_item" href="index.html">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb_item active">Shopping Cart</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<?php 
						$mess=Session::get('errors') ;
						Session::put('errors',null);   
					?> 
                    @if($mess)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>{{$mess}}</strong>
					</div>
                    @endif
<div class="cart-main-area section-padding--lg bg--white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 ol-lg-12">
                <form action="#">               
                    <div class="table-content wnro__table table-responsive">
                        <table>
                            <thead>
                                <tr class="title-top">
                                    <th class="product-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Tên sách</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng</th>
                                    <th class="product-remove">Xóa</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if(Cart::instance('shopping')->count())
                                @foreach(Cart::instance('shopping')->content() as $book)
                                <tr>
                                    <td class="product-thumbnail"><a href="{{URL::to('/chi-tiet/'.$book->options->slug_name)}}"><img src="{{URL::to('public/uploaded/books/'.$book->options->image)}}" alt="product img"></a></td>
                                    <td class="product-name"><a href="{{URL::to('/chi-tiet/'.$book->options->slug_name)}}">{{$book->name}}</a></td>
                                    <td class="product-price"><span class="amount">{{number_format($book->price)}} VND</span></td>
                                  
                                    <td class="product-quantity">
                                        <form action="#">    
                                         
                                        </form>
                                    <form action="{{ URL::to('/gio-hang/sua/'.$book->rowId) }}" method="POST">
                                        <input type="number" name="qty" value="{{$book->qty}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn"  >Update</button>
                                    </form>
                                    </td>
                               
                                    <td class="product-subtotal">{{number_format($book->subtotal)}} VND</td>
                                    <td class="product-remove"><a href="{{URL::to('/gio-hang/xoa/'.$book->rowId)}}">X</a></td>
                                    
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </form> 
                <div class="cartbox__btn">
                    <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                        <li><a href="{{URL::to('/')}}">Tiếp tục mua sắm</a></li>
                        <li><a href="{{URL::to('/gio-hang/xoa')}}">Xóa giỏ hàng</a></li>
                        <li><a href="{{URL::to('/thanh-toan')}}">Thanh toán</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $ship=30000;
        $subtotal=Cart::instance('shopping')->subtotal(0,"","");
        if($subtotal>200000){
            $total=$subtotal;
        }else{
           
            $total=$subtotal+$ship;
        }
        ?>
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="cartbox__total__area">
                    <div class="cartbox-total d-flex justify-content-between">
                        <ul class="cart__total__list">
                            <li>Tổng </li>
                            <li>Shipping</li>
                        </ul>
                        <ul class="cart__total__tk">
                          
                            <li>{{number_format($subtotal)}} VND</li>
                            <li>@if($subtotal<200000) {{number_format($ship)}} @else 0 @endif VND</li>
                            
                        </ul>
                    </div>
                    <div class="cart__total__amount">
                        <span>Total</span>
                        <span>{{number_format($total)}} VND</span>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- cart-main-area end -->
<!--//content-->
@endsection
@section('title')
	OnBook | Chi tiết giỏ hàng
@endsection
