@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhà xuất bản
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-12" style="padding-bottom:120px">
                        
                            <?php
                            $message=Session::get('message');
                            $pub=Session::get('pub');
                            Session::put('message',null);    
                        ?>
                         @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                        @endif
                        <a href="{{URL::to('admin/nha-xuat-ban/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/nha-xuat-ban/sua/'.$pub->idPub)}}" method="POST">
                           
                            <div class="form-group">
                                <label>Tên thương hiệu</label>
                                <input class="form-control" name="txtPubName" value="{{$pub->namePub}}"/>
                            </div> 
                            <div class="form-group">
                                <label>Địa chỉ </label><br>
                                <input class="form-control" name="txtPubAdress" value="{{$pub->address_pub}}"/>
                        </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription">{!!$pub->desc_pub!!}</textarea>
                            </div> 
                            <button type="submit" class="btn btn-default">Lưu</button>
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