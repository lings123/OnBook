@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Blog
                            <small>Add</small>
                        </h1>
                    </div>
                    <form action="{{URL::to('admin/blog/them')}}" method="POST"  enctype="multipart/form-data">
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
                               
                                Session::put('message',null);    
                            ?>
                             @if($message)
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Success</strong>
                                    {{$message}}
                                </div>
                            @endif
                            
                    <a href="{{URL::to('admin/blog/danh-sach')}}" class="btn btn-default">Trở về</a>
                    
                   
                        {{csrf_field()}}
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="txtName" placeholder="Nhập tiêu đề" value="{{old('txtName')}}" required/>
                            </div> 
                            <div class="form-group">
                                <label>Hình đại diện</label>
                                <input type="file" class="form-control" name="txtHinh" required />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtGioithieu" required>{{old('txtGioithieu')}}</textarea>
                            </div> 
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtNoidung" required>{{old('txtNoidung')}}</textarea>
                            </div> 
                           
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                          
                        </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection