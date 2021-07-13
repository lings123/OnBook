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
                            $type=Session::get('type');
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
                        <form action="{{URL::to('admin/loai-sach/sua/'.$type->idType)}}" method="POST">
                            
                            <div class="form-group">
                                <label>Loại sách</label>
                                <input class="form-control" name="txtTypeName" placeholder="Nhập loại sách" value="{{$type->nameType}}" required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="cate">
                                   @foreach($cate as $c)
                                    <option value="{{$c->idCate}}" @if($type->idCate==$c->idCate) selected @endif>{{$c->nameCate}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select class="form-control" name="status">
                                  @if($c->status==1)
                                    <option value="1" selected>Hiện</option>
                                    <option value="0">Ẩn</option>
                                  
                                  @else
                                    <option value="1" >Hiện</option>
                                    <option value="0" selected>Ẩn</option>
                                  
                                @endif
                                   
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="4" id="editor1" type="text" name="txtDescription" >{!!$type->mota!!}</textarea>
                            </div> 

                            <button type="submit" class="btn btn-default">Sửa</button>
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