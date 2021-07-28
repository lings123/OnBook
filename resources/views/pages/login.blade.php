@extends('layout.master')
@section('content')
    <!--banner-->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">My Account</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">My Account</span>
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
			<div class="col-lg-6 col-12">
				<div class="my__account__wrapper">
					<h3 class="account__title">Login</h3>
					
					<form action="{{URL::to('/login')}}" method="POST">
						<?php 
						$mess=Session::get('error') ;
						Session::put('error',null);   
						$mess2=Session::get('message') ;
						Session::put('message',null);  
						$mess3=Session::get('dangnhap') ;
						Session::put('dangnhap',null);  
						?> 
						@if($mess)
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>{{$mess}}</strong>
							</div>
						@endif
						@if($mess3)
							<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>{{$mess3}}</strong>
							</div>
						@endif
						@if($mess2)
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>{{$mess2}}</strong>
							</div>
						@endif
						<div class="account__form">
							<div class="input__box">
								<label>Email address <span>*</span></label>
								<input type="text" name="txtEmail" required>
							</div>
							<div class="input__box">
								<label>Password<span>*</span></label>
								<input type="password" name="txtPass" required>
							</div>
							{{ csrf_field() }}
							<div class="form__btn">
								<button type="submit">Login</button>
							</div>
							<a class="forget_pass" href="{{URL::to('/reset')}}">Lost your password?</a>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<div class="my__account__wrapper">
					
					<h3 class="account__title">Register</h3>
					
					<form action="{{URL::to('/signin')}}" method="POST">
						<?php $xacnhan=Session::get('xacnhan') ;
						Session::put('xacnhan',null);   ?>
						@if($errors)
							@if($errors->count()>0)
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Warning!!</strong><br>
								@foreach($errors->all() as $err)
									{{$err}}<br>
								@endforeach
							</div>
							@endif
						@endif
						@if($xacnhan)
							<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>{{$xacnhan}}</strong>
							</div>
						@endif
						<div class="account__form">
							<div class="input__box">
								<label>Name <span>*</span></label>
								<input type="text" name="txtName" required>
							</div>
							<div class="input__box">
								<label>Email address <span>*</span></label>
								<input type="email" name="txtEmail" required>
							</div>
							<div class="input__box">
								<label>Password<span>*</span></label>
								<input type="password" name="txtPass" required>
							</div>
							<div class="input__box">
								<label>Password Comfirm<span>*</span></label>
								<input type="password" name="txtConfirmPass" required>
							</div>
							{{ csrf_field() }}
							<div class="form__btn">
								<button type="submit">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End My Account Area -->
@endsection
@section('title')
	OnBook | Đăng ký/ Đăng nhập 
@endsection