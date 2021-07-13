@extends('layout.master')
@section('content')
    <?php $user=Session::get('user'); ?>
    <!--banner-->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Thông tin cá nhân</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Information</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-12 order-1 order-lg-2">
				<div class="my__account__wrapper">
					<h3 class="account__title">Thông tin cá nhân</h3>
					
					<form action="{{URL::to('/info')}}" method="POST">
						<?php 
						$mess=Session::get('message') ;
						Session::put('message',null);  
						$kh=DB::table('users')->where('id',$user->id)->first()
					?> 
                    @if($mess)
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>{{$mess}}</strong>
					</div>
					@endif
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
						<div class="account__form">
                            <label>Điểm tích lũy : {{number_format($kh->diemtichluy)}} điểm </label> 
							<div class="input__box">
								<label>Tên khách hàng <span>*</span></label> 
								<input type="text" name="txtName" value="{{$kh->name}}" required>
							</div>
							<div class="input__box">
								<label>Địa chỉ<span>*</span></label>
                               
								<input type="text" name="txtAddress" value="{{$kh->address}}" required>
							</div>
                            <div class="input__box">
								<label>Số điện thoại<span>*</span></label>
								<input type="text" name="txtPhone" value="{{$kh->phone}}" required>
							</div>
                            <div class="input__box">
								<label>Giới tích</label>
							</div>
                            <input type="radio" name="rdoGt" value="1" @if($kh->gioitinh==1) checked @endif > Nam
                            <input type="radio" name="rdoGt" value="0" @if($kh->gioitinh==0) checked @endif > Nữ
							{{ csrf_field() }}
                            
							<div class="form__btn">
                                <br>
								<button>Cập nhật</button>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                @include('layout.sider_kh');
            </div>
		</div>
	</div>
</section>
<!-- End My Account Area -->

@endsection
@section('title')
	OnBook | Cập nhật thông tin
@endsection