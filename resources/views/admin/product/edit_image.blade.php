@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hình ảnh
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                             @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                            <?php
                            $message=Session::get('message');
                            $product=Session::get('product');
                            $img=Session::get('img');
                            Session::put('message',null);    
                        ?>
                         @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                        @endif
                           
                        <form action="{{URL::to('admin/san-pham/hinh/sua/'.$img->idImg)}}" method="POST" enctype="multipart/form-data">
                            <div  class="form-group">
                                <label>Tên sản phẩm</label> 
                                <h4>
                                    {{$product->NameBook}}
                                </h4>
                            </div>
                            <div class="form-group">
                                <label>Hinh ảnh cũ</label>
                            </div>
                            <div class="form-group">
                                <img src="{{URL::to('uploaded/books/'.$img->NameImg)}}" width="150px" height="250px" style="border-radius: 5px;">
                            </div>
                            <div class='form-group'>
                                <label>Chọn hình ảnh</label>
                                <input type="file" name="txtHinh" width='150px' class='form-control'>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            <a href="{{URL::to('admin/san-pham/sua/'.$product->idBook)}}" class="btn btn-default">Trở về</a>
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