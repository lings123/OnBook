@extends('layout.master')
@section('content')
    <!--banner-->
  <!-- Start Bradcaump area -->
  <?php 
	$recent=Session::get('recent');
	$keyword=Session::get('keyword');
	$result=Session::get('result');
  ?>
  <div class="ht__bradcaump__area bg-image--6" style="background-image: url(../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Keyword : {{$keyword}}</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Tìm kiếm</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Blog Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 ">
				<div class="blog-page">
					<div class="page__header">
						<h2>Blogs</h2>
					</div>
					<!-- Start Single Post -->
					@if($result)
					@foreach($result as $blog)
					<article class="blog__post d-flex flex-wrap">
						<div class="thumb">
							<a href="{{URL('/blog/chi-tiet/'.$blog->slug_name)}}">
								<img src="{{URL('public/uploaded/blog/'.$blog->hinh_dai_dien)}}" alt="blog images">
							</a>
						</div>
						<div class="content">
							<h4><a href="{{URL('/blog/chi-tiet/'.$blog->slug_name)}}">{{$blog->tieude}}</a></h4>
							<ul class="post__meta">
								<?php $admin=DB::table('admin')->where('idAd',$blog->idAd)->first() ?>
								<li>Posts by : <a href="#">{{$admin->NameAd}}</a></li>
								<li class="post_separator">/</li>
								<li>{{ \Carbon\Carbon::parse($blog->create_date)->format('d/m/Y H:i:s')}}</li>
							</ul>
							<p>{!!$blog->gioithieu!!}</p>
							<div class="blog__btn">
								<a class="shopbtn" href="{{URL('/blog/chi-tiet/'.$blog->slug_name)}}">read more</a>
							</div>
						</div>
					</article>
					<!-- End Single Post -->
					@endforeach
                    
					@endif
				</div>
				<ul class="wn__pagination">
					<li >{{$result->links('vendor.pagination.semantic-ui')}}</li>
				</ul>
			</div>
			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
				@include('layout.sider_blog');
			</div>
		</div>
	</div>
</div>
<!-- End Blog Area -->
@endsection
@section('title')
	OnBook | Kết quả tìm kiếm bài viết
@endsection