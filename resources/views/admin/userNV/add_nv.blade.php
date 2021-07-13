@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhân viên
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-12" style="padding-bottom:120px">
                            @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong><br>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
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
                            <a href="{{URL::to('admin/nhan-vien/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/nhan-vien/them')}}" method="POST">
                            <div class="form-group">
                                <label>Tên nhân viên</label>
                                <input class="form-control" name="txtName" placeholder="Nhập tên nhân viên"  required/>
                            </div> 
                            
                            <div class="form-group">
                                <label>Giới tính </label><br>
                                <input name="gioitinh" type="radio" value="1" checked/>Nam
                                <input name="gioitinh" type="radio" value="0" />Nữ
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" placeholder="Nhập email nhân viên" required/>
                            </div> 

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="txtPass" placeholder="Nhập password"  required/>
                            </div> 

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="txtPhone" placeholder="Nhập số điện thoại +84" required/>
                            </div> 

                            <div class="form-group">
                                <label>Chức vụ </label><br>
                                <input name="chucvu" type="radio" value="1" />Nhân viên kho
                                <input name="chucvu" type="radio" value="3" />Nhân viên giao hàng
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