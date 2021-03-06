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
                    <a href="{{URL::to('admin/san-pham/danh-sach')}}" class="btn btn-default">Tr??? v???</a>
                    
                   
                        {{csrf_field()}}
                            <div class="form-group">
                                <label>T??n s???n ph???m</label>
                                <input class="form-control" name="txtName" placeholder="Nh???p t??n ?????y ?????" value="{{old('txtName')}}" required/>
                            </div> 
                            <div class="form-group">
                                <label>Th??? lo???i</label>
                                <select class="form-control" name="selectTypeId">
                                    @foreach($type as $t)
                                        <option value='{{$t->idType}}'>{{$t->nameType}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>T??c gi???</label>
                                <select class="form-control" name="selectAuthorId">
                                    @foreach($author as $a)
                                        <option value='{{$a->idAuthor}}'>{{$a->nameAuthor}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nh?? xu???t b???n</label>
                                <select class="form-control" name="selectPubId">
                                    @foreach($pub as $p)
                                        <option value='{{$p->idPub}}'>{{$p->namePub}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>H??nh ?????i di???n</label>
                                <input type="file" class="form-control" name="txtHinh" required />
                            </div>
                            <div class="form-group">
                                <label>Gi???i thi???u</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription" required>{{old('txtDescription')}}</textarea>
                            </div> 

                            <div class="form-group">
                                <label>S??? trang</label>
                                <input class="form-control" name="txtPage" placeholder="Nh???p s??? trang" value="{{old('txtPage')}}" required/>
                            </div> 

                            
                            <div class="form-group">
                                <label>Lo???i b??a</label>
                                <select class="form-control" name="selectBiaId">
                                    @foreach($bia as $b)
                                        <option value='{{$b->idBia}}'>{{$b->nameBia}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>chi???u r???ng</label>
                                <input class="form-control" name="txtRong" placeholder="Nh???p chi???u r???ng" value="{{old('txtRong')}}" required/>
                                <label>chi???u d??i</label>
                                <input class="form-control" name="txtDai" placeholder="Nh???p chi???u d??i" value="{{old('txtDai')}}" required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>????n gi??</label>
                                <input class="form-control" name="txtUnitPrice" placeholder="Nh???p ????n gi??" value="{{old('txtUnitPrice')}}"/>
                            </div> 
                            <div class="form-group">
                                <label>Gi?? khuy???n m??i</label>
                                <input class="form-control" name="txtPromoPrice" placeholder="Nh???p gi?? khuy???n m??i" value="{{old('txtPromoPrice')}}"/>
                            </div>
                            <div class="form-group">
                                <label>Tr???ng th??i</label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="1" checked="" type="radio">M???i
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="2" type="radio">C??
                                </label>
                            </div>

                            <div class="form-group">
                                <label>S??? l?????ng</label>
                                <input class="form-control" name="txtQty" placeholder="Nh???p s??? l?????ng" value="{{old('txtQty')}}" required/>
                            </div> 

                            <button type="submit" class="btn btn-default">Th??m</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                            <div class="col-lg-5" >
                                <div class="row" style="margin-bottom: 30px">
                                     <button type="button" class="btn btn-primary" id="btn-add-file">Th??m h??nh</button>
                                     <button type="button" class="btn btn-warning" id="reset-image" >reset</button>
                                    <button type="button" class="btn btn-danger" id="del-input" name='del'>x??a</button>
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