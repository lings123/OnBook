@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Add</small>
                        </h1>
                    </div>
                    <form action="{{URL::to('admin/san-pham/them')}}" method="POST"  enctype="multipart/form-data">
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                                Session::put('error',null);
                                Session::put('message',null);    
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
                                <input class="form-control" name="txtName" placeholder="Nhập tên đầy đủ" value="{{old('txtName')}}" required/>
                            </div> 
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="selectTypeId">
                                    @foreach($type as $t)
                                        <option value='{{$t->idType}}'>{{$t->nameType}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <select class="form-control" name="selectAuthorId">
                                    @foreach($author as $a)
                                        <option value='{{$a->idAuthor}}'>{{$a->nameAuthor}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản</label>
                                <select class="form-control" name="selectPubId">
                                    @foreach($pub as $p)
                                        <option value='{{$p->idPub}}'>{{$p->namePub}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình đại diện</label>
                                <input type="file" class="form-control" name="txtHinh" required />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription" required>{{old('txtDescription')}}</textarea>
                            </div> 

                            <div class="form-group">
                                <label>Số trang</label>
                                <input class="form-control" name="txtPage" placeholder="Nhập số trang" value="{{old('txtPage')}}" required/>
                            </div> 

                            
                            <div class="form-group">
                                <label>Loại bìa</label>
                                <select class="form-control" name="selectBiaId">
                                    @foreach($bia as $b)
                                        <option value='{{$b->idBia}}'>{{$b->nameBia}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>chiều rộng</label>
                                <input class="form-control" name="txtRong" placeholder="Nhập chiều rộng" value="{{old('txtRong')}}" required/>
                                <label>chiều dài</label>
                                <input class="form-control" name="txtDai" placeholder="Nhập chiều dài" value="{{old('txtDai')}}" required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input class="form-control" name="txtUnitPrice" placeholder="Nhập đơn giá" value="{{old('txtUnitPrice')}}"/>
                            </div> 
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input class="form-control" name="txtPromoPrice" placeholder="Nhập giá khuyến mãi" value="{{old('txtPromoPrice')}}"/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="1" checked="" type="radio">Mới
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="2" type="radio">Cũ
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtQty" placeholder="Nhập số lượng" value="{{old('txtQty')}}" required/>
                            </div> 

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                            <div class="col-lg-5" >
                                <div class="row" style="margin-bottom: 30px">
                                     <button type="button" class="btn btn-primary" id="btn-add-file">Thêm hình</button>
                                     <button type="button" class="btn btn-warning" id="reset-image" >reset</button>
                                    <button type="button" class="btn btn-danger" id="del-input" name='del'>xóa</button>
                                </div>
                                <div class="row">
                                    <div class ="col-lg-7">
                                        <div class='form-group' id="divUpload">
                                            <input type='file' class='form-control upload-1 file-upload' name='hinh[]' data-inputid="1" >
                                        </div>
                                    </div>
                                    <div class="col-lg-5" id="preview">
                                        <img class='box-preview-img img-1'/>
                                    </div>
                                </div>
                                
                            </div>
                    
                        </form>
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
            $("#btn-add-file").click(function ()
            {   
                if($('#divUpload input').length <8)
                {   
                    var i = $('#divUpload input').length + 1;
                    $("#divUpload").append("<input type='file' class='form-control upload-"+i+" file-upload' name='hinh[]'  data-inputid='"+i+"' >");                    
                    $("#preview").append("<img class='box-preview-img img-"+i+"'/>");
                }
            });

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

                $(".input-image").val("");

            });
        });
    </script>
@endsection