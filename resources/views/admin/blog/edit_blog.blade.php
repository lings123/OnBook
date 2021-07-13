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
                                $blog=Session::get('blog');
                                $img=Session::get('image');
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
                    <form action="{{URL::to('admin/blog/sua/'.$blog->idBlog)}}" method="POST"  enctype="multipart/form-data">
                   
                        {{csrf_field()}}
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                
                                <input class="form-control" name="txtName" placeholder="Nhập tiêu đề" value="{{$blog->tieude}}" required/>
                            </div> 
                            <div class="form-group">
                                <label>Hình đại diện</label>
                                <div style="margin: 10px; "><img src="{{URL::to('uploaded/blog/'.$blog->hinh_dai_dien)}}" width="250px" height="150px" style="border-radius: 4px"></div>
                                <input type="file" class="form-control" name="txtHinh" />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtGioithieu" required>{!!$blog->gioithieu!!}</textarea>
                            </div> 
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtNoidung" required>{!!$blog->noidung!!}</textarea>
                            </div> 
                           
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                           
                              
                            
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                    <!-- /#page-wrapper -->
            @endsection
            