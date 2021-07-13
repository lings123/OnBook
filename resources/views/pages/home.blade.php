@extends('layout.master')
@section('content')
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	
		<?php 
        $listslider=Session::get('listslider'); 
        $listcate=Session::get('cate') ;
        $listNew=Session::get('listNew');
		$user=Session::get('user');
        ?>

        <!-- Start Slider area -->
        <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
        	<!-- Start Single Slide -->
            @foreach ($listslider as $slider)
	        <div class="slide animation__style10 bg-image--1 fullscreen align__center--left"
            style="background-image: url(public/uploaded/slider/{{$slider->nameSlider}}) !important">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-lg-12">
	            			<div class="slider__content">
		            			<div class="contentbox">
		            				<h2>Buy <span>your </span></h2>
		            				<h2>favourite <span>Book </span></h2>
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="#nav-all">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
            @endforeach
            <!-- End Single Slide -->
        	
        </div>
        <!-- End Slider area -->
		<!-- Start BEst Seller Area -->
		@if($user)
		<section class="wn__product__area brown--color pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">Recent <span class="color--theme">Books</span></h2>
							<p >Những cuốn sách bạn đã mua gần đây.</p>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<?php 
					$data=array();
					$data2=array();
					$bills=DB::table('bills')->select('idBill')->where('idKH',$user->id)->get();
					foreach($bills as $bill){
						array_push($data,get_object_vars($bill));
					}
					
					$details=DB::table('detailbill')->select('idBook')->whereIn('idBill',$data)->orderBy('create_date','DESC')->get();
					foreach($details as $detail){
						array_push($data2,get_object_vars($detail));
					}
					$RecentBook=DB::table('books')->whereIn('idBook',$data2)->limit(10)->get();
					
				?>
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
					<!-- Start Single Product -->
                    @foreach($RecentBook as $book)
					<div class="product product__style--3">
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="product__thumb">
								<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="public/uploaded/books/{{$book->hinh_dai_dien}}" width="270" height="340" alt="product image"></a>
								
								<div class="hot__box">
									<span class="hot-label">NEW</span>
								</div>
							</div>
							<div class="product__content content--center">
								<h4><a href="{{URL::to('/chi-tiet/'.$book->slug_name)}}">{{$book->NameBook}}</a></h4>
								<ul class="prize d-flex">
                                    @if($book->sale_price!=0)
                                    <li>{{number_format($book->sale_price)}} VND</li>
									<li class="old_prize">{{number_format($book->unit_price)}} VND</li>
                                    @else
                                    <li>{{number_format($book->unit_price)}} VND</li>
                                    @endif
									
								</ul>
								<div class="action">
									<div class="actions_inner">
										<ul class="add_to_links">
											<li><a class="wishlist" href="{{URL::to('/yeu-thich/them/'.$book->idBook)}}"><i class="bi bi-heart-beat"></i></a></li>
											<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->idBook}}"><i class="bi bi-search"></i></a></li>
										</ul>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
                    @endforeach
					
				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>
		@endif
		<section class="wn__product__area brown--color pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">New <span class="color--theme">Books</span></h2>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
					<!-- Start Single Product -->
                    @foreach($listNew as $book)
					<div class="product product__style--3">
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="product__thumb">
								<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="public/uploaded/books/{{$book->hinh_dai_dien}}" width="270" height="340" alt="product image"></a>
								
								<div class="hot__box">
									<span class="hot-label">NEW</span>
								</div>
							</div>
							<div class="product__content content--center">
								<h4><a href="{{URL::to('/chi-tiet/'.$book->slug_name)}}">{{$book->NameBook}}</a></h4>
								<ul class="prize d-flex">
                                    @if($book->sale_price!=0)
                                    <li>{{number_format($book->sale_price)}} VND</li>
									<li class="old_prize">{{number_format($book->unit_price)}} VND</li>
                                    @else
                                    <li>{{number_format($book->unit_price)}} VND</li>
                                    @endif
									
								</ul>
								<div class="action">
									<div class="actions_inner">
										<ul class="add_to_links">
											<li><a class="wishlist" href="{{URL::to('/yeu-thich/them/'.$book->idBook)}}"><i class="bi bi-heart-beat"></i></a></li>
											<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->idBook}}"><i class="bi bi-search"></i></a></li>
										</ul>
									</div>
								</div>
								
							</div>
						</div>
					</div>
                    @endforeach
					
				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start Best Seller Area -->
		<section class="wn__bestseller__area bg--white pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">All <span class="color--theme">Products</span></h2>
						</div>
					</div>
				</div>
				<div class="row mt--50">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="product__nav nav justify-content-center" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>
                            
                            @foreach($listcate as $cate)
                            <a class="nav-item nav-link @if($cate->idCate==1)active @endif" data-toggle="tab" href="#nav-{{$cate->idCate}}" role="tab">{{$cate->nameCate}}</a>
                            
                           @endforeach
                        </div>
					</div>
				</div>
				<div class="tab__container mt--60">
					<!-- Start Single Tab Content -->
                    <?php  $books=DB::table('books')->get();  ?>
					<div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
                        
						<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                            @foreach($books as $book)
							<div class="single__product">
								<!-- Start Single Product -->
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="product product__style--3">
										<div class="product__thumb">
											<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="{{URL('public/uploaded/books/'.$book->hinh_dai_dien)}}" width="270" height="340"  alt="product image"></a>
											<div class="hot__box">
												@if($book->new!=0)<span class="hot-label">NEW</span>@endif
											</div>
										</div>
										<div class="product__content content--center content--center">
											<h4><a href="{{URL::to('/chi-tiet/'.$book->slug_name)}}">{{$book->NameBook}}</a></h4>
											<ul class="prize d-flex">
												@if($book->sale_price!=0)
                                                <li>{{number_format($book->sale_price)}} VND</li>
                                                <li class="old_prize">{{number_format($book->unit_price)}} VND</li>
                                                @else
                                                <li>{{number_format($book->unit_price)}} VND</li>
                                                @endif
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="wishlist" href="{{URL::to('/yeu-thich/them/'.$book->idBook)}}"><i class="bi bi-heart-beat"></i></a></li>
														<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->idBook}}"><i class="bi bi-search"></i></a></li>
													</ul>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<!-- Start Single Product -->
							</div>
                            @endforeach
						</div>
                       
					</div>
                    @foreach($listcate as $cate)
                    <?php $types=DB::table('type')->where('idCate',$cate->idCate)->get(); ?>
					<div class="row single__tab tab-pane fade show @if($cate->idCate==1)active @endif" id="nav-{{$cate->idCate}}" role="tabpanel">
                        
						<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                            
                            @foreach($types as $type)
                            <?php $books=DB::table('books')->where('idType',$type->idType)->get(); ?>
                            @foreach($books as $book)
							<div class="single__product">
								<!-- Start Single Product -->
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="product product__style--3">
										<div class="product__thumb">
											<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="{{URL('public/uploaded/books/'.$book->hinh_dai_dien)}}" width="270" height="340"  alt="product image"></a>
											<div class="hot__box">
												@if($book->new!=0)<span class="hot-label">NEW</span>@endif
											</div>
										</div>
										<div class="product__content content--center content--center">
											<h4><a href="{{URL::to('/chi-tiet/'.$book->slug_name)}}">{{$book->NameBook}}</a></h4>
											<ul class="prize d-flex">
												@if($book->sale_price!=0)
                                                <li>{{number_format($book->sale_price)}} VND</li>
                                                <li class="old_prize">{{number_format($book->unit_price)}} VND</li>
                                                @else
                                                <li>{{number_format($book->unit_price)}} VND</li>
                                                @endif
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														
														<li><a class="wishlist" href="{{URL::to('/wishlist/'.$book->idBook)}}"><i class="bi bi-heart-beat"></i></a></li>
														<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->idBook}}"><i class="bi bi-search"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Start Single Product -->
							</div>
                            @endforeach
                            @endforeach
                            
						</div>
                       
					</div>
                    @endforeach
					
				</div>
                
			</div>
            
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start Recent Post Area -->
		<section class="wn__recent__post bg--gray ptb--80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>
							<p>Cập nhật nhiều xu hướng sách cho mọi người theo dõi.</p>
						</div>
					</div>
				</div>
				<div class="row mt--50">
                    <?php $listBlog=Session::get('listBlog'); ?>
                    @foreach($listBlog as $blog)
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="{{URL('/blog/chi-tiet/'.$blog->slug_name)}}">{{$blog->tieude}}</a></h3>
								<p>{!!$blog->gioithieu!!}</p>
								<div class="post__time">
									<span class="day">{{ \Carbon\Carbon::parse($blog->create_date)->format('d/m/Y H:i:s')}}</span>
								</div>
							</div>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
		</section>
		<!-- End Recent Post Area -->
		
	
		<!-- QUICKVIEW PRODUCT -->
		<div id="quickview-wrapper">
		    <!-- Modal -->
            <?php $books=DB::table('books')->get(); ?>
            @foreach($books as $b)
		    <div class="modal fade" id="product{{$b->idBook}}" tabindex="-1" role="dialog">
		        <div class="modal-dialog modal__container" role="document">
		            <div class="modal-content">
		                <div class="modal-header modal__header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                </div>
		                <div class="modal-body">
		                    <div class="modal-product">
		                        <!-- Start product images -->
		                        <div class="product-images">
		                            <div class="main-image images">
		                                <img alt="big images" src="{{URL('public/uploaded/books/'.$b->hinh_dai_dien)}}" width="420" height="500">
		                            </div>
		                        </div>
		                        <!-- end product images -->
		                        <div class="product-info">
		                            <h1>{{$b->NameBook}}</h1>
									<div class="select__color">
		                                <h2>Còn : </h2> 
										<p>@if($b->quantity==0)<span>  In stock</span>@else {{$b->quantity}} @endif </p>
		                            </div>
		                            <div class="rating__and__review">
		                                <div class="review">
		                                    <a href="#">Điểm : {{$b->diem}}</a>
		                                </div>
		                            </div>
		                            <div class="price-box-3">
		                                <div class="s-price-box">
                                            @if($b->sale_price!=0)
                                            <span class="new-price">{{number_format($b->sale_price)}} VND</span>
                                            <span class="old-price">{{number_format($b->unit_price)}} VND</span>
                                            @else
                                            <span class="new-price">{{number_format($b->unit_price)}} VND</span>
                                            @endif
		                                   
		                                </div>
		                            </div>
		                            <br>
		                            <div class="select__color">
		                                <h2>Tác giả : </h2> 
                                        <?php $author=DB::table('author')->where('idAuthor',$b->idAuthor)->first(); ?>
                                        <a href="{{URL::to('/tac-gia/'.$author->idAuthor)}}">{{$author->nameAuthor}}</a>
		                            </div>
		                            <br>
		                            <div class="select__color">
		                                <h2>Nhà xuất bản : </h2> 
                                        <?php $pub=DB::table('publisher')->where('idPub',$b->idPub)->first(); ?>
                                        <a href="{{URL::to('/nha-xuat-ban/'.$pub->idPub)}}">{{$pub->namePub}}</a>
		                            </div>
                                    
                                        <div class="product__info__main">
                                    <div class="box-tocart d-flex">
										<form action="{{URL::to('/gio-hang/them/'.$b->idBook)}}" method="POST">
										{{ csrf_field() }}
                                        @if($b->quantity>0)
										<span>Số lượng</span>
											<input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
                                        <div class="addtocart__actions">
                                            <button class="tocart btn" type="submit" title="Add to Cart">Add to Cart</button>
                                        </div>
										@else
										<div class="addtocart__actions">
											<h3 style="color: darkred">Hết hàng</h3>
										</div>
										@endif
										</form>
                                    </div>
                                        </div>
                                    

		                            
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
            @endforeach
		</div>
		<!-- END QUICKVIEW PRODUCT -->
@endsection
@section('title')
	OnBook | Trang chủ
@endsection
