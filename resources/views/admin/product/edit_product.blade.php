@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sản Phẩm
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="col-lg-7" style="padding-bottom:100px">
                @if(count($errors)>0)
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                    </div>
                @endif
                
                <?php
                                $message=Session::get('message');
                                $error=Session::get('error');
                                $type=Session::get('type');
                                $author=Session::get('author');
                                $pub=Session::get('pub');
                                $bia=Session::get('bia');
                                $product=Session::get('book');
                                $image_books=Session::get('image_books');
                                Session::put('message',null); 
                                Session::put('error',null);   
                            ?>
                             @if($message)
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Success</strong>
                                    {{$message}}
                                </div>
                            @endif
                            @if($error)
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$error}}
                            </div>
                        @endif
                            <a href="{{URL::to('admin/san-pham/danh-sach')}}" class="btn btn-default">Trở về</a>
                    
                   
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input class="form-control" name="txtName" placeholder="Nhập tên đầy đủ" value="{{$product->NameBook}}" required/>
                                </div> 
                                <div class="form-group">
                                    <label>Thể loại</label>
                                    <select class="form-control" name="selectTypeId">
                                        @foreach($type as $t)
                                            <option value='{{$t->idType}}' @if($t->idType==$product->idType) selected @endif>{{$t->nameType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tác giả</label>
                                    <select class="form-control" name="selectAuthorId">
                                        @foreach($author as $a)
                                            <option value='{{$a->idAuthor}}' @if($a->idAuthor==$product->idAuthor) selected @endif>{{$a->nameAuthor}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nhà xuất bản</label>
                                    <select class="form-control" name="selectPubId">
                                        @foreach($pub as $p)
                                            <option value='{{$p->idPub}}' @if($p->idPub==$product->idPub) selected @endif>{{$p->namePub}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                        <div class="form-group">
                            <label>Hình đại diện</label>
                            <div style="margin: 10px; "><img src="{{URL::to('public/uploaded/books/'.$product->hinh_dai_dien)}}" width="150px" height="250px" style="border-radius: 4px"></div>
                            <input type="file" class="form-control" name="txtHinh" />
                        </div>
                        <div class="form-group">
                            <label>Giới thiệu</label>
                            <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription" required>{!!$product->description!!}</textarea>
                        </div> 

                        <div class="form-group">
                            <label>Số trang</label>
                            <input class="form-control" name="txtPage" placeholder="Nhập số trang" value="{{$product->pages}}" required/>
                        </div> 

                        
                        <div class="form-group">
                            <label>Loại bìa</label>
                            <select class="form-control" name="selectBiaId">
                                @foreach($bia as $b)
                                    <option value='{{$b->idBia}}' @if($b->idBia==$product->idBia) selected @endif>{{$b->nameBia}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>chiều rộng</label>
                            <input class="form-control" name="txtRong" placeholder="Nhập chiều rộng" value="{{$product->chieu_rong}}" required/>
                            <label>chiều dài</label>
                            <input class="form-control" name="txtDai" placeholder="Nhập chiều dài" value="{{$product->chieu_dai}}" required/>
                        </div> 
                        
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input class="form-control" name="txtUnitPrice" placeholder="Nhập đơn giá" value="{{$product->unit_price}}"/>
                        </div> 
                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <input class="form-control" name="txtPromoPrice" placeholder="Nhập giá khuyến mãi" value="{{$product->sale_price}}"/>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <label class="radio-inline">
                                <input name="rdoNew" value="1" @if($product->new == 1) checked @endif type="radio">Mới
                            </label>
                            <label class="radio-inline">
                                <input name="rdoNew" value="2" type="radio" @if($product->new == 2) checked @endif>Cũ
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input class="form-control" name="txtQty" placeholder="Nhập số lượng" value="{{$product->quantity}}" required/>
                        </div> 
                    <button type="submit" class="btn btn-default" name='ok'>Lưu lại</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
                <div class="col-lg-5" >

                    <div class="row" style="margin: 20px 0px; padding-top: 10px; border-top: 1px solid #ccc;">
                        <button type="button" class="btn btn-primary" id="btn-add-file">Thêm hình</button>
                        <button type="button" class="btn btn-warning" id="reset-image" >Hủy</button>
                        <button type="button" class="btn btn-danger" id="del-input" name='del'>xóa</button>
                    </div>
                    <div class="row">
                        <div class ="col-lg-7">
                            <div class='form-group' id="divUpload">
                                <input type='file' class='form-control upload-1 file-upload' name='hinh[]' data-inputid="1" >
                            </div>
                        </div>
                        <div class="col-lg-5" id="preview">
                            <img class='box-preview-img img-1' />
                        </div>
                    </div>
                 {{csrf_field()}}
                <form>
                    <div>
                        <h4>Danh sách hình ảnh</h4>
                        <div id="list-image">
                            @foreach($image_books as $p_image)
                            <div class="row item-image item-image-{{$p_image->idImg}}">
                                <div class="col-md-5 col-lg-6" >
                                    <img src="{{URL::to('public/uploaded/books/'.$p_image->NameImg)}}" style="border-radius: 4px"/>
                                    <a id='del_img' class="btn btn-danger btn-circle icon_del" data_img='{{$p_image->idImg}}'><i class="fa fa-times"></i></a>
                                    
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <p><a href="{{URL::to('admin/san-pham/hinh/sua/'.$p_image->idImg)}}">Sửa hình ảnh</a>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                    </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            // them input file
            $("#btn-add-file").click(function ()
            {   
                if($('#divUpload input').length < 9)
                {   
                    var i = $('#divUpload input').length + 1;
                    $("#divUpload").append("<input type='file' class='form-control upload-"+i+" file-upload' name='hinh[]'  data-inputid='"+i+"' >");                    
                    $("#preview").append("<img class='box-preview-img img-"+i+"'/>");
                }
            });
            //hien hinh anh preview khi chọn hinh
            $("#divUpload").delegate(".file-upload","change",function (event){
                var id = $(this).attr('data-inputid');
                $('#preview .img-'+id).css("visibility","visible")
                $('#preview .img-'+id).attr('src', URL.createObjectURL(event.target.files[0])); 
            });

            $("#del-input").click(function (){
                if($("#divUpload input").length>1){
                    var i = $("#divUpload input").length;
                    $("#divUpload .upload-"+i).remove();
                    $("#preview .img-"+i).remove();
                }
            });

            $("#reset-image").click(function ()
            {
                $(".box-preview-img").css("visibility","hidden");

                $(".file-upload").val("");

            });

            //xóa hình ảnh
            $('.icon_del').click(function () {
                var id = $(this).attr('data_img');
                $.ajax({
                    type: 'POST',
                    url: 'admin/hinh/xoa',
                    data:'id='+id,
                    async: true,
                    success:function(data){
                       if(data=='true'){
                            $('.item-image-'+id).fadeOut();
                       }
                    }
                });
               
            });
            

        });
    </script>
@endsection