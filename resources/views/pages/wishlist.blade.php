@extends('layout.master')
@section('content')
     <!-- Start Bradcaump area -->
     <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Yêu thích</h2>
                        <nav class="bradcaump-content">
                          <a class="breadcrumb_item" href="index.html">Home</a>
                          <span class="brd-separetor">/</span>
                          <span class="breadcrumb_item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="wishlist-area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="wishlist-content">
                        <form action="#">
                            <div class="wishlist-table wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-thumbnail">Hình ảnh</th>
                                            <th class="product-name"><span class="nobr">Tên sách</span></th>
                                            <th class="product-price"><span class="nobr"> giá </span></th>
                                            <th class="product-add-to-cart"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::instance('wishlist')->content() as $book)
                                        <tr>
                                            <td class="product-remove"><a href="{{URL::to('/yeu-thich/xoa/'.$book->rowId)}}">×</a></td>
                                            <td class="product-thumbnail"><a href="{{URL::to('/chi-tiet/'.$book->options->slug_name)}}"><img src="{{URL::to('public/uploaded/books/'.$book->options->image)}}" style="width: 184px;height: 276px;" alt="product img"></a></td>
                                            <td class="product-name"><a href="{{URL::to('/chi-tiet/'.$book->options->slug_name)}}">{{$book->name}}</a></td>
                                            <td class="product-price"><span class="amount">{{$book->price}}</span></td>
                                            <?php $sp=DB::table('books')->where('idBook',$book->id)->first(); ?>
                                            <td class="product-add-to-cart"><form></form>
                                                <form action="{{URL::to('/gio-hang/them/'.$book->id)}}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @if($sp->quantity>0)
                                                        <button class="btn btn-default">Add to Cart</button>
                                                    @else
                                                        <h3 style="color: darkred">Hết hàng</h3>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>  
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    @include('layout.sider_kh');
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end --> 
@endsection
@section('title')
	OnBook | Danh sách yêu thích
@endsection