<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//////HOME/////u
Route::get('/','App\Http\Controllers\PageController@getHome');

Route::get('/home','App\Http\Controllers\PageController@getHome');

Route::get('/contact','App\Http\Controllers\PageController@getContact');

Route::get('/khuyen-mai','App\Http\Controllers\PageController@getSalecode');

///Blog////
Route::group(['prefix'=>'/blog'],function(){
	Route::get('/','App\Http\Controllers\PageController@getBlog');
	Route::get('/chi-tiet/{slug_name}','App\Http\Controllers\PageController@getBlogDetail');
	Route::get('/tim-kiem','App\Http\Controllers\PageController@getBlogSearch');
});
///END BLOG////

////Lọc////
Route::get('/the-loai/{idType}','App\Http\Controllers\PageController@getCategory');
Route::get('/nha-xuat-ban/{idPub}','App\Http\Controllers\PageController@getPublisher');
Route::get('/tac-gia/{idAuthor}','App\Http\Controllers\PageController@getAuthor');
Route::get('/tinh-trang/{tt}','App\Http\Controllers\PageController@getTT');

///Chi tiết sản phẩm////
Route::get('/chi-tiet/{slug_name}', 'App\Http\Controllers\PageController@getDetail');

///Đăng ký////
Route::get('/signin','App\Http\Controllers\PageController@getLogin');
Route::post('/signin','App\Http\Controllers\PageController@postSignin');

////xác nhận email////

Route::get('/xac-nhan/{token}','App\Http\Controllers\PageController@activeUser')->name('user.activate');
///END Đăng ký////

/// Đăng nhập////
Route::get('/login','App\Http\Controllers\PageController@getLogin');
Route::post('/login','App\Http\Controllers\PageController@postLogin');
////END///

////Thông tin khách hàng////
Route::get('/info','App\Http\Controllers\PageController@getInfo');
Route::post('/info','App\Http\Controllers\PageController@postInfo');
//END///

////Đổi mật khẩu/////
Route::get('/change-password','App\Http\Controllers\PageController@getNewPass');
Route::post('/change-password','App\Http\Controllers\PageController@postNewPass');

/////Reset mật khẩu/////
Route::get('/reset','App\Http\Controllers\PageController@getReset');
Route::post('/reset','App\Http\Controllers\PageController@SendNewPass');

/////Danh sách đơn hàng////
Route::get('/listBill','App\Http\Controllers\PageController@getBills');
////Chi tiết đơn hàng////
Route::get('/don-hang/chi-tiet/{id_bill}','App\Http\Controllers\PageController@getDetailBill');
///Hủy đơn///
Route::post('/don-hang/chi-tiet/huy/{id_bill}','App\Http\Controllers\PageController@postBillDes');
////Wishlist////
Route::group(['prefix'=>'/yeu-thich'],function(){
	Route::get('/','App\Http\Controllers\WishlistController@getWishlist');
	Route::get('/them/{idBook}','App\Http\Controllers\WishlistController@AddWishlist');
	Route::get('/xoa/{rowId}','App\Http\Controllers\WishlistController@DelWishlist');
});

////Đăng xuất////
Route::get('/logout','App\Http\Controllers\PageController@getLogout');
////END///

////giỏ hàng////
Route::group(['prefix'=>'/gio-hang'],function(){
	Route::get('/','App\Http\Controllers\CartController@getCart');
	Route::post('/them/{idBook}','App\Http\Controllers\CartController@AddCart');
	Route::get('/xoa/{rowId}','App\Http\Controllers\CartController@DelCart');
	Route::post('/sua/{rowId}','App\Http\Controllers\CartController@UpdateCart');
	Route::get('/xoa','App\Http\Controllers\CartController@DelCartAll');
});

//END///



///END/////
////thanh toán////
Route::get('/thanh-toan','App\Http\Controllers\PageController@getCheckout');

Route::post('/ap-dung','App\Http\Controllers\PageController@postSale');
Route::get('/del-sale','App\Http\Controllers\PageController@delSale');
Route::post('/su-dung','App\Http\Controllers\PageController@postTichluy');

Route::post('/dat-hang','App\Http\Controllers\PageController@postBill');
///END///

////Comment////
Route::group(['prefix'=>'/danh-gia'],function(){
	Route::post('/them/{idBill}/{idBook}','App\Http\Controllers\PageController@postComment');
	
});

/////eND/////


////Tìm kiếm////
Route::get('/tim-kiem','App\Http\Controllers\PageController@getSearch');
///END///



////END////

