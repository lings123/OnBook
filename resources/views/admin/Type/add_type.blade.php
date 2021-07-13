@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                        
                            <?php
                            $message=Session::get('message');
                            $cate=Session::get('cate');
                            Session::put('message',null);    
                        ?>
                         @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                        @endif
                        <a href="{{URL::to('admin/loai-sach/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/loai-sach/them')}}" method="POST">
                            
                            <div class="form-group">
                                <label>Loại sách</label>
                                <input class="form-control" name="txtTypeName" placeholder="Nhập loại sách" value="{!! old('txtTypeName')!!}" required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="cate">
                                   @foreach($cate as $c)
                                    <option value="{{$c->idCate}}">{{$c->nameCate}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select class="form-control" name="status">
                                   
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="4" id="editor1" type="text" name="txtDescription" ></textarea>
                            </div> 

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection