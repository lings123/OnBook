@extends('layout.master')
@section('content')
<?php
    	$recent=Session::get('recent');
        $blog=Session::get('blog');
?> 
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--6" style="background-image: url(../../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">{{$blog->tieude}}</h2>
                        <nav class="bradcaump-content">
                          <a class="breadcrumb_item" href="index.html">Home</a>
                          <span class="brd-separetor">/</span>
                          <span class="breadcrumb_item active">Bài viết</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                                <img src="{{URL('public/uploaded/blog/'.$blog->hinh_dai_dien)}}" alt="blog images">
                            </div>
                            <div class="post_wrapper">
                                <div class="post_header">
                                    <h2>{{$blog->tieude}}</h2>
                                    <ul class="post_author">
                                        <?php $admin=DB::table('admin')->where('idAd',$blog->idAd)->first() ?>
                                        <li>Posts by : <a href="#">{{$admin->NameAd}}</a></li>
                                        <li class="post-separator">/</li>
                                        <li>{{ \Carbon\Carbon::parse($blog->create_date)->format('d/m/Y H:i:s')}}</li>
                                    </ul>
                                </div>
                                <div class="post_content">
                                    <p>{!!$blog->gioithieu!!}</p>
                                    <p>{!!$blog->noidung!!}</p>

                                </div>
                                
                            </div>
                        </article>
                      
                    </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                   @include('layout.sider_blog')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
	OnBook | Chi tiết bài viết
@endsection