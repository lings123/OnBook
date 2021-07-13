@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                            <?php 
                            $message= Session::get('message'); 
                            Session::put('message',null);
                        ?>
                        @if($message!=null)
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Success</strong>
                            {{$message}}
                        </div>
                        @endif
                        <a href="{{URL::to('admin/danh-muc/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/danh-muc/them')}}" method="POST">
                            
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input class="form-control" name="txtCateName" placeholder="Nhập tên danh mục" value="{!! old('txtCateName')!!}"/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select class="form-control" name="status">
                                   
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
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