@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tác giả
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-12" style="padding-bottom:120px">
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
                            <a href="{{URL::to('admin/tac-gia/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/tac-gia/them')}}" method="POST">
                            <div class="form-group">
                                <label>Tên tác giả</label>
                                <input class="form-control" name="txtAuthorName" placeholder="Nhập tên tác giả" value="{!! old('txtAuthorName')!!}" required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Giới tính </label><br>
                                <input name="gioitinh" type="radio" value="1" checked/>Nam
                                <input name="gioitinh" type="radio" value="0" />Nữ
                            </div>
                            
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" type="text" name="txtDescription" ></textarea>
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