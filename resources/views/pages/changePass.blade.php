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
					<h2 class="bradcaump-title">Đổi mật khẩu</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Change password</span>
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
					<h3 class="account__title">Đổi mật khẩu</h3>
					
					<form action="{{URL::to('/change-password')}}" method="POST">
						<?php 
						$mess=Session::get('message') ;
						Session::put('message',null);  
                        $error=Session::get('error') ;
						Session::put('error',null);  
					?> 
                    @if($mess)
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>{{$mess}}</strong>
					</div>
					@endif
                    @if($error)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>{{$error}}</strong>
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
							<div class="input__box">
								<label>Mật khẩu cũ <span>*</span></label> 
								<input type="password" name="txtPass"  required>
							</div>
							<div class="input__box">
								<label>Mật khẩu mới <span>*</span></label> 
								<input type="password" name="txtNewPass" required>
							</div>
                            <div class="input__box">
								<label>Xác nhận mật khẩu mới <span>*</span></label> 
								<input type="password" name="txtConfirmPass"required>
							</div>
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
	OnBook | Đổi mật khẩu
@endsection