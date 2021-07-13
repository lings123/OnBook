@extends('layout.master')
@section('content')
<?php
    $check=Session::get('check');
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
<div class="container">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="wn__order__box">
                <h3 class="onder__title">Cảm ơn bạn đã đã đặt hàng</h3>
                <ul class="order_product">
                <li>Bạn đã chọn hình thức giao hàng : {{$check->nameCheck}}</li>
               @if($check->idCheck==2)
                 <li>Để xác nhận bạn {!!$check->noidung!!}</li>
                @endif
                <li>Đơn hàng bạn đã được gửi qua mail, Bạn vui lòng kiểm tra </li>
               
            <div class="cartbox__btn">
                <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                    <li><a href="{{URL::to('/')}}">Trở lại trang chủ</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title')
	OnBook | Hoàn tất đặt hàng
@endsection