///ADMIN///
Route::group(['prefix'=>'admin'],function(){
	///Admin////
	Route::get('/','App\Http\Controllers\AdminController@getLoginAdmin');
	Route::get('/dashbroad','App\Http\Controllers\AdminController@show_dashbroad');
	Route::post('/dashbroad','App\Http\Controllers\AdminController@dashbroad');
	Route::get('/logout','App\Http\Controllers\AdminController@AdminLogout');
	///Category///
	Route::group(['prefix'=>'danh-muc'],function(){

		Route::get("them",'App\Http\Controllers\CategoryController@getAddCate');

		Route::post("them",'App\Http\Controllers\CategoryController@postAddCate');

		Route::get("sua/{id_Cate}",'App\Http\Controllers\CategoryController@getEditCate');

		Route::post("sua/{id_Cate}",'App\Http\Controllers\CategoryController@postEditCate');

		Route::get("danh-sach",'App\Http\Controllers\CategoryController@getListCate');

		Route::get('xoa/{id_Cate}',"App\Http\Controllers\CategoryController@getDelCate");

		Route::post('cap-nhat/{id_Cate}','App\Http\Controllers\CategoryController@postTTCate');

	});

	
	Route::group(['prefix'=>'tac-gia'],function (){
		Route::get('danh-sach','App\Http\Controllers\AuthorController@getListauthor');

		Route::get('them','App\Http\Controllers\AuthorController@getAddauthor');

		Route::post('them','App\Http\Controllers\AuthorController@postAddauthor');

		Route::get('sua/{id_Author}','App\Http\Controllers\authorController@geteditauthor');

		Route::post('sua/{id_Author}','App\Http\Controllers\authorController@postEditauthor');

		Route::get('xoa/{id}','App\Http\Controllers\authorController@getDelauthor');

	});

	Route::group(['prefix'=>'nha-xuat-ban'],function (){
		Route::get('danh-sach','App\Http\Controllers\PublisherController@getListPublisher');

		Route::get('them','App\Http\Controllers\PublisherController@getAddPublisher');

		Route::post('them','App\Http\Controllers\PublisherController@postAddPublisher');

		Route::get('sua/{id_Pub}','App\Http\Controllers\PublisherController@geteditPublisher');

		Route::post('sua/{id_Pub}','App\Http\Controllers\PublisherController@postEditPublisher');

		Route::get('xoa/{id_Pub}','App\Http\Controllers\PublisherController@getDelPublisher');

	});

	Route::group(['prefix'=>'bia'],function (){
		Route::get('danh-sach','App\Http\Controllers\BiaController@getListBia');

		Route::get('them','App\Http\Controllers\BiaController@getAddBia');

		Route::post('them','App\Http\Controllers\BiaController@postAddBia');

		Route::get('sua/{id_Bia}','App\Http\Controllers\BiaController@geteditBia');

		Route::post('sua/{id_Bia}','App\Http\Controllers\BiaController@postEditBia');

		Route::get('xoa/{id_Bia}','App\Http\Controllers\BiaController@getDelBia');

	});

	Route::group(['prefix'=>'khuyen-mai'],function (){
		Route::get('them','App\Http\Controllers\SaleController@getAddSales');

		Route::post('them','App\Http\Controllers\SaleController@postAddSales');

		Route::get('danh-sach','App\Http\Controllers\SaleController@getListSales');

		Route::get('sua/{id_Sale}','App\Http\Controllers\SaleController@getEditSales');

		Route::post('sua/{id_Sale}','App\Http\Controllers\SaleController@postEditSales');

		Route::get('xoa/{id_Sale}','App\Http\Controllers\SaleController@getDelSales');

		Route::post('cap-nhat/{id_Sale}','App\Http\Controllers\SaleController@postTTSale');

	});
	

	Route::group(['prefix'=>'loai-sach'],function (){
		Route::get('danh-sach','App\Http\Controllers\typeController@getListtype');

		Route::get('them','App\Http\Controllers\typeController@getAddtype');

		Route::post('them','App\Http\Controllers\typeController@postAddtype');

		Route::get('sua/{id_type}','App\Http\Controllers\typeController@getedittype');

		Route::post('sua/{id_type}','App\Http\Controllers\typeController@postEdittype');

		Route::get('xoa/{id_type}','App\Http\Controllers\typeController@getDeltype');

		Route::post('cap-nhat/{id_type}','App\Http\Controllers\typeController@postTTtype');

	});

	Route::group(['prefix'=>'thanh-toan'],function (){
		Route::get('danh-sach','App\Http\Controllers\CheckController@getListCheck');

		Route::get('them','App\Http\Controllers\CheckController@getAddCheck');

		Route::post('them','App\Http\Controllers\CheckController@postAddCheck');

		Route::get('sua/{id_check}','App\Http\Controllers\CheckController@geteditCheck');

		Route::post('sua/{id_check}','App\Http\Controllers\CheckController@postEditCheck');

		Route::get('xoa/{id_check}','App\Http\Controllers\CheckController@getDelCheck');

	});

	Route::group(['prefix'=>'nhan-vien'],function (){
		Route::get('them','App\Http\Controllers\UserNvController@getAddUserNv');

		Route::post('them','App\Http\Controllers\UserNvController@postAddUserNv');

		Route::get('danh-sach','App\Http\Controllers\UserNvController@getListUserNv');

		Route::get('sua/{id_nv}','App\Http\Controllers\UserNvController@getEditUserNv');

		Route::post('sua/{id_nv}','App\Http\Controllers\UserNvController@postEditUserNv');

		Route::get('xoa/{id_nv}','App\Http\Controllers\UserNvController@getDelUserNv');

		Route::post('doi-mat-khau/{id_nv}','App\Http\Controllers\UserNvController@postMkUserNv');

	});


	Route::group(['prefix'=>'khach-hang'],function (){

		Route::get('danh-sach','App\Http\Controllers\UserController@getListUser');

		Route::post('cap-nhat/{id_kh}','App\Http\Controllers\UserController@postTTUser');

		Route::get('xoa/{id_kh}','App\Http\Controllers\UserController@getDelUser');


	});

	Route::group(['prefix'=>'danh-gia'],function (){

		Route::get('danh-sach','App\Http\Controllers\CommentController@getListComment');

		Route::post('cap-nhat/{id_com}','App\Http\Controllers\CommentController@postTTComment');


	});

	Route::group(['prefix'=>'don-hang'],function (){

		Route::get('danh-sach','App\Http\Controllers\BillController@getListBill');

		Route::get('danh-sach-giao-hang/{idAd}','App\Http\Controllers\BillController@getListBillGH');

		Route::get('xoa/{id_bill}','App\Http\Controllers\BillController@getDelBill');

		Route::get('chi-tiet/{id_bill}','App\Http\Controllers\BillController@getDetailBill');

		Route::post('sua/{id_bill}','App\Http\Controllers\BillController@postTTBill');

		Route::post('dieu-hang/{id_bill}','App\Http\Controllers\BillController@postGHBill');
	});

	

	Route::group(['prefix'=>'san-pham'],function () {
		
		Route::get('them','App\Http\Controllers\productController@getAddProduct');

		Route::post('them','App\Http\Controllers\productController@postAddProduct');

		Route::get('danh-sach','App\Http\Controllers\productController@getListProduct');

		Route::post('cap-nhat/{id_book}','App\Http\Controllers\productController@postQtyProduct');

		Route::get('sua/{id_book}','App\Http\Controllers\productController@getEditProduct');

		Route::post('sua/{id_book}','App\Http\Controllers\productController@postEditProduct');

		Route::get('hinh/sua/{id_img}','App\Http\Controllers\productController@getEditImage');

		Route::post('hinh/sua/{id_img}','App\Http\Controllers\productController@postEditImage');
		
		Route::get('xoa/{id_book}','App\Http\Controllers\productController@getDelProduct');

	

	});

	Route::post('hinh/xoa',"App\Http\Controllers\productController@postDelImage");

	Route::group(['prefix'=>'blog'],function () {
		
		Route::get('them','App\Http\Controllers\BlogController@getAddBlog');

		Route::post('them','App\Http\Controllers\BlogController@postAddBlog');

		Route::get('danh-sach','App\Http\Controllers\BlogController@getListBlog');

		Route::get('sua/{id_blog}','App\Http\Controllers\BlogController@getEditBlog');

		Route::post('sua/{id_blog}','App\Http\Controllers\BlogController@postEditBlog');

		Route::get('hinh/sua/{id_img}','App\Http\Controllers\BlogController@getEditImage');

		Route::post('hinh/sua/{id_img}','App\Http\Controllers\BlogController@postEditImage');
		
		Route::get('xoa/{id_blog}','App\Http\Controllers\BlogController@getDelBlog');

	});

	Route::group(['prefix'=>'slider'],function () {
		
		Route::get('them','App\Http\Controllers\SliderController@getAddSlider');

		Route::post('them','App\Http\Controllers\SliderController@postAddSlider');

		Route::get('danh-sach','App\Http\Controllers\SliderController@getListSlider');

		Route::get('sua/{id_slider}','App\Http\Controllers\SliderController@getEditSlider');

		Route::post('sua/{id_slider}','App\Http\Controllers\SliderController@postEditSlider');
		
		Route::get('xoa/{id_slider}','App\Http\Controllers\SliderController@getDelSlider');

	});

	
});
///END///