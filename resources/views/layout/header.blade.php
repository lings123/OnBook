<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="{{URL::to('/')}}">
                        <img src="{{URL('public/images/logo/logo.png')}}" alt="logo images">
                    </a>
                </div>
            </div>
            <?php
               $user=Session::get('user');
            ?>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="{{URL::to('/')}}">Home</a>
                        </li>
                        <li class="drop"><a href="{{URL::to('/tinh-trang/all')}}">Books</a>
                            
                            <div class="megamenu mega03">
                                <?php $listcate=DB::table('category')->where('status',1)->get(); ?>
                                @foreach($listcate as $cate)
                                <ul class="item item03">
                                        <li class="title">{{$cate->nameCate}}</li>
                                        <?php $listtype=DB::table('type')->where('idCate',$cate->idCate)->where('status',1)->get(); ?>
                                        @foreach($listtype as $type)
                                        <li><a href="{{URL::to('/the-loai/'.$type->idType)}}">{{$type->nameType}}</a></li>
                                        @endforeach
                                </ul>
                                @endforeach
                            </div>
                        </li>
                       
                        <li class="drop"><a href="{{URL::to('/blog/')}}">Blog</a>
                        </li>
                        @if($user)
                        <li><a href="{{URL::to('/khuyen-mai')}}">Khuyến mãi</a></li>
                        @endif
                        <li><a href="{{URL::to('/contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    @if($user)<li class="wishlist"><a href="{{URL::to('/yeu-thich')}}"></a></li>@endif
                    <li class="shopcart"><a class="cartbox_active" href="#">@if(Cart::instance('shopping')->count() > 0)<span class="product_qun"> {{Cart::instance('shopping')->count()}} </span>@endif</a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <div class="micart__close">
                                    <span>close</span>
                                </div>
                                <div class="items-total d-flex justify-content-between">
                                    <span>{{Cart::instance('shopping')->count()}}</span>
                                    <span>Cart Subtotal</span>
                                </div>
                                <div class="total_amount text-right">
                                    <span>{{Cart::instance('shopping')->subtotal()}}</span>
                                </div>
                                <div class="mini_action checkout">
                                    <a class="checkout__btn" href="{{URL::to('/gio-hang')}}">Go to Cart</a>
                                </div>
                                <div class="single__items">
                                    <div class="miniproduct">
                                        @foreach(Cart::instance('shopping')->content() as $book)
                                        <div class="item01 d-flex mt--20">
                                            <div class="thumb">
                                                <a href="product-details.html"><img src="{{URL::to('public/uploaded/books/'.$book->options->image)}}" alt="product images"></a>
                                            </div>
                                            <div class="content">
                                                <h6><a href="product-details.html">{{$book->name}}</a></h6>
                                                <span class="prize">{{number_format($book->price)}} VND</span>
                                                <div class="product_prize d-flex justify-content-between">
                                                    <span class="qun">Số lượng: {{$book->qty}}</span>
                                                    <ul class="d-flex justify-content-end">
                                                        <li><a href="{{URL::to('/gio-hang/xoa/'.$book->rowId)}}"><i class="zmdi zmdi-delete"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>@if($user) Hi, {{ $user->name}} @else Account @endif </span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <div class="setting__menu">
                                                @if($user) 
                                                <span><a href="{{URL::to('/info')}}">Thông tin </a></span>
                                                <span><a href="{{URL::to('/listBill')}}">Danh sách đơn hàng</a></span>
                                                <span><a href="{{URL::to('/yeu-thich')}}">Danh sách yêu thích</a></span>
                                                <hr>
                                                <span><a href="{{URL::to('/change-password')}}">Đổi mật khẩu</a></span>
                                                <span><a href="{{URL::to('/logout')}}">Logout</a></span>
                                                @else
                                                <span><a href="{{URL::to('/login')}}">Sign In/Create An Account</a></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li><a href="#">Books</a>
                            <ul>
                                @foreach($listcate as $cate)
                                <li ><a href="#">{{$cate->nameCate}}</a><ul>
                                <?php $listtype=DB::table('type')->where('idCate',$cate->idCate)->get(); ?>
                                @foreach($listtype as $type)
                                <li><a href="{{URL::to('/the-loai/'.$type->idType)}}">{{$type->nameType}}</a></li>
                                @endforeach
                                </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="drop"><a href="{{URL::to('/blog/')}}">Blog</a>
                        </li>
                        <li><a href="{{URL::to('/trend')}}">Trending</a></li>
                        <li><a href="{{URL::to('/contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->	
    </div>		
</header>
<!-- //Header -->
<!-- Start Search Popup -->
<div class="brown--color box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="{{URL::to('/tim-kiem')}}" method="GET">
        <div class="field__search">
            <input type="text" name="keyword" placeholder="Tìm kiếm nhập sản phẩm cần tìm...">
            <div class="action">
                <a href="#"><i class="zmdi zmdi-search"></i></a>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->